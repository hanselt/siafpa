<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_monumento extends Model
{
    //
    protected $primaryKey='MONU_intId';
    public function gen_coordinacion()
    {
        return $this->belongsTo('App\Gen_monumento','COOR_intId','COOR_intId');
    }
    public function Cgm_atrimestrales()
    {
        return $this->hasMany('App\Cgm_atrimestral','MONU_intId','MONU_intId');
    }
    public function Cgm_imagenes_monumento()
    {
        return $this->hasMany('App\Gen_imagenes_monumento','MONU_intId','MONU_intId');
    }
}
