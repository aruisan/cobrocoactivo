
@extends('layouts.certificadosPdf')
@section('contenido')
		<div class="row">
			<center><h3>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</h3></center>
		</div>
		<div style="border:1px solid black;">
			<div style="width: 78%;   display: inline-block; margin-left: 3%">
				<h4>Fecha: <?=$dias[$fecha->format('w')]." ".$fecha->format('d')." de ".$meses[$fecha->format('n')-1]. " del ".$fecha->format('Y').'  Hora:'.$fecha->format('h:i:s')?></h4>
			</div>
			
			<div style="width: 12%;  display: inline-block; border:1px solid black; margin: 6px 0px 0px 0px;" class="col-md-2">
				<h4>Número {{$cdp->id}}</h4>
			</div> 
		</div>
				
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
						<td style="width: 30px;">Rubro: </td>
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
						<td style="width: 30px;">Objeto: </td>
						<td>{{$cdp->name}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">SOLICITADO POR: </td>
						<td> {{$cdp->cdpsSecretaria->name}}</td>
					</tr>
				</tbody>
			</table>
			
		</div>
@stop