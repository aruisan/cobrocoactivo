@extends('layouts.dashboard')
@section('titulo')
    Información del CDP
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/cdp/'.$cdp->vigencia_id) }}" class="btn btn-success"><span class="hide-menu">&nbsp; CDP's</span></a></li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Número del CDP:</b>&nbsp;{{ $cdp->id }}</h4>
        </center>
        <br>
        <center>
            <h4><b>Valor del CDP</b></h4>
        </center>
        <div class="text-center">
            @if($rol == 3 and $cdp->jefe_e == 0)
                $<?php echo number_format( $cdp->rubrosCdpValor->sum('valor_disp'),0) ?>
                @else
                $<?php echo number_format( $cdp->valor,0) ?>
            @endif
        </div>
        <br>
        @if($cdp->jefe_e != "3")
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
        @endif
        @if($cdp->jefe_e == "1" and $cdp->motivo != null)
            <br>
            <center>
                <h4><b>Motivo del Rechazo</b></h4>
            </center>
            <div class="text-center">
                {{ $cdp->motivo }}
            </div>
            <br>
        @endif
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
                                    <td><b>Fecha de Creación:</b></td>
                                    <td>{{ $cdp->fecha }}</td>
                                </tr>
                                @if($cdp->secretaria_e == "3" and $cdp->jefe_e == "3")
                                    <tr>
                                        <td><b>Fecha de Envio por Secretaria:</b></td>
                                        <td>{{ $cdp->ff_secretaria_e }}</td>
                                    </tr>
                                @endif
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
                                <td>$<?php echo number_format($cdp->saldo,0) ?></td>
                            </tr>
                            @if($cdp->secretaria_e == "3" and $cdp->jefe_e == "3")
                                <tr>
                                    <td><b>Fecha de Finalización:</b></td>
                                    <td>{{ $cdp->ff_jefe_e }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 text-center">
                        <br>
                        <b>
                            @if($cdp->secretaria_e == "3" and $cdp->jefe_e == "0")
                                Fecha de Envio por Secretaria:
                                {{ $cdp->ff_secretaria_e }}
                            @endif
                        </b>
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
    <div class="table-responsive" id="prog">
        @if($cdp->rubrosCdp->count() == 0 )
            <div class="col-md-12 align-self-center">
                <div class="alert alert-danger text-center">
                    El CDP no tiene rubros asigandos. Desea borrar el CDP? &nbsp;
                    <form action="{{ url('/administrativo/cdp/'.$cdp->vigencia_id.'/'.$cdp->id.'/delete') }}" method="post" class="form">
                        {!! method_field('DELETE') !!}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-danger">
                            Borrar CDP
                        </button>
                    </form>
                </div>
            </div>
        @else
        @endif
        <form action="{{url('/administrativo/rubrosCdp')}}" method="POST" class="form">
            {{ csrf_field() }}
            <table id="tabla_rubrosCdp" class="table table-bordered">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th scope="col" class="text-center">Rubros</th>
                    <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                </tr>
                </thead>
                <tbody>
                @if($cdp->jefe_e != "3")
                    @if($cdp->rubrosCdp->count() == 0)
                        @if($rol == 2)
                            <tr>
                                <td>&nbsp;</td>
                                <td class="text-center">
                                    <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">
                                    <select name="rubro_id[]" class="form-group-lg" required>
                                        @foreach($infoRubro as $rubro)
                                            <option value="{{ $rubro['id_rubro'] }}">{{ $rubro['codigo'] }} - {{ $rubro['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        @endif
                    @endif
                @endif
                @for($i = 0; $i < $cdp->rubrosCdp->count(); $i++)
                    @php($rubrosCdpData = $cdp->rubrosCdp[$i] )
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn-sm btn-success" onclick="ver('fuente{{$i}}')" ><i class="fa fa-arrow-down"></i></button>
                        </td>
                        <td class="text-center">
                            <div class="col-lg-4">
                                <h4>
                                    <b>{{ $rubrosCdpData->rubros->name }}</b>
                                </h4>
                            </div>
                            <div class="col-lg-4">
                                <h4>
                                    @foreach($infoRubro as $infoR)
                                        @if($infoR['id_rubro'] == $rubrosCdpData->rubros->id)
                                            <b>Rubro: {{ $infoR['codigo'] }}</b>
                                        @endif
                                    @endforeach
                                </h4>
                            </div>
                            <div class="col-lg-4">
                                @php( $valorT = $rubrosCdpData->rubrosCdpValor->sum('valor') )
                                <h4>
                                    <b>
                                        Valor:
                                        @if($rubrosCdpData->rubrosCdpValor->count() > 0)
                                            $<?php echo number_format( $rubrosCdpData->rubrosCdpValor->sum('valor') ,0) ?>
                                        @else
                                            $0.00
                                        @endif
                                    </b>
                                </h4>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($rol == 2)
                                @if($rubrosCdpData->rubrosCdpValor->count() == 0)
                                    <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminar({{ $rubrosCdpData->id }})" ><i class="fa fa-trash-o"></i></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr id="fuente{{$i}}" style="display: none">
                        <td style="vertical-align: middle">
                            <b>Fuentes del rubro {{ $rubrosCdpData->rubros->name }}</b>
                        </td>
                        <td>
                            <div class="col-lg-12">
                                @foreach($rubrosCdpData->rubros->fontsRubro as $fuentesRubro)
                                    @if($cdp->jefe_e == "3")
                                        <div class="col-lg-6">
                                            <input type="hidden" name="fuente_id[]" value="{{ $fuentesRubro->id }}">
                                            <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">
                                            <input type="hidden" name="rubros_cdp_id[]" value="{{ $rubrosCdpData->id }}">
                                            @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                                            <li style="list-style-type: none;">
                                                {{ $fuentesRubro->font->name }} : $<?php echo number_format( $fuentesRubro->valor_disp,0) ?>
                                            </li>
                                        </div>
                                    @elseif($fuentesRubro->valor_disp != 0)
                                        <div class="col-lg-6">
                                            <input type="hidden" name="fuente_id[]" value="{{ $fuentesRubro->id }}">
                                            <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">
                                            <input type="hidden" name="rubros_cdp_id[]" value="{{ $rubrosCdpData->id }}">
                                            @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                                            <li style="list-style-type: none;">
                                                {{ $fuentesRubro->font->name }} : $<?php echo number_format( $fuentesRubro->valor_disp,0) ?>
                                            </li>
                                        </div>
                                    @endif
                                    <div class="col-lg-6">
                                        @if($cdp->jefe_e == "3")
                                            Valor usado de {{ $fuentesRubro->font->name }}:
                                            @if($fuentesRubro->rubrosCdpValor->count() != 0)
                                                @foreach($fuentesRubro->rubrosCdpValor as  $valoresFR)
                                                    @php($id_rubrosCdp = $rubrosCdpData->id )
                                                    @if($valoresFR->cdp_id == $cdp->id)
                                                        <input type="hidden" name="rubros_cdp_valor_id[]" value="{{ $valoresFR->id }}">
                                                        @if($cdp->secretaria_e == "0")
                                                            <input type="number" required  name="valorFuenteUsar[]" id="id{{$fuentesRubro->font_id}}" class="valor{{ $valoresFR->rubrosCdp_id }}" value="{{ $valoresFR->valor }}" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                        @else
                                                            $<?php echo number_format( $valoresFR->valor,0) ?>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if($cdp->rubrosCdpValor->count() == 0)
                                                    <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                    <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                @endif
                                            @else
                                                <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                            @endif
                                        @elseif($fuentesRubro->valor_disp != 0)
                                            Valor usado de {{ $fuentesRubro->font->name }}:
                                            @if($fuentesRubro->rubrosCdpValor->count() != 0)
                                                @foreach($fuentesRubro->rubrosCdpValor as  $valoresFR)
                                                    @php($id_rubrosCdp = $rubrosCdpData->id )
                                                    @if($valoresFR->cdp_id == $cdp->id)
                                                        <input type="hidden" name="rubros_cdp_valor_id[]" value="{{ $valoresFR->id }}">
                                                        @if($cdp->secretaria_e == "0")
                                                            <input type="number" required  name="valorFuenteUsar[]" id="id{{$fuentesRubro->font_id}}" class="valor{{ $valoresFR->rubrosCdp_id }}" value="{{ $valoresFR->valor }}" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                        @else
                                                            $<?php echo number_format( $valoresFR->valor,0) ?>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if($cdp->rubrosCdpValor->count() == 0)
                                                    <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                    <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                @endif
                                            @else
                                                <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-center">
                            <b>Valor Total</b>
                            <br>
                            <b>
                                @if($rubrosCdpData->rubrosCdpValor->count() > 0)
                                    $<?php echo number_format( $rubrosCdpData->rubrosCdpValor->sum('valor') ,0) ?>
                                @else
                                    $0.00
                                @endif
                            </b>
                            <br>
                            &nbsp;
                            <br>

                            @if($cdp->jefe_e != "3" and $cdp->jefe_e != "2")
                                @if($rol == 2)
                                    @if($rubrosCdpData->rubrosCdpValor->count() > 0)
                                        <b>Liberar Dinero</b>
                                        <br>
                                        <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarV({{ $rubrosCdpData->rubrosCdpValor->first()->rubrosCdp_id }})" ><i class="fa fa-money"></i></button>
                                    @else
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table><br>
            <center>
                @if($cdp->jefe_e == "2" and $cdp->secretaria_e == "3")
                    <div class="col-md-12 align-self-center">
                        <div class="alert alert-danger text-center">
                            El CDP ha sido anulado.
                        </div>
                    </div>
                @else
                    @if($cdp->jefe_e != "3")
                        @if($rol == 2)
                            <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                            <button type="submit" class="btn btn-primary">Guardar Rubros</button>
                            @if($cdp->rubrosCdp->count() > 0 )
                                <a href="{{url('/administrativo/cdp/'.$cdp->id.'/'.$rol.'/'.$fechaActual.'/'.$cdp->rubrosCdpValor->sum('valor_disp').'/3')}}" class="btn btn-success">
                                    Enviar CDP
                                </a>
                            @endif
                        @elseif($rol == 3)
                            @if($cdp->rubrosCdp->count() > 0 )
                                <a href="{{url('/administrativo/cdp/'.$cdp->id.'/'.$rol.'/'.$fechaActual.'/'.$cdp->rubrosCdpValor->sum('valor_disp').'/3')}}" class="btn btn-success">
                                    Finalizar CDP
                                </a>
                                <a data-toggle="modal" data-target="#observacionCDP" class="btn btn-danger">
                                    Rechazar
                                </a>
                            @endif
                        @endif
                    @endif
                @endif
            </center>
        </form>
    </div>
        @if($cdp->jefe_e == "3" and $cdp->secretaria_e == "3")
            <div class="row">
                <div class="form-group text-center">
                    <form action="{{url('/administrativo/cdp/'.$cdp->id.'/anular/'.$cdp->vigencia_id)}}" method="POST">
                        {{method_field('POST')}}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-lg" type="submit" title="Al anular el CDP se retorna el dinero al rubro">Anular CDP</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    @include('modal.observacionCDP')
    @stop
@section('js')
    <script>

        var count1 = '<?php echo $cdp->rubrosCdp->count(); ?>';
        var ciclo1 = JSON.parse('<?php echo json_encode($cdp->rubrosCdp); ?>');

        for (i = 0; i < count1; i++) {
            var r1 = ciclo1[i];
            var fontsR = r1.rubros.fonts_rubro;
            for (j = 0; j < fontsR.length; j++){
                var fuenteR = fontsR[j].rubros_cdp_valor;
                for (k = 0; k < fuenteR.length; k++){
                    var idClass = '#valor'+fuenteR[k].rubrosCdp_id;
                    var idId = '.id'+fontsR[j].font_id;
                    var i = i;
                }

            }
        };

        var visto = null;
        function ver(num) {
            obj = document.getElementById(num);
            obj.style.display = (obj==visto) ? 'none' : '';
            if (visto != null)
                visto.style.display = 'none';
            visto = (obj==visto) ? null : obj;
        }

        $(document).ready(function() {

            $('#tabla_rubrosCdp').DataTable( {
                responsive: true,
                "searching": false,
                "ordering" : false
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

                    eliminarV: function(dato){
                        var urlrubrosCdpValor = '/administrativo/rubrosCdp/valor/'+dato;
                        axios.delete(urlrubrosCdpValor).then(response => {
                            location.reload();
                    });
                    },

                    nuevaFilaPrograma: function(){
                        var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                        $('#tabla_rubrosCdp tbody tr:first').before('<tr>\n' +
                            '                                <td>&nbsp;</td>\n' +
                            '                                <td class="text-center">\n' +
                            '                                    <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">\n' +
                            '                                    <select name="rubro_id[]" class="form-group-lg" required>\n' +
                            '                                        @foreach($infoRubro as $rubro)\n' +
                            '                                            <option value="{{ $rubro['id_rubro'] }}">{{ $rubro['codigo'] }} - {{ $rubro['name'] }}</option>\n' +
                            '                                        @endforeach\n' +
                            '                                    </select>\n' +
                            '                                </td>\n' +
                            '                                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '                            </tr>');

                    }
                }
            });
        } );
    </script>
@stop
