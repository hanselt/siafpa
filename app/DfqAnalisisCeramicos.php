<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DfqAnalisisCeramicos extends Model
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
  protected $table = 'dfq_analisis_ceramicos';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'codigo',
    'id_registrador',
    'gestion_documentaria',
    'solicitante',
    'solicitud_servicio',
    'fecha_solicitud_servicio',
    'documento_respuesta',
    'fecha_documento_respuesta',
    'ruta_fotografia',
    'id_proyecto',
    'tipo_proyecto',
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
    'id_termino_estado_conservacion',
    'observaciones_estado_conservacion',
    'parte_vasija',
    'observaciones_parte_vasija',
    'tipo_vasija',
    'observaciones_tipo_vasija',
    'decoracion_presente',
    'observaciones_decoracion',
    'tratamiento_superficie_externa',
    'observaciones_tratamiento_externo',
    'tratamiento_superficie_interna',
    'observaciones_tratamiento_interno',
    'espesor_seccion',
    'textura_pasta',
    'observaciones_textura_pasta',
    'color_inclusiones',
    'forma_inclusiones',
    'observaciones_forma_inclusiones',
    'porosidad',
    'metodos_obtencion_porosidad',
    'modo_coccion',
    'observaciones_modo_coccion',
    'area_porcentaje_inclusiones',
    'rangos_granulometricos',
    'metodos_obtencion_rangos_granulometricos',
    'relaciones_inclusiones_matriz_arcillosa',
    'metodos_obtencion_relaciones_inclusiones_matriz',
    'ruta_microfotografia',
    'tecnica_analisis_quimico',
    'equipo_analisis_quimico',
    'analisis_quimico_destructivo',
    'elementos_mayores_pasta',
    'elementos_menores_pasta',
    'elementos_mayores_decoracion',
    'elementos_menores_decoracion',
    'resultados_analisis_quimico',
    'tecnica_analisis_estructural',
    'equipo_analisis_estructural',
    'analisis_estructural_destructivo',
    'resultados_analisis_estructural',
    'conclusiones',
    'observaciones',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'parte_vasija' => 'array',
    'tratamiento_superficie_externa' => 'array',
    'tratamiento_superficie_interna' => 'array',
    'forma_inclusiones' => 'array',
    'modo_coccion' => 'array',
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
    $nro_ficha = DfqAnalisisCeramicos::whereYear('created_at', '=', $anio)
      ->where('id', '<', $this->id)
      ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }

  /**
   * Recuperar el estado de conservación de la ficha.
   */
  public function estadoConservacion()
  {
    return $this->belongsTo('App\Terminos', 'id_termino_estado_conservacion');
  }

  /**
   * Las siguientes funciones devuelven aquellos campos que necesitan ser procesador para mostrar en el reporte.
   */
  public function getReporteParteVasijaAttribute()
  {
    return safe_implode(', ', $this->parte_vasija);
  }
  public function getReporteTratamientoSuperficieExternaAttribute()
  {
    return safe_implode(', ', $this->tratamiento_superficie_externa);
  }
  public function getReporteTratamientoSuperficieInternaAttribute()
  {
    return safe_implode(', ', $this->tratamiento_superficie_interna);
  }
  public function getReporteFormaInclusionesAttribute()
  {
    return safe_implode(', ', $this->forma_inclusiones);
  }
  public function getReporteModoCoccionAttribute()
  {
    return safe_implode(', ', $this->modo_coccion);
  }
}
