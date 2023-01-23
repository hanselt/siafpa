<?php
Route::group(['prefix' => 'admincatastro'], function() {

    Route::get('/home', function () {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admincatastro')->user();

        //dd($users);

        return view('admincatastro.home');
    })->name('home');
    //perfil
    Route::get('/perfil', function () {
        return view('admincatastro/perfil');
    });
    //password

    //monumentos
    Route::get('ver-monumentos', [
        'uses' => 'Gen_monumentoController@indexfromAdmin',
        'as'    => 'ver_monumentos_admin'
    ]);


    // crear  monumentos
    Route::get('monumento/create', [
        'uses' => 'Gen_monumentoController@create',
        'as'   => 'admin_monumento_create'
    ]);
    Route::post('monumento/create', [
        'uses' => 'Gen_monumentoController@store',
        'as'    => 'admin_monumento_store'
    ]);
    Route::get('monumento/editar/{id}', [
        'uses' => 'Gen_monumentoController@edit',
        'as'   => 'admin_monumento_edit'
    ]);
    Route::patch('monumento/actualizar/{id}', [
        'uses' => 'Gen_monumentoController@update',
        'as'   => 'admin_monumento_update'
    ]);
    Route::get('monumento/archivos/{id}', [
        'uses' => 'Gen_monumentoController@createArchivos',
        'as'   => 'admin_archivos_create'
    ]);
    Route::post('monumento/archivos/{id}',[
        'uses' =>'Gen_monumentoController@storeArchivos',
        'as'   =>'admin_archivos_Store'
    ]);


    //UBIGEO
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

});