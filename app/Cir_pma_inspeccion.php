<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma_inspeccion extends Model
{
    //
    protected $table='cir_pma_inspecciones';
    protected $primaryKey='PMAI_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pma_calificaciones()
    {
        return $this->belongsTo('App\Cir_pma','PMA_varHojaTramite','PMA_varHojaTramite');
    }
}
