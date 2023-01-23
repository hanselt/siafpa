<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_persona extends Model
{
    public static function findPersona($PERS_varDNI)
    {
        return static::where('PERS_varDNI', $PERS_varDNI)->first();
    }
    //
    protected $primaryKey='PERS_varDNI';
    public function gen_coordinaciones()
    {
        return $this->hasMany('App\Gen_coordinacion','PERS_varDNI','PERS_varDNI');
    }
    public function cia_proyectos()
    {
        return $this->hasMany('App\Cia_proyecto','PERS_varDNI','PERS_varDNI');
    }
    public function cia_calificaciones()
    {
        return $this->hasMany('App\Cia_calificacion','PERS_varDNI','PERS_varDNI');
    }
    public function cia_supervisiones()
    {
        return $this->hasMany('App\Cia_supervision','PERS_varDNI','PERS_varDNI');
    }
    public function cia_informes_finales()
    {
        return $this->hasMany('App\Cia_informe_final','PERS_varDNI','PERS_varDNI');
    }
    public function admincalificacion()
    {
        return $this->hasOne('App\Admincalificacion','PERS_varDNI','PERS_varDNI');
    }
    public function admincatastro()
    {
        return $this->hasOne('App\Afmincatastro','PERS_varDNI','PERS_varDNI');
    }
    public function admin()
    {
        return $this->hasOne('App\Admin','PERS_varDNI','PERS_varDNI');
    }
    public function admincgm()
    {
        return $this->hasOne('App\Admincgm','PERS_varDNI','PERS_varDNI');
    }
    public function admincira()
    {
        return $this->hasOne('App\Admincira','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pmas()
    {
        return $this->hasMany('App\Cir_pma','PERS_varDNI','PERS_varDNI');
    }
    public function cir_cira_inspecciones()
    {
        return $this->hasMany('App\Cir_cira_inspeccion','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pma_calificaciones()
    {
        return $this->hasMany('App\Cir_pma_calificacion','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pma_inspecciones()
    {
        return $this->hasMany('App\Cir_pma_inspeccion','PERS_varDNI','PERS_varDNI');
    }
    public function cir_controles()
    {
        return $this->hasMany('App\Cir_control','PERS_varDNI','PERS_varDNI');
    }
    public function cir_opiniones()
    {
        return $this->hasMany('App\Cir_opinion','PERS_varDNI','PERS_varDNI');
    }

}
