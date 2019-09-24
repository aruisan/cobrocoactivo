@extends('layouts.dashboard')

@section('titulo')
    Editando Predio
@stop
@section('sidebar')
  @include('cobro.predios.cuerpo.aside')
@stop

@section("content")

<div style="
    height: 100%;
    display: flex;
    background: white;
    flex-wrap: wrap;
    width: 100%;

">
  
  <div class="row" style="
    justify-content: center;
    r: flex;
    width: 100%;
">
      <div class="col-lg-12 margin-tb">
              <h2 class="text-center">Predios Editar</h2>
      </div>
	<div class="container-fluid">
    	<div class="white">

        	@include('cobro.predios.partials._form', ['predio' => $predio, 'url' => 'predios/'.$predio->id, 'method' => 'PATCH'])
    	</div>
    </div>  </div>
</div>
@endsection