@extends('layouts.dashboard')
@section('titulo')
    PUC
@stop
@section('sidebar')
    {{-- @if($data)
        <li><a href="/administrativo/contabilidad/puc/level/create/{{ $data->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp; Modificar PUC</a></li>
    @endif --}}
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>PUC de Gastos</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    {{-- @if($data) --}}
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                        <thead>
                      
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Nombre Cuenta</th>
                            <th class="text-center">Estado</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($codigos as $codigo)
                     
                   
                  
                          <tr  style="background-color:@if($codigo['childrens_count'] != 0) #efb827; @else @endif" >
                                <td class="text-dark">{{ $codigo['code']}}</td>
                                <td class="text-dark">{{ $codigo['name'] }}</td>
                                @if($codigo['enable'] == 1)
                                 <td class="text-dark">{{'Activo'}}</td>
                                  @else 
                                    <td class="text-dark">{{'Inactivo'}}</td>
                                @endif

                               
                              
                            </tr>
                   
     
                @endforeach
                          
                        </tbody>
                    </table>
                    {{-- @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay un PUC almacenado.
                                <a href="{{ url('administrativo/contabilidad/puc/create') }}" title="Crear" class="btn-sm btn-primary"><i class="fa fa-plus"></i> Crear nuevo PUC</a>
                            </div>
                        </div>
                    @endif --}}
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
      "pageLength": 10,
         ordering: false,
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
        });
         
    </script>
@stop