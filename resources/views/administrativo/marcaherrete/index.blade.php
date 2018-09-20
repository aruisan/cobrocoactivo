@extends('layouts.dashboard')
@section('titulo')
    Listar Registros y Herretes
@stop
@section('sidebar')
  @include('administrativo.marcaherrete.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Listar Marcas y Herretes </h2>
    </div>
</div>


<table class="table table-bordered">
  <tr>
     <th>Ruta</th>
     <th>Persona</th>
     <th>Fecha Exp</th>
     <th>Fecha Venc</th>
     <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
     <th width="280px"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></th>
  </tr>
    @foreach ($registros as $data)
    <tr>
        <td class="text-center">{{ $data->ruta }}</td>
        <td class="text-center">{{ $data->persona_id}}</td>
        <td class="text-center">{{ $data->ff_expedicion }}</td>
        <td class="text-center">{{ $data->ff_vencimiento }}</td>
        <td class="text-center">
          <a href="{{ route('marcas-herretes.edit',$data->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','route' => ['marcas-herretes.destroy', $data->id],'style'=>'display:inline']) !!}
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