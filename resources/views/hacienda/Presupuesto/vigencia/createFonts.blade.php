@extends('layouts.dashboard')
@section('titulo')
	Creación de Fuentes
@stop
@section('sidebar')
	<li class="dropdown">
		<a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
			<span class="hide-menu">Niveles</span>
			&nbsp;
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
			@foreach($niveles as $level)
				<li><a href="/presupuesto/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
			@endforeach
			<li><a href="/presupuesto/font/create/{{ $vigencia->id }}" class="btn btn-primary">Fuentes</a></li>
			<li><a href="/presupuesto/rubro/create/{{ $vigencia->id }}" class="btn btn-primary">Rubros</a></li>
			<li><a href="/presupuesto/level/create/{{ $vigencia->id }}" class="btn btn-primary">Nuevo Nivel</a></li>
		</ul>
	</li>
    <br>
    <div class="card">
        <br>
<center>
    <h4><b>Estado Presupuestal de la Vigencia</b></h4>
</center>
    <br>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Presupuesto</td>
                <td class="text-dark">{{ $vigencia->presupuesto_inicial }}</td>
            </tr>
            <tr>
                <td>Ingresos en las Fuentes</td>
                <td class="text-dark">{{ $vigencia->fonts->sum('valor') }}</td>
            </tr>
            <tr>
                <td>Dinero Disponible</td>
                <td class="text-dark">{{ $vigencia->presupuesto_inicial - $vigencia->fonts->sum('valor') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Creación de Fuentes para la Vigencia {{ $vigencia->vigencia }}</h2></center>
            <br><hr>
            <form action="{{url('/presupuesto/font')}}" method="POST">
            {{ csrf_field() }}
                <input type="hidden" id="vigencia_id" name="vigencia_id" value="{{ $vigencia->id }}">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabla">
                        <thead>
                            <th class="text-center">Code</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                        </thead>
                        <tbody>
                            <tr v-for="dato in datos">
                                <th scope="row"><input type="hidden" name="font_id[]" v-model="dato.id"><input type="text" style="text-align:center" name="code[]" v-model="dato.code"></th>
                                <th scope="row"><input type="text" name="nombre[]" style="text-align:center" v-model="dato.name"></th>
                                <th scope="row"><input type="number" name="valor[]" style="text-align:center" v-model="dato.valor" required></th>
                                <td class="text-center"><button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            @for($i=0;$i < $fila ;$i++)
                            <tr >
                                <td><input type="hidden" name="font_id[]"><input type="text" name="code[]"></td>
                                <td><input type="text" name="nombre[]" required></td>
                                <td><input type="number" name="valor[]"  required></td>
                                <td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div><br><center>
            <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Nueva Fila</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </center>
        </form>
    </div>
</div>

@stop


@section('js')
<script>

    $(document).ready(function() {
        $('#tabla').DataTable( {
            responsive: true,
            "searching": false
        } );
    } );

//funcion para borrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#crud',
	created: function(){
		this.getDatos();
	},
	data:{
		datos: []
	},
	methods:{
		getDatos: function(){
			var urlVigencia = '/presupuesto/font/'+{{ $vigencia->id }};
			axios.get(urlVigencia).then(response => {
				this.datos = response.data;
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/presupuesto/font/'+dato;
			axios.delete(urlVigencia).then(response => {
				
					location.reload();
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after('<tr><td><input type="hidden" name="font_id[]"><input type="text" name="code[]"></td><td><input type="text" name="nombre[]" required></td><td><input type="number" name="valor[]" required></td><td class="text-center"><input type="button" class="borrar btn-sm btn-danger" value=" - " /></td></tr>');
		}
	}
});
</script>
@stop