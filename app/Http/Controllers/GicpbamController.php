<?php

namespace App\Http\Controllers;

use Auth;
use App\GicpbamAnalisisMuestras;
use App\GicpbamConservaciones;
use App\GicpbamControlesHumedad;
use App\GicpbamDibujosTecnicos;
use App\GicpbamFragmentos;
use App\GicpbamInventarios;
use App\GicpbamMontajesPanel;
use App\GicpbamMovimientosFragmento;
use DB;
use Illuminate\Http\Request;

class GicpbamController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public static function guardarFichaInventario(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamInventarios();
      $ficha->fill($request->inventario);
      $ficha->save();
      // Grabar el detalle
      $ficha->detalle()->createMany($request->detalle);
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarAnalisisCeramologico(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamFragmentos();
      $datos = $request->fragmento;
      $datos['responsable_analisis'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarConservacion(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamConservaciones();
      $datos = $request->conservacion;
      $datos['responsable_conservacion'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      // Grabar el detalle
      $ficha->fotografias()->createMany($request->fotografias);
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarDibujoTecnico(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamDibujosTecnicos();
      $datos = $request->dibujo;
      $datos['responsable_dibujo_tecnico'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarAnalisisMuestras(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamAnalisisMuestras();
      $datos = $request->analisis;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarMontajePanel(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamMontajesPanel();
      $datos = $request->montaje;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarControlHumedad(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamControlesHumedad();
      $datos = $request->control;
      $datos['registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function guardarMovimientoFragmento(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GicpbamMovimientosFragmento();
      $datos = $request->movimiento;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarAnalisisCeramologico(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamFragmentos::findOrFail($request->id_ficha);
      $ficha->fill($request->fragmento);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarConservacion(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamConservaciones::findOrFail($request->id_ficha);
      $ficha->fill($request->conservacion);
      $ficha->save();
      // Actualizar las fotografías
      $ficha->syncFotografias($request->fotografias);
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarDibujoTecnico(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamDibujosTecnicos::findOrFail($request->id_ficha);
      $ficha->fill($request->dibujo);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarAnalisisMuestras(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamAnalisisMuestras::findOrFail($request->id_ficha);
      $ficha->fill($request->analisis);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarMontajePanel(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamMontajesPanel::findOrFail($request->id_ficha);
      $ficha->fill($request->montaje);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarControlHumedad(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamControlesHumedad::findOrFail($request->id_ficha);
      $ficha->fill($request->control);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarMovimientoFragmento(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GicpbamMovimientosFragmento::findOrFail($request->id_ficha);
      $ficha->fill($request->movimiento);
      $ficha->save();
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }
}
