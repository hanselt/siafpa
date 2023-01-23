<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_opinion extends Model
{
    //
    protected $table='cia_opinion';
    protected $primaryKey='CONT_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Cia_control','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
