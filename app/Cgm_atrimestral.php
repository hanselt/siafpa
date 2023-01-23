<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cgm_atrimestral extends Model
{
    //
    protected $table = 'cgm_atrimestrales';
    protected $primaryKey='ATRI_intId';
    public function Cgm_monumento()
    {
        return $this->belongsTo('App\Gen_monumento','MONU_intId','MONU_intId');
    }
    public function Cgm_accion()
    {
        return $this->belongsTo('App\Cgm_accion','ACCI_intId','ACCI_intId');
    }
}
