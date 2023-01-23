<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
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
      return [ 'resultado' => true, 'permisos' => Permission::all()];
    } else {
      return [ 'resultado' => false, 'mensaje' => 'Forbidden method.' ];
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('mantenimientos.permisos.create');
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
      $permiso = new Permission();
      $permiso->fill($request->all());
      $permiso->save();
      $cache = Artisan::call('cache:forget', [
        'key' => 'spatie.permission.cache',
      ]);
      $respuesta['resultado'] = true;
      $respuesta['cache'] = $cache;
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
    //
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
}
