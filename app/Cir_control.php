<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cir_control extends Model
{
    //
    protected $table='cir_control';
    protected $primaryKey='CONT_varHojaTramite';
    //BuscarPadre de Antecedente 22-11
    public static function findPadre($CONT_varAntecedente)
    {
        return static::where('CONT_varAntecedente', $CONT_varAntecedente)->first();
    }
    //
    public function gen_persona()
    {
        return $this->belongsTo('App\Gen_persona','PERS_varDNI','PERS_varDNI');
    }
    public function cir_opinion()
    {
        return $this->hasOne('App\Cir_opinion','CONT_varHojaTramite','CONT_varHojaTramite');
    }
    public function cir_tramite()
    {
        return $this->hasOne('App\Cir_tramite','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
