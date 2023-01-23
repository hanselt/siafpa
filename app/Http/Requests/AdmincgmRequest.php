<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmincgmRequest extends FormRequest
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
            'email' => 'required|unique:admincgms',
            'password' => 'required|min:6|confirmed',
            'nivel' => 'required|numeric|between:1,2',
            'dni' => 'required',
        ];
    }
    public function messages()
    {
        return [
            
            'email.required' => 'Este Campo es requerido',
            'email.unique' => 'El correo ya esta siendo usado',
            'nivel.required' => 'Este Campo es requerido',
            'nivel.numeric' => 'Este Campo debe ser un número',
            'nivel.between' => 'El usuario debe ser del nivel 1 ó 2',
            'password.required' => 'Este Campo es requerido',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'password.confirmed' => 'Debe ingresar la misma contraseña',
            'dni.required' => 'Seleccione una encargado',
        ];
    }
}
