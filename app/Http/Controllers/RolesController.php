<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
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
      $resultados = Role::with('permissions')->paginate(10);
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
      return view('roles.index');
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('roles.create');
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
      $rol = Role::create(['name' => $request->input('name')]);
      $rol->syncPermissions($request->input('permisos'));
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['mensaje'] = $e->getMessage();
      $respuesta['resultado'] = false;
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
      $rol = Role::findOrFail($id);
      $rol->name = $request->input('name');
      $rol->save();
      // Sincronizar los permisos
      $rol->syncPermissions($request->input('permisos'));
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
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

  public function recuperarRoles()
  {
    return Role::all();
  }

  /**
   * Recuperar Roles mediante la búsqueda.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function listar(Request $request)
  {
    if ($request->ajax()) {
      $q = Role::with('permissions');

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
