<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_proyecto extends Model
{
    //
    protected $table='cia_proyectos';
    protected $primaryKey='PROY_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function cia_calificaciones()
    {
        return $this->hasMany('App\Cia_calificacion','PROY_varHojaTramite','PROY_varHojaTramite');
    }
    public function cia_superviciones()
    {
        return $this->hasMany('App\Cia_supervision','PROY_varHojaTramite','PROY_varHojaTramite');
    }
    public function cia_informe_final()
    {
        return $this->hasOne('App\Cia_informe_final','PROY_varHojaTramite','PROY_varHojaTramite');
    }
    public function cia_acta_coleccion()
    {
        return $this->hasOne('App\Cia_acta_coleccion','PROY_varHojaTramite','PROY_varHojaTramite');
    }
}
