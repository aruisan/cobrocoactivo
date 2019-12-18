@extends('layouts.dashboard')
@section('titulo')
    Asignar Código Contractual
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/presupuesto/informes/contractual/homologar') }}"><span class="hide-menu">Homologar</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Asignar Código Contractual al Rubro</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <form action="{{ asset('/presupuesto/informes/contractual/asignar/store') }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered hover" id="tabla">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Rubro</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Codigo Contractual</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Rubros as $value)
                    <tr>
                        <td class="text-center">
                            {{$value['id_rubro']}}
                            <input type="hidden" value="{{$value['id_rubro']}}" name="idRubro[]">
                        </td>
                        <td class="text-center">{{$value['rubro']}}</td>
                        <td class="text-center">{{$value['name']}}</td>
                        <td class="text-center">
                            <select class="form-control text-center" name="code[]" required>
                                <option>Selecciona un Código Contractual</option>
                                @foreach($codigos as $codigo)
                                    <option value="{{$codigo->id}}"> {{ $codigo->code }} - {{ $codigo->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script>
        $('#tabla').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
            paging: false,
            
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