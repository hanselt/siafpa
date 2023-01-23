<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class GicpbamInventarioDetalles extends Model
{
  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'gicpbam_inventario_detalles';

  /**
   * Atributos asignables.
   */
  protected $fillable = [
    'id_gicpbam_inventario',
    'nro_bolsa',
    'sector',
    'subsector',
    'unidad_excavacion',
    'contexto',
    'capa_nivel',
    'peso',
    'tipo_objeto',
    'material_morfologia',
    'periodo_ocupacion',
    'estilos_alfareros',
    'otros_estilos_alfareros',
    'parte_vasija',
    'otras_partes_vasija',
    'descripcion_general',
    'cantidad_total_bolsa',
    'observaciones',
    'cantidad_fragmentos_diagnosticos',
    'cantidad_oseos',
    'cantidad_liticos',
    'ruta_fotografia',
  ];

  /**
   * Indica al modelo no usar las columnas created_at y updated_at.
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = ['nro_inventario'];

  /**
   * Recuperar el Inventario asociado al Detalle.
   */
  public function inventario()
  {
    return $this->belongsTo('App\GicpbamInventarios', 'id_gicpbam_inventario');
  }

  /**
   * Recuperar la ubicación del Detalle para mostrar en los reportes.
   */
  public function getReporteUbicacionAttribute()
  {
    return ($this->sector ? ('Sector: ' . $this->sector . '. ') : '')
            . ($this->subsector ? ('Subsector: ' . $this->subsector . '. ') : '')
            . ($this->unidad_excavacion ? ('UE: ' . $this->unidad_excavacion . '. ') : '')
            . ($this->contexto ? ('Contexto: ' . $this->contexto . '. ') : '')
            . ($this->capa_nivel ? ('Capa/Nivel: ' . $this->capa_nivel . '.') : '');
  }

  /**
   * Recuperar el tipo de objeto del Detalle para mostrar en los reportes.
   */
  public function getReporteTipoObjetoAttribute()
  {
    return implode(", ", json_decode($this->tipo_objeto));
  }

  /**
   * Recuperar el material del Detalle para mostrar en los reportes.
   */
  public function getReporteMaterialAttribute()
  {
    $material_morfologia = json_decode($this->material_morfologia);
    return implode(", ", array_map(function ($elem) {
                          return $elem->material->abreviatura;
                        }, $material_morfologia));
  }

  /**
   * Recuperar lso estilos alfareros del Detalle para mostrar en los reportes.
   */
  public function getReporteEstilosAlfarerosAttribute()
  {
    $estilos_alfareros = json_decode($this->estilos_alfareros);
    return implode(", ", array_map(function ($elem) {
                          return $elem->estilo->denominacion;
                        }, $estilos_alfareros));
  }

  /**
   * Recuperar la parte de la vasija del Detalle para mostrar en los reportes.
   */
  public function getReporteParteVasijaAttribute()
  {
    return implode(", ", json_decode($this->parte_vasija));
  }
  /**
   * Recuperar el nro de inventario del Detalle como atributo.
   */
  public function getNroInventarioAttribute()
  {
    try {
      $id_inventario = $this->id_gicpbam_inventario;
      $id_detalle_inventario = $this->id;
      return str_pad(DB::select('
          SELECT (SELECT COUNT(*)
                  FROM gicpbam_inventario_detalles AS T2
                  WHERE T2.id < T1.id
                    AND T2.id_gicpbam_inventario = ?) + 1 AS nro_inv
          FROM gicpbam_inventario_detalles AS T1
          WHERE T1.id = ? and T1.id_gicpbam_inventario = ?
          ORDER BY T1.id'
        , [$id_inventario, $id_detalle_inventario, $id_inventario])[0]->nro_inv
        , 5, '0', STR_PAD_LEFT);
    } catch (\Exception $e) {
      return null;
    }
  }
  /*
   * Recuperar el período de ocupación del Detalle como atributo.
   */
  public function getPeriodoOcupacionAttribute($value)
  {
    return implode(", ", array_map(function ($elem) {
                          return $elem->denominacion;
                        }, json_decode($value)));
  }
  /*
   * Recuperar los sub estilos alfareros del Detalle para mostrar en los reportes.
   */
  public function getSubEstilosAttribute()
  {
    return implode(", ", array_map(function ($elem) {
                          return implode(', ', array_map(function ($subestilo) {
                            return $subestilo->denominacion;
                          }, $elem->subestilo));
                        }, json_decode($this->estilos_alfareros)));
  }
  /*
   * Recuperar morfología del Detalle para mostrar en los reportes.
   */
  public function getMorfologiaAttribute()
  {
    $material_morfologia = json_decode($this->material_morfologia);
    return implode(". ", array_map(function ($elem) {
                          return $elem->material->denominacion . ': ' .
                                 implode(', ', array_map(function ($morforlogia_item) {
                                   return $morforlogia_item->denominacion;
                                 }, $elem->morfologia));
                        }, $material_morfologia));
  }
}
