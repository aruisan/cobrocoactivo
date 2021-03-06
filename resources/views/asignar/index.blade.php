@extends('layouts.dashboard')

@section('titulo')
    Funcionarios
@stop
@section('sidebar')
  {{-- @include('cobro.predios.cuerpo.aside') --}}
@stop
@section('content')
	<div class="container-fluid">
		
				<button type="button" class="btn btn-info btn-lg mb-2" data-toggle="modal" data-target="#myModal">Relacionar Funcionario</button>

		<br>
		<table class="table table-bordered cell-border table-hover" id="example"  data-form="deleteForm">
			 <thead>
		        <tr class="active">
		            <th class="text-center">Nombre</th>
		            <th class="text-center">Tipo</th>
		            <th class="text-center">Jefe</th>
		            <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
		        </tr>
		    </thead>
		    <tbody>
			@foreach($user->boss_users as $func)
		    	<tr>
		    		<td class="text-center">{{$func->user->name}}</td>
		    		<td class="text-center">{{$func->user->type->nombre}}</td>
		    		<td class="text-center">{{$func->user->user_boss->boss->name}}</td>
		    		<td class="text-center">
		    		    @include('asignar.delete', ['usuario' => $func])
		    		</td>
		    	</tr>
			@endforeach
			</tbody>
		</table>
		    <div class="row">
        <center>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="{{ url('admin/funcionarios') }}" class="btn btn-default" style="color:black">Regresar al Listado De Funcionarios</a>
            </div>
        </center>
    </div>
	</div>




	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-sm">

	    <!-- Modal content-->
	    	<div class="modal-content ">
	    	<form action="/asignar" method="POST">
	      		<div class="modal-header">
	      		 	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      		  	<h4 class="modal-title">Relaciona un Funcionario</h4>
	      		</div>
	      		<div class="modal-body">
	      		  	<div class="form-group">
	      		  		{{ csrf_field() }}
	      		  		<input type="hidden" name="boss_id" value="{{ $user->id }}">
	      		  		<select name="user_id" class="form-control" >
	      		  		@foreach($funcionarios as $funcionario)
	      		  			<option value="{{ $funcionario->id }}">{{ $funcionario->name }}</option>
	      		  		@endforeach
	      		  		</select>
           		 	</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      			<button type="submit" class="btn btn-primary">Guardar</button>
	      		</div>
	     	</form>
	    	</div>
@stop

@section('js')
   <script>
		$(document).ready(function() {
		    $('#example').DataTable();
		} );
   </script>
@stop
           {{-- _token: '{{csrf_token()}}', --}}
