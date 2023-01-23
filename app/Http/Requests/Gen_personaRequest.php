<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gen_personaRequest extends FormRequest
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
            'PERS_varDNI' => 'required|numeric|unique:gen_personas|min:10000000|max:99999999',
            'PERS_varRna' => 'required|unique:gen_personas',
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
            'PERS_varDNI.required' => 'Este Campo es requerido',
            'PERS_varDNI.numeric' => 'Ingrese un DNI valido',
            'PERS_varDNI.unique' => 'El DNI ya esta registrado',
            'PERS_varDNI.min' => 'Ingrese DNI con 8 digitos',
            'PERS_varDNI.max' => 'Ingrese DNI con 8 digitos',
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
