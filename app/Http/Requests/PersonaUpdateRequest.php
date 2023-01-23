<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaUpdateRequest extends FormRequest
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
            'PERS_varRna' => 'required',
            'PERS_varTipo' => 'required',
            'PERS_varCargo' => 'required',
            'PERS_varApPaterno' => 'required',
            'PERS_varApMaterno' => 'required',
            'PERS_varNombres' => 'required',
            'PERS_varGradoAcademico' => 'required',
            'PERS_varDescription' => 'required',
        ];
    }
    public function messages()
    {
        return [
            
            'PERS_varRna.required' => 'Este Campo es requerido',
            'PERS_varTipo.required' => 'Este Campo es requerido',
            'PERS_varCargo.required' => 'Este Campo es requerido',
            'PERS_varApPaterno.required' => 'Este Campo es requerido',
            'PERS_varApMaterno.required' => 'Este Campo es requerido',
            'PERS_varNombres.required' => 'Este Campo es requerido',
            'PERS_varGradoAcademico.required' => 'Este Campo es requerido',
            'PERS_varDescription.required' => 'Este Campo es requerido',
        ];
    }
}
