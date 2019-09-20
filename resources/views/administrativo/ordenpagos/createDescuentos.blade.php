@extends('layouts.dashboard')
@section('titulo')
    Creación de Descuentos
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos') }}" class="btn btn-success">
            <span class="hide-menu">Ordenes de Pago</span></a>
    </li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Estado Actual del Registro</b></h4>
            <br>
            Valor Registro: $<?php echo number_format($ordenPago->registros->valor,0) ?>
            <br>
            Valor Total(+IVA): $<?php echo number_format($ordenPago->registros->val_total,0) ?>
            <br>
            Valor Disponible: $<?php echo number_format($ordenPago->registros->saldo,0) ?>
        </center>
        <br>
        <center>
            <h4><b>Valor Total de Descuentos</b></h4>
            <br>
            $<?php echo number_format($ordenPago->descuentos->sum('valor'),0) ?>
        </center>
        <br>
        </div>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud" style="background-color: white">
        <div class="row justify-content-center">
            <br>
            <center><h2>Descuentos de: {{ $ordenPago->nombre }}</h2></center>
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
                <form class="form-valide" action="{{url('/administrativo/ordenPagos/descuento')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    <br>
                    <br>
                    <center><h2>Descuentos Retención en la Fuente</h2></center>
                    <hr><br>
                    {{ csrf_field() }}
                    <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $ordenPago->id }}">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">%</th>
                            <th class="text-center">Base</th>
                            <th class="text-center">Valor</th>
                            </thead>
                            <tbody>
                            <tr v-for="dato in datos">
                                <td>
                                    <input type="hidden" name="id[]">
                                    <div class="col-md-12">
                                        <div class="col-md-1">
                                            <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button>
                                        </div>
                                        <div class="col-md-11">
                                            <input type="text" id="retencionF" name="retencionF" style="text-align:center">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" id="percent" name="porcent" style="text-align:center" disabled>
                                </td>
                                <td><input type="number" id="base" name="base" disabled style="text-align:center"></td>
                                <td>
                                    <input type="number" id="valor" style="text-align:center" disabled>
                                    <input type="hidden" id="valor2" name="valor" value="">
                                </td>
                            </tr>
                            <tr>
                                <input type="hidden" name="id[]">
                                <td>
                                    <select class="form-control" id="reten" onchange="llenar()" name="retencion_fuente" required>
                                        <option>Selecciona un Concepto de Descuento</option>
                                        @foreach($retenF as $reten)
                                            <option value="{{$reten->id}}">{{$reten->concepto}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="percent" name="porcent" style="text-align:center" disabled>
                                </td>
                                <td><input type="number" id="base" name="base" disabled style="text-align:center"></td>
                                <td>
                                    <input type="number" id="valor" style="text-align:center" disabled>
                                    <input type="hidden" id="valor2" name="valor" value="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                    <center><h2>Descuentos Municipales</h2></center>
                    <hr><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                            <th class="text-center">Id</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">Tarifa</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                            </thead>
                            <tbody>
                            @for($i=0;$i< count($desMun); $i++)
                                <tr>
                                    @if( $desMun[$i]->concepto == "Otras Contribuciones" or $desMun[$i]->concepto == "Otros Descuentos")
                                        <input type="hidden" value="{{$i + 1}}" name="idDesOther[]">
                                        <td class="text-center">{{ $desMun[$i]->id }}</td>
                                        <td>
                                            <input type="text" style="text-align:center" placeholder="{{ $desMun[$i]->concepto}}" name="concepto[]" required>
                                        </td>
                                        <td>
                                            <input type="number" style="text-align:center" placeholder="Tarifa" name="tarifa[]" min="0" required>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" placeholder="Valor del Descuento" name="valorOther[]" style="text-align:center" min="0" required>
                                        </td>
                                        <td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td>
                                    @else
                                        <input type="hidden" value="{{$i + 1}}" name="idDes[]">
                                        <td class="text-center">{{ $desMun[$i]->id }}</td>
                                        <td class="text-center">{{ $desMun[$i]->concepto }}</td>
                                        <td class="text-center">{{ $desMun[$i]->tarifa }}%</td>
                                        <?php
                                        $valorMulti = $ordenPago->registros->valor * $desMun[$i]->tarifa;
                                        $value = $valorMulti / 100;
                                        ?>
                                        <td class="text-center">
                                            $<?php echo number_format($value,0) ?>
                                            <input type="hidden" name="valorMuni[]" value="{{ $value }}">
                                        </td>
                                        <td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td>
                                    @endif
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        var Data = {
            @foreach($retenF as $key => $data)
                @if($ordenPago->registros->valor >= $data->base)
                    <?php
                        $valorM = $ordenPago->registros->valor * $data->tarifa;
                        $val = $valorM / 100;
                    ?>
                    "{{$data->id}}":["{{$data->tarifa}}","{{$data->base}}","{{$val}}"],
                @else
                    "{{$data->id}}":["{{$data->tarifa}}","{{$data->base}}","0"],
                @endif
            @endforeach
        };

        function llenar(){
            var select = document.getElementById('reten');
            var opcion = select.value;

            document.getElementById('percent').value = Data[opcion][0];
            document.getElementById('base').value = Data[opcion][1];
            document.getElementById('valor').value = Data[opcion][2];
            document.getElementById('valor2').value = Data[opcion][2];
        }


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
                    var urlVigencia = '/administrativo/ordenPagos/descuento/'+{{ $ordenPago->id }};
                    axios.get(urlVigencia).then(response => {
                        this.datos = response.data;
                    });
                },

                eliminarDatos: function(dato){
                    var urlVigencia = '/administrativo/ordenPagos/descuento/'+dato;
                    axios.delete(urlVigencia).then(response => {

                        location.reload();
                    });
                },

                nuevaFila: function(){

                    $('#tabla tr:last').after('<tr><input type="hidden" name="id[]"><td>\n' +
                        '                                    <select class="form-control" name="retencion_fuente">\n' +
                        '                                        @foreach($retenF as $reten)\n' +
                        '                                            <option value="{{$reten->id}}">{{$reten->concepto}} - {{$reten->tarifa}}%</option>\n' +
                        '                                        @endforeach\n' +
                        '                                    </select>\n' +
                        '                                </td><td><input type="number" name="porcent[]"  required></td>\n' +
                        '                                <td><input type="number" name="base[]"  required></td>\n' +
                        '                                <td><input type="number" name="valor[]" style="text-align:center" disabled placeholder="Al guardar el descuento surge el valor"></td><td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td></tr>');
                }
            }
        });
    </script>
@stop
