<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_acta_coleccion extends Model
{
    //
    protected $table='cia_acta_colecciones';
    protected $primaryKey='ACTA_intId';
    public function cia_proyecto()
    {
        return $this->belongsTo('App\Cia_proyecto','PROY_varHojaTramite','PROY_varHojaTramite');
    }
    public function cia_imagenes_coleccion()
    {
        return $this->hasMany('App\Cia_imagen_coleccion','ACTA_intId','ACTA_intId');
    }
}
