<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class GmcpcamInventarioDetalles extends Model
{
  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'gmcpcam_inventario_detalles';

  /*
   * Atributos asignables.
   */
  protected $fillable = [
    'id_gmpcam_inventario',
    'tipo_objeto',
    'peso',
    'sector',
    'subsector',
    'unidad_excavacion',
    'contexto',
    'capa_nivel',
    'coordenadas_utm',
    'codigos_anteriores',
    'identificacion',
    'periodo_cultural',
    'cultura_estilo',
    'descripcion',
    'estado_conservacion',
    'local',
    'deposito',
    'estante',
    'contenedor',
    'observaciones',
    'museable',
    'conservar',
    'material_diagnostico',
    'ruta_fotografia',
  ];

  /**
   * Indica al modelo no usar las columnas created_at y updated_at.
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'identificacion' => 'array',
  ];

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'nro_inv',
  ];

  /**
   * Recuperar el Inventario asociado al Detalle.
   */
  public function inventario()
  {
    return $this->belongsTo('App\GmcpcamInventarios', 'id_gmpcam_inventario');
  }

  public function estadoConservacion()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion');
  }

  public function getReporteCulturaEstiloAttribute()
  {
    $periodo = $this->periodo_cultural ? implode(", ", array_map(function ($elem) {
                          return $elem->denominacion;
                        }, $this->periodo_cultural))
               : '';
    $cultura = $this->cultura_estilo ? implode(", ", array_map(function ($elem) {
                          return $elem->denominacion;
                        }, $this->cultura_estilo))
               : '';
    return (!empty($periodo) ? "$periodo. " : "") . $cultura;
  }

  public function getUbicacionAttribute()
  {
    return ($this->sector ? ('Sitio/Sector: ' . $this->sector . '. ') : '')
            . ($this->subsector ? ('Subsector: ' . $this->subsector . '. ') : '')
            . ($this->unidad_excavacion ? ('Subsector: ' . $this->unidad_excavacion . '. ') : '')
            . ($this->contexto ? ('UE: ' . $this->contexto . '. ') : '')
            . ($this->capa_nivel ? ('Capa/Nivel: ' . $this->capa_nivel . '.') : '')
            . ($this->coordenadas_utm ? ('Coordenadas UTM: ' . $this->coordenadas_utm . '.') : '');
  }

  public function getUbicacionEspecificaAttribute()
  {
    return 'Local: ' . $this->local
            . '. Depósito: ' . $this->deposito
                . ($this->estante ? '. Estante: ' . $this->estante : '')
                . ($this->contenedor ? '. Contenedor: ' . $this->contenedor : '');
  }

  /*
   * Recuperar el Nro. de Inv.
   */
  public function getNroInvAttribute()
  {
    try {
      $id_inventario = $this->id_gmpcam_inventario;
      $id_detalle_inventario = $this->id;
      return str_pad(DB::select('
        SELECT (SELECT COUNT(*)
                FROM gmcpcam_inventario_detalles AS T2
                WHERE T2.id < T1.id
                  AND T2.id_gmpcam_inventario = ?) + 1 AS nro_inv
        FROM gmcpcam_inventario_detalles AS T1
        WHERE T1.id = ? and T1.id_gmpcam_inventario = ?
        ORDER BY T1.id'
      , [$id_inventario, $id_detalle_inventario, $id_inventario])[0]->nro_inv
      , 5, '0', STR_PAD_LEFT);
    } catch (\Exception $e) {
      return null;
    }
  }

  /*
   * Accesor para recuperar Período Cultural.
   */
  public function getPeriodoCulturalAttribute($value)
  {
    return json_decode($value);
  }

  /*
   * Accesor para recuperar Cultura - Estilo.
   */
  public function getCulturaEstiloAttribute($value)
  {
    return json_decode($value);
  }

  /*
   * Método para obtener los materiales del Item en formato legible.
   */
  public function getMaterialesAttribute()
  {
    return array_reduce($this->identificacion, function ($resultado, $item) {
      return $resultado . $item['material']['denominacion'] . ':' . $item['cantidad'] . '. ';
    }, '');
  }

  /*
   * Recuperar morfología del Detalle para mostrar en los reportes.
   */
  public function getMorfologiaAttribute()
  {
    return array_map(function ($elem) {
      return $elem['material']['denominacion'] . '. '
             . 'Cantidad: ' . $elem['cantidad'] . '. '
             . 'Bienes: ' . ($elem['bien_cultural'] ? implode(', ', array_map(function ($bien) {
                              return $bien['denominacion'];
                            }, $elem['bien_cultural'])) : '') . '.';
    }, $this->identificacion);
  }

  public function getReportePeriodoAttribute()
  {
    return $this->periodo_cultural ? implode(', ', array_map(function ($elem) {
             return $elem->denominacion;
           }, $this->periodo_cultural))
           : '';
  }

  public function getEstilosAlfarerosAttribute()
  {
    return $this->cultura_estilo ? implode(', ', array_map(function ($elem) {
             return $elem->denominacion;
           }, $this->cultura_estilo))
           : '';
  }
}
