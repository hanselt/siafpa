<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cgm_tareaRequest;
use App\Cgm_tarea;
use App\Cgm_actividad;

class Cgm_tareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tareas = DB::table('cgm_tareas')
                    ->orderBy('cgm_tareas.ACTI_intId')        
                    ->get();

        return view('admincgm.indextareas', ['tareas' => $tareas]);
    }
    public function buscar($id)
    {
        $tareas = DB::table('cgm_tareas')
                    ->where('cgm_tareas.ACTI_intId','=',$id)       
                    ->get();
        $buscado=true;

        return view('admincgm.indextareas')->with('tareas',$tareas)->with('buscado',$buscado);        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $actividades=Cgm_actividad::all();
        return view('admincgm.cgm_tarea.create')->with('actividades',$actividades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cgm_tareaRequest $request)
    {          
        //
        
        if ($request) {
            # code...
            $tarea= new Cgm_tarea;
            $tarea->ACTI_intId=$request->ACTI_intId;
            $tarea->TARE_varUnidadMedida=$request->TARE_varUnidadMedida;
            $tarea->TARE_varDescripcion=$request->TARE_varDescripcion;
            $tarea->save();
            return redirect('admincgm/ver-tareas')->with('status', 'Tarea  guardada con exito');
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
        $tarea = Cgm_tarea::find($id);
        $actividades=Cgm_actividad::all();
        // show the edit form and pass the nerd

        return view('admincgm.cgm_tarea.edit')->with('tarea', $tarea)->with('actividades',$actividades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cgm_tareaRequest $request, $id)
    {
        //
        if ($request) {
            # code...
            $tarea= Cgm_tarea::find($id);
            $tarea->ACTI_intId=$request->ACTI_intId;
            $tarea->TARE_varUnidadMedida=$request->TARE_varUnidadMedida;
            $tarea->TARE_varDescripcion=$request->TARE_varDescripcion;
            $tarea->save();
            return redirect('admincgm/ver-tareas')->with('status', 'Tarea  guardada con exito');
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
