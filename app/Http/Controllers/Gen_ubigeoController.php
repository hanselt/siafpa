<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Gen_ubigeo;


class Gen_ubigeoController extends Controller
{
    //
    public function provincia()
    {

        $departamento = Input::get('departamento');
        $provincias = \DB::table('gen_ubigeos')
            ->select('gen_ubigeos.UBIG_varId','gen_ubigeos.UBIG_varNombre')            
            ->where([
            	     ['UBIG_varPadre', '=', $departamento],
            	     ['UBIG_varProvinciaId','>','00']
            	    ])
            ->get();

        return \Response::json($provincias);
        
    }
    public function distrito()
    {

        $provincia = Input::get('provincia');
        $distritos = \DB::table('gen_ubigeos')
            ->select('gen_ubigeos.UBIG_varId','gen_ubigeos.UBIG_varNombre')            
            ->where('UBIG_varPadre', '=', $provincia)
            ->get();

        return \Response::json($distritos);
        
    }
    public function ubigeo()
    {

        $ubigeo = Input::get('ubigeo');
        $UDist = Gen_ubigeo::find($ubigeo);
        if (count($UDist)>0) {
            # code...
        
        $Depar=$UDist->UBIG_varDepartamentoId."0000";
        $Prov=$UDist->UBIG_varDepartamentoId.$UDist->UBIG_varProvinciaId."00";
        $UDepar = Gen_ubigeo::find($Depar);
        $UProv = Gen_ubigeo::find($Prov);
        $NomUbigeos=$UDist->UBIG_varNombre.",<br>".$UProv->UBIG_varNombre.",<br>".$UDepar->UBIG_varNombre;

            return \Response::json($NomUbigeos);
        }
        else {
            return \Response::json("Ubigeo No Valido");
        }
        
    }
}
