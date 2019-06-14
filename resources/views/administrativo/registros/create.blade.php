@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
    <li>
        <a href="{{route('registros.index')}}" class="btn btn-success">
            <span class="hide-menu"> Registros</span></a>
    </li>
    <br>
    <center>
        <h4><b>Dinero en los CDP's</b></h4>
    </center>
    <br>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
            @foreach($cdps as $cdp)
                <tr>
                    <td>{{ $cdp['name'] }}</td>
                    <td>$<?php echo number_format($cdp['saldo'],0) ?></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Registro</h2>
    </div>
</div>
<div class="col-md-12 align-self-center">
    <hr>
    <center>
        <h3>CDP's del Registro</h3>
    </center>
    <hr>
    <br>
    {!! Form::open(array('route' => 'registros.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="table-responsive" id="prog">
        <table id="tabla_rubrosCdp" class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center">Nombre CDP's</th>
                <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">
                    <select name="cdp_id[]" class="form-group-lg" required>
                        @foreach($cdps as $cdp)
                            <option value="{{ $cdp['id'] }}">{{ $cdp['name'] }}</option>
                        @endforeach
                    </select>
                </td>
                <td></td>
            </tr>
            </tbody>
        </table><br>
        <center>
            <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar Otro CDP</button>
        </center>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    <input type="hidden" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
    <input type="hidden" name="secretaria_e" value="0">
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Tercero: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <select class="form-control" name="persona_id">
                    @foreach($personas as $persona)
                        <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Relacionar persona</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Objeto: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                <textarea name="objeto" class="form-control"></textarea>
            </div>
            <small class="form-text text-muted">Nombre del registro</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Tipo de Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                <select name="tipo_doc" class="form-control" onchange="var obj= document.getElementById('tipo_doc_text');if(this.value=='Otro'){obj.style.display='inline'; }else{obj.style.display='none';};">
                    <option value="Contrato">Contrato</option>
                    <option value="Factura">Factura</option>
                    <option value="Resolución">Resolución</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <small class="form-text text-muted">Tipo de Documento</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6" id="tipo_doc_text_3">
            <label>Fecha del Documento</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" class="form-control" name="fecha_tipo_doc" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
            </div>
            <small class="form-text text-muted"> Fecha del Tipo de Documento</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: none" id="tipo_doc_text">
            <label>Cual Otro? </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="tipo_doc_text">
            </div>
            <small class="form-text text-muted"> Cual Otro Tipo de Documento?</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" id="tipo_doc_text_2">
        <label>Número de Documento</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
            <input type="number" class="form-control" name="num_tipo_doc" placeholder="Número de Documento">
        </div>
            <small class="form-text text-muted"> Número del Tipo de Documento</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <label>Subir Archivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="file" name="file" accept="application/pdf" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button type="submit" class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection
@section('js')
    <script>

        var visto = null;

        function ver(num) {
            obj = document.getElementById(num);
            obj.style.display = (obj==visto) ? 'none' : '';
            if (visto != null)
                visto.style.display = 'none';
            visto = (obj==visto) ? null : obj;
        }

        $(document).ready(function() {

            $('#tabla_rubrosCdp').DataTable( {
                responsive: true,
                "searching": false,
                "ordering" : false
            } );

            $('#tabla_rubrosCdpFin').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'pdf' ,'copy', 'csv', 'excel', 'print'
                ]
            } );

            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });

            new Vue({
                el: '#prog',

                methods:{

                    eliminar: function(dato){
                        var urlcdpsRegistro = '/administrativo/cdpsRegistro/'+dato;
                        axios.delete(urlcdpsRegistro).then(response => {
                            location.reload();
                        });
                    },

                    eliminarV: function(dato){
                        var urlCdpRegistrosValor = '/administrativo/cdpsRegistro/valor/'+dato;
                        axios.delete(urlCdpRegistrosValor).then(response => {
                            location.reload();
                        });
                    },

                    nuevaFilaPrograma: function(){
                        var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                        $('#tabla_rubrosCdp tbody tr:last').after('<tr>\n' +
                            '                                <td class="text-center">\n' +
                            '                                    <select name="cdp_id[]" class="form-group-lg" required>\n' +
                            '                                        @foreach($cdps as $cdp)\n' +
                            '                                            <option value="{{ $cdp["id"] }}">{{ $cdp["name"] }}</option>\n' +
                            '                                        @endforeach\n' +
                            '                                    </select>\n' +
                            '                                </td>\n' +
                            '                                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '                            </tr>');

                    }
                }
            });
        } );
    </script>
@stop