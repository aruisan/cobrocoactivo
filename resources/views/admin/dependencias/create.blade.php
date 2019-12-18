@extends('layouts.pdesarrollo')
@section('contenido')
    <div class="row page-titles">
        <div class="col-md-10 align-self-center">
            <center>
                <h2>{{ $pdd->name }}</h2>
            </center>
        </div>
        <div class="col-md-2 align-self-center">
            <ol class="breadcrumb">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Navegación
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/pdesarrollo">Plan de Desarrollo</a></li>
                        <li><a href="{{ asset('/pdesarrollo/data/create/'.$pdd->id) }}">Ejes y Programas</a></li>
                        <li><a href="{{ asset('/pdesarrollo/proyecto/create/'.$pdd->id) }}">Proyectos</a></li>
                        <li class="active">Crear Dependencia</li>
                    </ul>
                </div>
            </ol>
        </div>
    </div>
    <div class="container-fluid" id="crud">
        <!-- Start Page Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form" action="{{ route('dependencia.store')}}" method="POST">
                                @csrf
                                <table class="table" id="tabla">
                                    <input type="hidden" name="pdd_id" value="{{ $pdd->id }}">
                                    <thead>
                                    <th class="text-center">Nombre de la Dependencia</th>
                                    <th class="text-center"><i class="fa fa-trash-o"></i></th>
                                    </thead>
                                    <tbody>
                                    @foreach($pdd->dependencias as $dato)
                                        <tr class="table-primary">
                                            <td><input type="hidden" value="{{ $dato->id }}" name="id[]"><input type="text" class="form-control" name="nombre[]" value="{{$dato->name }}" required></td>
                                            <td class="text-center"><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><input type="text" class="form-control" name="nombre[]" required>
                                        <td class="text-center"><input type="button" class="borrar btn btn-danger" value="-" /></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Agregar Fila</button>
                                        <button type="submit" class="btn btn-primary" onclick="toastr.success('Creada Correctamente');">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });

        new Vue({
            el: '#crud',
            created: function(){
                this.getDatos();
            },
            data:{
                datos: []
            },
            methods:{

                nuevaFila: function(){
                    var dependencia=parseInt($("#tabla tr").length);
                    $('#tabla tr:last').after('<tr><td><input type="text" class="form-control" name="nombre[]" required></td><td class="text-center"><input type="button" class="borrar btn btn-danger" value="-" /></td></tr>');

                }
            }
        });
    </script>
@stop