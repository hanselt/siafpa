<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gen_persona;
use App\Cia_control;
use App\Cia_opinion;
use App\Cia_tramite;
use App\Http\Requests\Cia_Request;
use App\Http\Requests\Cia_antecedenteRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;

class ciaController extends Controller
{
    public function numero_dias_laborables($from, $to) {
      $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
      $holidayDays = ['*-12-25', '*-01-01','2017-11-16','2017-11-01','2017-12-25','2017-12-08']; # variable and fixed holidays

      $from = new DateTime($from);
      $to = new DateTime($to);
      $to->modify('+1 day');
      $interval = new DateInterval('P1D');
      $periods = new DatePeriod($from, $interval, $to);

      $days = 0;
      foreach ($periods as $period) {
          if (!in_array($period->format('N'), $workingDays)) continue;
          if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
          if (in_array($period->format('*-m-d'), $holidayDays)) continue;
          $days++;
      }
      return $days;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $proyectos = Cia_Proyecto::all();
        $cias = \DB::select("select * from cia_proyectos");
        return view('cia.index')->with('cias', $cias);
    }
    public function create()
    {
      return view('admincalificacion.cia.create');        
    }
    public function guardar(Cia_Request $request)
    {
      if ($request) {
              # code...
              $cia_control= new Cia_control;
              $cia_control->CONT_varHojaTramite=$request->CONT_varHojaTramite;
              $cia_control->CONT_varNombreProyecto=$request->CONT_varNombreProyecto;
              $cia_control->CONT_varAdminRemit=$request->CONT_varAdministradorEmpresa;
              $cia_control->CONT_varTipo=$request->CONT_varTipo;
              $cia_control->CONT_datFechaIngresoTD=$request->CONT_datFechaRecepcionTD;
              $cia_control->CONT_datFechaIngresoCCIA=$request->CONT_datFechaIngresoCCIA;
              $cia_control->CONT_varAntecedente=$request->CONT_varAntecedente;
              $HRantecedente=$request->CONT_varAntecedente;
              
              $cia_control->save();
              if ($HRantecedente!='Ninguno') {
                # code...
                $cir_antecedente=Cia_control::find($HRantecedente);
                if ($cir_antecedente!=null) {
                  # code...
                  $cir_antecedente->CONT_varEstado='Antecedente-'.$request->CONT_varHojaTramite;
                  $cir_antecedente->save();
                }
              }
              return redirect('admincalificacion/ver-ccia')->with('status', 'Ingreso Agregado');

            }      
    }
    public function show()
    {
        //
        
    }
    public function Showcia($id)
    {
        $ids=explode(' ', $id);        
        $proyecto = \DB::table('cir_cias')
                ->where('cir_cias.cia_varHojaTramite','like','%'.$ids[0].'%')
                ->first();
        if ($proyecto) {
          # code...
          return view('proyectos.cia')->with('Proyecto',$proyecto);
        }
        else
          return 'No existe el cia';
        
    }
    public function destroy($id)
    { 
       
    }
    public function store(Request $request)
    { 
      //return "ejemplo01";
        $idcia = $request->cia_varHojaTramite;
        $cia = Cir_cia::find($idcia);
        $alreadypath=$cia->cia_varDirArchivocia;

        //$ArrayPath=explode('/', $alreadypath);
        //$fileNombre= $ArrayPath[2];        
        //$exists = Storage::disk('cia')->exists($fileNombre);
        $path = 'archivos/cia/';
        $files = $request->file('file');
        $lcPath = '';
        foreach($files as $file){
            $fileName = $idcia.'-'.$file->getClientOriginalName();
            $file->move($path, $fileName);
            $lcPath = $path.$fileName;
        }


        if (is_file('/'.$alreadypath)) {
           /* Verifica si ya existe un archivo */
           //Si existe debe eliminar el archivo anterior
                  //Storage::delete('archivos/cia/'.$fileNombre);
                  $fileDel=new file;
                  $fileDel->delete($alreadypath);
                  $cia->cia_varDirArchivocia = $lcPath;
                  $cia->save();

           } 
           else{//caso contrario solo agrega el nuevo archivo
                  $cia->cia_varDirArchivocia = $lcPath;
                  $cia->save();
           }
        
        $cias = \DB::select("select * from cir_cias");
        return view('cia.index')->with('cias', $cias);
    }
    public function edit($id)
    {        
        $cia = Cir_cia::find($id);
        return view('cia.edit')->with('cia',$cia)
                        ->with('idcia',$id);
    }
    public function update(Request $request, $id)
    {
        
    }
    public function cias()
    {
        $cias = \DB::table('cir_cias')->get();

        return \Response::json($cias);
    }
    //funciones lista antecedentes
    public function listaPmas()
    {

        $HRpma = Input::get('pma');      
        $distritos = \DB::table('cia_control')
            ->select('cia_control.CONT_varHojaTramite')   
            ->where('CONT_varEstado','=','Observado/Notificado') 
            ->where(function ($query) {
                  return $query->where('CONT_varTipo', '=','PMA')
                        ->orwhere('CONT_varTipo', '=','Levantamiento Obs. PMA')
                        ->orwhere('CONT_varTipo', '=','Reingreso PMA');
              })
            ->get();

        return \Response::json($distritos);
        
    }
    public function listacias()
    {

        $HRcia = Input::get('cia');
        $distritos = \DB::table('cia_control')
            ->select('cia_control.CONT_varHojaTramite')
            ->where('CONT_varEstado','=','Observado/Notificado')            
            ->get();

        return \Response::json($distritos);
        
    }
    public function listaIngresos()
    {
      $ListaIngresos=\DB::table('cia_control')
                      ->select('*')
                      ->where('PERS_varDNI','=',null)
                      ->where('CONT_datFechaNotificacionUsuario','=',null)
                      ->get();
      $Calificadores=\DB::table('gen_personas')
                      ->select('PERS_varNombres','PERS_varApPaterno','PERS_varApMaterno','PERS_varDNI')
                      ->where('PERS_varCargo','=','Calificador CCIA')
                      ->get();
      return view('admincalificacion.indexIngresos')->with('ListaIngresos',$ListaIngresos)->with('Calificadores',$Calificadores);
    }
    public function asignarCalificador($hr,$dni)
    {
      
      $cia_control=Cia_control::find($hr);
      $persona=Gen_persona::findPersona($dni);
      $fecha=\Carbon\Carbon::now();
      
      if ($persona!=null) {
        # code...
        $cia_control->PERS_varDNI=$dni;
        $cia_control->CONT_datFechaAsignacionArqlgo=$fecha;
        $cia_control->save();
        return redirect('admincalificacion/ver-ccia')->with('status', 'Calificador Asignado');
      }
    }
    public function listarTiempos()
    {
      $tiempos=\DB::table('cia_control')
              ->whereNotIn('cia_control.CONT_varHojaTramite', function($q){
                $q->select('M.CONT_varHojaTramite')->from('cia_control as M')
                ->where('CONT_varEstado','like','Antecedente%')
                ->orwhere('CONT_varEstado','like','%SDDPCDPC%')
                ->orwhere('CONT_varEstado','like','%Observado/Notificado%');
              })
              ->get();
      return view('admincalificacion.indexTiempos')->with('tiempos',$tiempos);
    }
    public function listarIngresosCal()
    {
      $dni=Auth::User()->PERS_varDNI;
      $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.PERS_varDNI','=',$dni)
                      ->where('C.CONT_datFechaRecepcionArqlgo','=',null)
                      ->get();
      return view('admincalificacion.indexCalRecepcion')->with('ListaExpedientes',$ListaExpedientes);
    }
    public function recepcionarExp($HR)
    {
      $Expediente=Cia_control::find($HR);
      $dni=Auth::User()->PERS_varDNI;
      $fecha=\Carbon\Carbon::now();
      if ($dni==$Expediente->PERS_varDNI) {
        # code...
        $Expediente->CONT_datFechaRecepcionArqlgo=$fecha;
        $Expediente->save();
        return redirect('admincalificacion/ver-exp')->with('status', 'Expediente recepcionado');
      }
    }
    //areas
    public function listaAreas()
    {
      if(Auth::User()->nivel==3){
        $dni=Auth::User()->PERS_varDNI;
        $ListaExpedientes=\DB::table('cia_control as C')
                        ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                        ->select('C.*','R.CONT_intDiasTramite')
                        ->where('C.PERS_varDNI','=',$dni)
                        ->where('C.CONT_datFechaEnvioAreasTecnicas','=',null)
                        ->where('C.CONT_datFechaRecepcionArqlgo','!=',null)
                        ->get();
        return view('admincalificacion.areas.indexAreasEnvio')->with('ListaExpedientes',$ListaExpedientes);   
        }        
    }
    public function asignarAreas($hr,$areas)
    {
      if(Auth::User()->nivel==3){
        $dni=Auth::User()->PERS_varDNI;
        $cia_control=Cia_control::find($hr);      
        //$cia_control->CONT_varEstado=$estado;
        $fecha=\Carbon\Carbon::now();
        if ($cia_control->PERS_varDNI==$dni) {
          # code...
          $cia_control->CONT_varAreas=$areas;
          $cia_control->CONT_datFechaEnvioAreasTecnicas=$fecha;
        }
        $cia_control->save();
        return redirect('admincalificacion/ver-areas')->with('status', 'Enviado para opinion de áreas');
      }
    }
    public function listaAreasR()
    {
      if(Auth::User()->nivel==3){
        $dni=Auth::User()->PERS_varDNI;
        $ListaExpedientes=\DB::table('cia_control as C')
                        ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                        ->select('C.*','R.CONT_intDiasTramite')
                        ->where('C.PERS_varDNI','=',$dni)
                        ->where('C.CONT_datFechaEnvioAreasTecnicas','!=',null)
                        ->where('C.CONT_datFechaRecepcionArqlgo','!=',null)
                        ->where('C.CONT_datFechaRecepcionAreasTecnicas','=',null)
                        ->get();
        return view('admincalificacion.areas.indexAreasRecepcion')->with('ListaExpedientes',$ListaExpedientes);   
        }        
    }
    public function recepcionarAreas($hr,$areas)
    {
      if(Auth::User()->nivel==3){
        $dni=Auth::User()->PERS_varDNI;
        $cia_control=Cia_control::find($hr);      
        //$cia_control->CONT_varEstado=$estado;
        $fecha=\Carbon\Carbon::now();
        if ($cia_control->PERS_varDNI==$dni) {
          # code...
          $cia_control->CONT_varRespuestaAreas=$areas;
          $cia_control->CONT_datFechaRecepcionAreasTecnicas=$fecha;
        }
        $cia_control->save();
        return redirect('admincalificacion/ver-rareas')->with('status','Recepcionado con opiniones: '.$areas);
      }
    }
    //fin areas    
    public function listaCalificados()
    {
      $dni=Auth::User()->PERS_varDNI;
      $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.PERS_varDNI','=',$dni)
                      ->where('C.CONT_varEstado','=',null)
                      ->where('C.CONT_datFechaRecepcionArqlgo','!=',null)
                      ->where('C.CONT_datFechaRecepcionAreasTecnicas','!=',null)
                      ->get();
      return view('admincalificacion.indexCalificacion')->with('ListaExpedientes',$ListaExpedientes);           
    }
    //13 nov
    public function asignarEstado($hr,$estado)
    {
      if(Auth::User()->nivel==3){
      $cia_control=Cia_control::find($hr);      
      $cia_control->CONT_varEstado=$estado;
      $fecha=\Carbon\Carbon::now();
      if($estado=='Procedente' || $estado=='Improcedente'){
        $cia_opinion= new Cia_opinion();
        $cia_opinion->CONT_varHojaTramite=$cia_control->CONT_varHojaTramite;
        $cia_opinion->save();
      }
      else
      {
        if ($estado=='Observado') {
          # code...
          $cia_control->CONT_datFechaEmisionCCIA=$fecha;
        }                
      }
      $cia_control->save();
      return redirect('admincalificacion/ver-calificacion')->with('status', 'Expediente calificado');
      }
    }
    //13-noviembre
    public function listaCalAsignacion()
    {
      if (Auth::User()->nivel==3) {
        # code...
        $dni=Auth::User()->PERS_varDNI;
        $ListaExpedientes=\DB::table('cia_control as C')
                        ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                        ->select('C.*','R.CONT_intDiasTramite')
                        ->where('C.PERS_varDNI','=',$dni)
                        ->where('C.CONT_varEstado','=','Procedente')
                        ->orwhere('C.CONT_varEstado','=','Improcedente')
                        ->get();
        $Abogados=\DB::table('gen_personas')
                        ->select('PERS_varNombres','PERS_varApPaterno','PERS_varApMaterno','PERS_varDNI')
                        ->where('PERS_varCargo','=','Abogado CCIA')
                        ->orderBy('PERS_varGradoAcademico','desc')
                        ->get();
        return view('admincalificacion.indexCalAsignacion')->with('ListaExpedientes',$ListaExpedientes)->with('Abogados',$Abogados);   
      }        
    }
    //13-noviembre
    public function asignarAbogado($hr,$dni)
    {

      $cia_opinion=Cia_opinion::find($hr);   

      $cia_control=Cia_control::find($hr);
      
      if ($cia_control->CONT_varEstado=='Improcedente') {$cia_control->CONT_varEstado='Improcedente/ABG';}    
      else{$cia_control->CONT_varEstado='Procedente/ABG';}
      $cia_control->save();     

      $fecha=\Carbon\Carbon::now();
      if($cia_opinion!=null){
        $cia_opinion->OPIN_datFechaEmisionAbg=$fecha;
        $cia_opinion->PERS_varDNI=$dni;
        $cia_opinion->save();
      }
      
      return redirect('admincalificacion/ver-abogados')->with('status', 'Expediente asignado');
      
    }
    public function listaObs()
    {
      if(Auth::User()->nivel==2){
        $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.CONT_varEstado','=','Observado')
                      ->where('C.CONT_datFechaRecepcionCCIA','=',null)
                      ->get();
        return view('admincalificacion.indexObservados')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function recepcionarObs($hr)
    {
      if (Auth::User()->nivel==2) {
        # code...
        $cia_control=Cia_control::find($hr);
        $fecha=\Carbon\Carbon::now();
        $cia_control->CONT_datFechaRecepcionCCIA=$fecha;
        $cia_control->save();
        return redirect('admincalificacion/ver-observados')->with('status', 'Expediente recepcionado');
      }
    }
    public function listaOficiar()
    {
      if(Auth::User()->nivel==2){
        $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.CONT_varEstado','=','Observado')
                      ->where('C.CONT_datFechaRecepcionCCIA','!=',null)
                      ->get();
        return view('admincalificacion.indexOficiados')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function oficiar($hr,$fecha)
    {
      $cia_control=Cia_control::find($hr);
      
      if (Auth::User()->nivel==2) {
        
        if ($cia_control!=null) {
          # code...
          $cia_control->CONT_datFechaNotificacionUsuario=$fecha;
          $cia_control->CONT_varEstado='Observado/Notificado';
          $dias=$this->numero_dias_laborables($cia_control->CONT_datFechaIngresoTD,$fecha);
          if ($dias>1) {
            # code...
            $dias--;
          }
          if ($cia_control->CONT_varAntecedente!='Ninguno') {
            # code...
            $cir_antecedente=Cia_control::find($cia_control->CONT_varAntecedente);
            if ($cir_antecedente!=null) {
              # code...
              $dias=$dias+$cir_antecedente->CONT_intDiasTramite;
            }
          }
          $cia_control->CONT_intDiasTramite=$dias;
          $cia_control->save();
          return redirect('admincalificacion/ver-oficiados')->with('status', 'El Expediente '.$hr.' fue Oficiado');
        }
      }      
    }
    public function recepcionarAbg()
    {
      if (Auth::User()->nivel==4) {
        # code...      
        $dni=Auth::User()->PERS_varDNI;
        $ListaExpedientes=\DB::table('cia_control as C')
                      ->join('cia_opinion as OP','C.CONT_varHojaTramite','=','OP.CONT_varHojaTramite')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','OP.*','R.CONT_intDiasTramite')
                      ->where('OP.OPIN_datFechaRecepcionAbg','=',null)
                      ->where('OP.OPIN_datFechaEmisionAbg','!=',null)
                      ->where('OP.PERS_varDNI','=',$dni)
                      ->get();
        return view('admincalificacion.indexAbgRecepcion')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function recepcionarAbogado($hr)
    {
      if (Auth::User()->nivel==4) {
        # code...
        $cia_opinion=Cia_opinion::find($hr);
        $fecha=\Carbon\Carbon::now();
        $dni=Auth::User()->PERS_varDNI;
        $textRH='Expediente recepcionado : '.$hr;
        if ($cia_opinion!=null) {
          # code...
          if ($cia_opinion->PERS_varDNI==$dni) {
            # code...
            $cia_control=Cia_control::find($hr);
            $textRH=$textRH.' '.$cia_control->CONT_varTipo;
            $cia_opinion->OPIN_datFechaRecepcionAbg=$fecha;
            $cia_opinion->save();
          }          
        }
        return redirect('admincalificacion/recepcionarAbg')->with('status', $textRH);
      }
    }
    public function listaCalificarAbg(){
      if (Auth::User()->nivel==4) {
        # code...
        $lista_abg=\DB::table('cia_control as C')
                      ->join('cia_opinion','C.CONT_varHojaTramite','=','cia_opinion.CONT_varHojaTramite')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')                      
                      ->where('cia_opinion.OPIN_datFechaRecepcionAbg','!=',null)
                      ->where('C.CONT_varEstado','=','Procedente/ABG')
                      ->orwhere('C.CONT_varEstado','=','Improcedente/ABG')
                      ->get();
        return view('admincalificacion.indexCalificacionAbg')->with('ListaExpedientes',$lista_abg);
      }
    }
    public function AbogadoCal($hr,$estado){
      $dni=Auth::User()->PERS_varDNI;
      $cia_control=Cia_control::find($hr);
      $cia_opinion=Cia_opinion::find($hr);
      if (Auth::User()->nivel==4) {
        # code...
        if ($cia_opinion!=null) {
          # code...
          if ($cia_opinion->PERS_varDNI==$dni) {
            # code...
            if ($estado=='Procedente'){$cia_control->CONT_varEstado='Procedente/CC';}else
            if ($estado=='Improcedente'){$cia_control->CONT_varEstado='Improcedente/CC';}else
            if ($estado=='Observado'){$cia_control->CONT_varEstado='Observado/CC';}else
            {$cia_control->CONT_varEstado='Decaído/CC';}
            $cia_control->save();

            $textRH='El expediente ('.$hr.') se declaro: '.$estado.' y fue enviado la Coordinación de Certificaciones';
            $fecha=\Carbon\Carbon::now();
            $cia_control->CONT_datFechaEmisionCCIA=$fecha;
            $cia_control->save();
            //fin estado calificarAbg
            return redirect('admincalificacion/calificarAbg')->with('status', $textRH);
          }
        }
      }//
    }
    ///
    public function recepcionarCC()
    {
      ///
      if (Auth::User()->nivel==2) {
        # code...
        return view('admincalificacion.recepcion.create');        
      }
    }
    public function recepcionarCalificaciones(Request $request){
      //}
      if(Auth::User()->nivel==2){
        $hr=$request->hr;
            $cia_control=\DB::table('cia_control as C')                            
                            ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                            ->select('C.*','R.CONT_intDiasTramite')                      
                            ->where('C.CONT_datFechaEmisionCCIA','!=',null)
                            ->where('C.CONT_varEstado','!=','Observado')
                            ->where('C.CONT_datFechaRecepcionCCIA','=',null)
                            ->where('C.CONT_varHojaTramite','=',$hr)
                            ->first();
            
            if ($cia_control!=null) {
                # code...
                $cia_opinion=Cia_opinion::find($hr);
                $calificador=Gen_persona::find($cia_control->PERS_varDNI);
                $abogado=Gen_persona::find($cia_opinion->PERS_varDNI);
      
                $fecha=\Carbon\Carbon::now();
                $cir_tramite=Cia_control::find($hr);
                $estado=$cir_tramite->CONT_varEstado;
                $estado=$estado.'-R';
                $cir_tramite->CONT_datFechaRecepcionCCIA=$fecha;
                $cir_tramite->CONT_varEstado=$estado;
                $cir_tramite->save();
                return view('admincalificacion.recepcion.create')->with('Expediente',$cia_control)->with('Calificador',$calificador)->with('Abogado',$abogado); 
              
            }
            else{
              $cia_control=Cia_control::find($hr);
              if ($cia_control!=null) {
      
                # code...
                if ($cia_control->CONT_varEstado=='Observado') {
                  # code...
                  $mensaje='El '.$cia_control->CONT_varTipo.' debe ser recepcionado y notificado.';
                }
                else if($cia_control->CONT_varEstado=='Observado/Notificado'){
                  $mensaje='El '.$cia_control->CONT_varTipo.' fue notificado como Observado.';
                }
                else{
                  $EEstado=$cia_control->CONT_varEstado;
                  $estado=explode("-", $EEstado);
                  if (sizeof($estado)>1) {
                    # code...
                    if ($estado[1]=='R') {
                      # code...
                      $mensaje='El '.$cia_control->CONT_varTipo.' ya fue recepcionado.';
                    }
                    else $mensaje='El '.$cia_control->CONT_varTipo.' ya fue enviado.';
                  }else
                  $mensaje='El '.$cia_control->CONT_varTipo.' está siendo calificado.';
                }
                return view('admincalificacion.recepcion.create')->with('Iniciado',$cia_control)->with('Mensaje',$mensaje);
              }else{
                $textoError=$hr;
                return view('admincalificacion.recepcion.create')->with('Error',$textoError);
              }
            }
          }
      ////////////////
    }
    public function listaEnviar()
    {
      if (Auth::User()->nivel==2) {
        # code...

        $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_tramite','C.CONT_varHojaTramite','=','cia_tramite.CONT_varHojaTramite')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_datFechaRecepcionCCIA','!=',null)
                      ->where('C.CONT_varEstado','not like','%Observado%')
                      ->where('cia_tramite.CONT_varHojaTramite','=',null)
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->get();

        return view('admincalificacion.indexEnviarAFPA')->with('ListaExpedientes',$ListaExpedientes);        
      }
      //
    }
    public function enviarAFPA($hr){
      //
      if (Auth::User()->nivel==2) {
        $ListaExpedientes=\DB::table('cia_control')
                      ->leftjoin('cia_tramite','cia_control.CONT_varHojaTramite','=','cia_tramite.CONT_varHojaTramite')
                      ->where('cia_control.CONT_datFechaRecepcionCCIA','!=',null)
                      ->where('cia_control.CONT_varEstado','not like','%Observado%')
                      ->where('cia_tramite.CONT_varHojaTramite','=',null)
                      ->where('cia_control.CONT_varHojaTramite','=',$hr)
                      ->select('cia_control.*')
                      ->get();
        if ($ListaExpedientes!=null) {
          # code...
          $fecha=\Carbon\Carbon::now();
          $cia_control=Cia_control::find($hr);
          $cia_tramite=new Cia_tramite();
          $cia_tramite->CONT_varHojaTramite=$cia_control->CONT_varHojaTramite;
          $cia_tramite->TRAM_datFechaEmisionAFPA=$fecha;
          $cia_tramite->save();
          $texto='Expediente '.$hr.' enviado al Área Funcional de Patrimonio Arqueológico.';
          return redirect('admincalificacion/enviar-afpa')->with('status', $texto);
        }
        else{
          return redirect('admincalificacion/enviar-afpa')->with('status', 'No corresponde');
        }
        
      }
    }
    //funciones AFPA

    public function recepcionAFPA(){
      //
      if (Auth::User()->nivel==2) {
        # code...
        return view('admin.recepcion.create');        
      }
    }
    public function recepcionarPatrimonio(Request $request){
      //
      if(Auth::User()->nivel==2){
        $hr=$request->hr;
            $cia_control=\DB::table('cia_control as C')
                      ->leftjoin('cia_tramite','C.CONT_varHojaTramite','=','cia_tramite.CONT_varHojaTramite')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_datFechaRecepcionCC','!=',null)
                      ->where('C.CONT_varEstado','not like','%Observado%')
                      ->where('cia_tramite.CONT_varHojaTramite','!=',null)
                      ->where('cia_tramite.TRAM_datFechaRecepcionAFPA','=',null)
                      ->where('C.CONT_varHojaTramite','=',$hr)
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->first();
        if ($cia_control!=null) {
          # code...
          $fecha=\Carbon\Carbon::now();
          $cia_tramite=Cia_tramite::find($hr);
          $cia_tramite->TRAM_datFechaRecepcionAFPA=$fecha;
          $cia_tramite->save();
          $cir_opinion=Cir_opinion::find($hr);
          $calificador=Gen_persona::find($cia_control->PERS_varDNI);
          $abogado=Gen_persona::find($cir_opinion->PERS_varDNI);
          return view('admin.recepcion.create')->with('Expediente',$cia_control)->with('Calificador',$calificador)->with('Abogado',$abogado); 
        }
        else{
          //
          return view('admin.recepcion.create')->with('Error','El expediente :'.$hr.' no corresponde');
        }
      }
    }

    public function listaSD(){
      //
      if (Auth::User()->nivel==2) {
        $ListaExpedientes=\DB::table('cia_control as C')
                      ->leftjoin('cia_tramite','C.CONT_varHojaTramite','=','cia_tramite.CONT_varHojaTramite')
                      ->leftjoin('cia_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_datFechaRecepcionCC','!=',null)
                      ->where('C.CONT_varEstado','not like','%Observado%')
                      ->where('cia_tramite.CONT_varHojaTramite','!=',null)
                      ->where('cia_tramite.TRAM_datFechaRecepcionAFPA','!=',null)
                      ->where('cia_tramite.TRAM_datFechaEmisionSD','=',null)
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->get();

        return view('admin.indexEnviarSDDPCDPC')->with('ListaExpedientes',$ListaExpedientes);   
        
      }
      //
    }
    public function enviarSD($hr){
      //inicio
      if (Auth::User()->nivel==2) {
        $ListaExpedientes=\DB::table('cia_control')
                      ->leftjoin('cia_tramite','cia_control.CONT_varHojaTramite','=','cia_tramite.CONT_varHojaTramite')
                      ->where('cia_control.CONT_datFechaRecepcionCC','!=',null)
                      ->where('cia_control.CONT_varEstado','not like','%Observado%')
                      ->where('cia_tramite.TRAM_datFechaEmisionSD','=',null)
                      ->where('cia_tramite.TRAM_datFechaRecepcionAFPA','!=',null)
                      ->where('cia_control.CONT_varHojaTramite','=',$hr)
                      ->select('cia_control.*')
                      ->get();
        if ($ListaExpedientes!=null) {
          # code...
          $fecha=\Carbon\Carbon::now();
          $cia_control=Cia_control::find($hr);
          $cir_tramite=Cir_tramite::find($hr);
          $cir_tramite->TRAM_datFechaEmisionSD=$fecha;
          $cir_tramite->save();
          $estado=$cia_control->CONT_varEstado.'SDDPCDPC';
          $cia_control->CONT_varEstado=$estado;
          $cia_control->save();
          $texto='Expediente '.$hr.' enviado a Sub Dirección.';
          //si esta aprobado crear un registro cir_cia o cir_pma
          return redirect('admin/enviar-sddpcdpc')->with('status', $texto);
        }
        else{
          return redirect('admin/enviar-sddpcdpc')->with('status', 'No corresponde');
        }
        
      }
      //fin
    }
    //ANTECEDENTES
    public function createantecedente()
    {
      return view('admincalificacion.cia.antecedente');        
    }
    public function guardarantecedente(Cia_antecedenteRequest $request)
    {
      if (Auth::User()->nivel==2) {
        if ($request) {
                # code...
                $cia_control= new Cia_control;
                
                $cia_control->CONT_varHojaTramite=$request->CONT_varHojaTramite;
                $cia_control->CONT_varNombreProyecto=$request->CONT_varNombreProyecto;
                $cia_control->CONT_varAdminRemit=$request->CONT_varAdministradorEmpresa;
                $cia_control->CONT_varTipo=$request->CONT_varTipo;
                $cia_control->CONT_varEstado='Observado/Notificado';
                $cia_control->CONT_datFechaIngresoTD=$request->CONT_datFechaRecepcionTD;
                $cia_control->CONT_datFechaNotificacionUsuario=$request->CONT_datFechaNotificacionUsuario;

                $cia_control->CONT_varAntecedente=$request->CONT_varAntecedente;
                $HRantecedente=$request->CONT_varAntecedente;
                $dias=$this->numero_dias_laborables($cia_control->CONT_datFechaIngresoTD,$cia_control->CONT_datFechaNotificacionUsuario);
                if ($dias>1) {
                  # code...
                  $dias--;
                }
                if ($HRantecedente!='Ninguno') {
                  # code...
                  $cir_antecedente=Cia_control::find($HRantecedente);
                  if ($cir_antecedente!=null) {
                    # code...
                    $cir_antecedente->CONT_varEstado='Antecedente-'.$request->CONT_varHojaTramite;
                    $dias=$dias+$cir_antecedente->CONT_intDiasTramite;
                    $cir_antecedente->save();
                  }
                }
                $cia_control->CONT_intDiasTramite=$dias;
                $cia_control->save();
                return redirect('admincalificacion/ver-ccia')->with('status', 'Antecedente Agregado');

              }
      }     
    }

}
