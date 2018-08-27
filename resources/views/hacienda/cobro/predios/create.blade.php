
@extends('adminlte::page')

@section('title', 'CobroCoactivo')

@section('content_header')
    <h1>Creando Predio</h1>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 @include('predios.partials._form', ['predio' => $predio, 'url' => 'admin/predios', 'method' => 'POST'])
			</div>
		</div>
	</div>
@stop



