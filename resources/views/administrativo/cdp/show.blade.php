@extends('layouts.dashboard')
@section('titulo')
    Información del CDP
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/cdp') }}" class="btn btn-success"><span class="hide-menu">&nbsp; CDP's</span></a></li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor del CDP</b></h4>
        </center>
        <div class="text-center">
            $<?php echo number_format($cdp->valor,0) ?>
        </div>
        <br>
        <center>
            <h4><b>Valores de los Rubros</b></h4>
        </center>
        <br>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    @foreach($valores as $valor)
                    <tr>
                        <td>{{ $valor['name'] }}</td>
                        <td>$<?php echo number_format($valor['dinero'],0) ?></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h3>{{ $cdp->name }}</h3></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-lg-6">
                        <table class="table-responsive" width="100%">
                            <tbody class="text-center">
                                <tr>
                                    <td><b>Dependencia:</b></td>
                                    <td><textarea class="text-center" style="border: none; resize: none;" disabled>{{ $cdp->dependencia->name }}</textarea></td>
                                </tr>
                                <tr>
                                    <td><b>Fecha:</b></td>
                                    <td>{{ $cdp->fecha }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table-responsive" style="width: 100%">
                            <tbody class="text-center">
                            <tr>
                                <td><b>Observación:</b></td>
                                <td><textarea class="text-center" style="border: none; resize: none;" disabled>{{ $cdp->observacion }}</textarea></td>
                            </tr>
                            <tr>
                                <td><b>Saldo:</b></td>
                                <td>{{ $cdp->saldo }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center">
        <hr>
        <center>
            <h3>Rubros del CDP</h3>
        </center>
        <hr>
    <br>
    <div class="table-responsive">
        @if($cdp->rubrosCdp->count() == 0 )
            <div class="col-md-12 align-self-center">
                <div class="alert alert-danger text-center">
                    El CDP no tiene rubros asigandos.
                </div>
            </div>
        @else
        @endif
        <form action="{{url('/administrativo/rubrosCdp')}}" method="POST"  class="form" id="prog">
            {{ csrf_field() }}
            <table id="tabla_rubrosCdp" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Nombre del Rubro</th>
                    <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cdp->rubrosCdp as $dato)
                <tr>
                    <td class="text-center">
                        <h4>
                            <b>{{ $dato->rubros->name }}</b>
                        </h4>
                    </td>
                    <td class="text-center"><button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminar({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-center">
                        <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">
                        <select name="rubro_id[]" class="form-group-lg" required>
                            @foreach($rubros as $rubro)
                                <option value="{{ $rubro->id }}">{{ $rubro->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                </tr>
                </tbody>
            </table><br>
            <center>
                <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </center>
        </form>
    </div>
    </div>
    @stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#tabla_rubrosCdp').DataTable( {
                responsive: true,
                "searching": false,
                "pageLength": 4
            } );

            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });

            new Vue({
                el: '#prog',
                methods:{
                    eliminar: function(dato){
                        var urlrubrosCdp = '/administrativo/rubrosCdp/'+dato;
                        axios.delete(urlrubrosCdp).then(response => {
                            location.reload();
                    });
                    },

                    nuevaFilaPrograma: function(){
                        var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                        $('#tabla_rubrosCdp tbody tr:last').before('<tr>\n' +
                            '                        <td class="text-center">\n' +
                            '                            <select name="rubro_id[]" required>\n' +
                            '                                @foreach($rubros as $rubro)\n' +
                            '                                    <option value="{{ $rubro->id }}">{{ $rubro->name }}</option>\n' +
                            '                                @endforeach\n' +
                            '                            </select>\n' +
                            '                        </td>\n' +
                            '                        <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '                    </tr>');

                    }
                }
            });
        } );
    </script>
@stop
