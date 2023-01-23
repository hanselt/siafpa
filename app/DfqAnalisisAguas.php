<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DfqAnalisisAguas extends Model
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
  protected $table = 'dfq_analisis_aguas';

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
    'peso',
    'codigo_muestra',
    'muestreado_por',
    'fecha_muestreo',
    'fuente',
    'volumen',
    'color',
    'olor',
    'sabor',
    'ph',
    'conductividad',
    'turbidez',
    'solidos_disueltos',
    'solidos_suspendidos',
    'solidos_totales',
    'alcalinidad',
    'acidez',
    'dureza',
    'cloruros',
    'cloro_libre',
    'sulfatos',
    'nitratos',
    'fosfatos',
    'dbo',
    'detergentes',
    'hierro',
    'cobre',
    'coliformes_totales',
    'valores_referenciales_coliformes_totales',
    'coliformes_termotolerantes',
    'valores_referenciales_coliformes_termotolerantes',
    'escherichia_coli',
    'valores_referenciales_escherichia_coli',
    'conclusion_analisis_microbiologico',
    'parasito_hallado',
    'forma_infectante',
    'otra_forma_infectante',
    'taxonomia_parasito',
    'descripcion_parasito',
    'conclusion_analisis_parasitologico',
    'descripcion_algas',
    'taxonomia_algas',
    'conclusion_determinacion_algas',
    'conclusiones',
    'observaciones',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'parasito_hallado' => 'array',
    'forma_infectante' => 'array',
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
    $nro_ficha = DfqAnalisisAguas::whereYear('created_at', '=', $anio)
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

  /**
   * Las siguientes funciones devuelven aquellos campos que necesitan ser procesador para mostrar en el reporte.
   */
  public function getReporteFormaInfectanteAttribute()
  {
    return safe_implode(', ', $this->forma_infectante);
  }
  public function getReporteParasitoHalladoAttribute()
  {
    return $this->parasito_hallado ? implode(', ', array_map(function ($item) {
      return $item['denominacion'];
    }, $this->parasito_hallado))
    : '';
  }
}
