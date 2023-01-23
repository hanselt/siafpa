<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_tramite extends Model
{
    //
    protected $table='cir_tramite';
    protected $primaryKey='CONT_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Cir_control','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
