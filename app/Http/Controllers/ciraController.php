<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cir_Proyecto;
use App\Gen_persona;
use App\Cir_control;
use App\Cir_opinion;
use App\Cir_tramite;
use App\Http\Requests\Cir_ciraRequest;
use App\Http\Requests\Cir_antecedenteRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DatePeriod;
use DateInterval;

class ciraController extends Controller
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
	 public function index()
    {
       // $proyectos = Cia_Proyecto::all();
        $ciras = \DB::select("select * from cir_ciras");
        return view('cira.index')->with('ciras', $ciras);
    }
    public function create()
    {
      return view('admincira.cira.create');        
    }
    public function guardar(Cir_ciraRequest $request)
    {
      if ($request) {
              # code...
              $cir_control= new Cir_control;
              $cir_control->CONT_varHojaTramite=$request->CONT_varHojaTramite;
              $cir_control->CONT_varNombreProyecto=$request->CONT_varNombreProyecto;
              $cir_control->CONT_varAdminRemit=$request->CONT_varAdministradorEmpresa;
              $cir_control->CONT_varTipo=$request->CONT_varTipo;
              $cir_control->CONT_datFechaIngresoTD=$request->CONT_datFechaRecepcionTD;
              $cir_control->CONT_datFechaIngresoCC=$request->CONT_datFechaRecepcionCIRA;
              $cir_control->CONT_varAntecedente=$request->CONT_varAntecedente;
              $HRantecedente=$request->CONT_varAntecedente;
              
              $cir_control->save();
              if ($HRantecedente!='Ninguno') {
                # code...
                $cir_antecedente=Cir_control::find($HRantecedente);
                if ($cir_antecedente!=null) {
                  # code...
                  $cir_antecedente->CONT_varEstado='Antecedente-'.$request->CONT_varHojaTramite;
                  $cir_antecedente->save();
                }
              }
              return redirect('admincira/ver-cc')->with('status', 'Ingreso Agregado');

            }      
    }
    public function createantecedente()
    {
      return view('admincira.cira.antecedente');        
    }
    public function guardarantecedente(Cir_antecedenteRequest $request)
    {
      if (Auth::User()->nivel==2) {
        if ($request) {
                # code...
                $cir_control= new Cir_control;
                
                $cir_control->CONT_varHojaTramite=$request->CONT_varHojaTramite;
                $cir_control->CONT_varNombreProyecto=$request->CONT_varNombreProyecto;
                $cir_control->CONT_varAdminRemit=$request->CONT_varAdministradorEmpresa;
                $cir_control->CONT_varTipo=$request->CONT_varTipo;
                $cir_control->CONT_varEstado='Observado/Notificado';
                $cir_control->CONT_datFechaIngresoTD=$request->CONT_datFechaRecepcionTD;
                $cir_control->CONT_datFechaNotificacionUsuario=$request->CONT_datFechaNotificacionUsuario;

                $cir_control->CONT_varAntecedente=$request->CONT_varAntecedente;
                $HRantecedente=$request->CONT_varAntecedente;
                $dias=$this->numero_dias_laborables($cir_control->CONT_datFechaIngresoTD,$cir_control->CONT_datFechaNotificacionUsuario);
                if ($dias>1) {
                  # code...
                  $dias--;
                }
                if ($HRantecedente!='Ninguno') {
                  # code...
                  $cir_antecedente=Cir_control::find($HRantecedente);
                  if ($cir_antecedente!=null) {
                    # code...
                    $cir_antecedente->CONT_varEstado='Antecedente-'.$request->CONT_varHojaTramite;
                    $dias=$dias+$cir_antecedente->CONT_intDiasTramite;
                    $cir_antecedente->save();
                  }
                }
                $cir_control->CONT_intDiasTramite=$dias;
                $cir_control->save();
                return redirect('admincira/ver-cc')->with('status', 'Antecedente Agregado');

              }
      }     
    }
    public function show()
    {
        //
        
    }
    public function ShowCira($id)
    {
        $ids=explode(' ', $id);        
        $proyecto = \DB::table('cir_ciras')
                ->where('cir_ciras.CIRA_varHojaTramite','like','%'.$ids[0].'%')
                ->first();
        if ($proyecto) {
          # code...
          return view('proyectos.cira')->with('Proyecto',$proyecto);
        }
        else
          return 'No existe el Cira';
        
    }
    public function destroy($id)
    {	
       
    }
    public function store(Request $request)
    {	
    	//return "ejemplo01";
        $idCira = $request->CIRA_varHojaTramite;
        $Cira = Cir_cira::find($idCira);
        $alreadypath=$Cira->CIRA_varDirArchivoCira;

        //$ArrayPath=explode('/', $alreadypath);
        //$fileNombre= $ArrayPath[2];        
        //$exists = Storage::disk('cia')->exists($fileNombre);
        $path = 'archivos/cira/';
        $files = $request->file('file');
        $lcPath = '';
        foreach($files as $file){
            $fileName = $idCira.'-'.$file->getClientOriginalName();
            $file->move($path, $fileName);
            $lcPath = $path.$fileName;
        }


        if (is_file('/'.$alreadypath)) {
           /* Verifica si ya existe un archivo */
           //Si existe debe eliminar el archivo anterior
                  //Storage::delete('archivos/cia/'.$fileNombre);
                  $fileDel=new file;
                  $fileDel->delete($alreadypath);
                  $Cira->CIRA_varDirArchivoCira = $lcPath;
                  $Cira->save();

           } 
           else{//caso contrario solo agrega el nuevo archivo
                  $Cira->CIRA_varDirArchivoCira = $lcPath;
                  $Cira->save();
           }
        
        $ciras = \DB::select("select * from cir_ciras");
        return view('cira.index')->with('ciras', $ciras);
    }
    public function edit($id)
    {        
        $cira = Cir_cira::find($id);
        return view('cira.edit')->with('cira',$cira)
        								->with('idCira',$id);
    }
    public function update(Request $request, $id)
    {
        
    }
    public function ciras()
    {
        $ciras = \DB::table('cir_ciras')->get();

        return \Response::json($ciras);
    }
    //funciones lista antecedentes
    public function listaPmas()
    {

        $HRpma = Input::get('pma');      
        $distritos = \DB::table('cir_control')
            ->select('cir_control.CONT_varHojaTramite')   
            ->where('CONT_varEstado','=','Observado/Notificado') 
            ->where(function ($query) {
                  return $query->where('CONT_varTipo', '=','PMA')
                        ->orwhere('CONT_varTipo', '=','Levantamiento Obs. PMA')
                        ->orwhere('CONT_varTipo', '=','Reingreso PMA');
              })
            ->get();

        return \Response::json($distritos);
        
    }
    public function listaCiras()
    {

        $HRcira = Input::get('cira');
        $distritos = \DB::table('cir_control')
            ->select('cir_control.CONT_varHojaTramite')
            ->where('CONT_varEstado','=','Observado/Notificado')
            ->where(function ($query) {
                  return $query->where('CONT_varTipo', '=','CIRA')
                        ->orwhere('CONT_varTipo', '=','Levantamiento Obs. CIRA')
                        ->orwhere('CONT_varTipo', '=','Reingreso CIRA');
              })            
            ->get();

        return \Response::json($distritos);
        
    }
    public function listaIngresos()
    {
      $ListaIngresos=\DB::table('cir_control')
                      ->select('*')
                      ->where('PERS_varDNI','=',null)
                      ->where('CONT_datFechaNotificacionUsuario','=',null)
                      ->get();
      $Calificadores=\DB::table('gen_personas')
                      ->select('PERS_varNombres','PERS_varApPaterno','PERS_varApMaterno','PERS_varDNI')
                      ->where('PERS_varCargo','=','Calificador CC')
                      ->get();
      return view('admincira.indexIngresos')->with('ListaIngresos',$ListaIngresos)->with('Calificadores',$Calificadores);
    }
    public function asignarCalificador($hr,$dni)
    {
      
      $cir_control=Cir_control::find($hr);
      $persona=Gen_persona::findPersona($dni);
      $fecha=\Carbon\Carbon::now();
      
      if ($persona!=null) {
        # code...
        $cir_control->PERS_varDNI=$dni;
        $cir_control->CONT_datFechaAsignacionArqlgo=$fecha;
        $cir_control->save();
        return redirect('admincira/ver-cc')->with('status', 'Calificador Asignado');
      }
    }
    public function listarTiempos()
    {
      $tiempos=\DB::table('cir_control as C')
              ->whereNotIn('C.CONT_varHojaTramite', function($q){
                $q->select('M.CONT_varHojaTramite')->from('cir_control as M')
                ->where('CONT_varEstado','like','Antecedente%')
                ->orwhere('CONT_varEstado','like','%SDDPCDPC%')
                ->orwhere('CONT_varEstado','like','%Observado/Notificado%');
              })
              ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
              ->select('C.*','R.CONT_intDiasTramite')
              ->get();
      return view('admincira.indexTiempos')->with('tiempos',$tiempos);
    }
    public function listarIngresosCal()
    {
      $dni=Auth::User()->PERS_varDNI;
      $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.PERS_varDNI','=',$dni)
                      ->where('C.CONT_datFechaRecepcionArqlgo','=',null)
                      ->get();
      return view('admincira.indexCalRecepcion')->with('ListaExpedientes',$ListaExpedientes);
    }
    public function recepcionarExp($HR)
    {
      $Expediente=Cir_control::find($HR);
      $dni=Auth::User()->PERS_varDNI;
      $fecha=\Carbon\Carbon::now();
      if ($dni==$Expediente->PERS_varDNI) {
        # code...
        $Expediente->CONT_datFechaRecepcionArqlgo=$fecha;
        $Expediente->save();
        return redirect('admincira/ver-exp')->with('status', 'Expediente recepcionado');
      }
    }
    public function listaCalificados()
    {
      $dni=Auth::User()->PERS_varDNI;
      $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.PERS_varDNI','=',$dni)
                      ->where('C.CONT_varEstado','=',null)
                      ->where('C.CONT_datFechaRecepcionArqlgo','!=',null)
                      ->get();
      return view('admincira.indexCalificacion')->with('ListaExpedientes',$ListaExpedientes);           
    }
    //13 nov
    public function asignarEstado($hr,$estado)
    {
      if(Auth::User()->nivel==3){
      $cir_control=Cir_control::find($hr);      
      $cir_control->CONT_varEstado=$estado;
      $fecha=\Carbon\Carbon::now();
      if($estado=='Procedente' || $estado=='Improcedente'){
        $cir_opinion= new Cir_opinion();
        $cir_opinion->CONT_varHojaTramite=$cir_control->CONT_varHojaTramite;
        $cir_opinion->save();
      }
      else
      {
        if ($estado=='Observado') {
          # code...
          $cir_control->CONT_datFechaEmisionCC=$fecha;
        }                
      }
      $cir_control->save();
      return redirect('admincira/ver-calificacion')->with('status', 'Expediente calificado');
      }
    }
    //13-noviembre
    public function listaCalAsignacion()
    {
      $dni=Auth::User()->PERS_varDNI;
      $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.PERS_varDNI','=',$dni)
                      ->where('C.CONT_varEstado','=','Procedente')
                      ->orwhere('C.CONT_varEstado','=','Improcedente')
                      ->get();
      $Abogados=\DB::table('gen_personas')
                      ->select('PERS_varNombres','PERS_varApPaterno','PERS_varApMaterno','PERS_varDNI')
                      ->where('PERS_varCargo','=','Abogado CC')
                      ->orderBy('PERS_varGradoAcademico','desc')
                      ->get();
      return view('admincira.indexCalAsignacion')->with('ListaExpedientes',$ListaExpedientes)->with('Abogados',$Abogados);           
    }
    //13-noviembre
    public function asignarAbogado($hr,$dni)
    {

      $cir_opinion=Cir_opinion::find($hr);   

      $cir_control=Cir_control::find($hr);
      
      if ($cir_control->CONT_varEstado=='Improcedente') {$cir_control->CONT_varEstado='Improcedente/ABG';}    
      else{$cir_control->CONT_varEstado='Procedente/ABG';}
      $cir_control->save();     

      $fecha=\Carbon\Carbon::now();
      if($cir_opinion!=null){
        $cir_opinion->OPIN_datFechaEmisionAbg=$fecha;
        $cir_opinion->PERS_varDNI=$dni;
        $cir_opinion->save();
      }
      
      return redirect('admincira/ver-abogados')->with('status', 'Expediente asignado');
      
    }
    public function listaObs()
    {
      if(Auth::User()->nivel==2){
        $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.CONT_varEstado','=','Observado')
                      ->where('C.CONT_datFechaRecepcionCC','=',null)
                      ->get();
        return view('admincira.indexObservados')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function recepcionarObs($hr)
    {
      if (Auth::User()->nivel==2) {
        # code...
        $cir_control=Cir_control::find($hr);
        $fecha=\Carbon\Carbon::now();
        $cir_control->CONT_datFechaRecepcionCC=$fecha;
        $cir_control->save();
        return redirect('admincira/ver-observados')->with('status', 'Expediente recepcionado');
      }
    }
    public function listaOficiar()
    {
      if(Auth::User()->nivel==2){
        $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->where('C.CONT_varEstado','=','Observado')
                      ->where('C.CONT_datFechaRecepcionCC','!=',null)
                      ->get();
        return view('admincira.indexOficiados')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function oficiar($hr,$fecha)
    {
      $cir_control=Cir_control::find($hr);
      
      if (Auth::User()->nivel==2) {
        
        if ($cir_control!=null) {
          # code...
          $cir_control->CONT_datFechaNotificacionUsuario=$fecha;
          $cir_control->CONT_varEstado='Observado/Notificado';
          $dias=$this->numero_dias_laborables($cir_control->CONT_datFechaIngresoTD,$fecha);
          if ($dias>1) {
            # code...
            $dias--;
          }
          if ($cir_control->CONT_varAntecedente!='Ninguno') {
            # code...
            $cir_antecedente=Cir_control::find($cir_control->CONT_varAntecedente);
            if ($cir_antecedente!=null) {
              # code...
              $dias=$dias+$cir_antecedente->CONT_intDiasTramite;
            }
          }
          $cir_control->CONT_intDiasTramite=$dias;
          $cir_control->save();
          return redirect('admincira/ver-oficiados')->with('status', 'El Expediente '.$hr.' fue Oficiado');
        }
      }      
    }
    public function recepcionarAbg()
    {
      if (Auth::User()->nivel==4) {
        # code...      
        $dni=Auth::User()->PERS_varDNI;
        $ListaExpedientes=\DB::table('cir_control as C')
                      ->join('cir_opinion as OP','C.CONT_varHojaTramite','=','OP.CONT_varHojaTramite')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','OP.*','R.CONT_intDiasTramite')
                      ->where('OP.OPIN_datFechaRecepcionAbg','=',null)
                      ->where('OP.OPIN_datFechaEmisionAbg','!=',null)
                      ->where('OP.PERS_varDNI','=',$dni)
                      ->get();
        return view('admincira.indexAbgRecepcion')->with('ListaExpedientes',$ListaExpedientes);
      }
    }
    public function recepcionarAbogado($hr)
    {
      if (Auth::User()->nivel==4) {
        # code...
        $cir_opinion=Cir_opinion::find($hr);
        $fecha=\Carbon\Carbon::now();
        $dni=Auth::User()->PERS_varDNI;
        $textRH='Expediente recepcionado : '.$hr;
        if ($cir_opinion!=null) {
          # code...
          if ($cir_opinion->PERS_varDNI==$dni) {
            # code...
            $cir_control=Cir_control::find($hr);
            $textRH=$textRH.' '.$cir_control->CONT_varTipo;
            $cir_opinion->OPIN_datFechaRecepcionAbg=$fecha;
            $cir_opinion->save();
          }          
        }
        return redirect('admincira/recepcionarAbg')->with('status', $textRH);
      }
    }
    public function listaCalificarAbg(){
      if (Auth::User()->nivel==4) {
        # code...
        $lista_abg=\DB::table('cir_control as C')
                      ->join('cir_opinion','C.CONT_varHojaTramite','=','cir_opinion.CONT_varHojaTramite')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->select('C.*','R.CONT_intDiasTramite')                      
                      ->where('cir_opinion.OPIN_datFechaRecepcionAbg','!=',null)
                      ->where('C.CONT_varEstado','=','Procedente/ABG')
                      ->orwhere('C.CONT_varEstado','=','Improcedente/ABG')
                      ->get();
        return view('admincira.indexCalificacionAbg')->with('ListaExpedientes',$lista_abg);
      }
    }
    public function AbogadoCal($hr,$estado){
      $dni=Auth::User()->PERS_varDNI;
      $cir_control=Cir_control::find($hr);
      $cir_opinion=Cir_opinion::find($hr);
      if (Auth::User()->nivel==4) {
        # code...
        if ($cir_opinion!=null) {
          # code...
          if ($cir_opinion->PERS_varDNI==$dni) {
            # code...
            if ($estado=='Procedente'){$cir_control->CONT_varEstado='Procedente/CC';}else
            if ($estado=='Improcedente'){$cir_control->CONT_varEstado='Improcedente/CC';}else
            if ($estado=='Observado'){$cir_control->CONT_varEstado='Observado/CC';}else
            {$cir_control->CONT_varEstado='Decaído/CC';}
            $cir_control->save();

            $textRH='El expediente ('.$hr.') se declaro: '.$estado.' y fue enviado la Coordinación de Certificaciones';
            $fecha=\Carbon\Carbon::now();
            $cir_control->CONT_datFechaEmisionCC=$fecha;
            $cir_control->save();
            //fin estado calificarAbg
            return redirect('admincira/calificarAbg')->with('status', $textRH);
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
        return view('admincira.recepcion.create');        
      }
    }
    public function recepcionarCertificaciones(Request $request){
      //}
      if(Auth::User()->nivel==2){
        $hr=$request->hr;
            $cir_control=\DB::table('cir_control as C')                            
                            ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                            ->select('C.*','R.CONT_intDiasTramite')                      
                            ->where('C.CONT_datFechaEmisionCC','!=',null)
                            ->where('C.CONT_varEstado','!=','Observado')
                            ->where('C.CONT_datFechaRecepcionCC','=',null)
                            ->where('C.CONT_varHojaTramite','=',$hr)
                            ->first();
            
            if ($cir_control!=null) {
                # code...
                $cir_opinion=Cir_opinion::find($hr);
                $calificador=Gen_persona::find($cir_control->PERS_varDNI);
                $abogado=Gen_persona::find($cir_opinion->PERS_varDNI);
      
                $fecha=\Carbon\Carbon::now();
                $cir_tramite=Cir_control::find($hr);
                $estado=$cir_tramite->CONT_varEstado;
                $estado=$estado.'-R';
                $cir_tramite->CONT_datFechaRecepcionCC=$fecha;
                $cir_tramite->CONT_varEstado=$estado;
                $cir_tramite->save();
                return view('admincira.recepcion.create')->with('Expediente',$cir_control)->with('Calificador',$calificador)->with('Abogado',$abogado); 
              
            }
            else{
              $cir_control=Cir_control::find($hr);
              if ($cir_control!=null) {
      
                # code...
                if ($cir_control->CONT_varEstado=='Observado') {
                  # code...
                  $mensaje='El '.$cir_control->CONT_varTipo.' debe ser recepcionado y notificado.';
                }
                else if($cir_control->CONT_varEstado=='Observado/Notificado'){
                  $mensaje='El '.$cir_control->CONT_varTipo.' fue notificado como Observado.';
                }
                else{
                  $EEstado=$cir_control->CONT_varEstado;
                  $estado=explode("-", $EEstado);
                  if (sizeof($estado)>1) {
                    # code...
                    if ($estado[1]=='R') {
                      # code...
                      $mensaje='El '.$cir_control->CONT_varTipo.' ya fue recepcionado.';
                    }
                    else $mensaje='El '.$cir_control->CONT_varTipo.' ya fue enviado.';
                  }else
                  $mensaje='El '.$cir_control->CONT_varTipo.' está siendo calificado.';
                }
                return view('admincira.recepcion.create')->with('Iniciado',$cir_control)->with('Mensaje',$mensaje);
              }else{
                $textoError=$hr;
                return view('admincira.recepcion.create')->with('Error',$textoError);
              }
            }
          }
      ////////////////
    }
    public function listaEnviar()
    {
      if (Auth::User()->nivel==2) {
        # code...

        $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_varEstado','like','%-R')   
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->get();

        return view('admincira.indexEnviarAFPA')->with('ListaExpedientes',$ListaExpedientes);        
      }
      //
    }
    public function enviarAFPA($hr){
      //
      if (Auth::User()->nivel==2) {
        $ListaExpedientes=\DB::table('cir_control')
                      ->where('cir_control.CONT_varEstado','like','%-R')   
                      ->where('cir_control.CONT_varHojaTramite','=',$hr)
                      ->select('cir_control.*')
                      ->get();
        if ($ListaExpedientes!=null) {
          # code...
          $fecha=\Carbon\Carbon::now();
          $cir_control=Cir_control::find($hr);
            $estado=$cir_control->CONT_varEstado;
            $estado=$estado.'-AFPA';
            $cir_control->CONT_varEstado=$estado;
          $cir_control->save();
          $cir_tramite=new Cir_tramite();
          $cir_tramite->CONT_varHojaTramite=$cir_control->CONT_varHojaTramite;
          $cir_tramite->TRAM_datFechaEmisionAFPA=$fecha;
          $cir_tramite->save();
          $texto='Expediente '.$hr.' enviado al Área Funcional de Patrimonio Arqueológico.';
          return redirect('admincira/enviar-afpa')->with('status', $texto);
        }
        else{
          return redirect('admincira/enviar-afpa')->with('status', 'No corresponde');
        }
        
      }
    }
    //funciones AFPA

    public function recepcionAFPA(){
      //
     // if (Auth::User()->nivel==2) {
        # code...
        return view('admin.recepcion.create');        
      // }
    }
    public function recepcionarPatrimonio(Request $request){
      //
      if(Auth::User()->nivel==2){
        $hr=$request->hr;
            $cir_control=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_varEstado','like','%AFPA')
                      ->where('C.CONT_varHojaTramite','=',$hr)
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->first();
        if ($cir_control!=null) {
          # code...
          $control=Cir_control::find($hr);
            $estado=$control->CONT_varEstado;
            $estado=$estado.'R';
            $control->CONT_varEstado=$estado;
          $control->save();
          $fecha=\Carbon\Carbon::now();
          $cir_tramite=Cir_tramite::find($hr);
          $cir_tramite->TRAM_datFechaRecepcionAFPA=$fecha;
          $cir_tramite->save();
          $cir_opinion=Cir_opinion::find($hr);
          $calificador=Gen_persona::find($cir_control->PERS_varDNI);
          $abogado=Gen_persona::find($cir_opinion->PERS_varDNI);
          return view('admin.recepcion.create')->with('Expediente',$cir_control)->with('Calificador',$calificador)->with('Abogado',$abogado); 
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
        $ListaExpedientes=\DB::table('cir_control as C')
                      ->leftjoin('cir_control as R','C.CONT_varAntecedente','=','R.CONT_varHojaTramite')
                      ->where('C.CONT_varEstado','like','%AFPAR')
                      ->select('C.*','R.CONT_intDiasTramite')
                      ->get();

        return view('admin.indexEnviarSDDPCDPC')->with('ListaExpedientes',$ListaExpedientes);   
        
      }
      //
    }
    public function enviarSD($hr){
      //inicio
      if (Auth::User()->nivel==2) {
        $ListaExpedientes=\DB::table('cir_control')
                      ->where('cir_control.CONT_varEstado','like','%AFPAR')
                      ->where('cir_control.CONT_varHojaTramite','=',$hr)
                      ->select('cir_control.*')
                      ->get();
        if ($ListaExpedientes!=null) {
          # code...
          $fecha=\Carbon\Carbon::now();
          $cir_control=Cir_control::find($hr);
          $cir_tramite=Cir_tramite::find($hr);
          $cir_tramite->TRAM_datFechaEmisionSD=$fecha;
          $cir_tramite->save();
          $estado=$cir_control->CONT_varEstado.'-SDDPCDPC';
          $cir_control->CONT_varEstado=$estado;
          $cir_control->save();
          $texto='Expediente '.$hr.' enviado a Sub Dirección.';
          //si esta aprobado crear un registro cir_cira o cir_pma
          return redirect('admin/enviar-sddpcdpc')->with('status', $texto);
        }
        else{
          return redirect('admin/enviar-sddpcdpc')->with('status', 'No corresponde');
        }
        
      }
      //fin
    }
    //dias de trabajo
    
    //-----
}
