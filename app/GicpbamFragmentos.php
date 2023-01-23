<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamFragmentos extends Model
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
  protected $table = 'gicpbam_fragmentos';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'codigo_fragmento',
    'id_gmcpcam_inventario_detalle',
    'espacio',
    'gaveta',
    'panel',
    'forma_vasija',
    'otras_formas_vasija',
    'tipo_vasija',
    'estilo',
    'otros_estilos',
    'peso',
    'tecnica_superficie_externa',
    'tecnica_superficie_interna',
    'motivos_superficie_externa',
    'motivos_superficie_interna',
    'color_motivos_superficie_externa',
    'color_motivos_superficie_interna',
    'descripcion_decoracion',
    'labio',
    'borde',
    'diametro_borde',
    'cuello',
    'diametro_cuello',
    'cuerpo',
    'asa',
    'tipo_asa',
    'posicion_asa',
    'base',
    'diametro_base',
    'espesor_promedio',
    'mango',
    'apendice',
    'soporte',
    'reutilizacion',
    'tamano_antiplasticos',
    'color_pasta',
    'color_munsell_pasta',
    'textura',
    'coccion',
    'dureza',
    'ordenacion_inclusiones',
    'porcentaje_inclusiones',
    'porcentaje_porosidad',
    'color_superficie_externa',
    'color_superficie_interna',
    'tratamiento_superficie_externa',
    'tratamiento_superficie_interna',
    'observaciones',
    'responsable_analisis',
    'fecha_clasificacion',
    'ruta_fotografia',
  ];
  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'analisis_morfologico',
  ];
  /**
   * Recuperar el Detalle de Inventario del Fragmento.
   */
  public function detalleInventario()
  {
    return $this->belongsTo('App\GmcpcamInventarioDetalles', 'id_gmcpcam_inventario_detalle');
  }

  /**
   * Recuperar el Estilo del Fragmento.
   */
  public function estilo()
  {
    return $this->belongsTo('App\Terminos', 'estilo');
  }

  /**
   * Recuperar la Forma Vasija del Fragmento.
   */
  public function formaVasija()
  {
    return $this->belongsTo('App\Terminos', 'forma_vasija');
  }
  /**
   * Recuperar el labio del Fragmento.
   */
  public function labio()
  {
    return $this->belongsTo('App\Terminos', 'labio');
  }
  /**
   * Recuperar el borde del Fragmento.
   */
  public function borde()
  {
    return $this->belongsTo('App\Terminos', 'borde');
  }
  /**
   * Recuperar el borde del Fragmento.
   */
  public function cuello()
  {
    return $this->belongsTo('App\Terminos', 'cuello');
  }
  /**
   * Recuperar el borde del Fragmento.
   */
  public function cuerpo()
  {
    return $this->belongsTo('App\Terminos', 'cuerpo');
  }
  /**
   * Recuperar el asa del Fragmento.
   */
  public function asa()
  {
    return $this->belongsTo('App\Terminos', 'asa');
  }
  /**
   * Recuperar la base del Fragmento.
   */
  public function base()
  {
    return $this->belongsTo('App\Terminos', 'base');
  }
  /**
   * Recuperar la base del Fragmento.
   */
  public function tecnicaSuperficieExterna()
  {
    return $this->belongsTo('App\Terminos', 'tecnica_superficie_externa');
  }
  /**
   * Recuperar la base del Fragmento.
   */
  public function tecnicaSuperficieInterna()
  {
    return $this->belongsTo('App\Terminos', 'tecnica_superficie_interna');
  }
  /**
   * Recuperar la base del Fragmento.
   */
  public function motivosSuperficieExterna()
  {
    return $this->belongsTo('App\Terminos', 'motivos_superficie_externa');
  }
  /**
   * Recuperar la base del Fragmento.
   */
  public function motivosSuperficieInterna()
  {
    return $this->belongsTo('App\Terminos', 'motivos_superficie_interna');
  }
  /**
   * Recuperar el mango del Fragmento.
   */
  public function mango()
  {
    return $this->belongsTo('App\Terminos', 'mango');
  }
  /**
   * Recuperar el soporte del Fragmento.
   */
  public function soporte()
  {
    return $this->belongsTo('App\Terminos', 'soporte');
  }

  /**
   * Recuperar el registrador del fragmento (análisis ceramológico).
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'responsable_analisis');
  }

  /**
   * Recuperar la ubicacion del Fragmento.
   */
  public function getUbicacionAttribute()
  {
    return implode('. ', [("Espacio: " . $this->espacio), ("Gaveta: " . $this->gaveta), ("Panel: " . $this->panel)]);
  }
  /*
   * Recuperar Análisis Morfológico del Fragmento.
   */
  public function getAnalisisMorfologicoAttribute()
  {
    return
      ($this->labio ? 'Labio: ' . $this->labio()->first()->denominacion . '. ' : '') .
      ($this->borde ? 'Borde: ' . $this->borde()->first()->denominacion . '. Diámetro: ' . $this->diametro_borde . '. ' : '') .
      ($this->cuello ? 'Cuello: ' . $this->cuello()->first()->denominacion . '. Diámetro: ' . $this->diametro_cuello . '. ' : '') .
      ($this->cuerpo ? 'Cuerpo: ' . $this->cuerpo()->first()->denominacion . '. ' : '') .
      ($this->asa ? 'Asa: ' . $this->asa()->first()->denominacion . '. Tipo: ' . $this->tipo_asa . '. Posición: ' . $this->posicion_asa . '. ' : '') .
      ($this->base ? 'Base: ' . $this->base()->first()->denominacion . '. Diámetro: ' . $this->diametro_base . '. ' : '') .
      ($this->espesor_promedio ? 'Espesor promedio: ' . $this->espesor_promedio . '. ' : '') .
      ($this->mango ? 'Mango: ' . $this->mango()->first()->denominacion . '. ' : '') .
      ($this->apendice ? 'Apéndice: ' . $this->apendice . '. ' : '') .
      ($this->soporte ? 'Soporte: ' . $this->soporte()->first()->denominacion . '. ' : '') .
      ($this->reutilizacion ? 'Reutilización: ' . $this->reutilizacion . '.' : '');
  }
}
