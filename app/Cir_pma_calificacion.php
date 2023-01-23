<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma_calificacion extends Model
{
    //
    protected $table='cir_pma_calificaciones';
    protected $primaryKey='PMAC_varId';

    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function cir_pma_calificaciones()
    {
        return $this->belongsTo('App\Cir_pma','PMA_varHojaTramite','PMA_varHojaTramite');
    }
}
