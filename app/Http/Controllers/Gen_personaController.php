<?php

namespace App\Http\Controllers;

use App\Gen_coordinacion;
use App\Gen_persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Gen_personaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado=Gen_persona::all();
        return view('gen_persona.index',compact('listado'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gen_persona.create');
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
    public function show($PERS_varDNI)
    {
        //$persona = Gen_persona::findPersona($PERS_varDNI);
        //return view::make('gen_persona.single')->with('gen_persona',$persona);
        $persona = Gen_persona::find($PERS_varDNI);

        return view('gen_persona.single')->with('gen_persona', $persona);
        //return view::make('gen_persona.single', ['gen_persona' => Gen_persona::findPersona($PERS_varDNI)]);
        //return view('user.profile', ['user' => User::findOrFail($id)]);
        //return view('gen_persona.single', ['gen_persona' => Gen_persona::findPersona($PERS_varDNI)]);
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
    public function archivo(Request $request)
    {

    }

    /*
     * Metodos creados por Diego
     */

    public function indexfromAdmin()
    {


        $personas = DB::table('gen_personas')        
                    ->orderBy('PERS_varApPaterno', 'asc')
                    ->get();

        return view('admin.indexpersonas', ['personas' => $personas]);
    }
    public  function indexDNI()
    {
        $listadni=Gen_coordinacion::all('PERS_varDNI');
        return view('gen_persona_dnis.index',compact('listadni'));
    }


}
