<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cgm_actividad extends Model
{
    //
    protected $table = 'cgm_actividades';
    protected $primaryKey='ACTI_intId';
    public function Cgm_tareas()
    {
        return $this->hasMany('App\Cgm_tarea','ACTI_intId','ACTI_intId');
    }
}
