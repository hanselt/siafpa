<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GmcpcamDiagnosticos extends Model
{
  protected $table = 'gmcpcam_diagnosticos';
  /*
   * Atributos asignables
   */
  protected $fillable = [
    'fecha_diagnostico',
    'id_gmpcam_catalogacion',
    'ruta_fotografia_vista_anterior',
    'ruta_fotografia_vista_posterior',
    'ruta_fotografia_vista_detalle_1',
    'ruta_fotografia_vista_detalle_2',
    'descripcion',
    'diagnostico_estado',
    'diagnostico_descripcion',
    'observaciones',
    'responsable_diagnostico',
  ];

  /**
   * Lista de atributos adicionales que se devuelven en las consultas al modelo.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /**
   * Recuperar la Catalogación de la Ficha.
   */
  public function catalogacion()
  {
    return $this->belongsTo('App\GmcpcamCatalogaciones', 'id_gmpcam_catalogacion');
  }
  /*
   * Recuperar estado de diagnostico de la Ficha.
   */
  public function diagnosticoEstado()
  {
    return $this->belongsTo('App\Terminos', 'diagnostico_estado');
  }

  /**
   * Recuperar el registrador del diagnóstico.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'responsable_diagnostico');
  }

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GmcpcamDiagnosticos::whereYear('created_at', '=', $anio)
                                    ->where('id', '<', $this->id)
                                    ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
