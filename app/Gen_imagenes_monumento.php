<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_imagenes_monumento extends Model
{
    //
    protected $table = 'gen_imagenes_monumentos';
    protected $primaryKey='IMAG_intId';
    public function Gen_monumento()
    {
        return $this->belongsTo('App\Gen_monumento','ACCI_intId','ACCI_intId');
    }

}
