@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
    {{-- <li>
        <a href="{{route('registros.index')}}" class="btn btn-success">
            <span class="hide-menu"> Registros</span></a>
    </li> --}}
   
@stop
@section('content')
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Nuevo Registro</b></h4>
        </strong>
    </div>
    <ul class="nav nav-pills">
      <li class="nav-item">
            <a class="nav-link regresar"  href="{{url('administrativo/registros') }}">Volver a Registros</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " data-toggle="pill" href="#cdpDisp">Agregar CDP'S </a>
        </li>
       <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#datos">Agregar datos básicos </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#valor">Consultar Dinero CDP'S</a>
        </li>
     
    </ul>

 
<div class="col-lg-12 " style="background-color:white;">
            <div class="tab-content">

                 <div id="cdpDisp" class="tab-pane fade in active">
                        <hr>
                        <center>
                            <h3>CDP's Disponibles</h3>
                        </center>
                        <hr>


                        <br>
                        {!! Form::open(array('route' => 'registros.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                        <div class="table-responsive">
                            <table id="tabla_rubrosCdp" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">CDP's</th>
                                    <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                        <select name="cdp_id[]" class="form-control selectF" required>
                                            @foreach($cdps as $cdp)
                                                <option value="{{ $cdp['id'] }}">{{ $cdp['id'] }} - {{ $cdp['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table><br>
                            <center>
                                <div id="prog">
                                    <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar Otro CDP</button>
                                </div>
                            </center>
                            </div>
                      </div>
           
            <div class="tab-pane" id="datos" >
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2" >
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

                        </div>

                          <div class="tab-pane" id="valor" style="background-color:white;">
                             <br>
                                <center>
                                    <h4><b>Dinero en los CDP's</b></h4>
                                </center>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Dinero</th>
                                        </tr    >
                                        @foreach($cdps as $cdp)
                                            <tr class="text-center">
                                                <td>{{ $cdp['id'] }} - {{ $cdp['name'] }}</td>
                                                <td>$<?php echo number_format($cdp['saldo'],0) ?></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                          </div>
    </div>
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

            new Vue({
                el: '#prog',

                methods:{

                    nuevaFilaPrograma: function(){
                        $('#tabla_rubrosCdp tbody tr:last').after('<tr>\n' +
                            '                <td class="text-center">\n' +
                            '                    <select name="cdp_id[]" class="form-control selectF" required>\n' +
                            '                        @foreach($cdps as $cdp)\n' +
                            '                            <option value="{{ $cdp["id"] }}">{{ $cdp["id"] }} - {{ $cdp["name"] }}</option>\n' +
                            '                        @endforeach\n' +
                            '                    </select>\n' +
                            '                </td>\n' +
                            '                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '            </tr>');

                    }
                }
            });

            $('.selectF').select2();

            $('#tabla_rubrosCdp').DataTable( {
                responsive: true,
                "searching": false,
                "ordering" : false
            } );


            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });

        } );
    </script>
@stop