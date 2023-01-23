<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_pma_imagenes_coleccion extends Model
{
    //
    protected $table='cir_pma_imagen_colecciones';
    protected $primaryKey='IMAG_intId';
    public function cir_acta()
    {
        return $this->belongsTo('App\Cir_pma_acta_coleccion','PMAA_intId','PMAA_intId');
    }
}
