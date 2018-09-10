<?php


Route::get('/', function () {
	return view('visitante.index');
});
Route::get('/info', function(){
	dd(phpinfo());
});

Auth::routes();

//Route::get('/home', 'Cobro\HomeController@index')->name('home');


Route::group([ 'middleware' => 'auth'] ,function(){
	Route::get('dashboard', 'DashboardController@index');
	Route::resource('predios', 'Hacienda\Cobro\Predial\PredioController');


	////////////////////admin//////////////////
	Route::group(['prefix' => 'dashboard'] ,function () 
	{
		Route::get('notificaciones', 'NotificationController@index')->name('notificaciones.index');

		Route::get('notificaciones/{id}', 'NotificationController@read')->name('notifications.read');
		Route::delete('notificaciones/{id}', 'NotificationController@destroy')->name('notifications.destroy');
		Route::get('notificaciones-visibilidad/{id}', 'NotificationController@visibilidad')->name('notification.visibilidad');

		
		Route::resource('contractual', 'Administrativo\Contractual\ContractualController');
		Route::resource('administrativos', 'Sansonatorio\AdministrativoController');
		Route::resource('comisariafamilia', 'Convivencia\ComisariaFamiliaController');
		Route::resource('comiteconciliacion', 'Judicial\ComiteConsiliacionController');
		Route::resource('comparendos', 'Convivencia\ComparendoController');
		Route::resource('correspondencia', 'Administrativo\GestionDocumental\CorrespondenciaController');
		Route::resource('demandante', 'Judicial\DemandanteController');
		Route::resource('demandado', 'Judicial\DemandadoController');
		Route::resource('disciplinarios', 'Sansonatorio\DisciplinarioController');
		Route::resource('licenciasplaneacion', 'Planeacion\LicenciaPlaneacionController');
		Route::resource('maquinaria', 'Infraestructura\MaquinariaController');
		Route::resource('pazysalvo', 'Administrativo\PazYSalvoController');
		Route::resource('planmejoramiento', 'Auditoria\ControlInterno\PlanMejoramientoController');
		Route::resource('podaarboles', 'Administrativo\MedioAmbiente\PodaArbolController');
		Route::resource('policivo', 'Convivencia\PolicivoController');
		Route::resource('titulacionpredios', 'Administrativo\Vivienda\TitulacionPredioController');
		Route::resource('subirArchivo', 'SubirArchivoController');
		Route::resource('subirArchivoContractual', 'Administrativo\Contractual\SubirArchivoContractualController');

	});

	Route::group(['prefix' => 'administrativo'] ,function () 
	{
		Route::resource('registros', 'Administrativo\RegistrosController');
		
	});


	Route::group(['prefix' => 'admin'] ,function () 
	{

		//crud funcionarios
		Route::get('funcionarios/jefes/{id}', 'Admin\FuncionariosController@jefe');
		Route::resource('funcionarios', 'Admin\FuncionariosController');

		//crud de roles
		Route::resource('roles', 'Admin\RolesController');

		//crud dependencias
		Route::resource('dependencias', 'Admin\DependenciasController');
		Route::get('dependencias/listar', 'Admin\DependenciasController@listar')->name('dependencias.listar');
		




		////////////////////////////////////////////////////
		//Route::resource('personas', 'PersonasController');
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

		///// CDOP's

		Route::resource('cdp', 'Hacienda\Presupuesto\Cdp\CdpController');

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

////// RUTAS ALMACEN
Route::group(['prefix' => 'almacen'] ,function ()
{
	Route::get('/nuevaEntrada','Hacienda\Almacen\AlmacenController@nuevaEntrada');
	Route::get('/inventarioEntradas','Hacienda\Almacen\AlmacenController@inventarioEntradas');
	Route::get('/inventarioSalidas','Hacienda\Almacen\AlmacenController@inventarioSalidas');
	Route::get('/entradas','Hacienda\Almacen\AlmacenController@entradas');
	Route::get('/salidas','Hacienda\Almacen\AlmacenController@salidas');
	Route::Resource('/','Hacienda\Almacen\AlmacenController');

});

////// RUTAS CONTRACTUAL
Route::group(['prefix' => 'contractual'] ,function ()
{
	// Route::get('/nuevaEntrada','Hacienda\Almacen\AlmacenController@nuevaEntrada');
	// Route::get('/inventarioEntradas','Hacienda\Almacen\AlmacenController@inventarioEntradas');
	// Route::get('/inventarioSalidas','Hacienda\Almacen\AlmacenController@inventarioSalidas');
	// Route::get('/entradas','Hacienda\Almacen\AlmacenController@entradas');
	Route::get('/rubros','Administrativo\Contractual\VerRubrosController@index');
	Route::Resource('/','Administrativo\Contractual\ContractualController');
});