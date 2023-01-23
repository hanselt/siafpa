<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_opinion extends Model
{
    //
    protected $table='cir_opinion';
    protected $primaryKey='CONT_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Cir_control','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
