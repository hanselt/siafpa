<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cgm_actividadRequest extends FormRequest
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
            'ACTI_intYear' => 'required|numeric|between:1990,'.date('Y'),
            'ACTI_varUnidadMedida'=>'required',
            'ACTI_varDescripcion'=>'required',
        ];
    }
    public function messages()
    {
        return [

            'ACTI_intYear.required' => 'Este Campo es requerido',
            'ACTI_intYear.numeric' => 'Este Campo debe ser un Año',
            'ACTI_varUnidadMedida.required' => 'Este Campo es requerido',
            'ACTI_varDescripcion.required' => 'Este Campo es requerido',
            'ACTI_intYear.between' => 'El año debe estar entre :min - :max.',
            
            

        ];
    }
}
