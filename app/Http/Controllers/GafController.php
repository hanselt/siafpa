<?php

namespace App\Http\Controllers;

use App\GafAnalisisBioarqueologicos;
use Auth;
use DB;
use Illuminate\Http\Request;

class GafController extends Controller
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
      $ficha = new GafAnalisisBioarqueologicos();
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

  public static function actualizarFichaInventario(Request $request, &$respuesta) {
    $resultado = true;
    try {
      DB::beginTransaction();
      $ficha = GafAnalisisBioarqueologicos::findOrFail($request->id_ficha);
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
}
