<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class Cir_antecedenteRequest extends FormRequest
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
        $mn=Carbon::tomorrow();        
        return [
            //
            'CONT_varHojaTramite' => 'required|min:9|max:9|unique:cir_control',
            'CONT_datFechaNotificacionUsuario'=>'required|date|before:'.$mn,
            'CONT_datFechaRecepcionTD'=>'required|date|before:CONT_datFechaNotificacionUsuario',
            'CONT_varNombreProyecto'=>'required',
            'CONT_varAdministradorEmpresa'=>'required',
            'CONT_varAntecedente'=>'required',
        ];
    }
    public function messages()
    {
        $hoy=Carbon::now()->format('d/m/Y');
        return [

            'CONT_varHojaTramite.required' => 'Ingrese H.R.',
            'CONT_varHojaTramite.min' => 'Debe ingresar una H.R de 9 dígitos',
            'CONT_varHojaTramite.max' => 'Debe ingresar una H.R. de 9 dígitos',
            'CONT_varHojaTramite.unique' => 'La hoja de ruta ya esta registrada',
            'CONT_datFechaRecepcionTD.required' => 'Este Campo es requerido',
            'CONT_datFechaRecepcionTD.before' => 'La fecha debe ser igual o inferior a la fecha de emision de oficio',
            'CONT_datFechaRecepcionTD.date' => 'Este Campo debe ser una fecha',
            'CONT_datFechaNotificacionUsuario.required' => 'Este Campo es requerido',       
            'CONT_datFechaNotificacionUsuario.date' => 'Este Campo debe ser una fecha',
            'CONT_datFechaNotificacionUsuario.before' => 'La fecha debe ser igual o inferior a :'.$hoy,
            'CONT_varNombreProyecto.required' => 'Ingrese el Nombre del Proyecto',
            'CONT_varAdministradorEmpresa.required' => 'Ingrese el Administrador y/o Remitente',
            'CONT_varAntecedente.required' => 'Seleccione un antecedente',
        ];
    }
}
