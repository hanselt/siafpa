<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GmcpcamIntervenciones extends Model
{
  protected $table = 'gmcpcam_intervenciones';
  /*
   * Atributos asignables
   */
  protected $fillable = [
    'fecha_intervencion',
    'id_gmpcam_catalogacion',
    'propuesta_intervencion',
    'intervencion_realizada',
    'observaciones',
    'ruta_fotografia_vista_inicial',
    'ruta_fotografia_vista_final',
    'ruta_fotografia_vista_posterior',
    'ruta_fotografia_vista_perfil',
    'alto_final',
    'largo_final',
    'ancho_final',
    'espesor_final',
    'diametro_maximo_final',
    'diametro_minimo_final',
    'diametro_base_final',
    'peso_final',
    'observaciones_intervencion',
    'responsable',
  ];
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'propuesta_intervencion' => 'array',
    'intervencion_realizada' => 'array',
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
   * Relación con la tabla Fotografía
   */
  public function fotografias()
  {
    return $this->morphMany('App\Fotografias', 'ficha', 'subtipo', 'id_ficha');
  }
  /**
   * Recuperar la Catalogación de la Ficha.
   */
  public function catalogacion()
  {
    return $this->belongsTo('App\GmcpcamCatalogaciones', 'id_gmpcam_catalogacion');
  }

  /**
   * Recuperar el registrador de la intervención.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'responsable');
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

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GmcpcamIntervenciones::whereYear('created_at', '=', $anio)
                                      ->where('id', '<', $this->id)
                                      ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
