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
            <h2 class="text-center"> Orden Ruta </h2>
    </div>
</div>

 <h3> Ruta: {{$ruta->nombre}}</h3>

 <a href="{{route('ruta.orden.create', $ruta->id)}}" class="btn btn-success"> Nueva Orden</a><br><br>

<table class="table table-bordered">

  <tr>
     <th>ID</th>
     <th>Type</th>
     <th>Dependencia</th>
     <th>Dias</th>
     <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
     <th width="280px"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></th>
  </tr>
    @foreach ($ruta->dependencias as $data)
    <tr>
        <td class="text-center">{{ $data->pivot->id }}</td> 
        <td class="text-center">{{ $data->pivot->type_id}}</td> 
        <td class="text-center">{{ $data->pivot->dependencia_id}}</td> 
        <td class="text-center">{{ $data->pivot->dias}}</td> 
      
        <td class="text-center">
          <a href="{{ route('ruta.orden.edit', [$ruta->id, $data->pivot->id]) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','route' => ['ruta.orden.delete', $ruta->id , $data->pivot->id],'style'=>'display:inline']) !!}
                <button type="submit" name="delete_modal" class="btn btn-sm btn-danger" >
                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>


{{-- {!! $ruta->render() !!} --}}


@endsection