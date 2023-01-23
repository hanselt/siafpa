<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DfqAnalisisMateriales extends Model
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
  protected $table = 'dfq_analisis_materiales';

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
    'tipo_muestra',
    'cantidad_muestra',
    'unidad_medida_muestra',
    'observaciones_muestra',
    'analisis_solicitados_muestra',
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
    'estructura',
    'compactacion',
    'textura',
    'color',
    'tamano_grano',
    'datos_relevantes',
    'densidad_real',
    'densidad_aparente',
    'porcentaje_porosidad',
    'porcentaje_humedad',
    'compacidad',
    'porcentaje_humedad_equivalente',
    'porcentaje_capacidad_campo',
    'conductividad',
    'tds',
    'ph',
    'color_munsell',
    'analisis_textural',
    'porcentaje_material_fino',
    'porcentaje_material_grava_mediana',
    'porcentaje_material_grava_gruesa',
    'porcentaje_material_organico_presente',
    'porcentaje_otros_aditivos',
    'porcentaje_residuo_insoluble',
    'porcentaje_fraccion_soluble',
    'porcentaje_cal_apagada',
    'porcentaje_agregado',
    'relacion_conglomerante_agregado',
    'nutrientes',
    'porcentaje_materia_organica',
    'analisis_micronutrientes',
    'bases_intercambiables',
    'capacidad_intercambio_cationico',
    'analisis_quimico_por',
    'contraccion_lineal',
    'limite_liquido',
    'limite_plastico',
    'indice_plasticidad',
    'clasificacion_sucs_cl',
    'coeficiente_uniformidad',
    'coeficiente_curvatura',
    'clasificacion_sucs_gp',
    'resistencia_simple',
    'resistencia_triaxial',
    'estratos',
    'conclusiones',
    'observaciones',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'estratos' => 'array',
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
    $nro_ficha = DfqAnalisisMateriales::whereYear('created_at', '=', $anio)
      ->where('id', '<', $this->id)
      ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
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
}
