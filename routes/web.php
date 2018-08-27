<?php


Route::get('/', function () {
    return view('visitante.index');
});

Auth::routes();

//Route::get('/home', 'Cobro\HomeController@index')->name('home');


Route::group([ 'middleware' => 'auth'] ,function(){
	Route::get('dashboard', 'DashboardController@index');
	Route::resource('predios', 'Hacienda\Cobro\Predial\PredioController');


	////////////////////admin//////////////////
	Route::group(['prefix' => 'admin'] ,function () 
	{
		//Route::resource('personas', 'PersonasController');
		//Route::resource('funcionarios', 'Admin\FuncionariosController');

		//crud funcionarios
		Route::get('funcionarios', 'Admin\FuncionariosController@index')->name('admin.funcionarios');
		//Route::get('funcionarios/create', 'Admin\FuncionariosController@create')->middleware('permission:create_funcionarios');
		Route::get('funcionarios/create', 'Admin\FuncionariosController@create');
		Route::post('funcionarios', 'Admin\FuncionariosController@store');
		Route::get('funcionarios/{id}/edit', 'Admin\FuncionariosController@edit');
		Route::patch('funcionarios/{id}', 'Admin\FuncionariosController@update');
		Route::delete('funcionarios/{id}', 'Admin\FuncionariosController@destroy');
		Route::get('funcionarios/jefes/{id}', 'Admin\FuncionariosController@jefe');

		//crud de roles
		Route::get('roles', 'Admin\RolesController@index')->name('admin.roles');
		Route::get('roles/create', 'Admin\RolesController@create');
		Route::post('roles', 'Admin\RolesController@store');
		Route::get('roles/{id}', 'Admin\RolesController@show');
		Route::get('roles/{id}/edit', 'Admin\RolesController@edit');
		Route::patch('roles/{id}', 'Admin\RolesController@update');
		Route::delete('roles/{id}', 'Admin\RolesController@destroy');




		////////////////////////////////////////////////////
		//Route::get('asignar/{id}', 'AsignarController@index');
		//Route::resource('asignar', 'AsignarController');
/*
		Route::get('predios-sin-asignar', 'PredioController@predioSinAsignar')->name('unnassigned');
		Route::get('predios-asignados', 'PredioController@predioAsignado')->name('assignor');
		Route::post('predios-asignar', 'PredioController@predioAsignarAdministrativeStore')->name('assignor.store');
		Route::get('predio-expediente/{id}', 'PredioController@asignarExpediente')->name('assignor.expedient');

		Route::post('predio-asignar', 'PersonaPredioController@predioAsignarPersona');
		*/
		
		//Route::get('persona-find/{identificador}', 'PersonasController@personaFind');
		//Route::post('persona/find-create', 'PersonasController@PersonafindCreate');
		//Route::resource('personas-predios', 'PersonaPredioController');
		
		Route::get('usuarios-tipo/{id}', 'UserController@userstype');

		//Route::get('notificaciones', 'NotificationController@index')->name('notificaciones.index');
	    //Route::get('notificaciones/{id}', 'NotificationController@read')->name('notifications.read');
	    // Route::delete('notificaciones/{id}', 'NotificationController@destroy')->name('notifications.destroy');
	    //Route::get('notificaciones-visibilidad/{id}', 'NotificationController@visibilidad')->name('notification.visibilidad');

	    //Route::post('importar', 'ImportController@import')->name('importar');

	    //Route::resource('procesos','ProcesoController');

	    //Route::post('proceso-upload-file','ProcesoController@uploadFile')->name('proceso.upload.file');

	});

	////// RUTAS PRESUPUESTO
    Route::group(['prefix' => 'presupuesto'] ,function ()
    {
        Route::Resource('/', 'Hacienda\Presupuesto\PresupuestoController');

        Route::get('vigencia/create/{tipo}', 'Hacienda\Presupuesto\VigenciaController@create');
        Route::resource('vigencia', 'Hacienda\Presupuesto\VigenciaController');

        Route::get('level/create/{vigencia}', 'Hacienda\Presupuesto\LevelController@create');
        Route::resource('level', 'Hacienda\Presupuesto\LevelController');

        Route::get('registro/create/{vigencia}/{level}', 'Hacienda\Presupuesto\RegistroController@create');
        Route::resource('registro', 'Hacienda\Presupuesto\RegistroController');

        Route::get('font/create/{vigencia}', 'Hacienda\Presupuesto\FontsController@create');
        Route::resource('font', 'Hacienda\Presupuesto\FontsController');

        Route::get('rubro/create/{vigencia}', 'Hacienda\Presupuesto\RubrosController@create');
        Route::resource('rubro', 'Hacienda\Presupuesto\RubrosController');

        Route::resource('FontRubro', 'Hacienda\Presupuesto\FontRubroController');
        Route::resource('FontRubro/saldo', 'Hacienda\Presupuesto\FontRubroController@saldoFont');

    });

    ////// RUTAS PLAN DE DESARROLLO
    Route::group(['prefix' => 'pdd'] ,function ()
    {
        Route::resource('/','Planeacion\Pdd\PdesarrolloController');

        Route::get('data/create/{pdd}','Planeacion\Pdd\EjesController@create');
        Route::resource('eje','Planeacion\Pdd\EjesController');

        Route::resource('programa','Planeacion\Pdd\ProgramasController');

        Route::get('proyecto/create/{pdd}','Planeacion\Pdd\ProyectosController@create');
        Route::resource('proyecto','Planeacion\Pdd\ProyectosController');

        Route::get('subproyecto/create/{pdd}','Planeacion\Pdd\SubproyectosController@create');
        Route::resource('subproyecto','Planeacion\Pdd\SubproyectosController');

        Route::get('producto/create/{pdd}','Planeacion\Pdd\ProductoController@create');
        Route::resource('producto','Planeacion\Pdd\ProductoController');

        Route::get('periodo/create/{producto}','Planeacion\Pdd\PeriodoController@create');
        Route::resource('periodo','Planeacion\Pdd\PeriodoController');

    });

});

//Route::get('/home', 'HomeController@index')->name('home');

