@extends('layouts.dashboard')
@section('titulo')
    Mostrar Rol
@stop

@section('sidebar')
  @include('admin.roles.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Mostrar Rol</h2>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <h2 class="text-center">Permisos:</h2><br>
            <table>
                <thead>
                    <th>modulo</th>
                    <th>Permisos</th>
                </thead>
                <tbody>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $permiso)
                            <tr>
                                <td>{{ $permiso->modulo }}</td>
                                <td><label class="label label-success">{{ $permiso->name }}</label></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection