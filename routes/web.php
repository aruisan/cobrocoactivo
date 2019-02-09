<?php


Route::get('/', 'VisitanteController@index');





Route::get('/info', function(){
	dd(phpinfo());
});

Auth::routes();

//Route::get('/home', 'Cobro\HomeController@index')->name('home');


Route::group([ 'middleware' => 'auth'] ,function(){
	Route::get('dashboard', 'DashboardController@index');
	Route::resource('predios', 'Hacienda\Cobro\Predial\PredioController');

	//gestion de creacion y relacion de personas
	Route::post('persona/relacionar', 'PersonasController@PersonafindCreate')->name('persona.relacionar');
	Route::get('persona-identtificar/{identificador}', 'PersonasController@personaIdentificar')->name('persona.identificar');
	Route::resource('personas', 'PersonasController');
	Route::post('avatar', 'UserController@editAvatar')->name('user-avatar');
	Route::post('password', 'UserController@editPassword')->name('user-password');
	//Route::get('usuarios-tipo/{id}', 'UserController@userstype');

	////////////////////admin//////////////////
	Route::group(['prefix' => 'dashboard'] ,function () 
	{
		Route::get('notificaciones', 'NotificationController@index')->name('notificaciones.index');

		Route::get('notificaciones/{id}', 'NotificationController@read')->name('notifications.read');
		Route::delete('notificaciones/{id}', 'NotificationController@destroy')->name('notifications.destroy');
		Route::get('notificaciones-visibilidad/{id}', 'NotificationController@visibilidad')->name('notification.visibilidad');

		
		Route::resource('terceros', 'Administrativo\TercerosController');
		Route::resource('contractual', 'Administrativo\Contractual\ContractualController');
		Route::resource('administrativos', 'Sansonatorio\AdministrativoController');
		Route::resource('comisariafamilia', 'Convivencia\ComisariaFamiliaController');
		Route::resource('comiteconciliacion', 'Judicial\ComiteConsiliacionController');
		Route::resource('comparendos', 'Convivencia\ComparendoController');

        //RUTAS BOLETINES

        Route::Resource('boletines','Administrativo\GestionDocumental\BoletinesController');
        Route::get('/boletines/create','Administrativo\GestionDocumental\BoletinesController@create');


        //RUTAS ARCHIVO

        Route::get('/archivo/create','Administrativo\GestionDocumental\ArchivoController@create');
        Route::Resource('archivo','Administrativo\GestionDocumental\ArchivoController');
        Route::Resource('/archivo/manual','Administrativo\GestionDocumental\ManualContratController');
        Route::get('/archivo/manual/create','Administrativo\GestionDocumental\ManualContratController@create');
        Route::Resource('/archivo/plan','Administrativo\GestionDocumental\PlanAdquiController');
        Route::get('/archivo/plan/create','Administrativo\GestionDocumental\PlanAdquiController@create');


        //RUTAS CORRESPONDENCIA
		Route::get('correspondencia/create/{id}','Administrativo\GestionDocumental\CorrespondenciaController@create');
		Route::resource('correspondencia', 'Administrativo\GestionDocumental\CorrespondenciaController');

		//RUTAS ACUERDOS

        Route::Resource('acuerdos','Administrativo\GestionDocumental\Acuerdos\AcuerdosController');
        Route::get('/acuerdos/create','Administrativo\GestionDocumental\Acuerdos\AcuerdosController@create');
        Route::Resource('/acuerdos/proyectos','Administrativo\GestionDocumental\Acuerdos\ProyectosAcuerdoController');
        Route::get('/acuerdos/proyectos/create','Administrativo\GestionDocumental\Acuerdos\ProyectosAcuerdoController@create');
        Route::Resource('/acuerdos/actas','Administrativo\GestionDocumental\Acuerdos\ActasController');
        Route::get('/acuerdos/actas/create','Administrativo\GestionDocumental\Acuerdos\ActasController@create');
        Route::Resource('/acuerdos/resoluciones','Administrativo\GestionDocumental\Acuerdos\ResolucionesController');
        Route::get('/acuerdos/resoluciones/create','Administrativo\GestionDocumental\Acuerdos\ResolucionesController@create');


        //RUTAS COMISIONES

        Route::get('/comision/{id}/','Administrativo\GestionDocumental\Comisiones\ComisionesController@index');

        //RUTAS CONCEJALES

        Route::Resource('concejales','Administrativo\GestionDocumental\ConcejalController');
        Route::get('/concejales/create','Administrativo\GestionDocumental\ConcejalController@create');

        //RUTAS MESA DIRECTIVA

        Route::Resource('/mesaDir/','Administrativo\GestionDocumental\MesaDirectivaController');

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
		Route::resource('rutas', 'Configuracion\Rutas\RutaController');
		Route::get('ruta-orden/{id}', 'Configuracion\Rutas\RutaController@rutaOrden')->name('ruta.orden');
		Route::get('ruta-orden/{id}/create', 'Configuracion\Rutas\RutaController@rutaOrdenCreate')->name('ruta.orden.create');
		Route::post('ruta-orden/', 'Configuracion\Rutas\RutaController@rutaOrdenStore')->name('ruta.orden.store');
		Route::get('ruta-orden/{ruta}/edit/{id}', 'Configuracion\Rutas\RutaController@rutaOrdenEdit')->name('ruta.orden.edit');
		Route::put('ruta-orden/{ruta}/update/{id}', 'Configuracion\Rutas\RutaController@rutaOrdenUpdate')->name('ruta.orden.update');
		Route::delete('ruta-orden/{ruta}/delete/{id}', 'Configuracion\Rutas\RutaController@rutaOrdenDestroy')->name('ruta.orden.delete');

	});

	Route::group(['prefix' => 'administrativo'] ,function () 
	{
	    //Registros
	    Route::resource('registros', 'Administrativo\Registro\RegistrosController');
        Route::get('registros/{id}/{fecha}/{valor}/{estado}', 'Administrativo\Registro\RegistrosController@updateEstado');
        //Route::put('registros/r/{id}/{rol}/{estado}', 'Administrativo\Registro\RegistrosController@rechazar');
        Route::resource('cdpsRegistro','Administrativo\Registro\CdpsRegistroController');
        //pdf registros
		Route::get('/registro/pdf/{id}', 'Administrativo\Registro\RegistrosController@pdf')->name('registro-pdf');

        //CDP's

        Route::resource('cdp', 'Administrativo\Cdp\CdpController');
        Route::Resource('rubrosCdp','Administrativo\Cdp\RubrosCdpController');
        Route::Resource('rubrosCdp/valor','Administrativo\Cdp\RubrosCdpValorController');
        Route::get('cdp/{id}/{rol}/{fecha}/{valor}/{estado}', 'Administrativo\Cdp\CdpController@updateEstado');
        Route::put('cdp/r/{id}', 'Administrativo\Cdp\CdpController@rechazar');
        //pdf cdp
		Route::get('/cdp/pdf/{id}', 'Administrativo\Cdp\CdpController@pdf')->name('cpd-pdf');

        Route::resource('marcas-herretes', 'Administrativo\MarcaHerrete\MarcaHerreteController');
        Route::get('persona-find/{identificador}', 'Cobro\PersonasController@personaFind');
        Route::post('persona/find-create', 'Cobro\PersonasController@PersonafindCreate');
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
		
        //RUTAS ORDEN DEL DIA

        Route::resource('ordenDia','Admin\OrdenDiaController');

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
		

	    //Route::post('importar', 'ImportController@import')->name('importar');

	    //Route::resource('procesos','ProcesoController');

	    //Route::post('proceso-upload-file','ProcesoController@uploadFile')->name('proceso.upload.file');

	});

	////// RUTAS PRESUPUESTO


	Route::Resource('presupuesto', 'Hacienda\Presupuesto\PresupuestoController');
	Route::get('presupuesto/vigencia/create/{tipo}', 'Hacienda\Presupuesto\VigenciaController@create');
	Route::resource('presupuesto/vigencia', 'Hacienda\Presupuesto\VigenciaController');
	Route::get('presupuesto/level/create/{vigencia}', 'Hacienda\Presupuesto\LevelController@create');
	Route::resource('presupuesto/level', 'Hacienda\Presupuesto\LevelController');
	Route::get('presupuesto/registro/create/{vigencia}/{level}', 'Hacienda\Presupuesto\RegistroController@create');
	Route::resource('presupuesto/registro', 'Hacienda\Presupuesto\RegistroController');
	Route::get('presupuesto/font/create/{vigencia}', 'Hacienda\Presupuesto\FontsController@create');
	Route::resource('presupuesto/font', 'Hacienda\Presupuesto\FontsController');
	Route::get('presupuesto/rubro/create/{vigencia}', 'Hacienda\Presupuesto\RubrosController@create');
	Route::resource('presupuesto/rubro', 'Hacienda\Presupuesto\RubrosController');
    Route::put('presupuesto/rubro/m/{m}/{id}', 'Hacienda\Presupuesto\RubrosMovController@movimiento');
	Route::resource('presupuesto/FontRubro', 'Hacienda\Presupuesto\FontRubroController');
	Route::resource('presupuesto/FontRubro/saldo', 'Hacienda\Presupuesto\FontRubroController@saldoFont');
	
    ////// RUTAS PLAN DE DESARROLLO
	Route::resource('pdd','Planeacion\Pdd\PdesarrolloController');
	Route::get('pdd/data/create/{pdd}','Planeacion\Pdd\EjesController@create');
	Route::resource('pdd/eje','Planeacion\Pdd\EjesController');
	Route::resource('pdd/programa','Planeacion\Pdd\ProgramasController');
	Route::get('pdd/proyecto/create/{pdd}','Planeacion\Pdd\ProyectosController@create');
	Route::resource('pdd/proyecto','Planeacion\Pdd\ProyectosController');
	Route::get('pdd/subproyecto/create/{pdd}','Planeacion\Pdd\SubproyectosController@create');
	Route::resource('pdd/subproyecto','Planeacion\Pdd\SubproyectosController');
	Route::get('pdd/producto/create/{pdd}','Planeacion\Pdd\ProductoController@create');
	Route::resource('pdd/producto','Planeacion\Pdd\ProductoController');
	Route::get('pdd/periodo/create/{producto}','Planeacion\Pdd\PeriodoController@create');
	Route::resource('pdd/periodo','Planeacion\Pdd\PeriodoController');



	////// RUTAS ALMACEN

	Route::get('almacen/nuevaEntrada','Hacienda\Almacen\AlmacenController@nuevaEntrada');
	Route::get('almacen/inventarioEntradas','Hacienda\Almacen\AlmacenController@inventarioEntradas');
	Route::get('almacen/inventarioSalidas','Hacienda\Almacen\AlmacenController@inventarioSalidas');
	Route::get('almacen/entradas','Hacienda\Almacen\AlmacenController@entradas');
	Route::get('almacen/salidas','Hacienda\Almacen\AlmacenController@salidas');
	Route::Resource('almacen','Hacienda\Almacen\AlmacenController');

	////// RUTAS CONTRACTUAL

	// Route::get('/nuevaEntrada','Hacienda\Almacen\AlmacenController@nuevaEntrada');
	// Route::get('/inventarioEntradas','Hacienda\Almacen\AlmacenController@inventarioEntradas');
	// Route::get('/inventarioSalidas','Hacienda\Almacen\AlmacenController@inventarioSalidas');
	// Route::get('/entradas','Hacienda\Almacen\AlmacenController@entradas');
	Route::get('contractual/rubros','Administrativo\Contractual\VerRubrosController@index');
	Route::Resource('contractual','Administrativo\Contractual\ContractualController');


});