<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminos extends Model
{
  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'terminos';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tipo', 'subtipo', 'id_material', 'denominacion', 'id_padre', 'estado',
  ];

  /**
   * Indica al modelo no usar las columnas created_at y updated_at.
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * Recuperar el Material del Termino.
   */
  public function material()
  {
    return $this->belongsTo('App\Materiales', 'id_material');
  }

}
