<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');
//password
//password
Route::get('/password/{id}', [
    'uses' => 'AdminAuth\AdminController@editPassword',
    'as'   => 'admin_password_edit'
]);
Route::patch('/password/{id}', [
    'uses' => 'AdminAuth\AdminController@updatePassword',
    'as'   => 'admin_password_update'
]);
//perfil
Route::get('/perfil', function () {
    return view('admin/perfil');
});
// ver personas
Route::get('ver-personas', [
    'uses' => 'Gen_personaController@indexfromAdmin',
    'as'    => 'ver_personas_admin'
]);


// crear una nueva persona
Route::get('persona/create', [
    'uses' => 'AdminAuth\AdminController@createPersona',
    'as'   => 'admin_persona_create'
]);
Route::post('persona/create', [
    'uses' => 'AdminAuth\AdminController@storePersona',
    'as'   => 'admin_persona_store'
]);

// Edicion de Gen_personas

Route::get('persona/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editPersona',
    'as'   => 'admin_persona_edit'
]);
Route::patch('persona/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updatePersona',
    'as'   => 'admin_persona_update'
]);
// Agregar imagen a persona
Route::get('persona/imagen/{id}', [
    'uses' => 'AdminAuth\AdminController@imagenPersona',
    'as'   => 'admin_persona_imagen'
]);
Route::post('persona/imagenPersona/{id}',[
    'uses' =>'AdminAuth\AdminController@updateImagen',
    'as'   =>'admin_imagen_update'
]);

//Recuperar Nombre de Administrador coordinacion
Route::get('persona',[
    'uses'=>'AdminAuth\AdminController@persona',
    'as'=>'ver_pers'
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
// ver coordinaciones



//monumentos
Route::get('ver-monumentos', [
    'uses' => 'Gen_monumentoController@indexfromAdmin',
    'as'    => 'ver_monumentos_admin'
]);


// crear  monumentos
Route::get('monumento/create', [
    'uses' => 'AdminAuth\AdminController@createMonumento',
    'as'   => 'admin_monumento_create'
]);
Route::post('monumento/create', [
    'uses' => 'AdminAuth\AdminController@storeMonumento',
    'as'    => 'admin_monumento_store'
]);



/*
 * CRUD Administradores CIRA
 */
Route::get('admincira/create', [
    'uses' => 'AdminAuth\AdminController@createAdmincira',
    'as'   => 'admin_cira_create'
]);
Route::post('admincira/create', [
    'uses' => 'AdminAuth\AdminController@storeAdmincira',
    'as'   => 'admin_cira_store'
]);

Route::get('admin-ciras/delete/{id}', [
    'uses' => 'AdminAuth\AdminController@deleteAdminCira',
    'as'   => 'admin_delete_cira'
]);
//CRUD AFPA admins
Route::get('adminafpa/create', [
    'uses' => 'AdminAuth\AdminController@createAdminafpa',
    'as'   => 'admin_afpa_create'
]);
Route::post('adminafpa/create', [
    'uses' => 'AdminAuth\AdminController@storeAdminafpa',
    'as'   => 'admin_afpa_store'
]);
Route::get('admin-afpa/delete/{id}', [
    'uses' => 'AdminAuth\AdminController@deleteAdminAfpa',
    'as'   => 'admin_delete_afpa'
]);
//Listar administradores AFPA
Route::get('admin-afpa', [
    'uses' => 'AdminAuth\AdminController@adminAfpaList',
    'as'   => 'admin_afpa_list'
]);

Route::get('admin-afpa/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editAdminAfpa',
    'as'   => 'admin_edit_afpa'
]);
Route::patch('admin-afpa/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updateAdminAfpa',
    'as'   => 'admin_update_afpa'
]);


// Listar CIRAS
Route::get('admin-ciras', [
    'uses' => 'AdminAuth\AdminController@adminCirasList',
    'as'   => 'admin_ciras_list'
]);

Route::get('admin-ciras/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editAdminCira',
    'as'   => 'admin_edit_cira'
]);
Route::patch('admin-ciras/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updateAdminCira',
    'as'   => 'admin_update_cira'
]);


