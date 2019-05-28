@extends('layouts.dashboard')
@section('titulo')
    Liquidación de Orden de Pago
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
            <center><h2>Liquidación Orden de Pago: {{ $ordenPago->nombre }}</h2></center>
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
                    <b>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Disponible del Registro:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="$<?php echo number_format($registro->saldo,0) ?>" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>IVA:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="{{ $registro->iva }}%" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Total del Registro:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="$<?php echo number_format($registro->valor,0) ?>" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor de Pagos Anteriores:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="$<?php echo number_format($SumPagos,0) ?>" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Disponible:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="$<?php echo number_format($registro->saldo,0) ?>" disabled>
                        </div>
                        <div class="col-md-3 text-center">
                            <br>
                            <h4><b>Valor Bruto a Pagar:</b></h4>
                        </div>
                        <div class="col-md-9">
                            <br>
                            <input type="number" style="text-align: center" class="form-control" id="ValB" name="valor" value="0" max="{{ $registro->saldo }}" min="{{ $ordenPago->descuentos->sum('valor') }}" required onchange="sumar(this.value, '{{ $ordenPago->descuentos->sum("valor") }}');">
                        </div>
                        <div class="col-md-2">
                            &nbsp;
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Descuentos:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" value="$<?php echo number_format($ordenPago->descuentos->sum('valor'),0) ?> " disabled>
                            <input type="hidden" id="des" name="des" class="form-control" value="{{ $ordenPago->descuentos->sum('valor') }}">
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Neto a Pagar:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" style="text-align: center" class="form-control" id="valP" name="valP" disabled value="0">
                        </div>
                    </b>
                    <div class="col-md-12 text-center">
                        <hr>
                        <div class="alert alert-info">
                            <center>
                                Son: <span id="letras"></span>
                            </center>
                        </div>
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
