
@extends('layouts.certificadosPdf')
@section('contenido')
		<div class="row">
			<center><h3>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</h3></center>
		</div>
		<hr class="hrFecha br-black-1">
			<h4>Fecha: <?=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')?></h4>
		<hr class="hrFecha br-black-1">
		<div class="br-black-1">
			<br>
			<center>
				<h2>CERTIFICA</h2>
				<br>
				<p>
					Que en la fecha el presupuesto de Gastos para la vigencia fiscal del año {{$vigencia->vigencia}} Existe Disponibilidad Presupuestal por:
				</p>
			</center>
		</div>
		<?php $sumRubros = 0;?>
		@foreach($cdp->rubrosCdp as $rubrosCdp)
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Proyecto: </td>
						<td> {{$rubrosCdp->rubros->subProyecto->proyecto->name}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Sub-Proyecto: </td>
						<td> {{$rubrosCdp->rubros->subProyecto->name}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Valor: </td>
						<td> {{number_format($rubrosCdp->rubrosCdpValor->sum('valor'))}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Objeto: </td>
						<td> {{$rubrosCdp->rubros->name}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php $sumRubros = $sumRubros+$rubrosCdp->rubrosCdpValor->sum('valor');?>
		@endforeach
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">VALOR TOTAL: </td>
						<td> {{number_format($sumRubros)}} ({{\NumerosEnLetras::convertir($sumRubros)}})</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">SOLICITADO POR: </td>
						<td> {{$cdp->cdpsSecretaria->name}}</td>
					</tr>
				</tbody>
			</table>
			
		</div>
@stop