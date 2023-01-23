<?php

namespace App\Http\Controllers;

use App\Terminos;
use Illuminate\Http\Request;

class TerminosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $resultados = Terminos::with('material')->orderBy('tipo')->orderBy('subtipo')->orderBy('id_material')->orderBy('denominacion')->paginate(20);
      $respuesta = [
        'pagination' => [
          'total' => $resultados->total(),
          'per_page' => $resultados->perPage(),
          'current_page' => $resultados->currentPage(),
          'last_page' => $resultados->lastPage(),
          'from' => $resultados->firstItem(),
          'to' => $resultados->lastItem()
        ],
        'data' => $resultados
      ];
      return $respuesta;
    } else {
      return view('terminos.index');
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('terminos.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $termino = new Terminos();
    $termino->fill($request->all());
    $termino->save();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $respuesta = [];
    try {
      $elemento = Terminos::findOrFail($id);
      $elemento->fill($request->all());
      $elemento->save();
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $respuesta = [];
    try {
      Terminos::destroy($id);
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }

  /**
   * Recuperar términos de acuerdo al tipo.
   *
   * @param  string  $tipo, int  $ordenar
   * @return \Illuminate\Http\Response
   */
  public function recuperarPorTipo(Request $request, $tipo, $ordenar = 0, $subtipo = null)
  {
    if ($request->ajax()) {
      $q = Terminos::where('tipo', $tipo)
                   ->where('estado', 1)
                   ->where('subtipo', $subtipo)
                   ->select('id', 'denominacion');
      if ($ordenar) {
        $q->orderBy('denominacion');
      }
      return $q->get();
    } else {
      return [];
    }
  }

  /**
   * Recuperar términos de acuerdo al tipo.
   *
   * @param  string  $tipo, int  $ordenar
   * @return \Illuminate\Http\Response
   */
  public function buscar(Request $request, $tipo = '', $id_material = null, $texto = '', $subtipo = '')
  {
    if ($request->ajax() && $tipo != '' && $id_material != null && $texto != '') {
      $q = Terminos::where('tipo', $tipo)
                   ->where('id_material', $id_material)
                   ->where('denominacion', 'like', '%' . $texto . '%')
                   ->where('estado', 1)
                   ->orderBy('denominacion');
      if ($subtipo != '') {
        $q->where('subtipo', $subtipo);
      }
      return $q->get();
    } else {
      return [];
    }
  }

  /**
   * Recuperar Términos mediante la búsqueda.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function listar(Request $request)
  {
    if ($request->ajax()) {
      $q = Terminos::with('material')
                   ->orderBy('tipo')
                   ->orderBy('subtipo')
                   ->orderBy('id_material')
                   ->orderBy('denominacion');

      // Filtrar según búsqueda
      if ($request->has('columna') && $request->has('texto')) {
        $texto = '%' . $request->texto . '%';
        $q->where($request->columna, 'like', $texto);
      }

      $resultados = $q->paginate(20);
      $respuesta = [
        'pagination' => [
          'total' => $resultados->total(),
          'per_page' => $resultados->perPage(),
          'current_page' => $resultados->currentPage(),
          'last_page' => $resultados->lastPage(),
          'from' => $resultados->firstItem(),
          'to' => $resultados->lastItem()
        ],
        'data' => $resultados
      ];
      return $respuesta;
    } else {
      return response('Bad Request', 400);
    }
  }
}
