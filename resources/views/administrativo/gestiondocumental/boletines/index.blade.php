@extends('layouts.dashboard')
@section('titulo')
    Boletines
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busquedaBoletines" class="btn btn-primary hidden"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Boletines</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    @if(count($Boletines) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha del Documento</th>
                            <th class="text-center">Consecutivo</th>
                            <th class="text-center">Responsable</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Boletines as $key => $data)
                            <tr class="text-center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->ff_document }}</td>
                                <td>{{ $data->cc_id }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>
                                    <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{ url('dashboard/boletines/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay boletines almacenados.
                            </div>
                        </div>
                    @endif
                </div>
                <center>
                    <a href="{{ url('/dashboard/boletines/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Boletin</a>
                </center>
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

    </script>
@stop