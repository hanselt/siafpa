<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma_final extends Model
{
    //
    protected $table='cir_pma_finales';
    protected $primaryKey='PMAF_varHojaTramite';
    public function cir_pma()
    {
        return $this->belongsTo('App\Cir_pma','PMA_varHojaTramite','PMA_varHojaTramite');
    }
}
