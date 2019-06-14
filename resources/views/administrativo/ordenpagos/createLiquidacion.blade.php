@extends('layouts.dashboard')
@section('titulo')
    Contabilidad de Orden de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos/'.$ordenPago->id) }}" class="btn btn-success">
            <span class="hide-menu">Orden de Pago</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Contabilidad Orden de Pago: {{ $ordenPago->nombre }}</h2></center>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    Registro Seleccionado: {{ $ordenPago->registros->objeto }}
                </div>
                <div class="col-md-6 text-center">
                    Tercero: {{ $ordenPago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos/liquidacion/store')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $ordenPago->id }}">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                            <th class="text-center">Codigo Cuenta</th>
                            <th class="text-center">Nombre Cuenta</th>
                            <th class="text-center">Debito</th>
                            <th class="text-center">Credito</th>
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                            </thead>
                            <tbody>
                            @for($i=0;$i< count($ordenPagoDesc); $i++)
                                <tr>
                                    @if($ordenPagoDesc[$i]->retencion_fuentes_id == null)
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_municipales->codigo }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_retencion->codigo }}
                                        </td>
                                    @endif
                                    @if($ordenPagoDesc[$i]->retencion_fuentes_id == null)
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_municipales->cuenta }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_retencion->cuenta }}
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <input type="number" value="0" style="text-align:center" disabled>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" value="$<?php echo number_format($ordenPagoDesc[$i]->valor,0) ?>" style="text-align:center" disabled>
                                    </td>
                                    <td class="text-center"></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="col-md-12 align-self-center text-center">
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i>&nbsp; Liquidar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">

        function sumar (valor, descuento) {
            valor = parseInt(valor);
            descuento = parseInt(descuento);
            total = ( valor - descuento);
            $("#valP").val('$'+total);
            data = nn(total);
            document.getElementById('letras').innerHTML=data+' pesos mc';
        }

        var o=new Array("diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve", "veinte", "veintiuno", "veintidós", "veintitrés", "veinticuatro", "veinticinco", "veintiséis", "veintisiete", "veintiocho", "veintinueve");
        var u=new Array("cero", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
        var d=new Array("", "", "", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");
        var c=new Array("", "ciento", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos");

        function nn(n)
        {
            var n=parseFloat(n).toFixed(2);
            var p=n.toString().substring(n.toString().indexOf(".")+1);
            var m=n.toString().substring(0,n.toString().indexOf("."));
            var m=parseFloat(m).toString().split("").reverse();
            var t="";

            for (var i=0; i<m.length; i+=3)
            {
                var x=t;
                var b=m[i+1]!=undefined?parseFloat(m[i+1].toString()+m[i].toString()):parseFloat(m[i].toString());
                t=m[i+2]!=undefined?(c[m[i+2]]+" "):"";
                t+=b<10?u[b]:(b<30?o[b-10]:(d[m[i+1]]+(m[i]=='0'?"":(" y "+u[m[i]]))));
                t=t=="ciento cero"?"cien":t;
                if (2<i&&i<6)
                    t=t=="uno"?"mil ":(t.replace("uno","un")+" mil ");
                if (5<i&&i<9)
                    t=t=="uno"?"un millón ":(t.replace("uno","un")+" millones ");
                t+=x;
            }
            t=t.replace("  "," ");
            t=t.replace(" cero","");
            return t;
        }
    </script>
@stop
