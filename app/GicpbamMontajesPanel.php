<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamMontajesPanel extends Model
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
  protected $table = 'gicpbam_montajes_paneles';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_proyecto',
    'tipo_proyecto',
    'ubicacion_panel',
    'nro_panel',
    'gaveta',
    'largo_panel',
    'ancho_panel',
    'numero_fragmentos',
    'rango_codigos',
    'estilos',
    'observaciones',
    'ruta_foto_inicial',
    'ruta_foto_proceso',
    'ruta_foto_final',
    'responsable_adecuacion_panel',
    'responsable_codificacion',
    'estado_conservacion_panel',
    'es_renovacion_panel',
    'fecha_inicio',
    'fecha_entrega',
    'tipo_proyecto',
    'id_registrador',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'estilos' => 'array',
  ];

  /*
   * Lista de atributos adicionales que se devuelven en las consultas al modelo.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /**
   * Recuperar el Proyecto del Montaje en Panel.
   */
  public function proyecto()
  {
    return $this->morphTo('proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Nombre del Proyecto.
   */
  public function getProyectoNombreAttribute()
  {
    return $this->tipo_proyecto === 'cir_pmas' ? $this->proyecto->PMA_varNombreProyecto : $this->proyecto->PROY_varNombre;
  }

  /**
   * Recuperar los estilos.
   */
  public function getReporteEstilosAttribute()
  {
    return $this->estilos ? implode(', ', array_map(function ($elem) {
                          return $elem['denominacion'];
                        }, $this->estilos))
           : '';
  }

  /*
   * Recuperar el estado de conservacion del panel.
   */
  public function estadoConservacionPanel()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_panel');
  }

  /**
   * Recuperar el registrador del montaje en panel.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'id_registrador');
  }

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GicpbamMontajesPanel::whereYear('created_at', '=', $anio)
                                      ->where('id', '<', $this->id)
                                      ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
