@extends('layouts.dashboard')

@section('titulo')
Salidas
@stop

@section('sidebar')
@include('hacienda.almacen.cuerpo.side')
@stop

@section('content')
<div class="col-lg-12" align="center"> 
	<h2>Salida de activos</h2> 
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card" style="padding: 20px; margin-bottom: 40px;background: #">
			<div class="card-body">
				<form action="" method="post" role="form">
					<div class="form-group">
						<div class="col-lg-6">
							<label class="col-lg-3">
								<br><strong>N° Activo:</strong> 
							</label>
							<div class="col-lg-9">
								<input class="outlinenone" type="text" disabled="true" id="idProducto" value=""/>

								<input class="outlinenone" type="text" style="display:none" id="idProducto" name="idProducto"  value=""/>
							</div>
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">
								<br><strong>Fecha:</strong>
							</label>
							<div class="col-lg-9">
								<input type="date" name="fecha" x value="" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3 " for="proveedor">
								<br><strong>Proveedor:</strong>
							</label>
							<div class="col-lg-9">
								<input class="form-control" type="text" name="proveedor" disabled="true" value=""/>
							</div>
						</div>						
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3">
								<strong>Activo:</strong>
							</label>
							<div class="col-lg-9">
								<input  type="text" class="form-control" name="producto" disabled="true" value="" /> 
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3">
								<strong>Tipo de movimiento:</strong>
							</label>
							<div class="col-lg-9">
								<select id="movimiento" name="movimiento" class="form-control">
									<option value="salida">Salida</option>
									<option value="traslado">Traslado edificio</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3">
								<strong>Lugar destino:</strong>
							</label>
							<div class="col-lg-9">
								<select id="destino" name="destino" class="form-control">
									<option value="externo">Externo</option>";
									<option value="edificio">Edificio</option>"; 
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3">
								<strong>Stock actual:</strong>
							</label>
							<div class="col-lg-9">
								<input type="number" min="1" disabled="true" class="form-control" value=""/> 

								<input type="number" min="1" name="stock" style="display:none" class="form-control" value=""/> 
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12">
							<label class="col-lg-3">
								<strong>Unidades a ingresar:</strong>
							</label>
							<div class="col-lg-9">
								<input type="number" min="1" name="cantidad" class="form-control" value="" required/> 
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-12" align="center">
							<button  type="submit" class="btn btn-danger"><i class="fa fa-minus-square"></i> Salidas</button>
						</div>

					</div>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</div>

@stop