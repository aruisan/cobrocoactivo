@extends('layouts.dashboard')
@section('titulo')
    Homologar
@stop
@section('sidebar')
    {{-- @if( $rol == 2) --}}
        <li>
            <a href="{{ url('presupuesto/informes/contractual/homologar/create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp;
                <span class="hide-menu"> Añadir Código Contractual</span></a>
        </li>
        <li>
            <a href="{{ url('presupuesto/informes/contractual/asignar') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp;
                <span class="hide-menu"> Asignar Código Contractual</span></a>
        </li>
    {{-- @endif --}}
@stop

@section('content')


    <div class="col-lg-12 align-self-center">
                <div class="breadcrumb text-center">    
                                    
                    <strong>
                        <h4><b>Homologar</b></h4>
                    </strong>

                </div> 
                
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">

                                <table class="table table-bordered hover" id="tabla">
                                    <hr>
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="text-center">Tabla de Rubros con sus Códigos Contractuales Asignados</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Rubro</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Valor Inicial</th>
                                            <th class="text-center">Valor Disponible</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Rubros as $value)
                                        <tr>
                                            <td class="text-center">{{$value['codigo']}}</td>
                                            <td class="text-center">{{$value['rubro']}}</td>
                                            <td class="text-center">{{$value['name']}}</td>
                                            <td class="text-center">$ <?php echo number_format($value['valor'],0);?></td>
                                            <td class="text-center">$ <?php echo number_format($value['valor_disp'],0);?></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <hr>
                                <br>

                                <table class="table table-bordered hover" id="tabla2">
                                    <thead>
                                    <tr>
                                        <th colspan="5" class="text-center">Códigos Contractuales</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Editar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($codes as $value)
                                        <tr>
                                            <td class="text-center">{{$value->id}}</td>
                                            <td class="text-center">{{$value->code}}</td>
                                            <td class="text-center">{{$value->name}}</td>
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-danger">
                                                    @if($value->estado == "0")
                                                        Activado
                                                    @else
                                                        Desactivado
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('presupuesto/informes/contractual/homologar/'.$value->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                        </div>
                </div>
            </div>
    </div>
@stop

@section('js')
    <script>
        $('#tabla').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
                    
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
            dom: 'Bfrtip',
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
			  className: 'btn btn-success',
			  title: 'Predios'
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
			  title: 'Predios'
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info',
			  title: 'Predios'
		  },
	  ]	             
        } );

        $('#tabla2').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
       
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
            dom: 'Bfrtip',
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
			  className: 'btn btn-success',
			  title: 'Predios'
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
			  title: 'Predios'
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info',
			  title: 'Predios'
		  },
	  ]	             
        } );
    </script>
@stop