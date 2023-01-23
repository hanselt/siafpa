<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'GenericController@front');
Route::post('login', 'GenericController@iniciarSesion');
Route::get('escritorio', 'GenericController@escritorio');
Route::get('{proceso}/escritorio', 'GenericController@escritorioProceso');
Route::get('logout', 'GenericController@cerrarSesion');
Route::get('perfil', 'GenericController@perfil');
Route::get('perfil/usuario', 'GenericController@usuario');

Route::resource('terminos', 'TerminosController');
Route::resource('materiales', 'MaterialesController');
Route::resource('proyectos', 'ProyectosController');
Route::resource('pmas', 'PmasController');
Route::resource('arqueologos', 'ArqueologosController');
Route::resource('monumentos', 'MonumentosController');
Route::resource('usuarios', 'UsuariosController');
Route::resource('roles', 'RolesController');
Route::resource('permisos', 'PermisosController');
Route::resource('requisas', 'RequisasController');

Route::prefix('{gabinete}/fichas')->group(function () {
  Route::get('{tipo}/crear', 'FichasController@create');
  Route::get('{tipo}/{dependencia}/{id_ficha}/crear', 'FichasController@crearFichaDependiente');
  Route::get('{tipo}/listar', 'FichasController@index');
  Route::get('{tipo}/datos', 'FichasController@datos');
  Route::post('{tipo}', 'FichasController@guardar');
  Route::put('{tipo}', 'FichasController@actualizar');
  // Ruta para reportes
  Route::get('{tipo}/{id_ficha}/reporte', 'FichasController@reporte');
  Route::get('{tipo}/reportes', 'ReportesController@index');
  Route::post('{tipo}/reportes/{tipo_reporte}/generar', 'ReportesController@generar');
  Route::get('{tipo}/reportes/{tipo_reporte}/pdf/{params}', 'ReportesController@generarPdf')->where('params', '.+');
});

Route::prefix('busqueda')->group(function () {
  Route::get('proyectos/{tipo}/{clase}/{texto?}', 'ProyectosController@recuperarBusqueda');
  Route::get('terminos/{tipo?}/{id_material?}/{texto?}/{subtipo?}', 'TerminosController@buscar');
  Route::get('tipo/{tipo}/terminos/{ordenar?}/{subtipo?}', 'TerminosController@recuperarPorTipo');
  Route::get('roles', 'RolesController@recuperarRoles');
});

Route::prefix('pagina')->group(function () {
  Route::get('monumentos', 'MonumentosController@pagina');
  Route::get('arqueologos', 'ArqueologosController@pagina');
});

Route::prefix('listar')->group(function () {
  Route::get('terminos', 'TerminosController@listar');
  Route::get('monumentos', 'MonumentosController@listar');
  Route::get('arqueologos', 'ArqueologosController@listar');
  Route::get('proyectos', 'ProyectosController@listar');
  Route::get('pmas', 'PmasController@listar');
  Route::get('usuarios', 'UsuariosController@listar');
  Route::get('roles', 'RolesController@listar');
});

/*
 * Ruta para subir imágenes mediante Dropzone
 */
Route::post('dropzone/subir/{gabinete}/{tipo_ficha}', 'HerramientasController@dropzoneSubir');
Route::delete('dropzone/borrar/{gabinete}/{tipo_ficha}/{nombre_fotografia}', 'HerramientasController@dropzoneBorrar');

/*
 * Ruta para recuperar datos de Ubigeo
 */
Route::get('ubigeo/{codigo}', 'HerramientasController@ubigeo');
Route::get('distrito/{distrito}/ubigeo', 'HerramientasController@ubigeoDistrito');

/*
 * Ruta para pruebas
Route::get('tests', 'HerramientasController@tests');
 */

/*
 * Ruta auxiliar para guardar en cache la configuración.
 * Se utiliza en el servidor de producción.
 */
Route::get('/deploy', function () {
  $resultado = [];
  $resultado['exitCode0'] = Artisan::call('cache:clear');
  $resultado['exitCode1'] = Artisan::call('config:cache');
  $resultado['exitCode2'] = Artisan::call('view:clear');
  dd($resultado);
});

require (__DIR__ . '/admincalificacion.php');

require (__DIR__ . '/admincira.php');

require (__DIR__ . '/admincatastro.php');

require (__DIR__ . '/admincgm.php');
