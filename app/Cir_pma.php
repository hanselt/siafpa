<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma extends Model
{
    //
    protected $table='cir_pmas';
    protected $primaryKey='PMA_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pma_calificaciones()
    {
        return $this->hasMany('App\Cir_pma_calificacion','PMA_varHojaTramite','PMA_varHojaTramite');
    }
    public function cir_pma_inspecciones()
    {
        return $this->hasMany('App\Cir_pma_inspeccion','PMA_varHojaTramite','PMA_varHojaTramite');
    }
    public function cir_pma_final()
    {
        return $this->hasOne('App\Cir_pma_final','PMA_varHojaTramite','PMA_varHojaTramite');
    }
    public function cir_pma_acta_coleccion()
    {
        return $this->hasOne('App\Cir_pma_acta_coleccion','PMA_varHojaTramite','PMA_varHojaTramite');
    }
}
