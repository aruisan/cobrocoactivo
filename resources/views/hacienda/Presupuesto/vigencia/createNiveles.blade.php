@extends('layouts.presupuesto')
@section('contenido')

        <div class="container-fluid" id="crud">
			<div class="row">
                <div class="col-10">
                    <div class="card">
                        <form action="{{ url('/level') }}" method="POST"  class="form">
                                @csrf
                                <input type="hidden" class="form-control" id="vigencia_id" name="vigencia_id" value="{{ $vigencia->id }}">
                                <table class="table" id="tabla">
                                    <center><h2>Creacion de Niveles para la Vigencia {{ $vigencia->vigencia }}</h2></center><br><br>
                                    <thead>
                                        <th class="text-center">Nivel</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Cifras</th>
                                        <th class="text-center">Filas</th>
                                        <th class="text-center"><i class="fa fa-trash-o"></i></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="dato in datos" class="table-primary">
                                            <td><input type="hidden" name="level_id[]" v-model="dato.id"><input type="text" name="nivel[]" v-model="dato.level"></td>
                                            <td><input type="text" class="form-control" name="nombre[]" v-model="dato.name" required></td>
                                            <td><input type="number" class="form-control" name="cifra[]" v-model="dato.cifras" required></td>
                                            <td><input type="number" class="form-control" name="fila[]" v-model="dato.rows" required></td>
                                            <td><button type="button" class="btn btn-danger" v-on:click.prevent="eliminarDatos(dato.id)" ><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                        @for($i=0;$i < $fila ;$i++)
                                        <tr >
                                            <td><input type="hidden" name="level_id[]"><input type="text" name="nivel[]"></td>
                                            <td><input type="text" class="form-control" name="nombre[]" required></td>
                                            <td><input type="number" class="form-control" name="cifra[]" required></td>
                                            <td><input type="number" class="form-control" name="fila[]"  required></td>
                                            <td><input type="button" value="-" class="btn btn-danger borrar"/></td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table><br>
                            <center>
                                <button type="button" v-on:click.prevent="nuevaFila" class="btn btn-success">Agregar Fila</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </center>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    <br>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Niveles
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($niveles as $level)
                                <li><a href="/registro/create/{{ $level->vigencia_id }}/{{ $level->level }}">Nivel {{ $level->level }}</a></li>
                            @endforeach
                                <li><a href="/font/create/{{ $vigencia->id }}">Fuentes</a></li>
                                <li><a href="/rubro/create/{{ $vigencia->id }}">Rubros</a></li>
                                <li class="active">Nuevo Nivel</li>
                        </ul>
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
		this.getDatos();
	},
	data:{
		datos: []
	},
	methods:{
		getDatos: function(){
			var vigencia = $('#vigencia_id').val();
			var urlVigencia = '/level/'+vigencia;
			axios.get(urlVigencia).then(response => {
				this.datos = response.data;
			});
		},

		eliminarDatos: function(dato){
			var urlVigencia = '/level/'+dato;
			axios.delete(urlVigencia).then(response => {
				this.getDatos();
				toastr.success('Eliminado correctamente');
			});
		},

		nuevaFila: function(){
	  		var nivel=parseInt($("#tabla tr").length);
			$('#tabla tr:last').after('<tr><td><input type="hidden" name="level_id[]"><input type="text" name="nivel[]"></td><td><input type="text" class="form-control" name="nombre[]" required></td><td><input type="number" class="form-control" name="cifra[]" required></td><td><input type="number" class="form-control" name="fila[]" required></td><td><input type="button" class="borrar btn btn-danger" value="-" /></td></tr>');

		}
	}
});
</script>
@stop