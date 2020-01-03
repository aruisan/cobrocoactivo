@extends('layouts.dashboard')
@section('titulo')
    Correspondencia
@stop
{{-- @section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busqueda" class="btn btn-primary hidden"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop --}}
@section('content')



    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Correspondencia</b></h4>
        </strong>
    </div>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tabE">ENTRADA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tabS">SALIDA</a>
        </li>
    </ul>

    <div class="tab-content" >
        <div id="tabE" class="tab-pane active"><br>
            <div class="table-responsive">
               
                @if(count($CorrespondenciaE) > 0)
                <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                    <thead>
                    <tr class="text-center">
                        <th>Fecha del Acta</th>
                        <th>Fecha de Entrada</th>
                        <th>Nombre</th>
                        <th>Consecutivo</th>
                        <th>Número de Acta</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($CorrespondenciaE as $key => $data)
                        <tr class="text-center">
                            <td>{{$data->ff_document}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->cc_id}}</td>
                            <td>{{$data->number_doc}}</td>
                            <td>{{$data->ff_vence}}</td>
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
                            <td>
                                <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="{{ url('dashboard/correspondencia/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('dashboard/correspondencia/'.$data->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay correspondencias de entrada almacenadas.
                            </div>
                        </div>
                    @endif
                </table>
            </div>
            <center>
                <a href="{{ url('/dashboard/correspondencia/create/0') }}" title="Editar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Correspondencia de Entrada</a>
            </center>
        </div>
        <div id="tabS" class="tab-pane fade">
            <br>
            <div class="table-responsive">
                <br>
                @if(count($CorrespondenciaS) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrS">
                        <thead>
                        <tr class="text-center">
                            <th>Fecha del Acta</th>
                            <th>Fecha de Entrada</th>
                            <th>Nombre</th>
                            <th>Consecutivo</th>
                            <th>Respuesta</th>
                            <th>Fecha de Salida</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($CorrespondenciaS as $key => $data2)
                            <tr class="text-center">
                                <td>{{$data2->ff_document}}</td>
                                <td>{{$data2->created_at}}</td>
                                <td>{{$data2->name}}</td>
                                <td>{{$data2->cc_id}}</td>
                                <td>{{$data2->respuesta}}</td>
                                <td>{{$data2->ff_salida}}</td>
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
                                <td>
                                    <a href="{{Storage::url($data2->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{ url('dashboard/correspondencia/'.$data2->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('dashboard/correspondencia/'.$data2->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-md-12 align-self-center">
                        <div class="alert alert-danger text-center">
                            Actualmente no hay correspondencias de salida almacenadas.
                        </div>
                    </div>
                @endif
            </div>
            <center>
                <a href="{{ url('/dashboard/correspondencia/create/1') }}" title="Editar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Correspondencia de Salida</a>
            </center>
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
		
    </script>
@stop