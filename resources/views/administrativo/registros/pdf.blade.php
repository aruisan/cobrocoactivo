
@extends('layouts.certificadosPdf')
@section('contenido')
		<div class="row">
			<center><h3>REGISTRO PRESUPUESTAL</h3></center>
		</div>
		<div style="border:1px solid black;">
			<div style="width: 78%;   display: inline-block; margin-left: 3%">
				<h4>Fecha: <?=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')?></h4>
			</div>
			
			<div style="width: 12%;  display: inline-block; border:1px solid black; margin: 6px 0px 0px 0px;" class="col-md-2">
				<h4>Número {{$registro->id}}</h4>
			</div> 
		</div>
		<div class="br-black-1">
			<br>
			<center>
				<h2>CERTIFICA</h2>
				<br>
				<p>
					Que en la fecha el presupuesto de Gastos para la vigencia fiscal del año {{$vigencia->vigencia}} se le ha efectuado Registro Presupuestal por:
				</p>
			</center>
		</div>
		<?php $sumCdpsRegistro = 0;?>
		@foreach($registro->cdpsRegistro as $cdpsRegistro)
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Por valor de : </td>
						<td> {{$cdpsRegistro->valor}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Objeto: </td>
						<td> {{$cdpsRegistro->cdp->name}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php $sumCdpsRegistro = $sumCdpsRegistro+$cdpsRegistro->valor;?>
		@endforeach
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">VALOR TOTAL: </td>
						<td> {{number_format($sumCdpsRegistro)}} ({{\NumerosEnLetras::convertir($sumCdpsRegistro)}})</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Beneficiario: </td>
						<td> {{$registro->persona->nombre}}</td>
					</tr>
				</tbody>
			</table>
			
		</div>
@stop
		
	