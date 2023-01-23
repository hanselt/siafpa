<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cgm_actividadRequest;
use App\Cgm_actividad;

class Cgm_actividadController extends Controller
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
        
        return view('admincgm.cgm_actividad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cgm_actividadRequest $request)
    {
        //
        if($request)
        {
            $Actividad=new Cgm_actividad;
            $Actividad->ACTI_intYear=$request->ACTI_intYear;
            $Actividad->ACTI_varUnidadMedida=$request->ACTI_varUnidadMedida;
            $Actividad->ACTI_varDescripcion=$request->ACTI_varDescripcion;
            $Actividad->save();
            return redirect('admincgm/ver-actividades')->with('status', 'Actividad  guardada con exito');
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
        $actividad = Cgm_actividad::find($id);

        // show the edit form and pass the nerd

        return view('admincgm.cgm_actividad.edit', compact('actividad', $actividad));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cgm_actividadRequest $request, $id)
    {
        //
        if($request)
        {

            $Actividad=Cgm_actividad::find($id);
            $Actividad->ACTI_intYear=$request->ACTI_intYear;
            $Actividad->ACTI_varUnidadMedida=$request->ACTI_varUnidadMedida;
            $Actividad->ACTI_varDescripcion=$request->ACTI_varDescripcion;
            $Actividad->save();
            return redirect('admincgm/ver-actividades')->with('status', 'Actividad  guardada con exito');
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
    public function indexfromAdmin()
    {
        $actividades = DB::table('cgm_actividades')        
                    ->orderBy('ACTI_intYear', 'asc')
                    ->paginate(15);

        return view('admincgm.indexactividades', ['actividades' => $actividades]);
    }
}
