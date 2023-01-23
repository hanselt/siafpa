<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GmcpcamCatalogaciones extends Model
{
  protected $table = 'gmcpcam_catalogaciones';
  /*
   * Atributos asignables
   */
  protected $fillable = [
    'nro_registro_nacional',
    'poseedor',
    'id_gmpcam_inventario_detalle',
    'grupo',
    'codigo',
    'id_material',
    'bien_cultural',
    'especie',
    'tipo',
    'clase',
    'cultura_estilo',
    'cronologia',
    'descripcion_adicional_cronologia',
    'ruta_fotografia',
    'sector',
    'subsector',
    'unidad_excavacion',
    'contexto',
    'capa_nivel',
    'coordenadas_utm',
    'fecha_hallazgo',
    'registros_anteriores',
    'situacion_legal',
    'manufactura',
    'acabado_superficie',
    'decoracion',
    'descripcion_decoracion',
    'morfologia',
    'descripcion_adicional',
    'funcion_uso',
    'otra_funcion_uso',
    'alto',
    'largo',
    'ancho',
    'espesor',
    'diametro_maximo',
    'diametro_minimo',
    'diametro_base',
    'peso',
    'estado_conservacion',
    'descripcion_estado',
    'estado_integridad',
    'es_diagnostico',
    'es_intervencion',
    'es_otros_tratamientos',
    'es_conservacion_preventiva',
    'es_conservacion_curativa',
    'es_conservacion_restaurativa',
    'nro_resolucion_autorizacion',
    'nro_ficha_autorizacion',
    'nro_informe_autorizacion',
    'detalle_intervencion',
    'observaciones_intervencion',
    'bibliografia',
    'gabinete',
    'local',
    'deposito',
    'estante',
    'contenedor',
    'registrador',
    'catalogador',
    'fecha_catalogacion',
  ];
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'manufactura' => 'array',
    'decoracion' => 'array',
    'morfologia' => 'array',
  ];
  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['ubicacion_actual', 'ubicacion_especifica', 'codigo_bien'];
  /*
   * Relación con la tabla Fotografía
   */
  public function fotografias()
  {
    return $this->morphMany('App\Fotografias', 'ficha', 'subtipo', 'id_ficha');
  }

  /**
   * Recuperar el Material de la Ficha.
   */
  public function material()
  {
    return $this->belongsTo('App\Materiales', 'id_material');
  }
  /**
   * Recuperar el Detalle de Inventario de la Ficha.
   */
  public function detalleInventario()
  {
    return $this->belongsTo('App\GmcpcamInventarioDetalles', 'id_gmpcam_inventario_detalle');
  }
  /**
   * Recuperar el Bien Cultural de la Ficha.
   */
  public function bienCultural()
  {
    return $this->belongsTo('App\Terminos', 'bien_cultural');
  }
  /**
   * Recuperar el Estilo-Cultura de la Ficha.
   */
  public function culturaEstilo()
  {
    return $this->belongsTo('App\Terminos', 'cultura_estilo');
  }
  /**
   * Recuperar el Nombre del Tipo.
   */
  public function tipo()
  {
    return $this->belongsTo('App\Terminos', 'tipo');
  }
  /**
   * Recuperar la especie de la Ficha.
   */
  public function especie()
  {
    return $this->belongsTo('App\Terminos', 'especie');
  }
  /**
   * Recuperar la clase de la ficha.
   */
  public function clase()
  {
    return $this->belongsTo('App\Terminos', 'clase');
  }
  /*
   * Recuperar Especie-Tipo-Clase para mostrar en el reporte.
   */
  public function getReporteEspecieTipoClaseAttribute()
  {
    return ($this->especie ? 'ESPECIE:' . $this->especie()->first()->denominacion . '. ' : '')
            . ($this->clase ? 'CLASE:' . $this->clase()->first()->denominacion . '. ' : '')
            . ($this->tipo ? 'TIPO:' . $this->tipo()->first()->denominacion . '. ' : '');
  }
  /**
   * Recuperar la cronología de la Ficha.
   */
  public function cronologia()
  {
    return $this->belongsTo('App\Terminos', 'cronologia');
  }
  /**
   * Recuperar los registros anteriores de la Ficha.
   */
  public function getRegistrosAnterioresAttribute($value)
  {
    $registros = json_decode($value);
    for ($i=0; $i < 9; $i++) {
      if (!array_key_exists($i, $registros)) {
        $registros[$i] = '--';
      } elseif (!$registros[$i]) {
        $registros[$i] = '--';
      }
    }
    return $registros;
  }
  /**
   * Recuperar la manufactura de la Ficha para mostrar en el reporte.
   */
  public function getReporteManufacturaAttribute()
  {
    return $this->manufactura ? implode(", ", array_map(function ($elem) {
                          return $elem['denominacion'];
                        }, $this->manufactura))
           : '';
  }
  /**
   * Recuperar la decoración de la Ficha para mostrar en el reporte.
   */
  public function getReporteDecoracionAttribute()
  {
    return $this->decoracion ? implode(", ", array_map(function ($elem) {
                          return $elem['denominacion'];
                        }, $this->decoracion))
           : '';
  }
  /**
   * Recuperar función/uso de la Ficha.
   */
  public function funcionUso()
  {
    return $this->belongsTo('App\Terminos', 'funcion_uso');
  }
  /**
   * Recuperar estado de conservacion de la Ficha.
   */
  public function estadoConservacion()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion');
  }
  /**
   * Recuperar estado de integridad de la Ficha.
   */
  public function estadoIntegridad()
  {
    return $this->belongsTo('App\Terminos', 'estado_integridad');
  }
  /*
   * Recuperar Ubicación actual para mostrar en el reporte.
   */
  public function getUbicacionActualAttribute()
  {
    return ($this->gabinete ? $this->gabinete . '. ' : '')
            . ($this->deposito ? 'Depósito ' . $this->deposito . '. ' : '')
            . ($this->local ? 'Local de ' . $this->local . '. ' : '');
  }
  /*
   * Recuperar Ubicación específica para mostrar en el reporte.
   */
  public function getUbicacionEspecificaAttribute()
  {
    return ($this->estante ? 'Estante: ' . $this->estante . '. ' : '')
            . ($this->contenedor ? 'Contenedor: ' . $this->contenedor . '. ' : '');
  }
  /**
   * Recuperar el Registrador de la ficha.
   */
  public function registrador()
  {
    return $this->belongsTo('App\Personas', 'registrador');
  }
  /**
   * Recuperar el Catalogador de la ficha.
   */
  public function catalogador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'catalogador');
  }
  /**
   * Recuperar el código del bien de la ficha.
   */
  public function getCodigoBienAttribute()
  {
    return $this->material->abreviatura . ' ' . $this->codigo;
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
