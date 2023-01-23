<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiales extends Model
{
  protected $table = 'materiales';

  /**
   * Recuperar la codificación con el formato adecuado.
   *
   * @param  decimal  $value
   * @return string
   */
  public function getCodificacionAttribute($value)
  {
    return strval(floatval($value));
  }
}
