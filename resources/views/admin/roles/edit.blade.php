@extends('layouts.dashboard')
@section('titulo')
    Editar Funcionario
@stop

@section('sidebar')
    <li><a href="{{url('admin/funcionarios')}}" class="btn btn-success"><i class="material-icons md-18">account_box</i> Ver Funcionarios</a></li>
    <li><a href="{{url('admin/funcionarios/create')}}" class="btn btn-success"><i class="material-icons md-18">account_box</i>Crear Funcionario</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            Datos personas
            <i class="fa fa-user fa-fw "></i> 
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="#" class="btn btn-primary"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
                <a href="#" class="btn btn-primary"><i class="material-icons md-12ss">create</i> Crear</a>
            </li>
        </ul>
    </li>
@stop

@section("content")
	<div class="container-fluid">
    	<div class="row">
            <div class="col-md-12" id="data">
            <h2 class="text-center">Editar Rol
            </h2>
        	@include('admin.roles.partials._form', ['data' => $data, 'url' => 'admin/roles/'.$data->id, 'method' => 'PATCH'])
    	   </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        new Vue({
            el: '#data',
            created: function(){
                this.getJefes();
            },
            data:{
                selected: {{$jefe = (empty($jefe)) ? 0 : $jefe }},
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