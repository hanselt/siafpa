<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia_control extends Model
{
    //
    protected $table='cia_control';
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
    public function cia_opinion()
    {
        return $this->hasOne('App\Cia_opinion','CONT_varHojaTramite','CONT_varHojaTramite');
    }
    public function cia_tramite()
    {
        return $this->hasOne('App\Cia_tramite','CONT_varHojaTramite','CONT_varHojaTramite');
    }
}
