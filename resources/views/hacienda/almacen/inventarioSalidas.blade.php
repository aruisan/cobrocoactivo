@extends('layouts.dashboard')

@section('titulo')
Inventario - Salidas
@stop

@section('sidebar')
@include('hacienda.almacen.cuerpo.side')
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


@stop

@section('content')

<div class="row">
	<div class="col-lg-12 margin-tb">
		<h2 class="text-center">Inventario de salidas</h2>
	</div>
</div>

<table id="example" class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Proveedor</th>
			<th>N° producto</th>
			<th>Referencia</th>
			<th>Activo</th>
			<th>Tipo Movimiento</th>
			<th>Cantidad</th>
			<th>Lugar destino</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tiger Nixon</td>
			<td>System Architect</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>2011/04/25</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>Edinburgh</td>
		</tr>
		<tr>
			<td>Garrett Winters</td>
			<td>Accountant</td>
			<td>Tokyo</td>
			<td>63</td>
			<td>2011/07/25</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>Edinburgh</td>
		</tr>
		<tr>
			<td>Ashton Cox</td>
			<td>Junior Technical Author</td>
			<td>San Francisco</td>
			<td>66</td>
			<td>2009/01/12</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>Edinburgh</td>
		</tr>
	</tbody>
</table>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
		responsive: true,
		"language": {
			"search": "Buscar:",
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"info": "Mostrando página _PAGE_ de _PAGES_",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			}
		}
	} );
} );
</script>

@stop