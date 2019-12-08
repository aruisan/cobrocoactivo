@extends('layouts.dashboard')
@section('titulo')
    Listar Modulos
@stop
@section('sidebar')
   @include('admin.modulos.cuerpo.aside')
   @include('admin.permisos.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Listar Modulos</h2>
    </div>
</div>

 <div class="table-responsive">
                        <br>
    <div class="box">
            
         <div class="box-body">
            <table class="table table-bordered" id="tabla_modulos">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Editar</th>
                <th class="text-center">Eliminar</th>
              </tr>
                @foreach ($modulos as $key => $data)
                <tr>
                    <td class="text-center">{{ ++$i }}</td>
                    <td class="text-center">{{ $data->name }}</td>
                    <td class="text-center">
                      <a href="{{ route('modulos.edit',$data->id) }}" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                      </a>
                    </td>
                    <td class="text-center">
                        {!! Form::open(['method' => 'DELETE','route' => ['modulos.destroy', $data->id],'style'=>'display:inline']) !!}
                            <button type="submit" name="delete_modal" class="btn btn-sm btn-danger" >
                                <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>

      </div>
    </div>
</div>

{!! $modulos->render() !!}


@endsection


@section('js')
<script>
 
        
     </script>

@stop