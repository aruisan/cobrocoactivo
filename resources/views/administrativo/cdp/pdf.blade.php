



<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title></title>
	<style type="text/css">
		body { 
			margin: 4px;
			font-size: 10px;
		 }
	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<img src="{{ $base64 }}" class="img-responsive">
			</div>
			<div class="col-md-7"></div>
			<div class="col-md-3">
				<img src="{{asset('img/masporlasislas.png')}}" class="img-responsive">
			</div>
		</div>
	</div>









	<div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h3>{{ $cdp->name }}</h3></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-lg-6">
                        <table class="table table-responsive" width="100%">
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
                    {!! Form::open(['method' => 'DELETE','route' => ['cdp.destroy', $cdp->id],'style'=>'display:inline']) !!}
                    <button type="submit" class="btn btn-sm btn-danger">
                        Borrar CDP
                    </button>
                    {!! Form::close() !!}
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
                                        @foreach($rubros as $rubro)
                                            <option value="{{ $rubro['id'] }}">{{ $rubro['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
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
                                    @if($fuentesRubro->valor_disp != 0)
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
                                        @if($fuentesRubro->valor_disp != 0)
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

                            @if($cdp->jefe_e != "3")
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
            </center>
        </form>
    </div>
    </div>

</body>
</html>
	