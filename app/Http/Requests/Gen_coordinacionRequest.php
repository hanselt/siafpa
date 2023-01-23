<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gen_coordinacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'UBIG_varID' => 'required',
            'COOR_varNombre'=>'required',
            'PERS_varDNI'=>'required|unique:gen_coordinaciones',
            'COOR_varResenaHistorica' => 'required',
            'COOR_datFechaCreacion' => 'required',
            'COOR_varDireccion' => 'required',
            'COOR_varHorarioAtencion' => 'required',
            'COOR_varUTMX' => 'required|numeric',
            'COOR_varUTMY' => 'required|numeric',
            'Zona' => 'required|numeric|between:0,60',
            'CoordenadaLatitud' => 'required',
            'CoordenadaLongitud' => 'required',


        ];
    }
    public function messages()
    {


        return [

            'UBIG_varID.required' => 'Debe seleccionar un ubigeo',
            'COOR_varNombre.required' => 'Este Campo es requerido',

            'PERS_varDNI.required' => 'Seleccione una persona',
            'PERS_varDNI.unique' => 'La persona seleccionada ya administra otra coordinación',

            'COOR_varResenaHistorica.required' => 'Este Campo es requerido',
            'COOR_datFechaCreacion.required' => 'Este Campo es requerido',
            'COOR_varDireccion.required' => 'Este Campo es requerido',
            'COOR_varHorarioAtencion.required' => 'Este Campo es requerido',

            'COOR_varUTMX.required' => 'Este Campo es requerido',
            'COOR_varUTMX.numeric' => 'Este Campo es un numero',
            'COOR_varUTMY.required' => 'Este Campo es requerido',
            'COOR_varUTMY.numeric' => 'Este Campo es numero',

            'Zona.required' => 'Este Campo es requerido',
            'Zona.numeric' => 'Este Campo es requerido',
            'Zona.between' => 'El capo debe estar entre :min - :max.',

            'CoordenadaLatitud.required' => 'Ingrese coordenadas',
            'CoordenadaLongitud.required' => 'Ingrese coordenadas',
            
            

        ];
    }
}
