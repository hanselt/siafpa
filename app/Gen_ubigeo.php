<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_ubigeo extends Model
{
    //
    protected $primaryKey='UBIG_varId';
    protected $fillable = [
        'UBIG_varId', 'UBIG_varPadre', 'UBIG_varNombre','UBIG_varDepartamentoId','UBIG_varProvinciaId','UBIG_varDistritoId',
    ];
}
