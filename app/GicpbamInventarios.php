<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamInventarios extends Model
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
  protected $table = 'gicpbam_inventarios';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_proyecto',
    'periodo_intervencion',
    'contenedor',
    'responsable_clasificacion',
    'fecha_clasificacion',
    'tipo_proyecto',
  ];

  /*
   * Relación con la tabla Detalle
   */
  public function detalle()
  {
    return $this->hasMany('App\GicpbamInventarioDetalles', 'id_gicpbam_inventario');
  }

  /**
   * Recuperar el Proyecto del Inventario.
   */
  public function proyecto()
  {
    return $this->morphTo('proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Nombre del Proyecto para mostrar en los reportes.
   */
  public function getReporteProyectoNombreAttribute()
  {
    return $this->tipo_proyecto === 'cir_pmas' ? $this->proyecto->PMA_varNombreProyecto : $this->proyecto->PROY_varNombre;
  }

  /**
   * Recuperar el Director del Proyecto para mostrar en los reportes.
   */
  public function getReporteProyectoDirectorAttribute()
  {
    return implode(' ', [$this->proyecto->responsable->PERS_varGradoAcademico, $this->proyecto->responsable->PERS_varNombres, $this->proyecto->responsable->PERS_varApPaterno, $this->proyecto->responsable->PERS_varApMaterno]);
  }

}
