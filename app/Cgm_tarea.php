<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cgm_tarea extends Model
{
    //
    protected $table = 'cgm_tareas';
    protected $primaryKey='TARE_intId';
    public function Cgm_actividad()
    {
        return $this->belongsTo('App\Cgm_actividad','ACTI_intId','ACTI_intId');
    }
    public function Cgm_acciones()
    {
        return $this->hasMany('App\Cgm_accion','TARE_intId','TARE_intId');
    }
}
