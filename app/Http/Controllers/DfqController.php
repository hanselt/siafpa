<?php

namespace App\Http\Controllers;

use App\DfqAnalisisAguas;
use App\DfqAnalisisCeramicos;
use App\DfqAnalisisLiticos;
use App\DfqAnalisisMateriales;
use App\DfqAnalisisMetales;
use Auth;
use DB;
use Illuminate\Http\Request;

class DfqController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public static function guardarAnalisisLitico(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new DfqAnalisisLiticos();
      $datos = $request->ficha;
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

  public static function actualizarAnalisisLitico(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = DfqAnalisisLiticos::findOrFail($request->id_ficha);
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

  public static function guardarAnalisisMetales(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new DfqAnalisisMetales();
      $datos = $request->ficha;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      // Grabar las fotografías
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

  public static function actualizarAnalisisMetales(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = DfqAnalisisMetales::findOrFail($request->id_ficha);
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

  public static function guardarAnalisisMateriales(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new DfqAnalisisMateriales();
      $datos = $request->ficha;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      // Grabar las fotografías
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

  public static function actualizarAnalisisMateriales(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = DfqAnalisisMateriales::findOrFail($request->id_ficha);
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

  public static function guardarAnalisisCeramico(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new DfqAnalisisCeramicos();
      $datos = $request->ficha;
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

  public static function actualizarAnalisisCeramico(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = DfqAnalisisCeramicos::findOrFail($request->id_ficha);
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

  public static function guardarAnalisisAguas(Request $request, &$respuesta)
  {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = new DfqAnalisisAguas();
      $datos = $request->ficha;
      $datos['id_registrador'] = Auth::user()->id;
      $ficha->fill($datos);
      $ficha->save();
      // Grabar las fotografías
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

  public static function actualizarAnalisisAguas(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = DfqAnalisisAguas::findOrFail($request->id_ficha);
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
