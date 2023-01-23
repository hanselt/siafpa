<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminciraRequest extends FormRequest
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
            'email' => 'required|unique:adminciras',
            'password' => 'required|min:6|confirmed',
            'dni' => 'required',
            'nivel' => 'required',
        ];
    }
    public function messages()
    {
        return [
            
            'email.required' => 'Este Campo es requerido',
            'email.unique' => 'El correo ya esta siendo usado',
            'password.required' => 'Este Campo es requerido',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'password.confirmed' => 'Debe ingresar la misma contraseña',
            'dni.required' => 'Seleccione una encargado',
            'nivel.required' => 'Seleccione un nivel',
        ];
    }
}
