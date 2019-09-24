@extends('layouts.dashboard')

@section('titulo')
    Predios
@stop
@section('sidebar')
  @include('cobro.predios.cuerpo.aside')
@stop
@section('content')
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
              <h2 class="text-center">Predios</h2>
      </div>
  </div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				 @include('cobro.predios.partials._form', ['predio' => $predio, 'url' => 'predios', 'method' => 'POST'])
			</div>
		</div>
	</div>
</div>
@stop



