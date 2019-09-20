@extends('layouts.OPPdf')
@section('contenido')
	<div class="col-md-12 align-self-center">
		<div class="table-responsive br-black-1">
			<table class="table table-borderless">
				<tr class="text-center">
					<td>ORDEN DE PAGO No: {{ $OrdenPago->id }}</td>
					<td><?=$dias[$fecha->format('w')]." ".$fecha->format('d')." de ".$meses[$fecha->format('n')-1]. " del ".$fecha->format('Y')?></td>
				</tr>
				<tr class="text-center">
					<td>Beneficiario: {{$OrdenPago->registros->persona->nombre}}</td>
					<td>Nit o Cedula: {{ $OrdenPago->registros->persona->num_dc }}</td>
				</tr>
				<tr class="text-center">
					<td>Registro No: {{$R->id}}</td>
					<td>Fecha Registro: <?=$dias[$fechaR->format('w')]." ".$fechaR->format('d')." ".$meses[$fechaR->format('n')-1]. " ".$fechaR->format('Y')?></td>
				</tr>
			</table>
		</div>
		<div class="br-black-1">
			<center>
				<h4>CONCEPTO</h4>
				<p>
					<h5>{{ $OrdenPago->nombre }}</h5>
				</p>
			</center>
		</div>
		<br>
		<div class="table-responsive br-black-1">
			<table class="table table-borderless">
				<thead>
				<tr>
					<th class="text-center" colspan="3" style="background-color: rgba(19,165,255,0.14)">LIQUIDACIÓN</th>
				</tr>
				</thead>
				<tbody>
				<tr class="text-center">
					<td>
						<div class="col-md-12">
							<div class="col-md-6">VALOR BRUTO</div>
							<div class="col-md-6">$ <?php echo number_format($OrdenPago->registros->valor,0);?></div>
						</div>
					</td>
					<td>
						<div class="col-md-12">
							<div class="col-md-6">VALOR IVA</div>
							<div class="col-md-6">$ <?php echo number_format($OrdenPago->registros->iva,0);?></div>
						</div>
					</td>
					<td>
						<div class="col-md-12">
							<div class="col-md-6">VALOR TOTAL</div>
							<div class="col-md-6">$ <?php echo number_format($OrdenPago->registros->val_total,0);?></div>
						</div>
					</td>
				</tr>
				<tr class="text-center">
					<td>
						<div class="col-md-12">
							<div class="col-md-6">ANTICIPO</div>
							<div class="col-md-6">$ 0</div>
						</div>
					</td>
					<td>
						<div class="col-md-12">
							<div class="col-md-6">OTROS DESCUENTOS</div>
							<div class="col-md-6">$<?php echo number_format($OrdenPagoDescuentos->sum('valor'),0) ?></div>
						</div>
					</td>
					<td>
						<?php
							$pay= $OrdenPago->registros->val_total - $OrdenPagoDescuentos->sum('valor');
						?>
						<div class="col-md-12">
							<div class="col-md-6">A CANCELAR</div>
							<div class="col-md-6">$<?php echo number_format($pay,0) ?></div>
						</div>
					</td>
				</tr>
				<tr class="text-center">
					<td colspan="3">
						SON: {{\NumerosEnLetras::convertir($pay)}} M/CTE
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="table-responsive br-black-1">
			<table class="table table-bordered" id="tablaDesc">
				<thead>
				<tr>
					<th colspan="4" class="text-center" style="background-color: rgba(19,165,255,0.14)"> DESCUENTOS</th>
				</tr>
				<tr>
					<th class="text-center">Codigo</th>
					<th class="text-center">Descripcion</th>
					<th class="text-center">Base</th>
					<th class="text-center">Valor</th>
				</tr>
				</thead>
				<tbody>
				@foreach($OrdenPagoDescuentos as  $PagosDesc)
					<tr class="text-center">
						@if($PagosDesc->retencion_fuente_id == null)
							<td>{{ $PagosDesc->descuento_mun['codigo'] }}</td>
						@else
							<td>{{ $PagosDesc->descuento_retencion->codigo}}</td>
						@endif
						<td>{{ $PagosDesc->nombre }}</td>
						@if($PagosDesc->retencion_fuente_id == null)
							<td>$ <?php echo number_format($PagosDesc->descuento_mun['base'],0);?></td>
						@else
							<td>$ <?php echo number_format($PagosDesc->descuento_retencion->base,0);?></td>
						@endif
						<td>$ <?php echo number_format($PagosDesc['valor'],0);?></td>
					</tr>
				@endforeach
				<tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
					<td colspan="3"><b>Total Descuentos</b></td>
					<td><b>$ <?php echo number_format($OrdenPagoDescuentos->sum('valor'),0);?></b></td>
				</tr>
				</tbody>
			</table>
		</div>
		<br>
		<div class="table-responsive br-black-1">
			<table class="table table-bordered" id="tablaP">
				<thead>
				<tr>
					<th class="text-center" colspan="5" style="background-color: rgba(19,165,255,0.14)">PRESUPUESTO</th>
				</tr>
				<tr>
					<th class="text-center">Codigo</th>
					<th class="text-center">Descripción</th>
					<th class="text-center">Fuente Financiación</th>
					<th class="text-center">Registro</th>
					<th class="text-center">Valor</th>
				</tr>
				</thead>
				<tbody>
				@for($i = 0; $i < $R->cdpRegistroValor->count(); $i++)
					<tr class="text-center">
						<td>
							@for($x = 0; $x < count($infoRubro); $x++)
								@if($infoRubro[$x]['id_rubro'] == $R->cdpRegistroValor[$i]->fontRubro->rubro->id)
									{{ $infoRubro[$x]['codigo'] }}
								@endif
							@endfor
						</td>
						<td>{{ $R->cdpRegistroValor[$i]->fontRubro->rubro->name}}</td>
						<td>{{ $R->cdpRegistroValor[$i]->fontRubro->font->code }} - {{ $R->cdpRegistroValor[$i]->fontRubro->font->name }}</td>
						<td>{{ $OrdenPago->registros->objeto }}</td>
						<td>$ <?php echo number_format($OrdenPago->registros->valor,0);?></td>
					</tr>
				@endfor
				</tbody>
			</table>
		</div>
		<div class="table-responsive br-black-1">
			<table class="table table-bordered" id="tablaP">
				<thead>
				<tr>
					<th class="text-center" colspan="5" style="background-color: rgba(19,165,255,0.14)">CONTABILIZACIÓN</th>
				</tr>
				<tr>
					<th class="text-center">Codigo</th>
					<th class="text-center">Descripción</th>
					<th class="text-center">Tercero</th>
					<th class="text-center">Debito</th>
					<th class="text-center">Credito</th>
				</tr>
				</thead>
				<tbody>
				@for($y = 0; $y < count($OrdenPago->pago); $y++)
					<tr class="text-center">
						<td>{{ $OrdenPago->pago[$y]->data_puc->codigo }}</td>
						<td>{{ $OrdenPago->pago[$y]->data_puc->nombre_cuenta }}</td>
						<td>{{ $OrdenPago->registros->persona->num_dc }} {{ $OrdenPago->registros->persona->nombre }}</td>
						@if($OrdenPago->pago[$y]->data_puc->naturaleza % 2 == 0)
							<?php
							$valuesD[] = $OrdenPago->pago[$y]->valor;
							?>
							<td>$<?php echo number_format($OrdenPago->pago[$y]->valor,0);?></td>
							<td>$0</td>
						@else
							<?php
							$valuesC[] = $OrdenPago->pago[$y]->valor;
							?>
							<td>$0</td>
							<td>$<?php echo number_format($OrdenPago->pago[$y]->valor,0);?></td>
						@endif
					</tr>
				@endfor
				@for($z = 0; $z < $OrdenPago->pucs->count(); $z++)
					<tr class="text-center">
						<?php
						$valorTot = $OrdenPago->pucs[$z]->valor - $OrdenPagoDescuentos->sum('valor');
						?>
						<td>{{$OrdenPago->pucs[$z]->data_puc->codigo}}</td>
						<td>{{$OrdenPago->pucs[$z]->data_puc->nombre_cuenta}}</td>
						<td>{{ $OrdenPago->registros->persona->num_dc }} {{ $OrdenPago->registros->persona->nombre }}</td>
						@if($OrdenPago->pucs[$z]->data_puc->naturaleza % 2 == 0)
							<?php
							$valuesD[] = $valorTot;
							?>
							<td>$<?php echo number_format($valorTot,0);?></td>
							<td>$0</td>
						@else
							<?php
							$valuesC[] = $valorTot;
							?>
							<td>$0</td>
							<td>$<?php echo number_format($valorTot,0);?></td>
						@endif
					</tr>
				@endfor
				<tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
					<td colspan="3"><b>Total</b></td>

					@if(isset($valuesD))
						<td><b>$<?php echo number_format(array_sum($valuesD),0);?></b></td>
					@else
						<td><b>$0</b></td>
					@endif
					@if(isset($valuesC))
						<td><b>$<?php echo number_format(array_sum($valuesC),0);?></b></td>
					@else
						<td><b>$0</b></td>
					@endif
				</tr>
				</tbody>
			</table>
		</div>
	</div>
@stop