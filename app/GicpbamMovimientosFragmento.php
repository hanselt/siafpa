<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamMovimientosFragmento extends Model
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
  protected $table = 'gicpbam_movimientos_fragmento';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_gicpbam_fragmento',
    'procedencia',
    'destino',
    'documento_resolucion',
    'motivo_traslado',
    'responsable_entrega',
    'responsable_recepcion',
    'observaciones',
    'ruta_foto_entrega',
    'ruta_foto_recepcion',
    'fecha_entrega',
    'fecha_devolucion',
    'id_registrador',
  ];

  /*
   * Lista de atributos adicionales que se devuelven en las consultas al modelo.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /*
   * Recuperar el Fragmento del Movimiento.
   */
  public function fragmento()
  {
    return $this->belongsTo('App\GicpbamFragmentos', 'id_gicpbam_fragmento');
  }

  /**
   * Recuperar el registrador del Análisis de Muestras.
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
    $nro_ficha = GicpbamMovimientosFragmento::whereYear('created_at', '=', $anio)
                                            ->where('id', '<', $this->id)
                                            ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
