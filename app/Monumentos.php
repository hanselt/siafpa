<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monumentos extends Model
{
  protected $table = 'gen_monumentos';

  /**
   * Definir la clave primaria.
   *
   * @var string
   */
  protected $primaryKey = 'MONU_intId';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'abreviatura',
  ];

  /**
   * Definir los campos que no se deben retornar en las consultas.
   *
   * @var string
   */
  protected $hidden = [ 'UBIG_varID', 'MONU_varDU', 'MONU_varDescripcion', 'COOR_intId', 'MONU_varDescripcion', 'MONU_varDescripcionArquitectura', 'MONU_varEtimologia', 'MONU_douCoordenadaLatitud', 'MONU_douCoordenadaLongitud', 'MONU_varTipo', 'MONU_varEstado', 'MONU_varDirArchivoKML', 'MONU_varHorarioAtencion', 'MONU_varDirArchivoREDeclaratoria', 'MONU_varDirArchivoREDelimitacion', 'MONU_varDirVideo', 'created_at', 'updated_at', ];
}
