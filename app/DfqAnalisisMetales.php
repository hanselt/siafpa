<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DfqAnalisisMetales extends Model
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
  protected $table = 'dfq_analisis_metales';

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
    'codigo_muestra',
    'muestreado_por',
    'fecha_muestreo',
    'id_termino_morfologia',
    'peso',
    'altura',
    'largo',
    'diametro_superior',
    'diametro_inferior',
    'ancho_minimo',
    'ancho_maximo',
    'espesor_mayor',
    'espesor_menor',
    'estado_fisico',
    'aspecto_superficie',
    'tipo_corrosion',
    'estado_corrosion',
    'productos_corrosion',
    'tecnicas_fabricacion',
    'tecnicas_agujereados',
    'tecnicas_cortado',
    'tecnicas_uniones_mecanicas',
    'tecnicas_uniones_metalicas',
    'tecnicas_decorativas',
    'tecnicas_acabado',
    'decoraciones_no_metalicas',
    'otras_decoraciones_no_metalicas',
    'aleaciones',
    'otras_aleaciones',
    'cubrimientos_metalicos',
    'conclusiones',
    'observaciones',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'estado_fisico' => 'array',
    'aspecto_superficie' => 'array',
    'tipo_corrosion' => 'array',
    'estado_corrosion' => 'array',
    'productos_corrosion' => 'array',
    'tecnicas_fabricacion' => 'array',
    'tecnicas_agujereados' => 'array',
    'tecnicas_cortado' => 'array',
    'tecnicas_uniones_mecanicas' => 'array',
    'tecnicas_uniones_metalicas' => 'array',
    'tecnicas_decorativas' => 'array',
    'tecnicas_acabado' => 'array',
    'decoraciones_no_metalicas' => 'array',
    'otras_decoraciones_no_metalicas' => 'array',
    'aleaciones' => 'array',
    'cubrimientos_metalicos' => 'array',
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
    $nro_ficha = DfqAnalisisMetales::whereYear('created_at', '=', $anio)
    ->where('id', '<', $this->id)
    ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }

  /**
   * Recuperar la morfología de la ficha.
   */
  public function morfologia()
  {
    return $this->belongsTo('App\Terminos', 'id_termino_morfologia');
  }

  /**
   * Relación con la tabla Fotografía
   */
  public function fotografias()
  {
    return $this->morphMany('App\Fotografias', 'ficha', 'subtipo', 'id_ficha');
  }

  /*
   * Método para sincronizar (actualizar) las fotografías de una ficha.
   */
  public function syncFotografias(array $nuevas_fotos)
  {
    $fotos_actuales = $this->fotografias;
    $nuevas_fotos = collect($nuevas_fotos);
    // Borrar los items del detalle que se eliminaron
    $ids_borrar = $fotos_actuales->filter(
      function ($item) use ($nuevas_fotos) {
        return empty(
          $nuevas_fotos->where('id', $item->id)->first()
        );
      }
    )->map(function ($item) {
        $id = $item->id;
        $item->delete();
        return $id;
      }
    );
    // Grabar los nuevos items del detalle
    $nuevos_items = $nuevas_fotos->filter(
      function ($item) {
        return empty($item['id']);
      }
    )->map(function ($item) {
      return new Fotografias($item);
    });
    $this->fotografias()->saveMany($nuevos_items);
  }

  /**
   * Las siguientes funciones devuelven aquellos campos que necesitan ser procesador para mostrar en el reporte.
   */
  public function getReporteEstadoFisicoAttribute()
  {
    return safe_implode(', ', $this->estado_fisico);
  }
  public function getReporteAspectoSuperficieAttribute()
  {
    return safe_implode(', ', $this->aspecto_superficie);
  }
  public function getReporteTipoCorrosionAttribute()
  {
    return safe_implode(', ', $this->tipo_corrosion);
  }
  public function getReporteEstadoCorrosionAttribute()
  {
    return safe_implode(', ', $this->estado_corrosion);
  }
  public function getReporteProductosCorrosionAttribute()
  {
    return safe_implode(', ', $this->productos_corrosion);
  }
  public function getReporteTecnicasFabricacionAttribute()
  {
    return safe_implode(', ', $this->tecnicas_fabricacion);
  }
  public function getReporteTecnicasAgujereadosAttribute()
  {
    return safe_implode(', ', $this->tecnicas_agujereados);
  }
  public function getReporteTecnicasCortadoAttribute()
  {
    return safe_implode(', ', $this->tecnicas_cortado);
  }
  public function getReporteTecnicasUnionesMecanicasAttribute()
  {
    return safe_implode(', ', $this->tecnicas_uniones_mecanicas);
  }
  public function getReporteTecnicasUnionesMetalicasAttribute()
  {
    return safe_implode(', ', $this->tecnicas_uniones_metalicas);
  }
  public function getReporteTecnicasDecorativasAttribute()
  {
    return $this->tecnicas_decorativas ? implode(', ', array_map(function ($item) {
      return $item['denominacion'];
    }, $this->tecnicas_decorativas))
    : '';
  }
  public function getReporteTecnicasAcabadoAttribute()
  {
    return safe_implode(', ', $this->tecnicas_acabado);
  }
  public function getReporteDecoracionesNoMetalicasAttribute()
  {
    return safe_implode(', ', $this->decoraciones_no_metalicas);
  }
  public function getReporteOtrasDecoracionesNoMetalicasAttribute()
  {
    return safe_implode(', ', $this->otras_decoraciones_no_metalicas);
  }
  public function getReporteAleacionesAttribute()
  {
    return safe_implode('-', $this->aleaciones);
  }
  public function getReporteCubrimientosMetalicosAttribute()
  {
    return safe_implode(', ', $this->cubrimientos_metalicos);
  }
}
