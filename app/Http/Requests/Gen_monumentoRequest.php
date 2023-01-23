<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gen_monumentoRequest extends FormRequest
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
            'COOR_intId' => 'required',
            'MONU_varNombre' => 'required',
            'MONU_varCategoria' => 'required',
            'MONU_varUTMX' => 'required|numeric',
            'MONU_varUTMY' => 'required|numeric',
            'Zona' => 'required|numeric|between:1,60',
            'MONU_douCoordenadaLatitud' => 'required|numeric|between:-90,90',
            'MONU_douCoordenadaLongitud' => 'required|numeric|between:-180,180',


        ];
    }
    public function messages()
    {


        return [
            'UBIG_varID.required' => 'Seleccione una Ubicación Geográfica',
            'COOR_intId.required' => 'Este Campo es requerido',

            
            'MONU_varNombre.required' => 'Este Campo es requerido',
            'MONU_varCategoria.required' => 'Este Campo es requerido',
            
            'MONU_varUTMX.required' => 'Este Campo es requerido',
            'MONU_varUTMX.numeric' => 'Este Campo es un numero',
            'MONU_varUTMY.required' => 'Este Campo es requerido',
            'MONU_varUTMY.numeric' => 'Este Campo es numero',
            'Zona.required' => 'Este Campo es requerido',
            'Zona.numeric' => 'Este Campo es numero',
            'Zona.between' => 'La zona debe estar entre :min y :max',
            'MONU_douCoordenadaLatitud.required' => 'Este Campo es requerido',
            'MONU_douCoordenadaLatitud.between' => 'La latidud debe estar entre :min y :max',
            'MONU_douCoordenadaLatitud.numeric' => 'Este Campo es numero',
            'MONU_douCoordenadaLongitud.required' => 'Este Campo es requerido',
            'MONU_douCoordenadaLongitud.between' => 'La longitud debe estar entre :min y :max',
            'MONU_douCoordenadaLongitud.numeric' => 'Este Campo es numero',
        ];
    }
}
