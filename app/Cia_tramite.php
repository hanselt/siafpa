<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_tramite extends Model
{
    //
    protected $table='cia_tramite';
    protected $primaryKey='CONT_varHojaTramite';
    public function gen_persona()
    {
        return $this->belongsTo('App\Cia_control','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
