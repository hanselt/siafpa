<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DfqAnalisisLiticos extends Model
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
  protected $table = 'dfq_analisis_liticos';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'codigo',
    'gestion_documentaria',
    'solicitante',
    'solicitud_servicio',
    'fecha_solicitud_servicio',
    'documento_respuesta',
    'fecha_documento_respuesta',
    'id_registrador',
    'id_proyecto',
    'tipo_proyecto',
    'ruta_fotografia',
    'tipo_muestra',
    'cantidad_muestra',
    'unidad_medida_muestra',
    'observaciones_muestra',
    'analisis_solicitados_muestra',
    'sitio',
    'sector',
    'subsector',
    'unidad_excavacion',
    'contexto',
    'capa',
    'nivel',
    'profundidad',
    'wgs84_este',
    'wgs84_norte',
    'peso',
    'codigo_muestra',
    'muestreado_por',
    'fecha_muestreo',
    'metodo_analisis',
    'modo',
    'tiempo_total_irradiacion',
    'tiempo_por_filtro',
    'nro_filtros',
    'nro_lecturas_ejecutadas',
    'elementos_mayoritarios',
    'elementos_traza',
    'rasgos_significativos',
    'elementos_procedencia',
    'estadisticos_descriptivos',
    'nivel_confianza',
    'estadistico_multivariante',
    'metodo_clasificacion',
    'distancia',
    'paquete_estadistico',
    'patron_comparativo',
    'cantera_tipo_quimico',
    'descripcion_ubicacion',
    'procedencia_muestra',
    'estructura',
    'textura',
    'color_matriz',
    'color_clastos_granos',
    'tamano_grano',
    'dureza',
    'minerales_primarios',
    'minerales_secundarios',
    'minerales_accesorios',
    'origen',
    'clasificacion',
    'nombre',
    'conclusiones',
    'observaciones',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'tipo_muestra' => 'array',
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
    $nro_ficha = DfqAnalisisLiticos::whereYear('created_at', '=', $anio)
    ->where('id', '<', $this->id)
    ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
