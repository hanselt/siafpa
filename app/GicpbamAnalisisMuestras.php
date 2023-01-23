<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamAnalisisMuestras extends Model
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
  protected $table = 'gicpbam_analisis_muestras';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_gicpbam_fragmento',
    'nombre_muestra',
    'altitud',
    'fecha_recojo_muestra',
    'fecha_entrega_muestra',
    'tipo_analisis_solicitado',
    'nombre_laboratorio',
    'ubicacion_laboratorio',
    'ruta_foto_referencial',
    'informes_resultados',
    'observaciones',
    'responsable_entrega',
    'responsable_recepcion',
    'fecha_analisis',
    'id_registrador',
  ];

  /*
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /**
   * Recuperar el Fragmento del Análisis de Muestras.
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
    $nro_ficha = GicpbamAnalisisMuestras::whereYear('created_at', '=', $anio)
                                        ->where('id', '<', $this->id)
                                        ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
