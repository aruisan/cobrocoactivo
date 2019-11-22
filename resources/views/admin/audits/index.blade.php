@extends('layouts.dashboard')
@section('titulo')
    Logs
@stop
@section('content')
    <div class="col-md-12 align-self-center">

        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Logs</b></h4>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabCreate">Creaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabUpdate">Actualizaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabDelete">Eliminaciones</a>
                </li>
            </ul>
        <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabCreate" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($created) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha de Creación</th>
                                <th class="text-center">Usuario Responsable</th>
                                <th class="text-center">Id Registro Afectado</th>
                                <th class="text-center">Modelo Afectado</th>
                                <th class="text-center">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($created as $key => $data)
                                <tr class="text-center">
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->auditable_id }}</td>
                                    <td>{{ $data->auditable_type }}</td>
                                    <td>
                                        <a href="{{ url('admin/audits/'.$data->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no se han creado registros.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="tabUpdate" class="tab-pane fade">
                    <br>
                    <div class="table-responsive">
                        <br>
                        @if(count($updated) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrS">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha de Actualización</th>
                                <th class="text-center">Usuario Responsable</th>
                                <th class="text-center">Id Registro Afectado</th>
                                <th class="text-center">Modelo Afectado</th>
                                <th class="text-center">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($updated as $key => $manual)
                                <tr class="text-center">
                                    <td>{{ $manual->id }}</td>
                                    <td>{{ $manual->created_at }}</td>
                                    <td>{{ $manual->user->name }}</td>
                                    <td>{{ $manual->auditable_id }}</td>
                                    <td>{{ $manual->auditable_type }}</td>
                                    <td>
                                        <a href="{{ asset('admin/audits/'.$manual->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no se han realizado actualizaciones a los registros.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="tabDelete" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($deleted) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_PA">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha de Eliminación</th>
                                <th class="text-center">Usuario Responsable</th>
                                <th class="text-center">Id Registro Afectado</th>
                                <th class="text-center">Modelo Afectado</th>
                                <th class="text-center">Ver</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($deleted as $key => $plan)
                                <tr class="text-center">
                                    <td>{{ $plan->id }}</td>
                                    <td>{{ $plan->created_at }}</td>
                                    <td>{{ $plan->user->name }}</td>
                                    <td>{{ $plan->auditable_id }}</td>
                                    <td>{{ $plan->auditable_type }}</td>
                                    <td>
                                        <a href="{{ asset('admin/audits/'.$plan->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no se han eliminado registros.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
          

 $('#tabla_corrE').DataTable( {
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
			  className: 'btn btn-success'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX',
			  header :true,
              	exportOptions: {
				  columns: [ 0,1,2,3,4]
					},
			  pageSize: 'LEGAL',
			  className: 'btn btn-danger',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info'
		  },
	  ]	             

		 });

          $('#tabla_corrS').DataTable( {
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
			  className: 'btn btn-success'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX',
			  header :true,
              	exportOptions: {
				  columns: [ 0,1,2,3,4]
					},
			  pageSize: 'LEGAL',
			  className: 'btn btn-danger',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info'
		  },
	  ]	             

		 });
      

               $('#tabla_PA').DataTable( {
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
			  className: 'btn btn-success'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX',
			  header :true,
              	exportOptions: {
				  columns: [ 0,1,2,3,4]
					},
			  pageSize: 'LEGAL',
			  className: 'btn btn-danger',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info'
		  },
	  ]	             

		 });

        $(document).ready(function() {
            var table = $('#tabla_corrE').DataTable();
            var table = $('#tabla_corrS').DataTable();
            var table = $('#tabla_PA').DataTable();
        });
        
    </script>
@stop