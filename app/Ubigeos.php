<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeos extends Model
{
  protected $table = 'gen_ubigeos';

  /**
   * Marcar la clave primaria como no autoincremental.
   *
   * @var string
   */
  public $incrementing = false;

  /**
   * Definir la clave primaria.
   *
   * @var string
   */
  protected $primaryKey = 'UBIG_varId';
}
