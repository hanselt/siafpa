<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamDibujosTecnicos extends Model
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
  protected $table = 'gicpbam_dibujos_tecnicos';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_gicpbam_fragmento',
    'tipo_digitalizacion',
    'descripcion_dibujo_tecnico',
    'ruta_dibujo_tecnico',
    'ruta_banda_decorativa',
    'ruta_reconstruccion_hipotetica',
    'responsable_dibujo_tecnico',
    'fecha_inicio',
    'fecha_culminacion',
  ];

  /*
   * Lista de atributos adicionales que se devuelven en las consultas al modelo.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /**
   * Recuperar el Fragmento del Dibujo Técnico.
   */
  public function fragmento()
  {
    return $this->belongsTo('App\GicpbamFragmentos', 'id_gicpbam_fragmento');
  }

  /*
   * Recuperar el tipo de digitalización del dibujo técnico.
   */
  public function tipoDigitalizacion()
  {
    return $this->belongsTo('App\Terminos', 'tipo_digitalizacion');
  }

  /**
   * Recuperar el registrador del dibujo técnico.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'responsable_dibujo_tecnico');
  }

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GicpbamDibujosTecnicos::whereYear('created_at', '=', $anio)
                                        ->where('id', '<', $this->id)
                                        ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
