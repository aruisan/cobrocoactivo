@extends('layouts.dashboard')

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li> <a href="{{ url('dashboard/contractual') }}" class="btn btn-link botonMenu">Ver Procesos</a></li>       
			<li class="active">Ver archivos el proceso</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
		<center>
			<h3 class="text-primary">Proceso {{$modulo->modulo}}</h3>	
		</center>
		<div class="col-sm-offset-2 col-md-offse-3 col-lg-offset-3 col-xs-12 col-sm-8 col-md-6 col-lg-6">		
			<table class="table">
				<tbody>
					<tr>
						<td>CIUDAD: </td>
						<td>Girardot - Cundinamarca</td>
					</tr>
					<tr>
						<td>RESPONSABLES: </td>
						<td>{{$modulo->responsable}}</td>
					</tr>
					<tr>
						<td>VALOR: </td>
						<td>${{ $modulo->valor}} pesos</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div> 

<div class="row">
	<div class="">
		<br>
		<br>
		<center>
			<h4>Archivos del Proceso {{$modulo->modulo}}
			</h4>
		</center>
	</div>
	<a id="subir" class="btn btn-warning" data-toggle="modal" data-target="#modal-create-archivos">Subir Archivo {{$modulo->modulo}}</a>
	<br>
	<table id="tableArchivo" class="table table-condensed table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>Archivo</th>
				<th>Fecha de Archivo</th>
				<th></th>			
			</tr>
		</thead>
		<tbody>
			@foreach($archivos as $archivo)
			<tr>
				<td>{{$archivo->nombre}}</td>
				<td>{{$archivo->ff_cargue}}</td>
				<td><a href="{{ asset('/uploads/modulos/'.$archivo->ruta) }}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></a>
					<button class="btn btn-success editArchivo" data-toggle="modal" data-target="#modal-create-archivos"><i class="fa fa-pencil-square-o"></i></button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>

<!-- Modal -->
<div class="modal fade" id="modal-create-archivos" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"> Formulario de Archivos</h4>
			</div>
			<form  class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('subirArchivoContractual.store') }}" >
				<form  class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('subirArchivo.store') }}" >
					<div class="modal-body-2">
						{!! csrf_field() !!}
						<div class="form-group">
							<label for="nombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-10">
								<input type="hidden" name="id" value="{{ $modulo->id }}">
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">FECHA</label>
							<div class="col-sm-10">
								<input type="date" class="form-control" name="fecha" required>
							</div>
						</div>

						<label for="inputFile" class="col-md-2 control-label">File</label>

						<div class="col-md-10">
							<input type="file" name="file">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Subir Archivo</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@stop
	@section('sidebar')
@include('administrativo.contractual.sideBar')
	@stop       

