<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Gen_coordinacionController extends Controller
{
    //
    public function indexfromAdmin()
    {
        //return view('gen_persona.index',compact('listado'));
        /*
         * $coordinaciones = Gen_coordinacion::all();
        return view('admin.indexcoordinaciones',compact('coordinaciones'));
         */    
        


        $coordinaciones = DB::table('gen_coordinaciones')
                          ->join('gen_personas','gen_personas.PERS_varDNI','=','gen_coordinaciones.PERS_varDNI')
                          ->select('gen_coordinaciones.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')
                          ->get();
        return view('admincgm.indexcoordinaciones', ['coordinaciones' => $coordinaciones]);
    }
    public function coordinacion()
    {
      $coordinacion = \DB::table('gen_coordinaciones')
                            ->get();
        return \Response::json($coordinacion);
    }        
}
