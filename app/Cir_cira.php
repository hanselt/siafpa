<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_cira extends Model
{
    //
    protected $table='cir_ciras';
    protected $primaryKey='CIRA_varHojaTramite';
    public function cir_cira_inspecciones()
    {
        return $this->hasMany('App\Cir_cira_inspeccion','CIRA_varHojaTramite','CIRA_varHojaTramite');
    }
}
