<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gen_monumento;
use App\Gen_ubigeo;
use App\Gen_coordinacion;
use App\Gen_imagenes_monumento;
use App\Cgm_atrimestral;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Gen_monumentoRequest;
use Illuminate\Support\Facades\Auth;

class Gen_monumentoController extends Controller
{
    //    
    public function indexfromAdmin()
    {
        //return view('gen_persona.index',compact('listado'));
        /*
         * $monumentos = Gen_monumento::all();
        return view('admin.indexmonumentos',compact('monumentos'));
         */


        $monumentos = DB::table('gen_monumentos')
                                ->join('gen_coordinaciones','gen_monumentos.COOR_intId','=','gen_coordinaciones.COOR_intId')
                                ->select('gen_coordinaciones.COOR_varNombre','gen_monumentos.*')
                                ->orderBy('gen_coordinaciones.COOR_intId')
                                ->get();

        return view('admincatastro.indexmonumentos')->with('monumentos',$monumentos);
    }
    public function create()
    {
        //$depubigeos = Gen_ubigeo::where('UBIG_varProvinciaId','00')->get();
        $depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        $coordinaciones = DB::table('gen_coordinaciones')->get();
        //$depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        //$monumentos = Gen_monumento::all();
        //\Session::flash('msg', 'Thanks for voting');
        return view('admincatastro.gen_monumento.create')->with('depubigeos',$depubigeos)->with('coordinaciones',$coordinaciones);
    }

