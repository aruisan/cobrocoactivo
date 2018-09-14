@extends('layouts.dashboard')
@section('titulo')
    Listar Registros y Herretes
@stop
@section('sidebar')
  @include('administrativo.registros.cuerpo.aside')
  <li>
      <a href="{{ url('/administrativo/cdp') }}" class="btn btn-primary">
          <i class="fa fa-file"></i>
          <span class="hide-menu"> CDP's</span></a>
  </li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <br>
            <h2 class="text-center"> Listar Registros y Herretes </h2>
        <br>
        <hr>
    </div>
</div>


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Nombre Registro</th>
     <th>Nombre Tercero</th>
     <th>Nombre CDP</th>
     <th>Archivo</th>
     <th>Acciones</th>
  </tr>
    @foreach ($registros as $key => $data)

    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td class="text-center">{{ $data->objeto }}</td>
        <td class="text-center">{{ $data->persona->nombre }}</td>
        <td class="text-center">{{ $data->cdp->name }}</td>
        <td class="text-center">{{ $data->ruta }}</td>
        <td class="text-center">
          <a href="{{ route('registros.edit',$data->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
          </a>
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