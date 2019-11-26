@extends('layouts.dashboard')
@section('titulo')
    Acuerdos
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busquedaAcuerdos" class="btn btn-primary hidden"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">

        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Acuerdos</b></h4>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('acuerdos-list') #tabAcuerdos @endcan">ACUERDOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('proyectosAcuerdos-list') #tabProy @endcan">PROYECTOS DE ACUERDO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('actas-list') #tabActas @endcan">ACTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('resoluciones-list') #tabRes @endcan">RESOLUCIONES</a>
                </li>
            </ul>
        <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabAcuerdos" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($Acuerdos) > 0)
                        <table class="table table-hover table-bordered" align="100%" id="tabla_Acuerdos">
                            <thead>
                            <tr>
                                <th class="text-center">Fecha del Documento</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Consecutivo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha de Salida</th>
                                <th class="text-center">Comisión</th>
                                <th class="text-center">Fecha 1er Debate</th>
                                <th class="text-center">Fecha 2do Debate</th>
                                <th class="text-center">Fecha de Aprobación</th>
                                <th class="text-center">Fecha de Sanción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Acuerdos as $key => $data)
                                <tr class="text-center">
                                    <td>{{ $data->ff_document }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->cc_id }}</td>
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
                                    <td>{{ $data->ff_salida }}</td>
                                    <td>{{ $data->comision->name }}</td>
                                    <td>{{ $data->ff_primerdbte }}</td>
                                    <td>{{ $data->ff_segundodbte }}</td>
                                    <td>{{ $data->ff_aprobacion }}</td>
                                    <td>{{ $data->ff_sancion }}</td>
                                    <td>
                                        <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{ url('dashboard/acuerdos/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay acuerdos almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/acuerdos/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Acuerdo</a>
                    </center>
                </div>
                <div id="tabProy" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($ProyAcuerdos) > 0)
                            <table class="table table-hover table-bordered" align="100%" id="tabla_Proy">
                                <thead>
                                <tr class="text-center">
                                    <th>Fecha del Documento</th>
                                    <th>Fecha de Entrada</th>
                                    <th>Nombre</th>
                                    <th>Fecha de Modificación</th>
                                    <th>Consecutivo</th>
                                    <th>Estado</th>
                                    <th>Fecha de Salida</th>
                                    <th>Comisión</th>
                                    <th>Fecha 1er Debate</th>
                                    <th>Fecha 2do Debate</th>
                                    <th>Concejal Ponenete</th>
                                    <th>Concejal</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ProyAcuerdos as $key => $data2)
                                    <tr class="text-center">
                                        <td>{{ $data2->ff_document }}</td>
                                        <td>{{ $data2->created_at }}</td>
                                        <td>{{ $data2->name }}</td>
                                        <td>{{ $data2->updated_at }}</td>
                                        <td>{{ $data2->cc_id }}</td>
                                        <td>
                                            @if($data2->estado == "0")
                                                Pendiente
                                            @elseif($data2->estado == "1")
                                                Aprobado
                                            @elseif($data2->estado == "2")
                                                Rechazado
                                            @else
                                                Archivado
                                            @endif
                                        </td>
                                        <td>{{ $data2->ff_salida }}</td>
                                        <td>{{ $data2->comision->name }}</td>
                                        <td>{{ $data2->ff_primerdbte }}</td>
                                        <td>{{ $data2->ff_segundodbte }}</td>
                                        <td>{{ $data2->concejalesPonentes->persona->nombre}}</td>
                                        <td>{{ $data2->Concejales->persona->nombre}}</td>
                                        <td>
                                            <a href="{{Storage::url($data2->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                            <a href="{{ url('dashboard/acuerdos/proyectos/'.$data2->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay proyectos de acuerdo almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/acuerdos/proyectos/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Proyecto de Acuerdo</a>
                    </center>
                </div>
                <div id="tabActas" class="tab-pane fade">
                    <br>
                    <div class="table-responsive">
                        <br>
                        @if(count($Actas) > 0)
                            <table class="table table-hover table-bordered" align="100%" id="tabla_Actas">
                                <thead>
                                <tr class="text-center">
                                    <th>Fecha del Documento</th>
                                    <th>Nombre</th>
                                    <th>Consecutivo</th>
                                    <th>Estado</th>
                                    <th>Comisión</th>
                                    <th>Fecha de Aprobación</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($Actas as $key => $data3)
                                    <tr class="text-center">
                                        <td>{{ $data3->ff_document }}</td>
                                        <td>{{ $data3->name }}</td>
                                        <td>{{ $data3->cc_id }}</td>
                                        <td>
                                            @if($data3->estado == "0")
                                                Pendiente
                                            @elseif($data3->estado == "1")
                                                Aprobado
                                            @elseif($data3->estado == "2")
                                                Rechazado
                                            @else
                                                Archivado
                                            @endif
                                        </td>
                                        <td>{{ $data3->comision->name }}</td>
                                        <td>{{ $data3->ff_aprobacion }}</td>
                                        <td>
                                            <a href="{{Storage::url($data3->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                            <a href="{{ url('dashboard/acuerdos/actas/'.$data3->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay actas almacenadas.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/acuerdos/actas/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Acta</a>
                    </center>
                </div>
                <div id="tabRes" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        @if(count($Resoluciones) > 0)
                            <table class="table table-hover table-bordered" align="100%" id="tabla_Res">
                                <thead>
                                <tr class="text-center">
                                    <th>Fecha del Documento</th>
                                    <th>Fecha de Entrada</th>
                                    <th>Nombre</th>
                                    <th>Consecutivo</th>
                                    <th>Comisión</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($Resoluciones as $key => $data4)
                                    <tr class="text-center">
                                        <td>{{ $data4->ff_document }}</td>
                                        <td>{{ $data4->created_at }}</td>
                                        <td>{{ $data4->name }}</td>
                                        <td>{{ $data4->cc_id }}</td>
                                        <td>{{ $data4->comision->name }}</td>
                                        <td>
                                            <a href="{{Storage::url($data4->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                            <a href="{{ url('dashboard/acuerdos/resoluciones/'.$data4->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay resoluciones almacenadas.
                                </div>
                            </div>
                        @endif
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/acuerdos/resoluciones/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Resolución</a>
                    </center>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
        



               $('#tabla_Actas').DataTable({
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
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
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

   $('#tabla_Proy').DataTable({
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
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
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

   $('#tabla_Acuerdos').DataTable({
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
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
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

   $('#tabla_Res').DataTable({
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
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
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

    </script>
@stop