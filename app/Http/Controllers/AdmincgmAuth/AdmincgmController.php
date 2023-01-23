<?php

namespace App\Http\Controllers\AdmincgmAuth;

use Illuminate\Http\Request;
use App\Gen_coordinacion;
use App\Gen_ubigeo;
use App\Gen_persona;
use App\Admincgm;
use App\Http\Requests\Gen_coordinacionRequest;
use App\Http\Requests\CoordinacionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdmincgmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    /*
     * Metodos CRUD para Administrat las
     * coordinaciones
     */


    public function createCoordinacion()
    {        
        $depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();        

        return view('admincgm.gen_coordinacion.create')->with('depubigeos',$depubigeos)->with('personas',$personas);
    }

    public function storeCoordinacion(Gen_coordinacionRequest $request)
    {
        if ($request) {            

            $coordinacion=new Gen_coordinacion();
            $coordinacion->UBIG_varID=$request->UBIG_varID;
            $coordinacion->PERS_varDNI=$request->PERS_varDNI;
            $coordinacion->COOR_varNombre=$request->COOR_varNombre;
            $coordinacion->COOR_varResenaHistorica=$request->COOR_varResenaHistorica;
            $fecha= Carbon::parse($request->COOR_datFechaCreacion)->format('Y-m-d');
            $coordinacion->COOR_datFechaCreacion=$fecha;
            $coordinacion->COOR_varDireccion=$request->COOR_varDireccion;
            $coordinacion->COOR_varHorarioAtencion=$request->COOR_varHorarioAtencion;
            $coordinacion->COOR_varCoordenadaLatitud=$request->CoordenadaLatitud;
            $coordinacion->COOR_varCoordenadaLongitud=$request->CoordenadaLongitud;
            $coordinacion->save();
            return redirect('admincgm/ver-coordinaciones')->with('status', 'Coordinación  guardada con exito');
        }

    }


    public function editCoordinacion($id)
    {
        // mostrar formulario de edicion
        $coordinacion = Gen_coordinacion::find($id);
        $ubig=$coordinacion->UBIG_varID;
        $ubigeoactual= Gen_ubigeo::find($ubig); 
        $idd=$ubigeoactual->UBIG_varId;       
        $Aubigeos=DB::table('gen_ubigeos as Ud')
                     ->join('gen_ubigeos as Up','Up.UBIG_varPadre','=','Ud.UBIG_varId')
                     ->join('gen_ubigeos as Ut','Ut.UBIG_varPadre','=','Up.UBIG_varId')
                     ->where('Ut.UBIG_varId','=',$idd)                        
                     ->select('Ut.UBIG_varNombre as Distrito','Ut.UBIG_varId as DistritoId','Up.UBIG_varNombre as Provincia','Up.UBIG_varId as ProvinciaId','Ud.UBIG_varNombre as Departamento','Ud.UBIG_varId as DepartamentoId')
                     ->get();
        
        
        //dd($Aubigeos2[57].$Aubigeos2[58].$Aubigeos2[59].$Aubigeos2[60].$Aubigeos2[61]);
        $Apersona=Gen_persona::find($coordinacion->PERS_varDNI);
        $depubigeos= DB::table('gen_ubigeos')->where('UBIG_varProvinciaId','=','00')->get();
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();
        // show the edit form and pass the nerd
        
        return view('admincgm.gen_coordinacion.edit')->with('coordinacion', $coordinacion)->with('depubigeos',$depubigeos)->with('personas',$personas)->with('Aubigeos',$Aubigeos)->with('Apersonas',$Apersona);

    }

    public function updateCoordinacion(CoordinacionUpdateRequest $request, $id)
    {
        

        $coordinacion = Gen_coordinacion::find($id);
        //$coordinacion->update($request->all());
            $coordinacion->UBIG_varID=$request->UBIG_varID;
            $coordinacion->PERS_varDNI=$request->PERS_varDNI;
            $coordinacion->COOR_varNombre=$request->COOR_varNombre;
            $coordinacion->COOR_varResenaHistorica=$request->COOR_varResenaHistorica;
            $fecha= Carbon::parse($request->COOR_datFechaCreacion)->format('Y-m-d');
            $coordinacion->COOR_datFechaCreacion=$fecha;
            $coordinacion->COOR_varDireccion=$request->COOR_varDireccion;
            $coordinacion->COOR_varHorarioAtencion=$request->COOR_varHorarioAtencion;
            $coordinacion->COOR_varCoordenadaLatitud=$request->CoordenadaLatitud;
            $coordinacion->COOR_varCoordenadaLongitud=$request->CoordenadaLongitud;
            $coordinacion->save();

        return redirect('admincgm/ver-coordinaciones')->with('status', 'informacion actualizacda');
    }
    public function editPassword($id)
    {
        $admin=Admincgm::find($id);
        return view('admincgm.password')->with('admin',$admin);
    }
    public function updatePassword(Request $request,$id)
    {
        if ($request) {
            # code...

            $Admincgm=Admincgm::find($id);
            if($request->password1!='')
            {
                $Admincgm->password=bcrypt($request->password1);
                $Admincgm->save();
                return redirect('admincgm/perfil')->with('status','Contraseña cambiada');
            }
            else
            {
                $admin=Admincgm::find($id);
                return view('admincgm.password')->with('admin',$admin);
            }
        }
        else
            $admin=Admincgm::find($id);
                return view('admincgm.password')->with('admin',$admin);
    }

}
