@extends('layouts.dashboard')
@section('titulo')
    Plan de Desarrollo
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Navegación</span>
            &nbsp
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ asset('/pdd') }}" class="btn btn-primary">Plan de Desarrollo</a></li>
            <li><a href="{{ asset('/pdd/data/create/'.$pdd->id) }}" class="btn btn-primary">Ejes y Programas</a></li>
            <li><a href="{{ asset('/pdd/proyecto/create/'.$pdd->id) }}" class="btn btn-primary">Proyectos</a></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
    <center>
        <h2>{{ $pdd->name }}</h2>
    </center>
    <br>
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario" id="ejes">
        <center>
            <h3>Ejes</h3>
        </center>
        <form action="/pdd/eje" method="POST"  class="form">
            {{ csrf_field() }}
            <input type="hidden" name="pdd_id" value="{{ $pdd->id }}">
            <br>
            <table class="table table-bordered" id="tabla_ejes">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"><input type="hidden" name="id[]"><input type="text"  name="nombre[]" required></th>
                    <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                </tr>
                @foreach($pdd->ejes as $dato)
                    <tr style="background-color:#9fcdff">
                        <th scope="row"><input type="hidden" value="{{ $dato->id }}" name="id[]"><input type="text" name="nombre[]" value="{{$dato->name }}" style="text-align:center" required></th>
                        <td class="text-center"><button type="button" class="btn-sm btn-danger borrar" v-on:click.prevent="eliminarDatos({{ $dato->id }})" ><i class="fa fa-trash-o"></i></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <center>
                <button type="button" v-on:click.prevent="nuevaFilaEje" class="btn btn-success">Agregar Fila</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </center>
        </form>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario" id="prog">
        <center>
            <h3>Programas</h3>
        </center>
        <br>
        @if($pdd->ejes->count() > 0)
            <form action="/pdd/programa" method="POST"  class="form">
                {{ csrf_field() }}
                <table id="tabla_programas" class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Eje</th>
                        <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><input type="hidden" name="id[]"><input type="text" name="nombre[]" required></th>
                        <td class="text-center">
                            <select name="eje_id[]" required>
                                @foreach($pdd->ejes as $dato3)
                                    <option value="{{ $dato3->id }}">{{ $dato3->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                    </tr>
                    @foreach($pdd->ejes as $ejes)
                        @foreach($ejes->programas as $dato2)
                            <tr style="background-color:#9fcdff">
                                <th scope="row"><input type="hidden" value="{{ $dato2->id }}" name="id[]"><input type="text" style="text-align:center" name="nombre[]" value="{{ $dato2->name }}" required></th>
                                <td class="text-center">
                                    <select name="eje_id[]" required>
                                        @foreach($pdd->ejes as $dato3)
                                            <option value="{{ $dato3->id }}" @if($dato2->eje_id == $dato3->id) selected @endif>{{ $dato3->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar" v-on:click.prevent="eliminarDatos2({{ $dato2->id }})" ><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table><br>
                <center>
                    <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </center>
            </form>
        @else
            <div class="alert alert-warning">
                <center>
                    <h3 class="text-warning">debes de crear ejes para poder crear programas</h3>
                </center>
            </div>
        @endif
    </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>

    $(document).ready(function() {
        var tableE = $('#tabla_ejes').DataTable( {
            responsive: true,
            "searching": false,
            paging: false
        } );


        $('#tabla_programas').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 3
        } );

    } );
	  	
//funcion para borrar una celda
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
});

new Vue({
	el: '#ejes',
	methods:{
		eliminarDatos: function(dato){
			var urlVigencia = '/pdd/eje/'+dato;
			axios.delete(urlVigencia).then(response => {
                location.reload();
			});
		},

		nuevaFilaEje: function(){
	  		var nivel=parseInt($("#tabla_ejes tr").length);
			$('#tabla_ejes tbody tr:first').before('<tr>\n' +
                '                    <th scope="row"><input type="hidden" name="id[]"><input type="text"  name="nombre[]" required></th>\n' +
                '                    <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp;</button></td>\n' +
                '                </tr>');

		}
    
	}
});

new Vue({
    el: '#prog',
    methods:{
        eliminarDatos2: function(dato2){
            var urlVigencia2 = '/pdd/programa/'+dato2;
            axios.delete(urlVigencia2).then(response => {
                location.reload();
        });
        },

        nuevaFilaPrograma: function(){
            var nivel=parseInt($("#tabla_programas tr").length);
            $('#tabla_programas tbody tr:first').before('<tr>\n' +
                '                        <th><input type="hidden" name="id[]"><input type="text" name="nombre[]" required></th>\n' +
                '                        <td class="text-center">\n' +
                '                            <select name="eje_id[]" required>\n' +
                '                                @foreach($pdd->ejes as $dato3)\n' +
                '                                    <option value="{{ $dato3->id }}">{{ $dato3->name }}</option>\n' +
                '                                @endforeach\n' +
                '                            </select>\n' +
                '                        </td>\n' +
                '                        <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                '                    </tr>');

        }
    }
});

</script>
@stop