@extends('layouts.dashboard')
@section('titulo')
    Editar Funcionarios
@stop
@section('sidebar')
  @include('admin.funcionarios.cuerpo.aside')
@stop
@section('content')


<div class="col-12 formularioFuncionarios">


        <div class="row">
            <div class="col-lg-9 margin-tb">
                    <h2 class="text-center">Editar Usuario</h2>

            </div>
        </div>

{!! Form::model($user, ['method' => 'PATCH','route' => ['funcionarios.update', $user->id]]) !!}


     <div class="row inputCenter" id="data" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
            
            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>


            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                <div class="form-group">
                    <strong>Correo:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>


            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                        {{ Form::label('Dependencia', 'Dependencia')}}
                        {!! Form::select('dependencia_id', $dependencias,null, array('class' => 'form-control')) !!}
                    </div>
                </div>


            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                <div class="form-group">
                    {{ Form::label('Rol', 'Rol')}}
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                <div class="form-group">
                    {{ Form::label('Tipo', 'Tipo')}}
                    {{ Form::select('type_id', $tipos , null, ['id'=>'type','class' => 'form-control', 'placeholder' =>'Selecciona Tipo de usuario', '@change' => 'getJefes()']) }}            
                </div>
            </div>


        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group" style="display: none;" id="divJefes">
                {{ Form::label('Jefe', 'Jefe')}}
                <select class="form-control" name="jefe" v-model="selected" id="jefe">
                    <option v-for="dato in datos" v-bind:value="dato.id">
                      @{{dato.name}}
                    </option>             
                </select>          
            </div>
        </div>

</div>


        <div class="row" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a;    margin-right: 15px;
    margin-left: 15px;">
           
            <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">

                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>


          <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <div class="form-group">
                    <strong>Confirmar Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
            </div>

        </div>

   <div class="row" >
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    

        </div>
    </div>

</div>
{!! Form::close() !!}


@endsection

@section('js')
    <script type="text/javascript">
        new Vue({
            el: '#data',
            created: function(){
                this.getJefes();
            },
            data:{

                selected: @if($user->user_boss) {{ $user->user_boss->boss_id }} @else 0 @endif,
                datos: []
            },
            methods:{
                getJefes: function(){
                    var data = $('#type').val();
                        if(data == 1 || data == 5 || data == 6)
                        {
                            this.selected = 0;
                            $('#divJefes').hide();
                        }else{
                            $('#divJefes').show();
                            var url = '/admin/funcionarios/jefes/'+data;
                            axios.get(url)
                                 .then(response => {
                                    this.datos = response.data;
                            });
                        }
                    
                }

            }
        });
    </script>
@stop