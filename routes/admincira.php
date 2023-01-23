<?php


Route::group(['prefix' => 'admincira'], function() {
    

    Route::get('/home', function () {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admincira')->user();

        //dd($users);

        return view('admincira.home');
    })->name('home');

    //perfil
    Route::get('/perfil', function () {
        return view('admincira/perfil');
    });
    //password

    //CIRA Registro
    Route::get('crear/cira','ciraController@create');
    Route::post('crear/cira','ciraController@guardar');
    //CREAR antecedentes 11-12  
    Route::get('crear/ciraantecedente','ciraController@createantecedente');
    Route::post('crear/ciraantecedente','ciraController@guardarantecedente');


    // CIRA 
    Route::get('cargarcira', 'ImportarExcelController@cargarcira');
    Route::post('cargarcira', 'ImportarExcelController@cargarciraPOST');
    Route::get('importarcira','ImportarExcelController@importarCIRA');
    Route::resource('cira', 'ciraController');

    // PMA 
    Route::get('cargarpma', 'ImportarExcelController@cargarpma');
    Route::post('cargarpma', 'ImportarExcelController@cargarpmaPOST');
    Route::get('importarpma','ImportarExcelController@importarPMA');
    Route::resource('pma', 'pmaController');

    //Listar pma antecedentes
    Route::get('pmas',[
        'uses'=>'ciraController@listaPmas',
        'as'=>'ver_pmas'
    ]);
    //Listar cira antecedentes
    Route::get('ciras',[
        'uses'=>'ciraController@listaCiras',
        'as'=>'ver_ciras'
    ]);
    //Ver ingresos
    Route::get('ver-cc', [
        'uses' => 'ciraController@listaIngresos',
        'as'    => 'ver_control_ingreso'
    ]);
    //Asignar Calificador
    Route::get('calificador/{id}/{dni}', [
        'uses' => 'ciraController@asignarCalificador',
        'as'   => 'admin_cira_asignar'
    ]);
    //Control de tiempos
    Route::get('ver-tiempos', [
        'uses' => 'ciraController@listarTiempos',
        'as'    => 'ver_control_tiempos'
    ]);
    //Listar de exp a recepcionar
    Route::get('ver-exp', [
        'uses' => 'ciraController@listarIngresosCal',
        'as'    => 'ver_recepcion_exp'
    ]);
    //Recepcionar Exp
    Route::get('recepcalificador/{hr}', [
        'uses' => 'ciraController@recepcionarExp',
        'as'   => 'admin_cal_recepcionar'
    ]);

    //Listar Exp para calificar
    Route::get('ver-calificacion', [
        'uses' => 'ciraController@listaCalificados',
        'as'    => 'ver_control_cal'
    ]);
    //Calificar
    //Asignar Calificador
    Route::get('calificacion/{id}/{dni}', [
        'uses' => 'ciraController@asignarEstado',
        'as'   => 'admin_cira_calificar'
    ]);
    //Asignar Abogado
    Route::get('ver-abogados', [
        'uses' => 'ciraController@listaCalAsignacion',
        'as'    => 'ver_abog_exp'
    ]);
    //13-11 Asignar abogado a expediente
    Route::get('abogado/{id}/{dni}', [
        'uses' => 'ciraController@asignarAbogado',
        'as'   => 'admin_cira_abg'
    ]);
    //observados 
    Route::get('ver-observados', [
        'uses' => 'ciraController@listaObs',
        'as'    => 'ver_obs_exp'
    ]);
    Route::get('recepcionarObs/{hr}', [
        'uses' => 'ciraController@recepcionarObs',
        'as'   => 'admin_obs'
    ]);
    //oficiados listaOficiar
    Route::get('ver-oficiados', [
        'uses' => 'ciraController@listaOficiar',
        'as'    => 'ver_ofi_exp'
    ]);
    Route::get('oficiar/{hr}/{fecha}', [
        'uses' => 'ciraController@oficiar',
        'as'   => 'admin_oficiar'
    ]);
    //14 de noviembre
    //ver 
    Route::get('ver-oficiados', [
        'uses' => 'ciraController@listaOficiar',
        'as'    => 'ver_ofi_exp'
    ]);
    //15 nov
    Route::get('recepcionarAbg', [
        'uses' => 'ciraController@recepcionarAbg',
        'as'   => 'admin_abg_recepcionar'
    ]);

    //17
    Route::get('calificarAbg', [
        'uses' => 'ciraController@listaCalificarAbg',
        'as'    => 'ver_abg_op'
    ]);

    //20
    Route::get('recepcionarExpAbg/{hr}', [
        'uses' => 'ciraController@recepcionarAbogado',
        'as'   => 'admin_exp_abg'
    ]);
    Route::get('AbogadoCalificar/{hr}/{estado}', [
        'uses' => 'ciraController@AbogadoCal',
        'as'   => 'Abogado_cal'
    ]);
    //vistarecepcion
    Route::get('recepcionCertificaciones', [
        'uses' => 'ciraController@recepcionarCC',
        'as'    => 'recepcionar_cc'
    ]);
    //recepcion de calificados en cc
    Route::post('recepcionCert', [
        'uses' => 'ciraController@recepcionarCertificaciones',
        'as'   => 'recep_cc'
    ]);
    //envio a afpa
    Route::get('enviar-afpa', [
        'uses' => 'ciraController@listaEnviar',
        'as'    => 'ver_enviar_afpa'
    ]);
    //enviar a afpa 1
    Route::get('enviar_Afpa/{hr}', [
        'uses' => 'ciraController@enviarAFPA',
        'as'   => 'enviar_patrimonio'
    ]);
    //recepcionar afpa

    //lista para SDDPCDPC

    //enviar SDDPCDPC
    Route::get('enviar_Afpa/{begin}/{end}', [
        'uses' => 'ciraController@diasLab',
        'as'   => 'dias_labb'
    ]);


});    