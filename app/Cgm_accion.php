<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cgm_accion extends Model
{
    //
    protected $table = 'cgm_acciones';
    protected $primaryKey='ACCI_intId';
    public function Cgm_tarea()
    {
        return $this->belongsTo('App\Cgm_tarea','TARE_intId','TARE_intId');
    }
    public function Cgm_atrimestrales()
    {
        return $this->hasMany('App\Cgm_atrimestral','ACCI_intId','ACCI_intId');
    }
}
