<?php
Route::group(['prefix' => 'admincgm'], function() {


    Route::get('/home', function () {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admincgm')->user();

        //dd($users);

        return view('admincgm.home');
    })->name('home');
    //perfil
    Route::get('/perfil', function () {
        return view('admincgm/perfil');
    });
    //password

    //ver personas en coordinacion
    Route::get('ver-coordinaciones', [
        'uses' => 'Gen_coordinacionController@indexfromAdmin',
        'as'    => 'ver_coordinaciones_admin'
    ]);

    // crear coordinaciones
    Route::get('coordinacion/create', [
        'uses' => 'AdmincgmAuth\AdmincgmController@createCoordinacion',
        'as'   => 'admin_coordinacion_create'
    ]);
    Route::post('coordinacion/create', [
        'uses' => 'AdmincgmAuth\AdmincgmController@storeCoordinacion',
        'as'    => 'admin_coordinacion_store'
    ]);
    // Edicion cooordinaciones
    Route::get('coordinacion/editar/{id}', [
        'uses' => 'AdmincgmAuth\AdmincgmController@editCoordinacion',
        'as'   => 'admin_coordinacion_edit'
    ]);
    Route::patch('coordinacion/actualizar/{id}', [
        'uses' => 'AdmincgmAuth\AdmincgmController@updateCoordinacion',
        'as'   => 'admin_coordinacion_update'
    ]);
    //Ubigeo

    Route::get('prov',[
        'uses'=>'Gen_ubigeoController@provincia',
        'as'=>'ver_prov'
    ]);
    Route::get('dist',[
        'uses'=>'Gen_ubigeoController@distrito',
        'as'=>'ver_dist'
    ]);

    Route::get('nomubigeo',[
        'uses'=>'Gen_ubigeoController@ubigeo',
        'as'=>'ver_dist'
    ]);

    //actividades CRUD
    //ver personas en actividades
    Route::get('ver-actividades', [
        'uses' => 'Cgm_actividadController@indexfromAdmin',
        'as'    => 'ver_actividades_admin'
    ]);

    // crear actividades
    Route::get('actividad/create', [
        'uses' => 'Cgm_actividadController@create',
        'as'   => 'admin_actividad_create'
    ]);
    Route::post('actividad/create', [
        'uses' => 'Cgm_actividadController@store',
        'as'    => 'admin_actividad_store'
    ]);
    // Edicion actividades
    Route::get('actividad/editar/{id}', [
        'uses' => 'Cgm_actividadController@edit',
        'as'   => 'admin_actividad_edit'
    ]);
    Route::patch('actividad/actualizar/{id}', [
        'uses' => 'Cgm_actividadController@update',
        'as'   => 'admin_actividad_update'
    ]);

    //tareas CRUD
    //ver personas en actividades
    Route::get('ver-tareas', [
        'uses' => 'Cgm_tareaController@index',
        'as'    => 'ver_tareas_admin'
    ]);

    Route::get('ver-tareas/{id}', [
        'uses' => 'Cgm_tareaController@buscar',
        'as'   => 'admin_tareas_buscar'
    ]);

    // crear actividades
    Route::get('tarea/create', [
        'uses' => 'Cgm_tareaController@create',
        'as'   => 'admin_tarea_create'
    ]);
    Route::post('tarea/create', [
        'uses' => 'Cgm_tareaController@store',
        'as'    => 'admin_tarea_store'
    ]);
    // Edicion actividades
    Route::get('tarea/editar/{id}', [
        'uses' => 'Cgm_tareaController@edit',
        'as'   => 'admin_tarea_edit'
    ]);
    Route::patch('tarea/actualizar/{id}', [
        'uses' => 'Cgm_tareaController@update',
        'as'   => 'admin_tarea_update'
    ]);

    //acciones CRUD
    //ver personas en actividades
    Route::get('ver-acciones', [
        'uses' => 'Cgm_accionController@index',
        'as'    => 'ver_acciones_admin'
    ]);
    Route::get('ver-acciones/{id}', [
        'uses' => 'Cgm_accionController@buscar',
        'as'   => 'admin_acciones_buscar'
    ]);
    // crear actividades
    Route::get('accion/create', [
        'uses' => 'Cgm_accionController@create',
        'as'   => 'admin_accion_create'
    ]);
    Route::post('accion/create', [
        'uses' => 'Cgm_accionController@store',
        'as'    => 'admin_accion_store'
    ]);
    // Edicion actividades
    Route::get('accion/editar/{id}', [
        'uses' => 'Cgm_accionController@edit',
        'as'   => 'admin_accion_edit'
    ]);
    Route::patch('accion/actualizar/{id}', [
        'uses' => 'Cgm_accionController@update',
        'as'   => 'admin_accion_update'
    ]);

    //acciones trimestrales
    //ver resumen
    Route::get('ver-resumen', [
        'uses' => 'Cgm_atrimestralController@resumen',
        'as'    => 'ver_resumen_admin'
    ]);
    //ver
    Route::get('ver-atrimestrales', [
        'uses' => 'Cgm_atrimestralController@index',
        'as'    => 'ver_atrimestrales_admin'
    ]);
    //crear

    Route::get('atrimestral/create/{id}', [
        'uses' => 'Cgm_atrimestralController@create',
        'as'   => 'admin_atrimestral_create'
    ]);
    Route::post('atrimestral/create', [
        'uses' => 'Cgm_atrimestralController@store',
        'as'    => 'admin_atrimestral_store'
    ]);

    Route::get('atrimestral/editar/{id}', [
        'uses' => 'Cgm_atrimestralController@edit',
        'as'   => 'admin_atrimestral_edit'
    ]);
    Route::patch('atrimestral/actualizar/{id}', [
        'uses' => 'Cgm_atrimestralController@update',
        'as'   => 'admin_atrimestral_update'
    ]);

    Route::get('atrimestral/archivos/{id}', [
        'uses' => 'Cgm_atrimestralController@createImages',
        'as'   => 'admin_aimagenes_create'
    ]);
    Route::post('atrimestral/archivos/{id}',[
        'uses' =>'Cgm_atrimestralController@storeImages',
        'as'   =>'admin_aimagenes_Store'
    ]);

    Route::get('atrimestral/archivo/{id}', [
        'uses' => 'Cgm_atrimestralController@createDoc',
        'as'   => 'admin_afile_create'
    ]);
    Route::post('atrimestral/archivo/{id}',[
        'uses' =>'Cgm_atrimestralController@storeDoc',
        'as'   =>'admin_afile_Store'
    ]);


    //MONUMENTOS
    Route::get('monumento/editar/{id}', [
        'uses' => 'Gen_monumentoController@editar',
        'as'   => 'admin_monumento_edit'
    ]);
    Route::patch('monumento/actualizar/{id}', [
        'uses' => 'Gen_monumentoController@actualizar',
        'as'   => 'admin_monumento_update'
    ]);
    Route::get('ver-monumentos', [
        'uses' => 'Gen_monumentoController@indexCgm',
        'as'    => 'ver_monumentos_admin'
    ]);

    Route::get('monumento/archivos/{id}', [
        'uses' => 'Gen_monumentoController@createImages',
        'as'   => 'admin_archivos_create'
    ]);
    Route::post('monumento/archivos/{id}',[
        'uses' =>'Gen_monumentoController@storeImages',
        'as'   =>'admin_archivos_Store'
    ]);
    Route::get('monum',[
        'uses'=>'Gen_monumentoController@ImagenesDeMonumento',
        'as'=>'ver_monum'
    ]);

    //eliminar imagenes
    Route::get('monumento/imagenes/{id}', [
        'uses' => 'Gen_monumentoController@editarImagenes',
        'as'   => 'admin_imagen_edit'
    ]);
    Route::get('monumento/imagen/{id}',
        'Gen_monumentoController@actualizarImagenes'
    );

});