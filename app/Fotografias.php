<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografias extends Model
{
  protected $table = 'fotografias';
  /*
   * Atributos asignables
   */
  protected $fillable = [
    'ruta', 'descripcion', 'id_ficha', 'subtipo',
  ];

  /**
   * Indica al modelo no usar las columnas created_at y updated_at.
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * Recuperar la ficha de la Fotografía.
   */
  public function ficha()
  {
    return $this->morphTo('ficha', 'subtipo', 'id_ficha');
  }
}
