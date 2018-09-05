@extends('layouts.dashboard')

@section('titulo')
Nuevas Entradas
@stop

@section('sidebar')
@include('hacienda.almacen.cuerpo.side')
@stop

@section('content')

<div class="col-lg-12">
	<h2 class="text-center">Nuevas entradas</h2>
</div>

<div class="row">
	<div class="col-lg-12" >
		<div class="card" style="padding: 20px; margin-bottom: 40px;background: #">
			<div class="card-body">
				<form action="crear.php" method="post" role="form" >
					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right" for="proveedor">
							<strong>Proveedor:</strong>
						</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="producto" placeholder="Ingrese nombre del activo" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right">
							<strong>Nombre:</strong>
						</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="producto" placeholder="Ingrese nombre del activo" required>
						</div>

					</div>

					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right">
							<strong>Referencia:</strong>
						</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="referencia" placeholder="Ingrese Referencia" required>	
						</div>

					</div>

					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right">
							<strong>Cantidad:</strong>
						</label>
						<div class="col-lg-7">
							<input type="number" min="1" name="cantidad" class="form-control" placeholder="Ingrese cantidad" required>	
						</div>

					</div>

					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right">
							<strong>Fecha:</strong>
						</label>
						<div class="col-lg-7">
							<input type="date" name="fecha" class="form-control" required>
						</div>

					</div>

					<div class="form-group">
						<label class="col-lg-3 col-form-label text-right">
							<strong>Lugar destino:</strong>
						</label>
						<div class="col-lg-7">
							<select class="form-control" disabled="true">
								<option type="text"value="almacen">Almacén</option>
								<option value="edificio">Edificio</option>
								<option value="externo">Externo</option>
							</select>

							<input type="text" id="destino" name="destino" style="display:none" class="form-control" value="almacen">
						</div>

					</div>

					<div class="form-group">
						<div class="col-lg-12 ml-auto text-center">
							<button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>	
						</div>

					</div>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</div>
@stop