@extends('layouts.dashboard')
@section('titulo')
    Crear Funcionarios
@stop
@section('sidebar')
  @include('users.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center">Create New User</h2>
    </div>
</div>




{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST')) !!}
<div class="row" id="data">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Digite el Nombre','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Correo:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Correo ','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="form-group">
            {{ Form::label('Tipo', 'Tipo')}}
            {{ Form::select('tipo', $tipos , null, ['id'=>'type','class' => 'form-control', 'placeholder' =>'Selecciona Tipo de usuario', '@change' => 'getJefes()']) }}            
        </div>
    </div>

        <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group" style="display: none;" id="divJefes">
                {{ Form::label('Jefe', 'Jefe')}}
                <select class="form-control" name="jefe" v-model="selected">
                    <option v-for="dato in datos" v-bind:value="dato.id">
                      @{{dato.name}}
                    </option>             
                </select>          
            </div>
        </div>

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection

@section('js')
    <script type="text/javascript">

        new Vue({
            el: '#data',
            jefes: function(){
                this.getJefes();
            },
            data:{
                selected: "",
                datos: []
            },
            methods:{
                getJefes: function(){
                    var data = $('#type').val();
                        if(data > 1)
                        {
                            $('#divJefes').show();
                        }else{
                            $('#divJefes').hide();
                        }
                    var url = '/admin/funcionarios/jefes/'+data;
                    axios.get(url)
                         .then(response => {
                            this.datos = response.data;
                    });
                }

            }
        });
    </script>
@stop