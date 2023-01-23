<?php

namespace App\Http\Controllers;

use App\Monumentos;
use Illuminate\Http\Request;

class MonumentosController extends Controller
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
      return Monumentos::orderBy('MONU_varNombre')->get();;
    } else {
      return view('monumentos.index');
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
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
      $monumento = Monumentos::findOrFail($id);
      $monumento->fill($request->all());
      $monumento->save();
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
    //
  }

  /**
   * Devolver una página.
   *
   * @return \Illuminate\Http\Response
   */
  public function pagina(Request $request)
  {
    if ($request->ajax()) {
      $resultados = Monumentos::orderBy('MONU_varNombre')->paginate(10);
      return [
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
      $q = Monumentos::orderBy('MONU_varNombre');

      // Filtrar según búsqueda
      if ($request->has('columna') && $request->has('texto')) {
        $texto = '%' . $request->texto . '%';
        $q->where($request->columna, 'like', $texto);
      }

      $resultados = $q->paginate(10);
      return [
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
    } else {
      return response('Bad Request', 400);
    }
  }
}
