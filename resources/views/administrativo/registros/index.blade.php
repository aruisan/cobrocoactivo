@extends('layouts.dashboard')
@section('titulo')
    Listar Registros y Herretes
@stop
@section('sidebar')
  @include('admin.roles.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Listar Registros y Herretes </h2>
    </div>
</div>


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Nombre</th>
     <th>Dirección</th>
     <th>Marca</th>
     <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
     <th width="280px"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></th>
  </tr>
    @foreach ($registros as $key => $data)
    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td class="text-center">{{ $data->persona->name }}</td>
        <td class="text-center">{{ $data->persona->direccion }}</td>
        <td class="text-center">{{ $data->ruta }}</td>
        <td class="text-center">
          <a href="{{ route('registros.edit',$data->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','route' => ['registros.destroy', $data->id],'style'=>'display:inline']) !!}
                <button type="submit" name="delete_modal" class="btn btn-sm btn-danger" >
                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>


{!! $registros->render() !!}


@endsection