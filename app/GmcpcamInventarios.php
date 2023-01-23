<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GmcpcamInventarios extends Model
{
  protected $table = 'gmcpcam_inventarios';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'id_proyecto',
    'periodo',
    'poseedor',
    'registrador',
    'fecha_registro',
    'tipo_proyecto'
  ];

  /*
   * Relación con la tabla Detalle
   */
  public function detalle()
  {
    return $this->hasMany('App\GmcpcamInventarioDetalles', 'id_gmpcam_inventario');
  }

  /**
   * Recuperar el Proyecto del Inventario.
   */
  public function proyecto()
  {
    return $this->morphTo('proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el registrador del Inventario.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'registrador');
  }

  /**
   * Recuperar el nombre del proyecto para mostrar en el reporte.
   */
  public function getReporteProyectoNombreAttribute()
  {
    return $this->tipo_proyecto === 'cir_pmas' ? $this->proyecto->PMA_varNombreProyecto : $this->proyecto->PROY_varNombre;
  }
  /*
   * Método para sincronizar (actualizar) el detalle de una ficha.
   */
  public function syncDetalle(array $nuevo_detalle)
  {
    $detalle_actual = $this->detalle;
    $nuevo_detalle = collect($nuevo_detalle);
    // Borrar los items del detalle que se eliminaron
    $ids_borrar = $detalle_actual->filter(function ($item) use ($nuevo_detalle) {
      return empty($nuevo_detalle->where('id', $item->id)->first());
    })->map(function ($item) {
      $id = $item->id;
      $item->delete();
      return $id;
    });
    // Grabar los nuevos items del detalle
    $nuevos_items = $nuevo_detalle->filter(function ($item) {
      return empty($item['id']);
    })->map(function ($item) {
      return new GmcpcamInventarioDetalles($item);
    });
    $this->detalle()->saveMany($nuevos_items);
    // Actualizar los items modificados
    $ids_actualizar = $nuevo_detalle->filter(function ($item) {
      return !empty($item['id']);
    })->map(function ($item) {
      $item_aux = GmcpcamInventarioDetalles::find($item['id']);
      $item_aux->fill($item);
      $item_aux->save();
      return $item_aux->id;
    });
  }
  /*
   * Método para obtener el total de piezas del inventario.
   */
  public function getTotalPiezasAttribute()
  {
    return array_reduce($this->detalle->toArray(), function ($total, $item) {
      return $total + array_reduce($item['identificacion'], function ($total2, $elem) {
        return $total2 + $elem['cantidad'];
      }, 0);
    }, 0);
  }
}
