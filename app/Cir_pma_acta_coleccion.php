<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma_acta_coleccion extends Model
{
    //
    protected $table='cir_pma_acta_colecciones';
    protected $primaryKey='PMAA_intId';
    public function cir_pma()
    {
        return $this->belongsTo('App\Cir_pma','PMA_varHojaTramite','PMA_varHojaTramite');
    }
    public function cir_pma_imagenes_coleccion()
    {
        return $this->hasMany('App\Cir_pma_imagenes_coleccion','PMAA_intId','PMAA_intId');
    }
}
