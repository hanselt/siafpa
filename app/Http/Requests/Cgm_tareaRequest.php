<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cgm_tareaRequest extends FormRequest
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
            'ACTI_intId' => 'required',
            'TARE_varUnidadMedida'=>'required',
            'TARE_varDescripcion'=>'required',
        ];
    }
    public function messages()
    {
        return [

            'ACTI_intId.required' => 'Debe agregar primero actividades',
            'TARE_varUnidadMedida.required' => 'Este Campo es requerido',
            'TARE_varDescripcion.required' => 'Este Campo es requerido',       
        ];
    }
}
