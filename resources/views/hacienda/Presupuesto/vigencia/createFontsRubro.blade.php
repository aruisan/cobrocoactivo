@extends('layouts.dashboard')
@section('titulo')
	Asignación de Fuentes al Rubro
@stop
@section('sidebar')
	<li class="dropdown">
		<a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
			<span class="hide-menu">Niveles</span>
			&nbsp;
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
			@foreach($rubro->vigencia->levels as $level)
				<li><a href="/presupuesto/registro/create/{{ $rubro->vigencia->id }}/{{ $level->level }}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
			@endforeach
			<li><a href="/presupuesto/font/create/{{ $rubro->vigencia->id }}" class="btn btn-primary">Fuentes</a></li>
			<li><a href="/presupuesto/rubro/create/{{ $rubro->vigencia->id }}" class="btn btn-primary">Rubros</a></li>
			<li><a href="/presupuesto/level/create/{{ $rubro->vigencia->id }}" class="btn btn-primary">Nuevo Nivel</a></li>
		</ul>
	</li>
	<br>
	<div class="card">
		<br>
		<center>
			<h4><b>Fuentes y su Disponibilidad</b></h4>
		</center>
		<br>
		<div class="table-responsive">
            <table class="table">
                <thead>
                <th>Fuente</th>
                <th>Disponibilidad</th>
                </thead>
                <tbody>
                @foreach($rubro->vigencia->fonts as $font)
                    <tr>
                        <td>{{ $font->name }}</td>
                        <td>$<?php echo number_format($font->valor - $font->fontsRubro->sum('valor'),0) ?></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
		</div>
	</div>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor del Rubro $<?php echo number_format($rubro->fontsRubro->sum('valor'),0) ?></b></h4>
        </center>
        <br>
    </div>
@stop
@section('content')
<div id="content">
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center>
                <h2>Fuentes del Rubro {{ $rubro->name }}</h2>
            </center>
            <br><hr>
        </div>
        <form action="{{url('/presupuesto/FontRubro')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="rubro_id" value="{{ $rubro->id }}">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabla">
                    <thead>
                    <th class="text-center">Fuente</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center"><i class="fa fa-trash-o"></i></th>
                    </thead>
                    <tbody>
                    @foreach($rubro->fontsRubro as $dato)
                        <tr>
                            @if($rubro->vigencia->fonts)
                                <td>
                                    <input type="hidden" name="fontRubro_id[]" value="{{ $dato->id }}">
                                    <select name="font_id[]" class="form-control font">
                                        @foreach($rubro->vigencia->fonts as $font)
                                            <option value="{{ $font->id }}" @if($dato->font_id == $font->id) selected @endif>{{ $font->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @else
                                <td>No existen fuentes en la Vigencia</td>
                            @endif
                                <th scope="row"><input type="number" style="text-align:center" name="valor[]" value="{{ $dato->valor }}" required></th>
                                <td class="text-center" style="vertical-align:middle;"><button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            @endforeach
                            <tr>
                                @if($rubro->vigencia->fonts)
                                <td>
                                    <input type="hidden" name="fontRubro_id[]">
                                    <select name="font_id[]" class="form-control">
                                        @foreach($rubro->vigencia->fonts as $font)
                                            <option value="{{ $font->id }}">{{ $font->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @else
                                    <td>No existen fuentes en la Vigencia</td>
                                @endif
                                <td><input type="number" name="valor[]" required></td>
                                <td class="text-center" style="vertical-align:middle;"><button type="button" class="btn-sm btn-danger borrar"> - </button></td>
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
			var urlVigencia = '/presupuesto/FontRubro/'+dato;
			axios.delete(urlVigencia).then(response => {
				location.reload();
			});
		},

		nuevaFila: function(){
	  		
			$('#tabla tr:last').after('<tr>@if($rubro->vigencia->fonts) <td><input type="hidden" name="fontRubro_id[]"><select name="font_id[]" class="form-control"> @foreach($rubro->vigencia->fonts as $font) <option value="{{ $font->id }}">{{ $font->name }}</option> @endforeach </select></td> @else <td>No existen fuentes en la Vigencia</td> @endif <td><input type="number" name="valor[]" required></td><td class="text-center" style="vertical-align:middle;"><button type="button" class="btn-sm btn-danger borrar"> - </button></td></tr>');
		}
	}
});
</script>
@stop