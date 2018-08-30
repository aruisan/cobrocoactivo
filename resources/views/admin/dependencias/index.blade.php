@extends('layouts.dashboard')
@section('titulo')
    Listar Dependencias
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Dependencias</h2>
    </div>
</div>

   <div class="container-fluid" id="crud">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="form-validation">
                    <form class="form" action="{{ route('dependencias.store')}}" method="POST">
                        {{ csrf_field() }}
                        <table class="table" id="tabla">
                            <thead>
                                <th class="text-center">Nombre de la Dependencia</th>
                                <th class="text-center"><i class="fa fa-trash-o"></i></th>
                            </thead>
                            <tbody>
                                @can('dependencia-create')
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="name[]" required>
                                    <td class="text-center">
                                        <button class="borrar btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                                @endcan
                                <tr class="table-primary" v-for="dato in datos">
                                    <td>
                                        <input type="text" @if(!auth()->user()->can('dependencia-edit')) disabled @endif class="form-control" name="name[]" v-model="dato.name" @can('dependencia-edit') @change="actualizar(dato.id)" @endcan required>
                                    </td>
                                    <td class="text-center">
                                    @can('dependencia-delete')
                                        <button type="submit" class="btn btn-sm btn-danger" v-on:click.prevent="eliminar(dato.id)">
                                            <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                                        </button>
                                    @endcan
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                            @can('dependencia-create')
                                <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success btn-sm">Agregar Fila</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                            @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function(){
            var table = $('#tabla').DataTable();
        });

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
                datos: [],
            },
            methods:{
                getDatos: function(){
                    var ruta = '/admin/dependencias/create';
                    axios.get(ruta)
                    .then(response => {
                        this.datos = response.data;
                    })
                    .catch(function (error) {
                       console.log('Error: ' + error);
                    }); 
                },
                actualizar: function(dato){
                    var ruta = '/admin/dependencias/'+dato;
                    axios.put(ruta, {
                        datos: this.datos,
                    })
                    .then(response => {
                        console.log(response.data);
                        //this.getDatos();
                        toastr.success('Dependencia Actualizada correctamente');
                    })
                    .catch(function (error) {
                       console.log('Error: ' + error);
                    });
                },
                eliminar: function(dato){
                    var ruta = '/admin/dependencias/'+dato;
                    axios.delete(ruta)
                    .then(response => {
                        if(response.data == 0)
                        {
                            this.getDatos();
                            toastr.error('Dependencia borrada correctamente');
                        }else{
                            toastr.warning(response.data);
                        }
                            
                    })
                    .catch(function (error) {
                       console.log('Error: ' + error);
                    });
    
                },
                nuevaFila: function(){
                    var dependencia=parseInt($("#tabla tr").length);
                    $('#tabla tbody tr:first').before('<tr><td><input type="text" class="form-control" name="name[]" required></td><td class="text-center"><button class="borrar btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td></tr>');

                }
            }
        });
    </script>
@stop
