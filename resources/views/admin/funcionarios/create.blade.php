
@extends('layouts.dashboard')
@section('titulo')
    Funcionarios
@stop

@section('sidebar')
    <li><a href="{{url('admin/funcionarios')}}" class="btn btn-success"><i class="material-icons md-18">account_box</i> Ver Funcionarios</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw "></i> 
                ROLES FUNCIONARIOS
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{url('admin/roles')}}" class="btn btn-primary"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
                <a href="{{url('admin/roles/create')}}" class="btn btn-primary"><i class="material-icons md-12ss">create</i> Crear</a>
            </li>
        </ul>
    </li>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" id="data">
                    <h2 class="text-center">Crear Funcionario</h2>
				 @include('admin.funcionarios.partials._form', ['usuario' => $usuario, 'tipos'=> $tipos ,'url' => 'admin/funcionarios', 'method' => 'POST'])
			</div>
		</div>
	</div> 
@stop

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