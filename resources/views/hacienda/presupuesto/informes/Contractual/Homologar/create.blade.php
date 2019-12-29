@extends('layouts.dashboard')
@section('titulo')
    Añadir Código Contractual
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/presupuesto/informes/contractual/homologar') }}"><span class="hide-menu">Homologar</span></a></li>
@stop
@section('content')

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="row">


                <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 ">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formularioContractual">
                <div class="row">
                    <br>
                    <div class="col-lg-12 margin-tb">
                        <h2 class="text-center"> Añadir Código Contractual</h2>
                    </div>
                </div>



            <div class="row inputCenter" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
                <br>
                {!! Form::open(array('route' => 'homologar.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Código: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="code" required>
                        </div>
                        <small class="form-text text-muted">Código Contractual</small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Nombre: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <small class="form-text text-muted">Nombre Contractual</small>
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <button class="btn btn-success btn-raised btn-lg">Añadir</button>
                </div>
                {!! Form::close() !!}
            </div>

                 <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 ">
                </div>
        </div>
    </div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered hover" id="tabla">
            <thead>
                <tr>
                  <th colspan="4" class="text-center">  <strong><h4>Códigos Contractuales Almacenados</h4><strong></th> 
                </tr>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Estado</th>
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
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
    </script>
@stop