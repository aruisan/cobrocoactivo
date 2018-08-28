@extends('layouts.dashboard')
@section('titulo')
    Funcionarios
@stop
@section('sidebar')
  @include('users.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center">administracion Funcionarios</h2>
    </div>
</div>


<table class="table table-bordered">
 <tr>
   <th class="text-center">No</th>
   <th class="text-center">Name</th>
   <th class="text-center">Email</th>
   <th class="text-center">Roles</th>
   <th class="text-center">Tipo</th>
   <th class="text-center">Jefe</th>
   <th class="text-center"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></th>
   <th class="text-center"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td class="text-center">{{ ++$i }}</td>
    <td class="text-center">{{ $user->name }}</td>
    <td class="text-center">{{ $user->email }}</td>
    <td class="text-center">
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td class="text-center">@if($user->type) {{$user->type->nombre}} @endif</td>
    <td class="text-center">@if($user->user_boss) {{$user->user_boss->boss->name}} @endif</td>
    <td class="text-center">
      <a href="{{ route('funcionarios.edit',$user->id) }}" class="btn btn-sm btn-info">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
      </a>
    </td>
    <td>
        {!! Form::open(['method' => 'DELETE','route' => ['funcionarios.destroy', $user->id],'style'=>'display:inline']) !!}
          <button type="submit" name="delete_modal" class="btn btn-sm btn-danger delete" >
            <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
          </button>
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}


@endsection