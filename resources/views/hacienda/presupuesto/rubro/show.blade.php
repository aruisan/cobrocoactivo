@extends('layouts.dashboard')
@section('titulo')
    Información del Rubro
@stop
@section('sidebar')
    <li> <a href="{{ url('/presupuesto') }}" class="btn btn-success"><i class="fa fa-money"></i><span class="hide-menu">&nbsp; Presupuesto</span></a></li>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor Total del Rubro</b></h4>
        </center>
        <div class="text-center">
            $ <?php echo number_format($valor,0);?>.00
        </div>
        <br>
            <center>
                <h4><b>Valor Disponible del Rubro</b></h4>
            </center>
        <div class="text-center">
            $ <?php echo number_format($valorDisp,0);?>.00
        </div>
        <br>
    </div>
    @if( $rol == 2)
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown">
            ACCIONES
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a data-toggle="modal" data-target="#adicion" class="btn btn-primary text-left">Adición</a>
            </li>
            <li>
                <a data-toggle="modal" data-target="#reduccion" class="btn btn-primary text-left">Reducción</a>
            </li>
            <li>
                <a data-toggle="modal" data-target="#credito" class="btn btn-primary text-left">Credito</a>
            </li>
        </ul>
    </li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center formularioRubro">
        <div class="row justify-content-center">
            <center><h2>{{ $rubro->name }}</h2></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Nombre:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $rubro->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Codigo Rubro:</label>
                            <div class="col-lg-6">
                                <input type="number" disabled class="form-control" style="text-align:center" name="valor" value="{{ $rubro->cod }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Subproyecto:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $rubro->SubProyecto->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Vigencia:</label>
                            <div class="col-lg-6">
                                <input type="number" disabled class="form-control" style="text-align:center" name="valor" value="{{ $rubro->vigencia->vigencia }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center formularioRubro">
        <hr>
        <center>
            <h3>Fuentes del Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaFuentesR">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Valor Inicial</th>
                    <th class="text-center">Valor Disponible</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fuentesR as  $fuentes)
                    <tr>
                        <td>{{ $fuentes->font->code }}</td>
                        <td>{{ $fuentes->font->name }}</td>
                        <td class="text-center">$ <?php echo number_format($fuentes['valor'],0);?>.00</td>
                        <td class="text-center">$ <?php echo number_format($fuentes['valor_disp'],0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="col-md-12 align-self-center formularioRubro" style="background-color: white">
        <br>
        <hr>
        <center>
            <h3>CDP's Asignados al Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaCDPs">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Estado Actual</th>
                    <th class="text-center">Valor Inicial</th>
                    <th class="text-center">Valor Disponible</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rubro->rubrosCdp as  $data)
                    <tr class="text-center">
                        <td><a href="{{ url('administrativo/cdp/'.$data->cdps->id) }}">{{ $data->cdps->id }}</a></td>
                        <td>{{ $data->cdps->name }}</td>
                        <td>
                            <span class="badge badge-pill badge-danger">
                                @if( $data->cdps->jefe_e == "0")
                                    Pendiente
                                @elseif( $data->cdps->jefe_e == "1")
                                    Rechazado
                                @elseif( $data->cdps->jefe_e == "2")
                                    Anulado
                                @elseif( $data->cdps->jefe_e == "3")
                                    Aprobado
                                @else
                                    En Espera
                                @endif
                                    </span>
                        </td>
                        <td>$ <?php echo number_format($data->cdps->valor,0);?>.00</td>
                        <td>$ <?php echo number_format( $data->cdps->saldo,0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="col-md-12 align-self-center formularioRubro" style="background-color: white">
        <br>
        <hr>
        <center>
            <h3>Registros Asignados al Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaRegistros">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Valor Inicial</th>
                    <th class="text-center">Valor Disponible</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rubro->cdpRegistroValor as  $data2)
                    <tr class="text-center">
                        <td><a href="{{ url('administrativo/registros/'.$data2->registro_id) }}">{{ $data2->registro_id }}</a></td>
                        <td>{{ $data2->registro->objeto }}</td>
                        <td>$ <?php echo number_format($data2->valor,0);?>.00</td>
                        <td>$ <?php echo number_format( $data2->valor_disp,0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 align-self-center formularioRubro" style="background-color: white">
        <hr>
        <center>
            <h3>Movimientos del Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaMovimientos">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre Fuente</th>
                    <th class="text-center">Valor Inicial</th>
                    <th class="text-center">Adición</th>
                    <th class="text-center">Reducción</th>
                    <th class="text-center">Credito</th>
                    <th class="text-center">Contra Credito</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fuentesR as $fuentes)
                    <tr>
                        <td>{{ $fuentes->id }}</td>
                        <td>{{ $fuentes->font->name }}</td>
                        <td class="text-center">$ <?php echo number_format($fuentes['valor'],0);?>.00</td>
                        <td class="text-center">
                            @foreach($valores as $valAdd)
                                @if($fuentes->font_id == $valAdd['id'])
                                    $ <?php echo number_format($valAdd['adicion'],0);?>.00
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach($valores as $valAdd)
                                @if($fuentes->font_id == $valAdd['id'])
                                    $ <?php echo number_format($valAdd['reduccion'],0);?>.00
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach($valores as $valAdd)
                                @if($fuentes->font_id == $valAdd['id'])
                                    $ <?php echo number_format($valAdd['credito'],0);?>.00
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach($valores as $valAdd)
                                @if($fuentes->font_id == $valAdd['id'])
                                    $ <?php echo number_format($valAdd['ccredito'],0);?>.00
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        @if($files != 0)
            <center>
                <h3>Archivios Correspondientes a los Movimientos del Rubro</h3>
            </center>
            <hr>
            <br>
            <div class="input-group">
                <div class="row text-center">
                    @foreach($files as $file)
                        @if($file['mov'] == 1)
                            <a href="{{Storage::url($file['ruta'])}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp; Credito y Contracredito</a>
                        @elseif($file['mov'] == 2)
                            <a href="{{Storage::url($file['ruta'])}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o">&nbsp; Adición</i></a>
                        @elseif($file['mov'] == 3)
                            <a href="{{Storage::url($file['ruta'])}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o">&nbsp; Reducción</i></a>
                        @endif

                    @endforeach
                </div>
            </div>
        @endif
    </div>
    @include('modal.adicionRubro')
    @include('modal.reduccionRubro')
    @include('modal.creditoRubro')
    @stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="{{ asset('/js/datatableRubro.js') }}"></script>
    <script>
       
        var visto = null;
        function ver(num) {
            obj = document.getElementById(num);
            obj.style.display = (obj==visto) ? 'none' : '';
            if (visto != null)
                visto.style.display = 'none';
            visto = (obj==visto) ? null : obj;
        }

        new Vue({
            el: '#add',

            methods:{

                eliminar: function(dato){
                    var urlrubrosCdp = '/administrativo/rubrosCdp/'+dato;
                    axios.delete(urlrubrosCdp).then(response => {
                        location.reload();
                });
                },

                eliminarV: function(dato){
                    var urlrubrosCdpValor = '/administrativo/rubrosCdp/valor/'+dato;
                    axios.delete(urlrubrosCdpValor).then(response => {
                        location.reload();
                });
                },
            },
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
                    var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                    $('#tabla_rubrosCdp tbody tr:first').before('<td>\n' +
                        '                                  <div class="col-lg-12">\n' +
                        '                                      @foreach($fuentesR as $fuentesRubro)\n' +
                '                                                  <input type="hidden" name="rubro_Mov_id[]" value="{{ $fuentesRubro->id }}">\n' +
                '                                                  <input type="number" required  name="valorRed{{ $fuentesRubro->id }}[]" class="form-group-sm" value="0" style="text-align: center">\n' +
                        '                                      @endforeach\n' +
                        '                                  </div>\n' +
                        '                              </td>');

                }
            }
        });
    </script>
@stop
