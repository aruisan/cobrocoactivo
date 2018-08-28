@extends('layouts.dashboard')
@section('titulo')
    Listar Roles
@stop
@section('sidebar')
  @include('roles.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Listar Roles</h2>
    </div>
</div>


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
     <th width="280px"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span></th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td class="text-center">{{ $role->name }}</td>
        <td class="text-center">
          <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-info">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
        </td>
        <td class="text-center">
            {!! Form::open(['method' => 'DELETE','url' => ['admin/roles/destroy', $role->id],'style'=>'display:inline']) !!}
                <button type="submit" name="delete_modal" class="btn btn-sm btn-danger" >
                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}


@endsection