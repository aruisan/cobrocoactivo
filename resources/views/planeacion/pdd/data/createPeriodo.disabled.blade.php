@extends('layouts.pdesarrollo')
@section('contenido')

<div id="content"> 
    <div id="contenido">
        <div class="row justify-content-center" id="crud">
        	<div class="col-3">
        		<div class="card">
        			<div class="card-title">
        				<center>
        					<h3>Información del Producto</h3>
        				</center>
        			</div>
        			<div class="card-body">
						<div class="basic-form">
							<form>
								<div class="form-group">
									<label>Nombre</label>
									<input type="text" class="form-control" placeholder="Ciclas" disabled>
								</div>
								<div class="form-group">
									<label>Cantidad</label>
									<input type="number" class="form-control" placeholder="1000" disabled>
								</div>
								<div class="form-group">
									<label>Sub Proyecto</label>
									<input type="text" class="form-control" placeholder="Objetos Niños" disabled>
								</div>
							</form>
						</div>
        			</div>
        		</div>
        	</div>
	        <div class="col-6">
	        		<div class="card">
	        			<div class="card-title">
	        				<center>
	        					<h3>Creación de Periodos</h3>
	        				</center>
	        			</div>
	        			<div class="card-body">
			        		<form action="" method="POST">
			        				@csrf
				        			<input type="hidden" class="form-control"  name="rubro_id" value="">
				        			<div class="table-responsive">
				        				<table class="table" id="tabla">
						        			<thead>
						        				<th class="text-center">Periodo</th>
						        				<th class="text-center">Cantidad</th>
						        				<th class="text-center"><i class="fa fa-trash-o"></i></th>
						        			</thead>
						        			<tbody>
						        				<tr class="table-primary">
													<td align="center"><select>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select></td>
						        					<td><input type="number" class="form-control" name="valor[]" value="" required></td>
						        					<td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos" ><i class="fa fa-trash-o"></i></button></td>
						        				</tr>
						        				<tr>
													<td align="center"><select>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
														</select></td>
						        					<td><input type="number" class="form-control" name="valor[]" required></td>
						        					<td><button type="button" class="btn btn-danger borrar"> - </button></td>
						        				</tr>
						        			</tbody>
					        			</table>
					        		</div>
								<br>
								<center>
			        			<button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fila</button>
			        			<button type="submit" class="btn btn-primary">Guardar</button>
								</center>
								<br>
			        		</form>
			        	</div>
			        	<div class="card-footer">
			        		<center class="text-info">
			        			Cantidad Total. $120.00
			        		</center>
			        	</div>
			        </div>
	        </div>
	        <div class="col-1">
				<br>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Navegación
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="/pdesarrollo">Plan de Desarrollo</a></li>
							<li><a href="/pdesarrollo/data/create/1">Ejes, Programas y Proyectos</a></li>
							<li><a href="/pdesarrollo/subproyecto/create/1">Sub Proyectos</a></li>
							<li><a href="/pdesarrollo/producto/create/1">Productos</a></li>
                            <li class="active">Periodos</li>
						</ul>
					</div>

	        </div>
	    </div>
    </div>
</div>

@stop

@section('js')
<script>
	  	


//funcion para borrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#crud',
	created: function(){
		this.getDatosFont();
	},
	methods:{
		getDatosFont: function(){
			/*
			$('.font').each(function(){
			   alert($(this).val());
			});*/
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/FontRubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				location.reload();
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after('<tr><td align="center"><select>\n' +
                '                                           <option value="1">1</option>\n' +
                '                                           <option value="2">2</option>\n' +
                '                                           <option value="3">3</option>\n' +
                '                                           <option value="4">4</option>\n' +
                '</select></td><td><input type="number" class="form-control" name="valor[]" required></td><td><button type="button" class="btn btn-danger borrar"> - </button></td></tr>');
		}
	}
});
</script>
@stop