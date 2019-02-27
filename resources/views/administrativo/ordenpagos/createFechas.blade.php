@extends('layouts.dashboard')
@section('titulo')
    Creación de Fechas de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos/'.$ordenPago->id) }}" class="btn btn-success">
            <span class="hide-menu">Orden de Pago</span></a>
    </li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Estado Presupuestal Orden de Pago</b></h4>
        </center>
        <br>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>Valor Orden de Pago</td>
                        <td>$<?php echo number_format($ordenPago->valor,0) ?></td>
                    </tr>
                    <tr>
                        <td>Dinero Disponible Orden de Pago</td>
                        <td>$<?php echo number_format($ordenPago->saldo,0) ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <center>
                <h4><b>Valor Actual de Pagos Por Fechas</b></h4>
                <br>
                $<?php echo number_format($ordenPago->fechas->sum('valor'),0) ?>
            </center>

        </div>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Fechas de Pago de: {{ $ordenPago->nombre }}</h2></center>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    Registro Seleccionado: {{ $ordenPago->registros->objeto }}
                </div>
                <div class="col-md-6 text-center">
                    Tercero: {{ $ordenPago->registros->persona->nombre }}
                </div>
            </div>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos/fechas')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $ordenPago->id }}">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                            </thead>
                            <tbody>
                            <tr v-for="dato in datos">
                                <input type="hidden" name="id[]" v-model="dato.id">
                                <th scope="row"><input type="date" name="fecha[]" style="text-align:center" v-model="dato.fecha" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="2019-12-31"></th>
                                <th scope="row"><input type="number" name="valor[]" style="text-align:center" v-model="dato.valor" required></th>
                                <td class="text-center"><button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            @for($i=0;$i < 1 ;$i++)
                                <tr>
                                    <input type="hidden" name="id[]">
                                    <td><input type="date" name="fecha[]" required value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="2019-12-31"></td>
                                    <td><input type="number" name="valor[]"  required></td>
                                    <td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div><br><center>
                        <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fecha</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>

        $(document).ready(function() {
            $('#tabla').DataTable( {
                responsive: true,
                "searching": false,
                "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""}
            } );
        } );

        //funcion para borrar una celda
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
                getDatos: function(){
                    var urlVigencia = '/administrativo/ordenPagos/fechas/'+{{ $ordenPago->id }};
                    axios.get(urlVigencia).then(response => {
                        this.datos = response.data;
                    });
                },

                eliminarDatos: function(dato){
                    var urlVigencia = '/administrativo/ordenPagos/fechas/'+dato;
                    axios.delete(urlVigencia).then(response => {

                        location.reload();
                    });
                },

                nuevaFila: function(){

                    $('#tabla tr:last').after('<tr>\n' +
                        '                                    <input type="hidden" name="id[]">\n' +
                        '                                    <td><input type="date" name="fecha[]" required value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="2019-12-31"></td>\n' +
                        '                                    <td><input type="number" name="valor[]"  required></td>\n' +
                        '                                    <td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td>\n' +
                        '                                </tr>');
                }
            }
        });
    </script>
@stop
