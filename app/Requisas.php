<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisas extends Model
{
  /**
   * SoftDeletes permite que los registros de la tabla no sean borrados permanentemente por defecto.
   * Esto mantiene la consistencia del índice y permite recuperar en caso de borrado por error.
   */
  use SoftDeletes;

  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'requisas';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'modalidad',
    'nombre',
    'periodo',
    'origen',
    'documento_ingreso',
    'nombre_responsable',
    'ubigeo',
    'departamento',
    'provincia',
    'distrito',
    'anexo',
    'centro_poblado',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'modalidad' => 'array',
  ];

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'codigo_caja', 'modalidad_intervencion',
  ];

  /**
   * Recuperar el GMCPCAM Inventario de la Requisa.
   */
  public function gmcpcamInventarios()
  {
    return $this->morphMany('App\GmcpcamInventarios', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Montaje en Panel del Proyecto.
   */
  public function gicpbamMontajesPanel()
  {
    return $this->morphMany('App\GicpbamMontajesPanel', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el análisis bioarqueológico de la requisa.
   */
  public function gafAnalisisBioarqueologico()
  {
    return $this->morphMany('App\GafAnalisisBioarqueologicos', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Monumento de la Requisa.
   */
  public function getCodigoCajaAttribute()
  {
    return null;
  }

  /*
   * Recuperar la modalidad de intervención de la Requisa.
   */
  public function getModalidadIntervencionAttribute()
  {
    return $this->modalidad['denominacion'];
  }

}
