@extends('layouts.dashboard')
@section('titulo')
    Contratación
@stop
@section('sidebar')
    {{-- <li>
        <a href="{{ url('/contractual/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu">Crear Contractual</span></a>
    </li> --}}
@stop
@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 formularioAcuerdo">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Contractual</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
          
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">Contractual</a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link regresar"  href="{{  url('/contractual/create') }}" >Nuevo Contrato</a>
                </li>
             
            </ul>
            
    <div class="tab-content col-sm-12" >

        <div class="table-responsive">
            <br>
            @if(count($consulta)>0)
            <table class="table table-hover table-bordered" align="100%" id="tabla_Contractual">
                <thead>
                    <th>PROCESO</th>
                    <th>RESPONSABLE</th>
                    <th>VALOR</th>
                    <th>ASUNTO</th>
                    <th>ACCIONES</th>

                </thead>
                <tbody>
                    @foreach($consulta as $data )

                    <tr>
                        <td>{{$data->modulo}}</td>
                        <td>{{$data->responsable}}</td>
                        <td>$ <?php echo number_format($data->valor,0);?></td>
                        <td>{{$data->asunto}}</td>
                        <td class="text-center">
                            <a href="contractual/{{$data->id}}/edit " class="btn-sm btn-success" title="Editar"><span class="fa fa-edit"></span></a>
                            <a href="contractual/{{$data->id}}/anexos " class="btn-sm btn-primary" title="Anexos"><span class="glyphicon glyphicon-open-file"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-danger">
                    Actualmente no hay contratos creados, para crearlos de clic en el siguiente enlace:
                    <a href="{{ route('contractual.create') }}" class="alert-link">Nuevo Contrato</a>.
                </div>
            @endif
        </div>
    </div>
    </div>
    </div>
@stop
@section('js')
    <script>


           $('#tabla_Contractual').DataTable({
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