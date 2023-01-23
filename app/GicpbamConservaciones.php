<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamConservaciones extends Model
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
  protected $table = 'gicpbam_conservaciones';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_gicpbam_fragmento',
    'estado_conservacion',
    'acciones_conservacion',
    'acciones_montaje_almacenamiento',
    'descripcion',
    'responsable_conservacion',
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
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'acciones_conservacion' => 'array',
  ];

  /**
   * Recuperar el Fragmento de la Conservación.
   */
  public function fragmento()
  {
    return $this->belongsTo('App\GicpbamFragmentos', 'id_gicpbam_fragmento');
  }

  /**
   * Recuperar el estado de conservacion.
   */
  public function estadoConservacion()
  {
    return $this->belongsTo('App\Terminos', 'estado_conservacion');
  }

  /**
   * Recuperar el registrador de la conservación.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'responsable_conservacion');
  }

  /*
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

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GicpbamConservaciones::whereYear('created_at', '=', $anio)
                                      ->where('id', '<', $this->id)
                                      ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }
}
