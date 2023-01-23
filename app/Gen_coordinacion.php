<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_coordinacion extends Model
{
    //
    protected $table='gen_coordinaciones';
    protected $primaryKey='COOR_intId';
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function gen_monumentos()
    {
        return $this->hasMany('App\Gen_monumento','COOR_intId','COOR_intId');
    }
    public static function findCoordinacion($PERS_varDNI)
    {
        return static::where('PERS_varDNI', $PERS_varDNI)->first();
    }

}
