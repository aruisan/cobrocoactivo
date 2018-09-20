@extends('layouts.dashboard')
@section('titulo')
    Proyectos Pdd
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
    <div class="col-md-12 align-self-center" id="proyectos">
    <center>
        <h2>Proyectos de {{ $pdd->name }}</h2>
    </center>
        <br>
        @if($count > 0)
            <form action="/pdd/proyecto" method="POST" class="form">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" id="vigencia_id" name="vigencia_id" value="{{ $pdd->id }}">
                <div class="table-responsive">
                    <table id="tabla_proyectos" class="table table-bordered">
                        <thead>
                        <th class="text-center">Num Proyecto</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Línea Base</th>
                        <th class="text-center">Indicador</th>
                        <th class="text-center">Meta Inicial Resultado</th>
                        <th class="text-center">Programa</th>
                        <th class="text-center"><i class="fa fa-trash-o"></i></th>
                        <th class="text-center"><i class="fa fa-bars"></i></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" name="code[]">
                            </td>
                            <td>
                                <input type="hidden" name="id[]">
                                <input type="text" name="nombre[]" required>
                            </td>
                            <td><input type="number" name="linea_base[]" required></td>
                            <td><input type="text" name="indicador[]" required></td>
                            <td><input type="number" name="metaInicial[]" required></td>
                            <input type="hidden" value="0" name="modificacion[]">
                            <input type="hidden" value="0" name="metaDefinitiva[]">
                            <td>
                                <select name="programa_id[]">
                                    @foreach($pdd->ejes as $ejes)
                                        @foreach($ejes->programas as $programa)
                                            <option value="{{ $programa->id }}">{{$programa->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center"><button type="button" class="btn-sn btn-danger borrar">&nbsp; - &nbsp;</button></td>
                            <td></td>
                        </tr>
                            @foreach($pdd->ejes as $ejes)
                                @foreach($ejes->programas as $programas)
                                    @foreach($programas->proyectos as $proyecto)
                                        <tr>
                                            <td>
                                                <input style="text-align:center" type="text" value="{{ $proyecto->code }}"  name="code[]">
                                            </td>
                                            <td>
                                                <input style="text-align:center" type="hidden" value="{{ $proyecto->id }}" name="id[]">
                                                <input style="text-align:center" type="text" name="nombre[]" value="{{ $proyecto->name }}" required>
                                            </td>
                                            <td><input style="text-align:center" type="number" name="linea_base[]" value="{{ $proyecto->linea_base }}" required></td>
                                            <td><input style="text-align:center" type="text" name="indicador[]" value="{{ $proyecto->indicador }}" required></td>
                                            <td><input style="text-align:center" type="number" name="metaInicial[]" value="{{ $proyecto->metaInicial }}" required></td>
                                            <td>
                                                <select name="programa_id[]">
                                                    @foreach($pdd->ejes as $ejes)
                                                        @foreach($ejes->programas as $programa)
                                                            <option value="{{ $programa->id }}" @if($programa->id == $proyecto->programa_id) selected @endif>{{$programa->name}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-sm btn-danger borrar" v-on:click.prevent="eliminarDatos({{ $proyecto->id }})" >
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                            <td style="vertical-align:middle;">
                                                <a class="btn-sm btn-primary" href="{{ asset('/pdd/proyecto/'.$proyecto->id) }}">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <br>
                <center>
                    <button type="button" v-on:click.prevent="nuevaFilaProyecto" class="btn btn-success">Agregar Fila</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </center>
            </form>
        @else
            <div class="alert alert-warning">
                <center>
                    <h3 class="text-warning">
                        debes de crear programas para poder crear proyectos<a href="{{ asset('/pdd/data/create/'.$pdd->id) }}">ir a Programas</a> </h3>
                </center>
            </div>
        @endif
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>

    $(document).ready(function() {
        $('#tabla_proyectos').DataTable( {
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
    el: '#proyectos',
    methods:{

        eliminarDatos: function(dato){
            var urlVigencia = '/pdd/proyecto/'+dato;
            axios.delete(urlVigencia).then(response => {
               location.reload();
        });
        },

        nuevaFilaProyecto: function(){
            var nivel=parseInt($("#tabla_proyectos tr").length);
            $('#tabla_proyectos tbody tr:first').before('<tr>\n' +
                '                                   <td>\n' +
                '                                       <input type="text"  name="code[]">\n' +
                '                                   </td>\n' +
                '                                   <td>\n' +
                '                                       <input type="hidden" name="id[]">\n' +
                '                                       <input type="text" name="nombre[]" required>\n' +
                '                                   </td>\n' +
                '                                   <td><input type="number" name="linea_base[]" required></td>\n' +
                '                                   <td><input type="text" name="indicador[]" required></td>\n' +
                '                                   <td><input type="number" name="metaInicial[]" required></td>\n' +
                '                                   <input type="hidden" value="0" name="modificacion[]" required>\n' +
                '                                   <input type="hidden" value="0" name="metaDefinitiva[]" required>\n' +
                '                                   <td>\n' +
                '                                       <select name="programa_id[]">\n' +
                '                                       @foreach($pdd->ejes as $ejes)\n' +
                '                                           @foreach($ejes->programas as $programa)\n' +
                '                                                   <option value="{{ $programa->id }}">{{$programa->name}}</option>\n' +
                '                                           @endforeach\n' +
                '                                       @endforeach\n' +
                '                                       </select>\n' +
                '                                   </td>\n' +
                '                                   <td class="text-center"><button type="button" class="btn-sn btn-danger borrar">&nbsp; - &nbsp;</button></td>' +
                '                                   <td></td>\n' +
                '                               </tr>');
        }
    }
});


</script>
@stop