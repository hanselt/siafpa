<?php

namespace App\Http\Controllers;

use Auth;
use App\GmcpcamCatalogaciones;
use App\GmcpcamDiagnosticos;
use App\GmcpcamIntervenciones;
use App\GmcpcamInventarios;
use DB;
use Illuminate\Http\Request;

class GmcpcamController extends Controller
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
      $ficha = new GmcpcamInventarios();
      $datos = $request->ficha;
      $datos['registrador'] = Auth::user()->id;
      $ficha->fill($datos);
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

  public static function guardarFichaCatalogacion(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GmcpcamCatalogaciones();
      $datos = $request->ficha;
      $datos['catalogador'] = Auth::user()->id;
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

  public static function guardarFichaDiagnostico(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GmcpcamDiagnosticos();
      $datos = $request->ficha;
      $datos['responsable_diagnostico'] = Auth::user()->id;
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

  public static function guardarFichaIntervencion(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new GmcpcamIntervenciones();
      $datos = $request->ficha;
      $datos['responsable'] = Auth::user()->id;
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

  public static function actualizarFichaInventario(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GmcpcamInventarios::findOrFail($request->id_ficha);
      $ficha->fill($request->ficha);
      $ficha->save();
      // Grabar el detalle
      $ficha->syncDetalle($request->detalle);
      DB::commit();
      $respuesta['id_ficha'] = $ficha->id;
    } catch (\Exception $e) {
      DB::rollback();
      $resultado = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $resultado;
  }

  public static function actualizarFichaCatalogacion(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GmcpcamCatalogaciones::findOrFail($request->id_ficha);
      $ficha->fill($request->ficha);
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

  public static function actualizarFichaDiagnostico(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GmcpcamDiagnosticos::findOrFail($request->id_ficha);
      $ficha->fill($request->ficha);
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

  public static function actualizarFichaIntervencion(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GmcpcamIntervenciones::findOrFail($request->id_ficha);
      $ficha->fill($request->ficha);
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
}
