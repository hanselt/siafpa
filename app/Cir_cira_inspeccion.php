<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_cira_inspeccion extends Model
{
    //
    protected $table='cir_cira_inspecciones';
    protected $primaryKey='CIRI_varId';
    public function cir_cira()
    {
        return $this->belongsTo('App\Cir_cira_inspeccion','CIRA_varHojaTramite','CIRA_varHojaTramite');
    }
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
}
