<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_imagen_coleccion extends Model
{
    //
    protected $table='cia_imagenes_colecciones';
    protected $primaryKey='IMAG_intId';
    public function Cia_acta_coleccion()
    {
        return $this->belongsTo('App\Cia_acta_coleccion','ACTA_intId','ACTA_intId');
    }
}
