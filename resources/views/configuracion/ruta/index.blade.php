@extends('layouts.dashboard')
@section('titulo')
    Listar Registros y Herretes
@stop
@section('sidebar')
  @include('configuracion.ruta.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Rutas </h2>
    </div>
</div>


<table class="table table-bordered">
  <tr>
     <th>ID</th>
     <th>Ruta</th>
     <th class="text-center"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></th>
     <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
     <th width="280px"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></th>
  </tr>
    @foreach ($rutas as $data)
    <tr>
        <td class="text-center">{{ $data->id }}</td>
        <td class="text-center">{{ $data->nombre}}</td>
        <td class="text-center">
          <a href="{{ route('rutas.show',$data->id) }}" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
          </a>
        </td>        
        <td class="text-center">
          <a href="{{ route('rutas.edit',$data->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','route' => ['rutas.destroy', $data->id],'style'=>'display:inline']) !!}
                <button type="submit" name="delete_modal" class="btn btn-sm btn-danger"  disabled="disabled">
                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>


{!! $rutas->render() !!}


@endsection