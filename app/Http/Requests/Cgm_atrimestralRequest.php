<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cgm_atrimestralRequest extends FormRequest
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
            'MONU_intId' => 'required',
            'ACCI_intId'=>'required',
            'ATRI_intTrimestre'=>'required|numeric|between:1,4',
            'ATRI_douDimension'=>'required|numeric|min:0.01',
            'ATRI_douCostoUnitario'=>'required|numeric',
            'ATRI_varPlanes'=>'required',
            'ATRI_intEjecucionPresupuestal'=>'required|numeric|between:1,100',
        ];
    }
    public function messages()
    {
        return [

            'MONU_intId.required' => 'Debe agregar primero monumentos a la coordinación',
            'ACCI_intId.required' => 'Busque una actividad correcta',
            'ATRI_intTrimestre.required' => 'Este Campo es requerido',       
            'ATRI_intTrimestre.numeric' => 'Este Campo es requerido',
            'ATRI_intTrimestre.between' => 'Este Campo es debe estar entre :min - :max',
            'ATRI_douDimension.required' => 'Este Campo es requerido',       
            'ATRI_douDimension.numeric' => 'Debe ingresar un numero válido',       
            'ATRI_douDimension.min' => 'Debe ingresar un numero mayor a :min',       
            'ATRI_douCostoUnitario.required' => 'Este Campo es requerido',       
            'ATRI_douCostoUnitario.numeric' => 'Debe ingresar un numero válido',       
            'ATRI_varPlanes.required' => 'Este Campo es requerido',       
            'ATRI_intEjecucionPresupuestal.required' => 'Este Campo es requerido',       
            'ATRI_intEjecucionPresupuestal.numeric' => 'Este Campo es requerido',       
            'ATRI_intEjecucionPresupuestal.between' => 'Este Campo es debe estar entre :min - :max',       
        ];
    }
}


