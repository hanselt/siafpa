<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cgm_accionRequest extends FormRequest
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
            'TARE_intId' => 'required',
            'ACCI_varUnidadMedida'=>'required',
            'ACCI_varDescripcion'=>'required',
        ];
    }
    public function messages()
    {
        return [

            'TARE_intId.required' => 'Debe agregar primero actividades',
            'ACCI_varUnidadMedida.required' => 'Este Campo es requerido',
            'ACCI_varDescripcion.required' => 'Este Campo es requerido',       
        ];
    }
}
