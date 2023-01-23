<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_calificacion extends Model
{
    //
    protected $table='cia_calificaciones';
    protected $primaryKey='CALI_intId';
    public function cia_proyecto()
    {
        return $this->belongsTo('App\Cia_proyecto','PROY_varHojaTramite','PROY_varHojaTramite');
    }
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
}
