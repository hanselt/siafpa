<?php

Route::group(['prefix' => 'admincalificacion'], function() {
    
    Route::get('/home', function () {
      /*  $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admincalificacion')->user();

        //dd($users);*/

        return view('admincalificacion.home');
    })->name('home');

    Route::get('/perfil', function () {
        return view('admincalificacion/perfil');
    });
    //password

    Route::get('cargarccia', 'ImportarExcelController@cargarccia');
    Route::post('cargarccia', 'ImportarExcelController@cargarcciaPOST');
    Route::get('importarccia','ImportarExcelController@importarCiaProyectos');
    Route::resource('/ccia', 'Cia_proyectosController');

    //
    Route::resource('ciaproyectos', 'Cia_proyectosController');

    /////
    //CIRA Registro
    Route::get('crear/cia','ciaController@create');
    Route::post('crear/cia','ciaController@guardar');

    //Listar pma antecedentes
    Route::get('pmas',[
        'uses'=>'ciaController@listaPmas',
        'as'=>'ver_pmas'
    ]);
    //Listar cia antecedentes 
    Route::get('cias',[
        'uses'=>'ciaController@listaCias',
        'as'=>'ver_cias'
    ]);
    //Ver ingresos
    Route::get('ver-ccia', [
        'uses' => 'ciaController@listaIngresos',
        'as'    => 'ver_control_ingreso'
    ]);
    //Asignar Calificador
    Route::get('calificador/{id}/{dni}', [
        'uses' => 'ciaController@asignarCalificador',
        'as'   => 'admin_cia_asignar'
    ]);
    //Control de tiempos
    Route::get('ver-tiempos', [
        'uses' => 'ciaController@listarTiempos',
        'as'    => 'ver_control_tiempos'
    ]);
    //Listar de exp a recepcionar
    Route::get('ver-exp', [
        'uses' => 'ciaController@listarIngresosCal',
        'as'    => 'ver_recepcion_exp'
    ]);
    //Recepcionar Exp
    Route::get('recepcalificador/{hr}', [
        'uses' => 'ciaController@recepcionarExp',
        'as'   => 'admin_cal_recepcionar'
    ]);
    //SOLICITAR OPINION AREAS
    //Listar Exp para areas
    Route::get('ver-areas', [
        'uses' => 'ciaController@listaAreas',
        'as'    => 'ver_areas'
    ]);
    //dar areas
    //Asignar areas
    Route::get('areas/{id}/{dni}', [
        'uses' => 'ciaController@asignarAreas',
        'as'   => 'areas_calificar'
    ]);
    //Listar Exp recepcionar areas
    Route::get('ver-rareas', [
        'uses' => 'ciaController@listaAreasR',
        'as'    => 'ver_rareas'
    ]);
    //areas
    //recepcionar area
    Route::get('r-areas/{id}/{dni}', [
        'uses' => 'ciaController@recepcionarAreas',
        'as'   => 'admin_rareas'
    ]);
    //ENDOP


    //Listar Exp para calificar
    Route::get('ver-calificacion', [
        'uses' => 'ciaController@listaCalificados',
        'as'    => 'ver_control_cal'
    ]);
    //Calificar
    //Asignar Calificador
    Route::get('calificacion/{id}/{dni}', [
        'uses' => 'ciaController@asignarEstado',
        'as'   => 'admin_cia_calificar'
    ]);
    //Asignar Abogado
    Route::get('ver-abogados', [
        'uses' => 'ciaController@listaCalAsignacion',
        'as'    => 'ver_abog_exp'
    ]);
    //13-11 Asignar abogado a expediente
    Route::get('abogado/{id}/{dni}', [
        'uses' => 'ciaController@asignarAbogado',
        'as'   => 'admin_cia_abg'
    ]);
    //observados 
    Route::get('ver-observados', [
        'uses' => 'ciaController@listaObs',
        'as'    => 'ver_obs_exp'
    ]);
    Route::get('recepcionarObs/{hr}', [
        'uses' => 'ciaController@recepcionarObs',
        'as'   => 'admin_obs'
    ]);
    //oficiados listaOficiar
    Route::get('ver-oficiados', [
        'uses' => 'ciaController@listaOficiar',
        'as'    => 'ver_ofi_exp'
    ]);
    Route::get('oficiar/{hr}/{fecha}', [
        'uses' => 'ciaController@oficiar',
        'as'   => 'admin_oficiar'
    ]);
    //14 de noviembre
    //ver 
    Route::get('ver-oficiados', [
        'uses' => 'ciaController@listaOficiar',
        'as'    => 'ver_ofi_exp'
    ]);
    //15 nov
    Route::get('recepcionarAbg', [
        'uses' => 'ciaController@recepcionarAbg',
        'as'   => 'admin_abg_recepcionar'
    ]);

    //17
    Route::get('calificarAbg', [
        'uses' => 'ciaController@listaCalificarAbg',
        'as'    => 'ver_abg_op'
    ]);

    //20
    Route::get('recepcionarExpAbg/{hr}', [
        'uses' => 'ciaController@recepcionarAbogado',
        'as'   => 'admin_exp_abg'
    ]);
    Route::get('AbogadoCalificar/{hr}/{estado}', [
        'uses' => 'ciaController@AbogadoCal',
        'as'   => 'Abogado_cal'
    ]);
    //vistarecepcion
    Route::get('recepcionCertificaciones', [
        'uses' => 'ciaController@recepcionarCC',
        'as'    => 'recepcionar_cc'
    ]);
    //recepcion de calificados en cc
    Route::post('recepcionCcia', [
        'uses' => 'ciaController@recepcionarCalificaciones',
        'as'   => 'recep_ccia'
    ]);
    //envio a afpa
    Route::get('enviar-afpa', [
        'uses' => 'ciaController@listaEnviar',
        'as'    => 'ver_enviar_afpa'
    ]);
    //enviar a afpa 1
    Route::get('enviar_Afpa/{hr}', [
        'uses' => 'ciaController@enviarAFPA',
        'as'   => 'enviar_patrimonio'
    ]);
    //recepcionar afpa

    //lista para SDDPCDPC

    //enviar SDDPCDPC
    Route::get('enviar_Afpa/{begin}/{end}', [
        'uses' => 'ciaController@diasLab',
        'as'   => 'dias_labb'
    ]);

    //CREAR antecedentes 11-12  
    Route::get('crear/ciaantecedente','ciaController@createantecedente');
    Route::post('crear/ciaantecedente','ciaController@guardarantecedente');

});