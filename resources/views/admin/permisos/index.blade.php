@extends('layouts.dashboard')
@section('titulo')
    Listar Permisos
@stop
@section('sidebar')
   @include('admin.modulos.cuerpo.aside')
  @include('admin.permisos.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Listar Permisos</h2>
    </div>
</div>


<table class="table table-bordered" id="permisos">
  <tr>
     <th class="text-center">No</th>
     <th class="text-center">Nombre</th>
     <th class="text-center">Editar</th>
    <th class="text-center">Eliminar</th>
  </tr>
    @foreach ($permisos as $key => $permiso)
    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td class="text-center">{{ $permiso->name }}</td>
        <td class="text-center">
          <a href="{{ route('permisos.edit',$permiso->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','route' => ['permisos.destroy', $permiso->id],'style'=>'display:inline']) !!}
                <button type="submit" name="delete_modal" class="btn btn-sm btn-danger" >
                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>


{!! $permisos->render() !!}


@endsection


@section('js')
   <script>
		   
		
   </script>
@stop