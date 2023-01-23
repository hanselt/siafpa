<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GafAnalisisBioarqueologicos extends Model
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
  protected $table = 'gaf_analisis_bioarqueologicos';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_proyecto',
    'tipo_proyecto',
    'nro_contexto_funerario',
    'nro_individuo',
    'sexo',
    'edad',
    'estatura',
    'sector',
    'subsector',
    'unidad_excavacion',
    'contexto',
    'capa_nivel',
    'coordenadas_utm',
    'craneo_frontal',
    'craneo_occipital',
    'craneo_esfenoides',
    'craneo_vomer',
    'craneo_mandibula',
    'craneo_hioides',
    'craneo_parietal_derecho',
    'craneo_parietal_izquierdo',
    'craneo_temporal_derecho',
    'craneo_temporal_izquierdo',
    'craneo_maxilar_derecho',
    'craneo_maxilar_izquierdo',
    'craneo_nasal_derecho',
    'craneo_nasal_izquierdo',
    'craneo_malar_derecho',
    'craneo_malar_izquierdo',
    'craneo_lacrimal_derecho',
    'craneo_lacrimal_izquierdo',
    'craneo_palatino_derecho',
    'craneo_palatino_izquierdo',
    'craneo_cornete_derecho',
    'craneo_cornete_izquierdo',
    'craneo_martillo_derecho',
    'craneo_martillo_izquierdo',
    'craneo_yunque_derecho',
    'craneo_yunque_izquierdo',
    'craneo_estribo_derecho',
    'craneo_estribo_izquierdo',
    'esternon',
    'nro_esternon',
    'sacro',
    'nro_sacro',
    'vertebras_cervicales',
    'nro_vertebras_cervicales',
    'vertebras_dorsales',
    'nro_vertebras_dorsales',
    'vertebras_lumbares',
    'nro_vertebras_lumbares',
    'costillas_derechas',
    'costillas_izquierdas',
    'clavicula_derecha',
    'clavicula_izquierda',
    'longitud_clavicula',
    'omoplato_derecho',
    'omoplato_izquierdo',
    'longitud_omoplato',
    'humero_derecho',
    'humero_izquierdo',
    'longitud_humero',
    'radio_derecho',
    'radio_izquierdo',
    'longitud_radio',
    'cubito_derecho',
    'cubito_izquierdo',
    'longitud_cubito',
    'mano_derecha',
    'mano_izquierda',
    'longitud_mano',
    'ilion_derecho',
    'ilion_izquierdo',
    'longitud_ilion',
    'isquion_derecho',
    'isquion_izquierdo',
    'longitud_isquion',
    'pubis_derecho',
    'pubis_izquierdo',
    'longitud_pubis',
    'femur_derecho',
    'femur_izquierdo',
    'longitud_femur',
    'rotula_derecha',
    'rotula_izquierda',
    'longitud_rotula',
    'tibia_derecha',
    'tibia_izquierda',
    'longitud_tibia',
    'perone_derecho',
    'perone_izquierdo',
    'longitud_perone',
    'pie_derecho',
    'pie_izquierdo',
    'longitud_pie',
    'estado_conservacion_craneo',
    'estado_conservacion_extremidades_superiores',
    'estado_conservacion_extremidades_inferiores',
    'estado_conservacion_costillas',
    'estado_conservacion_vertebras',
    'estado_conservacion_esternon',
    'estado_conservacion_pelvis',
    'estado_conservacion_sacro',
    'porcentaje_craneo',
    'porcentaje_extremidades_superiores',
    'porcentaje_extremidades_inferiores',
    'porcentaje_costillas',
    'porcentaje_vertebras',
    'porcentaje_esternon',
    'porcentaje_pelvis',
    'porcentaje_sacro',
    'fotografia_contexto_funerario_1',
    'fotografia_contexto_funerario_2',
    'fotografia_gabinete_1',
    'fotografia_gabinete_2',
    'observaciones',
    'fecha',
    'id_registrador',
  ];

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /**
   * Recuperar el Proyecto del análisis.
   */
  public function proyecto()
  {
    return $this->morphTo('proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el estado de conservación del cráneo.
   */
  public function estadoConservacionCraneo()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_craneo');
  }

  /**
   * Recuperar el estado de conservación de las extremidades superiores .
   */
  public function estadoConservacionExtremidadesSuperiores()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_extremidades_superiores');
  }

  /**
   * Recuperar el estado de conservación de las extremidades inferiores.
   */
  public function estadoConservacionExtremidadesInferiores()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_extremidades_inferiores');
  }

  /**
   * Recuperar el estado de conservación de las costillas .
   */
  public function estadoConservacionCostillas()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_costillas');
  }

  /**
   * Recuperar el estado de conservación de las vértebras.
   */
  public function estadoConservacionVertebras()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_vertebras');
  }

  /**
   * Recuperar el estado de conservación del esternón.
   */
  public function estadoConservacionEsternon()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_esternon');
  }

  /**
   * Recuperar el estado de conservación de la pelvis.
   */
  public function estadoConservacionPelvis()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_pelvis');
  }

  /**
   * Recuperar el estado de conservación del sacro.
   */
  public function estadoConservacionSacro()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion_sacro');
  }

  /**
   * Recuperar el registrador del análisis.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'id_registrador');
  }

  /**
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GafAnalisisBioarqueologicos::whereYear('created_at', '=', $anio)
    ->where('id', '<', $this->id)
    ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