/*
 * CRUD Administradores CGM
 */


Route::get('admincgm/create', [
    'uses' => 'AdminAuth\AdminController@createAdmincgm',
    'as'   => 'admin_cgm_create'
]);
Route::post('admincgm/create', [
    'uses' => 'AdminAuth\AdminController@storeAdmincgm',
    'as'   => 'admin_cgm_store'
]);
// Listar CGM
Route::get('admin-cgms', [
    'uses' => 'AdminAuth\AdminController@adminCgmsList',
    'as'   => 'admin_cgms_list'
]);

Route::get('admin-cgms/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editAdminCgm',
    'as'   => 'admin_edit_cgm'
]);
Route::patch('admin-cgms/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updateAdminCgm',
    'as'   => 'admin_update_cgm'
]);
Route::get('admin-cgms/delete/{id}', [
    'uses' => 'AdminAuth\AdminController@deleteAdminCgm',
    'as'   => 'admin_delete_cgm'
]);
/*
 * CRUD Administradores CALIFICACIONES
 */
Route::get('admincalificaciones/create', [
    'uses' => 'AdminAuth\AdminController@createAdmincalificacion',
    'as'   => 'admin_calificacion_create'
]);
Route::post('admincalificaciones/create', [
    'uses' => 'AdminAuth\AdminController@storeAdmincalificacion',
    'as'   => 'admin_calificacion_store'
]);

// Listar calificaciones
Route::get('admin-calificaciones', [
    'uses' => 'AdminAuth\AdminController@adminCalificacionesList',
    'as'   => 'admin_calificaciones_list'
]);

Route::get('admin-calificacion/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editAdminCalificacion',
    'as'   => 'admin_edit_calificacion'
]);
Route::patch('admin-calificacion/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updateAdminCalificacion',
    'as'   => 'admin_update_calificacion'
]);//admin_delete_calificacion
Route::get('admin-calificacion/delete/{id}', [
    'uses' => 'AdminAuth\AdminController@deleteAdminCalificacion',
    'as'   => 'admin_delete_calificacion'
]);
/*
 * CRUD Administradores CATASTROS
 */
Route::get('admincatastro/create', [
    'uses' => 'AdminAuth\AdminController@createAdmincatastro',
    'as'   => 'admin_catastro_create'
]);
Route::post('admincatastro/create', [
    'uses' => 'AdminAuth\AdminController@storeAdmincatastro',
    'as'   => 'admin_catastro_store'
]);

// Listar catastros
Route::get('admin-catastros', [
    'uses' => 'AdminAuth\AdminController@adminCatastrosList',
    'as'   => 'admin_catastros_list'
]);

Route::get('admin-catastro/editar/{id}', [
    'uses' => 'AdminAuth\AdminController@editAdminCatastro',
    'as'   => 'admin_edit_catastro'
]);
Route::patch('admin-catastro/actualizar/{id}', [
    'uses' => 'AdminAuth\AdminController@updateAdminCatastro',
    'as'   => 'admin_update_catastro'
]);//admin_delete_catastro
Route::get('admin-catastro/delete/{id}', [
    'uses' => 'AdminAuth\AdminController@deleteAdminCatastro',
    'as'   => 'admin_delete_catastro'
]);
//24-nov
//recepcionar afpa

//vistarecepcion
Route::get('recepcionAFPA', [
    'uses' => 'ciraController@recepcionAFPA',
    'as'    => 'recepcionar_afpa'
]);
//recepcion de calificados en afpa
Route::post('recepcionPA', [
    'uses' => 'ciraController@recepcionarPatrimonio',
    'as'   => 'recep_afpa'
]);

//lista para SDDPCDPC
Route::get('enviar-sddpcdpc', [
    'uses' => 'ciraController@listaSD',
    'as'    => 'ver_enviar_sd'
]);

//enviar SDDPCDPC
Route::get('enviar_sdd/{hr}', [
    'uses' => 'ciraController@enviarSD',
    'as'   => 'enviar_patrimonio'
]);