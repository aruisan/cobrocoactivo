@extends('layouts.dashboard')
@section('titulo')
    Archivos
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busquedaArchivos" class="btn btn-primary hidden"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">

        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Archivos</b></h4>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('archivos-list') #tabArchivo @endcan">ARCHIVO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('manualContrataciones-list') #tabMC @endcan">MANUAL DE CONTRATACIÓN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('planAdquisiciones-list') #tabPA @endcan">PLAN DE ADQUISICIONES</a>
                </li>
            </ul>
        <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabArchivo" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($Documents) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del Documento</th>
                                <th class="text-center">Fecha de Entrada</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Número</th>
                                <th class="text-center">Fecha de Vencimiento</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Responsable</th>
                                <th class="text-center">Tercero</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Documents as $key => $data)
                                <tr class="text-center">
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->ff_document }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->number_doc }}</td>
                                    <td>{{ $data->ff_vence }}</td>
                                    <td>
                                        @if($data->estado == "0")
                                            Pendiente
                                        @elseif($data->estado == "1")
                                            Aprobado
                                        @elseif($data->estado == "2")
                                            Rechazado
                                        @else
                                            Archivado
                                        @endif
                                    </td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->tercero->nombre }}</td>
                                    <td>
                                        <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{ url('dashboard/archivo/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay archivos almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/archivo/create') }}" title="Editar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Archivo</a>
                    </center>
                </div>
                <div id="tabMC" class="tab-pane fade">
                    <br>
                    <div class="table-responsive">
                        <br>
                        @if(count($ManualC) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrS">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del Manual</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($ManualC as $key => $manual)
                                <tr class="text-center">
                                    <td>{{ $manual->id }}</td>
                                    <td>{{ $manual->ff_document }}</td>
                                    <td>{{ $manual->name }}</td>
                                    <td>
                                        <a href="{{Storage::url($manual->resource->ruta)}}" target="_blank" title="Archivo" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{ asset('/dashboard/archivo/manual/'.$manual->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay manuales de contratación almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/archivo/manual/create') }}" title="Agregar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar Manual de Contratación</a>
                    </center>
                </div>
                <div id="tabPA" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($PlanA) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_PA">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del plan</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($PlanA as $key => $plan)
                                <tr class="text-center">
                                    <td>{{ $plan->id }}</td>
                                    <td>{{ $plan->ff_document }}</td>
                                    <td>{{ $plan->name}}</td>
                                    <td>
                                        <a href="{{Storage::url($plan->resource->ruta)}}" target="_blank" title="Archivo" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{ asset('/dashboard/archivo/plan/'.$plan->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay planes de adquisiciones almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/archivo/plan/create') }}" title="Nuevo" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Plan de Adquisiciones</a>
                    </center>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
      
            
   $('#tabla_corrE').DataTable({
	language: {
			  "lengthMenu": "Mostrar _MENU_ registros",
			  "zeroRecords": "No se encontraron resultados",
			  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			  "sSearch": "Buscar:",
			  "oPaginate": {
				  "sFirst": "Primero",
				  "sLast":"Último",
				  "sNext":"Siguiente",
				  "sPrevious": "Anterior"
			   },
			   "sProcessing":"Procesando...",
		  },
	  //para usar los botones
	  "pageLength": 5,   
	  responsive: "true",
	  dom: 'Bfrtilp',       
	  buttons:[ 
			  {
			  extend:    'copyHtml5',
			  text:      '<i class="fa fa-clone"></i> ',
			  titleAttr: 'Copiar',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'excelHtml5',
			  text:      '<i class="fa fa-file-excel-o"></i> ',
			  titleAttr: 'Exportar a Excel',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
			  pageSize: 'LEGAL',
			  className: 'btn btn-primary',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-primary'
		  },
	  ]	             

		 });
		

           $('#tabla_corrS').DataTable({
	language: {
			  "lengthMenu": "Mostrar _MENU_ registros",
			  "zeroRecords": "No se encontraron resultados",
			  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			  "sSearch": "Buscar:",
			  "oPaginate": {
				  "sFirst": "Primero",
				  "sLast":"Último",
				  "sNext":"Siguiente",
				  "sPrevious": "Anterior"
			   },
			   "sProcessing":"Procesando...",
		  },
	  //para usar los botones
	  "pageLength": 5,   
	  responsive: "true",
	  dom: 'Bfrtilp',       
	  buttons:[ 
			  {
			  extend:    'copyHtml5',
			  text:      '<i class="fa fa-clone"></i> ',
			  titleAttr: 'Copiar',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'excelHtml5',
			  text:      '<i class="fa fa-file-excel-o"></i> ',
			  titleAttr: 'Exportar a Excel',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
			  pageSize: 'LEGAL',
			  className: 'btn btn-primary',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-primary'
		  },
	  ]	             

		 });

   $('#tabla_PA').DataTable({
	language: {
			  "lengthMenu": "Mostrar _MENU_ registros",
			  "zeroRecords": "No se encontraron resultados",
			  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			  "sSearch": "Buscar:",
			  "oPaginate": {
				  "sFirst": "Primero",
				  "sLast":"Último",
				  "sNext":"Siguiente",
				  "sPrevious": "Anterior"
			   },
			   "sProcessing":"Procesando...",
		  },
	  //para usar los botones
	  "pageLength": 5,   
	  responsive: "true",
	  dom: 'Bfrtilp',       
	  buttons:[ 
			  {
			  extend:    'copyHtml5',
			  text:      '<i class="fa fa-clone"></i> ',
			  titleAttr: 'Copiar',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'excelHtml5',
			  text:      '<i class="fa fa-file-excel-o"></i> ',
			  titleAttr: 'Exportar a Excel',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
			  pageSize: 'LEGAL',
			  className: 'btn btn-primary',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-primary'
		  },
	  ]	             

		 });


        
    </script>
@stop