<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cgm_accionRequest;
use App\Cgm_actividad;
use App\Cgm_tarea;
use App\Cgm_accion;

class Cgm_accionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acciones = DB::table('cgm_acciones')
                    ->orderBy('cgm_acciones.TARE_intId')        
                    ->get();

        return view('admincgm.indexacciones', ['acciones' => $acciones]);
    }
    public function buscar($id)
    {
        $acciones = DB::table('cgm_acciones')
                    ->where('cgm_acciones.TARE_intId','=',$id)        
                    ->get();
        $buscado=true;
        return view('admincgm.indexacciones')->with('acciones',$acciones)->with('buscado',$buscado);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tareas=Cgm_tarea::all();
        return view('admincgm.cgm_accion.create')->with('tareas',$tareas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cgm_accionRequest $request)
    {
        //
        if ($request) {            
            # code...
            $accion= new Cgm_accion;
            $accion->TARE_intId=$request->TARE_intId;
            $accion->ACCI_varUnidadMedida=$request->ACCI_varUnidadMedida;
            $accion->ACCI_varDescripcion=$request->ACCI_varDescripcion;
            $accion->save();
            return redirect('admincgm/ver-acciones')->with('status', 'Acción  guardada con exito');
        }
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
        $accion = Cgm_accion::find($id);
        $tareas=Cgm_tarea::all();
        // show the edit form and pass the nerd

        return view('admincgm.cgm_accion.edit')->with('accion', $accion)->with('tareas',$tareas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cgm_accionRequest $request, $id)
    {
        //
        if ($request) {
            # code...
            $accion= Cgm_accion::find($id);
            $accion->TARE_intId=$request->TARE_intId;
            $accion->ACCI_varUnidadMedida=$request->ACCI_varUnidadMedida;
            $accion->ACCI_varDescripcion=$request->ACCI_varDescripcion;
            $accion->save();
            return redirect('admincgm/ver-acciones')->with('status', 'Acción  actualizada con exito');
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
}
