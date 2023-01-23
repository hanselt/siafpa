<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cgm_tareaRequest;
use App\Cgm_atrimestral;
use App\Cgm_accion;
use App\Gen_coordinacion;
use App\Gen_monumento;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Cgm_atrimestralRequest;
use Validator;

class Cgm_atrimestralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resumen()
    {
      $resumen=DB::table('cgm_acciones')
                      ->join('cgm_atrimestrales','cgm_acciones.ACCI_intId','=','cgm_atrimestrales.ACCI_intId')
                      ->groupBy('cgm_acciones.ACCI_varDescripcion')
                      ->groupBy('cgm_atrimestrales.ATRI_intTrimestre')
                      ->select(DB::raw('cgm_acciones.ACCI_varDescripcion,cgm_atrimestrales.ATRI_intTrimestre,COUNT(cgm_atrimestrales.ATRI_intTrimestre) as Trimestre'))
                      ->get();
      return view('admincgm.indexresumen')->with('resumenes',$resumen);
    }
    public function index()
    {
        //
        $dni=Auth::User()->PERS_varDNI;
        $nivel=Auth::User()->nivel;
        $coordinacion=Gen_coordinacion::findCoordinacion($dni);
        $trimestrales=null;
        if ($nivel!=null) {
            # code...
            if ($nivel==1) {
                # code...
                $trimestrales=DB::table('cgm_atrimestrales')
                            ->join('cgm_acciones','cgm_acciones.ACCI_intId','=','cgm_atrimestrales.ACCI_intId')
                            ->join('gen_monumentos','gen_monumentos.MONU_intId','=','cgm_atrimestrales.MONU_intId')
                            ->join('gen_coordinaciones','gen_coordinaciones.COOR_intId','=','gen_monumentos.COOR_intId')
                            ->select('cgm_atrimestrales.*','gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_coordinaciones.COOR_varNombre','cgm_acciones.ACCI_intId','cgm_acciones.ACCI_varDescripcion','cgm_acciones.ACCI_varUnidadMedida')
                            ->orderBy('gen_coordinaciones.COOR_varNombre')
                            ->orderBy('cgm_acciones.ACCI_varDescripcion')
                            ->orderBy('cgm_atrimestrales.ATRI_intTrimestre')
                            ->get();
            }
            else{
                $trimestrales=DB::table('cgm_atrimestrales')
                          ->join('cgm_acciones','cgm_acciones.ACCI_intId','=','cgm_atrimestrales.ACCI_intId')
                          ->join('gen_monumentos','gen_monumentos.MONU_intId','=','cgm_atrimestrales.MONU_intId')
                          ->join('gen_coordinaciones','gen_coordinaciones.COOR_intId','=','gen_monumentos.COOR_intId')
                          ->where('gen_coordinaciones.COOR_intId','=',$coordinacion->COOR_intId)
                          ->select('cgm_atrimestrales.*','gen_monumentos.MONU_varCategoria','gen_monumentos.MONU_varNombre','gen_coordinaciones.COOR_varNombre','cgm_acciones.ACCI_intId','cgm_acciones.ACCI_varDescripcion','cgm_acciones.ACCI_varUnidadMedida')
                          ->orderBy('gen_monumentos.MONU_varNombre')
                          ->orderBy('cgm_acciones.ACCI_varDescripcion')
                          ->orderBy('cgm_atrimestrales.ATRI_intTrimestre')
                          ->get();
            }
        }
        
        
        return view('admincgm.indexatrimestrales')->with('trimestrales',$trimestrales);
                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //        
        $accion = Cgm_accion::find($id);              
        $monumentos=null;
        $dni=Auth::User()->PERS_varDNI;


        $coordinacion=Gen_coordinacion::findCoordinacion($dni);
        if ($coordinacion!=null) {
                    # code...
            $monumentos = DB::table('gen_monumentos')
                    ->where('gen_monumentos.COOR_intId','=',$coordinacion->COOR_intId)       
                    ->get();
        }
        return view('admincgm.cgm_atrimestral.create')->with('monumentos',$monumentos)->with('accion',$accion)->with('coordinacion',$coordinacion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cgm_atrimestralRequest $request)
    {
        //

        if ($request) {
            # code...
            $Eatrimestral=Cgm_atrimestral::where('MONU_intId',$request->MONU_intId)->where('ACCI_intId',$request->ACCI_intId)->where('ATRI_intTrimestre',$request->ATRI_intTrimestre)->first();
            if ($Eatrimestral!=null) {
                # code...
                    $mensaje='El trimestre '.$request->ATRI_intTrimestre;
                    $msj=$mensaje.' para esa acción ya fue agregado';
                    \Session::flash('msg', $msj);
                    return \Redirect::back();
                    //return \Response::json('El trimestre '.$Eatrimestral->ATRI_intTrimestre.' ya fue agregado con anterioridad, agregue otro trimestre o modifique la accion de ese trimestre');//
            }
            else
            {
                $Atrimestral=new Cgm_atrimestral;
                    $Atrimestral->ACCI_intId=$request->ACCI_intId;
                    $Atrimestral->MONU_intId=$request->MONU_intId;
                    $Atrimestral->ATRI_intTrimestre=$request->ATRI_intTrimestre;
                    $Atrimestral->ATRI_douDimension=$request->ATRI_douDimension;
                    $Atrimestral->ATRI_douCostoUnitario=$request->ATRI_douCostoUnitario;
                    $Atrimestral->ATRI_varPlanes=$request->ATRI_varPlanes;
                    $Atrimestral->ATRI_intEjecucionPresupuestal=$request->ATRI_intEjecucionPresupuestal;
                    $Atrimestral->save();
                    return redirect('admincgm/ver-atrimestrales')->with('status', 'Acción guardada con exito');
            }
        }
    }

    public function updateImagen(Request $request,$id)
    {
        //            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $atrimestral = Cgm_atrimestral::find($id);
        $accion = Cgm_accion::find($atrimestral->ACCI_intId);
        $monumentotri= Gen_monumento::find($atrimestral->MONU_intId);
        $coordinacion=Gen_coordinacion::find($monumentotri->COOR_intId);
        return view('admincgm.cgm_atrimestral.edit')->with('atrimestral',$atrimestral)->with('accion',$accion)->with('monumentotri',$monumentotri)->with('coordinacion',$coordinacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cgm_atrimestralRequest $request, $id)
    {
        //
        if ($request) {
            # code...
            
            $Atrimestral=Cgm_atrimestral::find($id);
            if ($Atrimestral->ATRI_intTrimestre==$request->ATRI_intTrimestre) {
                # code...
                $Atrimestral->ATRI_douDimension=$request->ATRI_douDimension;
                $Atrimestral->ATRI_douCostoUnitario=$request->ATRI_douCostoUnitario;
                $Atrimestral->ATRI_varPlanes=$request->ATRI_varPlanes;
                $Atrimestral->ATRI_intEjecucionPresupuestal=$request->ATRI_intEjecucionPresupuestal;
                $Atrimestral->save();
                return redirect('admincgm/ver-atrimestrales')->with('status', 'Acción guardada con exito');

            }
            else
            {

                $Eatrimestral=Cgm_atrimestral::where('MONU_intId',$request->MONU_intId)->where('ACCI_intId',$request->ACCI_intId)->where('ATRI_intTrimestre',$request->ATRI_intTrimestre)->first();
                if ($Eatrimestral!=null) {
                # code...
                    $mensaje='El trimestre '.$request->ATRI_intTrimestre;
                    $msj=$mensaje.' para esa acción ya fue agregado';
                    \Session::flash('msg', $msj);
                    return \Redirect::back();
                    //return \Response::json('El trimestre '.$Eatrimestral->ATRI_intTrimestre.' ya fue agregado con anterioridad, agregue otro trimestre o modifique la accion de ese trimestre');//
                }
                else
                {
                    $Atrimestral->ATRI_douDimension=$request->ATRI_douDimension;
                    $Atrimestral->ATRI_intTrimestre=$request->ATRI_intTrimestre;
                    $Atrimestral->ATRI_douCostoUnitario=$request->ATRI_douCostoUnitario;
                    $Atrimestral->ATRI_varPlanes=$request->ATRI_varPlanes;
                    $Atrimestral->ATRI_intEjecucionPresupuestal=$request->ATRI_intEjecucionPresupuestal;
                    $Atrimestral->save();
                    return redirect('admincgm/ver-atrimestrales')->with('status', 'Acción guardada con exito');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function createImages($id)
    {
        
        $atrimestral=Cgm_atrimestral::find($id);
        $accion = Cgm_accion::find($atrimestral->ACCI_intId);
        $monumentotri= Gen_monumento::find($atrimestral->MONU_intId);
        $coordinacion=Gen_coordinacion::find($monumentotri->COOR_intId);
        return view('admincgm.cgm_atrimestral.archivos')->with('atrimestral',$atrimestral)->with('accion',$accion)->with('monumentotri',$monumentotri)->with('coordinacion',$coordinacion);
    }
    public function storeImages(Request $request,$id)
    {
      if ($request) {
            # code...
            $atrimestral = Cgm_atrimestral::find($id);
            $path = public_path().'/archivos/cgm/acciones/';
            $pathdb='/archivos/cgm/acciones/';
            $files = $request->file('file');
            $i =0;
            foreach($files as $file){
                $ext=$file->getClientOriginalExtension();

                if($i<=0){
                          
                          $fileName = $id.'antes.'.$ext;
                          $file->move($path, $fileName);
                          $lcPath = $pathdb.$fileName;
                          $atrimestral->ATRI_varImagenAntes=$lcPath;
                          $atrimestral->save();

                         }
                elseif($i==1){
                          
                          $fileName = $id.'durante.'.$ext;
                          $file->move($path, $fileName);
                          $lcPath = $pathdb.$fileName;
                          $atrimestral->ATRI_varImagenDurante=$lcPath;
                          $atrimestral->save();
                         }
                else{
                          
                          $fileName = $id.'despues.'.$ext;
                          $file->move($path, $fileName);
                          $lcPath = $pathdb.$fileName;
                          $atrimestral->ATRI_varImagenDespues=$lcPath;
                          $atrimestral->save();
                         }
                $i++;
            }
      }
    }
    public function createDoc($id)
    {
        
        $atrimestral=Cgm_atrimestral::find($id);
        $accion = Cgm_accion::find($atrimestral->ACCI_intId);
        $monumentotri= Gen_monumento::find($atrimestral->MONU_intId);
        $coordinacion=Gen_coordinacion::find($monumentotri->COOR_intId);
        return view('admincgm.cgm_atrimestral.archivo')->with('atrimestral',$atrimestral)->with('accion',$accion)->with('monumentotri',$monumentotri)->with('coordinacion',$coordinacion);
    }
    public function storeDoc(Request $request,$id)
    {
      if ($request) {
            # code...
            $atrimestral = Cgm_atrimestral::find($id);
            $path = public_path().'/archivos/cgm/acciones/';
            $pathdb='/archivos/cgm/acciones/';
            $files = $request->file('file');
            $i =0;
            foreach($files as $file){
                $fileName = $id.'doc.pdf';
                $file->move($path, $fileName);
                $lcPath = $pathdb.$fileName;
                $atrimestral->ATRI_varDirDocumento=$lcPath;
                $atrimestral->save();
            }
      }
    }
    
}