    public function store(Gen_monumentoRequest $request)
    {


        if ($request) {
            $Monumento=new Gen_monumento;
            $Monumento->UBIG_varID=$request->UBIG_varID;
            $Monumento->MONU_varDU=$request->MONU_varDU;
            $Monumento->COOR_intId=$request->COOR_intId;
            $Monumento->MONU_varNombre=$request->MONU_varNombre;
            $Monumento->MONU_varCategoria=$request->MONU_varCategoria;
            $Monumento->MONU_varTipo=$request->MONU_varTipo;
            $Monumento->MONU_varEstado=$request->MONU_varEstado;
            $Monumento->MONU_varDescripcion='';
            $Monumento->MONU_varDescripcionArquitectura='';
            $Monumento->MONU_varHorarioAtencion='';
            $Monumento->MONU_varEtimologia='';
            $Monumento->MONU_douCoordenadaLatitud=$request->MONU_douCoordenadaLatitud;
            $Monumento->MONU_douCoordenadaLongitud=$request->MONU_douCoordenadaLongitud;
            $Monumento->MONU_varDirVideo='';                
            $Monumento->MONU_varDirArchivoKML='';
            $Monumento->MONU_varDirArchivoREDeclaratoria='';
            $Monumento->MONU_varDirArchivoREDelimitacion='';
            $Monumento->save();
            return redirect('admincatastro/ver-monumentos')->with('status', 'Monumento  guardado con exito');
        }


    }
    public function edit($id)
    {
        $depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        $coordinaciones = DB::table('gen_coordinaciones')->get();
        
        $monumentos = DB::table('gen_monumentos')
                                ->join('gen_ubigeos as d','d.UBIG_varID','=','gen_monumentos.UBIG_varID')
                                ->join('gen_ubigeos as p','d.UBIG_varPadre','=','p.UBIG_varID')
                                ->join('gen_ubigeos as dd','p.UBIG_varPadre','=','dd.UBIG_varID')
                                ->join('gen_coordinaciones','gen_monumentos.COOR_intId','=','gen_coordinaciones.COOR_intId')
                                ->select('dd.UBIG_varNombre as Departamento','dd.UBIG_varID as DepartamentoId','p.UBIG_varNombre as Provincia','p.UBIG_varID as ProvinciaId','d.UBIG_varNombre as Distrito','d.UBIG_varID as DistritoId','gen_coordinaciones.COOR_varNombre','gen_monumentos.*')
                                ->where('gen_monumentos.MONU_intId','=',$id)
                                ->get();
        
        return view('admincatastro.gen_monumento.edit')->with('depubigeos',$depubigeos)->with('coordinaciones',$coordinaciones)->with('monumentos',$monumentos);
    }
    public function update(Gen_monumentoRequest $request,$id)
    {
        if ($request) {
            # code...
            $Monumento=Gen_monumento::find($id);
            $Monumento->UBIG_varID=$request->UBIG_varID;
            $Monumento->COOR_intId=$request->COOR_intId;
            $Monumento->MONU_varNombre=$request->MONU_varNombre;
            $Monumento->MONU_varCategoria=$request->MONU_varCategoria;
            $Monumento->MONU_varTipo=$request->MONU_varTipo;
            $Monumento->MONU_varEstado=$request->MONU_varEstado;
            $Monumento->MONU_douCoordenadaLatitud=$request->MONU_douCoordenadaLatitud;
            $Monumento->MONU_douCoordenadaLongitud=$request->MONU_douCoordenadaLongitud;
            $Monumento->MONU_varDU=$request->MONU_varDU;
            $Monumento->save();
            return redirect('admincatastro/ver-monumentos')->with('status', 'Monumento  actualizado con exito');            
        }
    }
    public function createImages($id)
    {
        $monumento=Gen_monumento::find($id);
        return view('admincgm.gen_monumento.archivos')->with('monumento',$monumento);
    }
    public function storeImages(Request $request,$id)
    {
        if ($request) {
            # code...
            $monumento = Gen_monumento::find($id);
            $path = public_path().'/archivos/cgm/img/';
            $pathdb='/archivos/cgm/img/';
            $files = $request->file('file');
            foreach($files as $file){
                //$ext=$file->getClientOriginalExtension();
                $numeroImagenes= DB::table('gen_imagenes_monumentos')
                                    ->where('gen_imagenes_monumentos.MONU_intId','=',$id)->count();
                if($numeroImagenes<9)
                {
                    $name=$file->getClientOriginalName();
                    $fileName = $id.$name;
                    $file->move($path, $fileName);
                    $lcPath = $pathdb.$fileName;
                    $ImagenMonumento=new Gen_imagenes_monumento;
                    $ImagenMonumento->MONU_intId=$id;
                    $ImagenMonumento->IMAG_varDirImagen =$lcPath;
                    $ImagenMonumento->IMAG_varNombre=$fileName;
                    $ImagenMonumento->IMAG_booEstado=1;
                    $ImagenMonumento->save();
                }
                else
                {
                    $Imagen = DB::table('gen_imagenes_monumentos')
                                    ->where('gen_imagenes_monumentos.MONU_intId','=',$id)
                                    ->where('gen_imagenes_monumentos.IMAG_booEstado','=',0)->first();
                    if ($Imagen) {
                        # code...
                        $file->move($path,$Imagen->IMAG_varNombre);
                        $ImagenMonumento=Gen_imagenes_monumento::find($Imagen->IMAG_intId);
                        $ImagenMonumento->IMAG_booEstado=1;
                        $ImagenMonumento->save();                        
                    }
                }

            }
        }
    }
    public function createArchivos($id)
    {
        $depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        $coordinaciones = DB::table('gen_coordinaciones')->get();
        $monumentos = DB::table('gen_monumentos')
                                ->join('gen_ubigeos as d','d.UBIG_varID','=','gen_monumentos.UBIG_varID')
                                ->join('gen_ubigeos as p','d.UBIG_varPadre','=','p.UBIG_varID')
                                ->join('gen_ubigeos as dd','p.UBIG_varPadre','=','dd.UBIG_varID')
                                ->join('gen_coordinaciones','gen_monumentos.COOR_intId','=','gen_coordinaciones.COOR_intId')
                                ->select('dd.UBIG_varNombre as Departamento','dd.UBIG_varID as DepartamentoId','p.UBIG_varNombre as Provincia','p.UBIG_varID as ProvinciaId','d.UBIG_varNombre as Distrito','d.UBIG_varID as DistritoId','gen_coordinaciones.COOR_varNombre','gen_monumentos.*')
                                ->where('gen_monumentos.MONU_intId','=',$id)
                                ->get();
        return view('admincatastro.gen_monumento.archivos')->with('depubigeos',$depubigeos)->with('coordinaciones',$coordinaciones)->with('monumentos',$monumentos);
    }
    public function storeArchivos(Request $request,$id)
    {
        if($request){        
        $monumento = Gen_monumento::find($id);
        $path = public_path().'/archivos/catastro/declaratoria/';
        $path2 = public_path().'/archivos/catastro/delimitacion/';
        $path3 = public_path().'/archivos/catastro/kml/';
        $pathdb='/archivos/catastro/declaratoria/';
        $pathdb2='/archivos/catastro/delimitacion/';
        $pathdb3='/archivos/catastro/kml/';
        $files = $request->file('file');
        
        $lcPath = '';
        $lcPath2 = '';
        $lcPath3 = '';
        $cont=1;

        foreach($files as $file){
            $ext=$file->getClientOriginalExtension();
            if ($ext=='pdf') {
                    # code...
                if($cont==1)
                {
                    $fileName = $id.'decl.'.$ext;
                    $file->move($path, $fileName);
                    $lcPath = $pathdb.$fileName;
                    $cont++;
                }
                else
                {
                    $fileName = $id.'deli.'.$ext;
                    $file->move($path2, $fileName);
                    $lcPath2 = $pathdb2.$fileName;
                }
            }    
            else
            {
                $fileName = $id.'kml.'.$ext;
                $file->move($path3, $fileName);
                $lcPath3 = $pathdb3.$fileName;
            }
                            
            
        }
        
          
        $monumento->MONU_varDirArchivoREDeclaratoria = $lcPath;
        $monumento->MONU_varDirArchivoREDelimitacion = $lcPath2;
        $monumento->MONU_varDirArchivoKML = $lcPath3;
        $monumento->save();
        //////// ///// ///// ///// /// //        
        return redirect('admincatastro/ver-monumentos')->with('status', 'informacion actualizacda');        
        }
    }
    public function editar($id)
    {
        $monumento=Gen_monumento::find($id);
        return view('admincgm.gen_monumento.edit')->with('monumento',$monumento);
    }
    public function actualizar(Request $request,$id)
    {
        if ($request) {
            # code...
            $Monumento=Gen_monumento::find($id);
            $Monumento->MONU_varDescripcion=$request->MONU_varDescripcion;
            $Monumento->MONU_varDescripcionArquitectura=$request->MONU_varDescripcionArquitectura;
            $Monumento->MONU_varEtimologia=$request->MONU_varEtimologia;
            $Monumento->MONU_varDirVideo=$request->MONU_varDirVideo;
            $Monumento->MONU_varHorarioAtencion=$request->MONU_varHorarioAtencion;
            $Monumento->save();
            return redirect('admincgm/ver-monumentos')->with('status', 'Monumento  actualizado con exito');            
        }
    }
    public function indexCgm()
    {
        $dni=Auth::User()->PERS_varDNI;
        $nivel=Auth::User()->nivel;
        $coordinacion=Gen_coordinacion::findCoordinacion($dni);
        if($coordinacion!=null)
        {
        if($nivel==2)
        {
        
        
            $monumentos = DB::table('gen_monumentos')
                                ->join('gen_coordinaciones','gen_monumentos.COOR_intId','=','gen_coordinaciones.COOR_intId')
                                ->select('gen_coordinaciones.COOR_varNombre','gen_monumentos.*')
                                ->where('gen_coordinaciones.COOR_intId','=',$coordinacion->COOR_intId)
                                ->orderBy('gen_monumentos.MONU_varNombre')
                                ->get();
        }
        else
        {
            $monumentos = DB::table('gen_monumentos')
                                ->join('gen_coordinaciones','gen_monumentos.COOR_intId','=','gen_coordinaciones.COOR_intId')
                                ->select('gen_coordinaciones.COOR_varNombre','gen_monumentos.*')
                                ->orderBy('gen_coordinaciones.COOR_varNombre','gen_monumentos.MONU_varNombre')
                                ->get();
        }

        return view('admincgm.indexmonumentos')->with('monumentos',$monumentos);            
        }
    }
    public function monumento()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->leftJoin( DB::raw( 
                                '(SELECT MAX( cgm_atrimestrales.ATRI_intId ),cgm_atrimestrales.* FROM cgm_atrimestrales GROUP BY MONU_intId DESC) as AA' ), function( $leftJoin)
                                {
                                    $leftJoin->on( 'AA.MONU_intId', '=', 'gen_monumentos.MONU_intId' );
                                })
                            ->leftJoin('cgm_acciones','cgm_acciones.ACCI_intId','=','AA.ACCI_intId')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','AA.ATRI_intTrimestre','AA.ATRI_varImagenAntes','AA.ATRI_varImagenDurante','AA.ATRI_varImagenDespues','cgm_acciones.ACCI_varDescripcion')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Arqueológico Prehispánico')
                            ->get();
                            /*
        ->select('first_name', 'TotalCatches.*')

        ->join(DB::raw('(SELECT user_id, COUNT(user_id) TotalCatch, DATEDIFF(NOW(), MIN(created_at)) Days, COUNT(user_id)/DATEDIFF(NOW(), MIN(created_at)) CatchesPerDay FROM `catch-text` GROUP BY user_id) TotalCatches'), function($join)
        {
            $join->on('users.id', '=', 'TotalCatches.user_id');
        })
        ->orderBy('TotalCatches.CatchesPerDay', 'DESC')
        ->get();*/        


        return \Response::json($monumentos);
    }
    public function showmonumento()
    {
        $nombremonumento = Input::get('nombremonumento');

        $monumentos = \DB::table('gen_monumentos')
                        ->where('MONU_varNombre','like','%'.$nombremonumento.'%')
                        ->select('MONU_douCoordenadaLongitud','MONU_douCoordenadaLatitud','MONU_varNombre')
                        ->first();

        return \Response::json($monumentos);
    }
    public function getItemID(Request $request){
        
        $lcIdMonumento = $request->idMonumento;
        // Obtener datos del monumento
        $lcMonumento = Gen_monumento::find($lcIdMonumento);
        // Obtener imagenes
        $lcImagenes = Gen_imagenes_monumento::where('MONU_intId',$lcIdMonumento)->where('IMAG_booEstado',1)->get();
        // Obtener Actividades trimestrales
        $lcActividades = DB::table('cgm_atrimestrales')
            ->join('cgm_acciones', 'cgm_atrimestrales.ACCI_intId', '=', 'cgm_acciones.ACCI_intId')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('MONU_intId',$lcIdMonumento)
            ->select('cgm_atrimestrales.*', 'cgm_acciones.ACCI_varDescripcion')
            ->get();
        
        //echo $lcIdMonumento;
        //dd($lcActividades);
        return view('monumentos.vistaindividual')
            ->with('lcMonumento',$lcMonumento)
            ->with('lcImagenes',$lcImagenes)
            ->with('lcActividades',$lcActividades);

    }
    public function ImagenesDeMonumento()
    {
        $idmonumento = Input::get('idmonumento');
        $imagenes=\DB::table('gen_imagenes_monumentos')
                        ->where('gen_imagenes_monumentos.MONU_intId','=',$idmonumento)
                        ->select('gen_imagenes_monumentos.IMAG_varDirImagen')
                        ->get();
        return \Response::json($imagenes);
    }
    public function editarImagenes($id)
    {
        $imagenes = DB::table('gen_imagenes_monumentos')
                    ->where('gen_imagenes_monumentos.MONU_intId','=',$id)
                    ->get();
        $monumento=Gen_monumento::find($id);
        return view('admincgm.gen_monumento.editarimagenes')->with('imagenes',$imagenes)->with('monumento',$monumento);
    }
    public function actualizarImagenes($id)
    {
        $imagen = Gen_imagenes_monumento::find($id);
        $imagen->IMAG_booEstado=0;
        $imagen->save();
        return redirect('admincgm/monumento/imagenes/'.$imagen->MONU_intId);
    }
    public function atrimestral()
    {
        $idmonumento = Input::get('idmonumento');
        $monumentos=DB::table('cgm_atrimestrales')
                        ->join('cgm_acciones','cgm_atrimestrales.ACCI_intId','=','cgm_acciones.ACCI_intId')
                        ->where('cgm.MONU_intId','=',$idmonumento)
                        ->select('cgm_atrimestrales.*','cgm_acciones.ACCI_varDescripcion')
                        ->orderBy('cgm_atrimestrales.ATRI_intId','desc')
                        ->first();

        return \Response::json($monumentos);        
    }
    public function nombres()
    {
        $monumentos=DB::table('gen_monumentos')
                        ->select('gen_monumentos.MONU_varNombre')
                        ->where('gen_monumentos.MONU_varTipo','=','Monumento Arqueológico Prehispánico')
                        ->get();
        return \Response::json($monumentos);
    }
    public function monumentoindividual()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->leftJoin('gen_imagenes_monumentos','gen_imagenes_monumentos.MONU_intId','=','gen_monumentos.MONU_intId')
                            ->select('gen_monumentos.MONU_intId','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varDescripcion','gen_monumentos.MONU_varEtimologia','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_varHorarioAtencion','gen_imagenes_monumentos.IMAG_varDirImagen')
                            ->groupBy('gen_monumentos.MONU_intId','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varDescripcion','gen_monumentos.MONU_varEtimologia','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_varHorarioAtencion')
                            ->get();


        return \Response::json($monumentos);
    }

    public function MAPidentificado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Arqueológico Prehispánico')
                            ->where('gen_monumentos.MONU_varEstado','=','Identificado')
                            ->get();
        return \Response::json($monumentos);
    }
    public function MAPregistrado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado','MONU_varDirArchivoREDeclaratoria','MONU_varDirArchivoREDelimitacion')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Arqueológico Prehispánico')
                            ->where('gen_monumentos.MONU_varEstado','=','Registrado')
                            ->get();
        return \Response::json($monumentos);
    }
    public function MAPsaneado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado','MONU_varDirArchivoREDeclaratoria','MONU_varDirArchivoREDelimitacion')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Arqueológico Prehispánico')
                            ->where('gen_monumentos.MONU_varEstado','=','Saneado')
                            ->get();
        return \Response::json($monumentos);
    }
    ////Monumento Historico Villreynal y Republicano
    public function MHVRidentificado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Historico Virreinal y Republicano')
                            ->where('gen_monumentos.MONU_varEstado','=','Identificado')
                            ->get();
        return \Response::json($monumentos);
    }
    public function MHVRregistrado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado','MONU_varDirArchivoREDeclaratoria','MONU_varDirArchivoREDelimitacion')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Historico Virreinal y Republicano')
                            ->where('gen_monumentos.MONU_varEstado','=','Registrado')
                            ->get();
        return \Response::json($monumentos);
    }
    public function MHVRsaneado()
    {

        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado','MONU_varDirArchivoREDeclaratoria','MONU_varDirArchivoREDelimitacion')
                            ->where('gen_monumentos.MONU_varTipo','=','Monumento Historico Virreinal y Republicano')
                            ->where('gen_monumentos.MONU_varEstado','=','Saneado')
                            ->get();
        return \Response::json($monumentos);
    }
    public function AHregistrado()
    {
        $monumentos = \DB::table('gen_monumentos')
                            ->select('gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_monumentos.MONU_intId','gen_monumentos.MONU_douCoordenadaLatitud','gen_monumentos.MONU_douCoordenadaLongitud','gen_monumentos.MONU_varEstado','MONU_varDirArchivoREDeclaratoria','MONU_varDirArchivoREDelimitacion')
                            ->where('gen_monumentos.MONU_varTipo','=','Áreas Históricas')
                            ->get();
        return \Response::json($monumentos);        
    }
}
