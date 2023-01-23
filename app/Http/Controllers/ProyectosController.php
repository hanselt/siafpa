<?php

namespace App\Http\Controllers;

use App\CiaProyectos;
use App\CirPmas;
use App\Requisas;
use Illuminate\Http\Request;

class ProyectosController extends Controller
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
      $resultados = CiaProyectos::with(['responsable', 'monumento'])->paginate(10);
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
      return view('proyectos.index');
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('proyectos.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $respuesta = [];
    try {
      $proyecto = new Proyectos();
      $proyecto->fill($request->all());
      $proyecto->save();
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
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
    //
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
      $elemento = CiaProyectos::findOrFail($id);
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
      Proyectos::destroy($id);
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }

  /**
   * Recuperar Proyectos según parámetros de búsqueda.
   *
   * @param  int  $modalidad, string texto
   * @return \Illuminate\Http\Response
   */
  public function recuperarBusqueda(Request $request, $tipo, $clase, $texto = '')
  {
    if ($request->ajax() && $texto != '') {
      $resultado = null;
      $texto = '%' . $texto . '%';
      if ($clase == 'cir_pmas') {
        $resultado = CirPmas::where('PMA_varNombreProyecto', 'like', $texto)
                    ->with('responsable')
                    ->get();
      } elseif ($clase === 'cia_proyectos') {
        $resultado = CiaProyectos::where('PROY_varTipo', $tipo)
                         ->where('PROY_varNombre', 'like', $texto)
                         ->with('responsable')
                         ->get();
      } else {
        $aux = Requisas::where('nombre', 'like', $texto)
                       ->get();
        $resultado = $aux->filter(function ($item) use ($tipo) {
          return $item->modalidad['tipo'] === $tipo;
        });
      }
      return $resultado;
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
      $q = CiaProyectos::with(['responsable', 'monumento']);

      // Filtrar según búsqueda
      if ($request->has('columna') && $request->has('texto')) {
        $texto = '%' . $request->texto . '%';

        if ($request->columna === 'periodo') {
          $q->whereYear('PROY_datFechaIngreso', 'like', $texto);
        } else {
          $q->where($request->columna, 'like', $texto);
        }
      }

      $resultados = $q->paginate(10);
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
