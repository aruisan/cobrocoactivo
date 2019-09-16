@extends('layouts.dashboard')
@section('titulo')
    Registro
@stop
@section('sidebar')
  <li>
      <a href="{{route('registros.index')}}" class="btn btn-success">
          <span class="hide-menu"> Registros</span></a>
  </li>
  <br>
  <div class="card">
      <br>
      <center>
          <h4><b>Valor del Registro</b></h4>
          <h5>Obtenido de los CDP</h5>
      </center>
      <div class="text-center">
          $<?php echo number_format($registro->valor,0) ?>
      </div>
      <br>
      <center>
          <h4><b>IVA del Registro</b></h4>
      </center>
      <div class="text-center">
          $<?php echo number_format($registro->iva,0) ?>
      </div>
      <br>
      <center>
          <h4><b>Valor Total del Registro</b></h4>
          <h5>Valor Registro + Valor IVA</h5>
      </center>
      <div class="text-center">
          $<?php echo number_format($registro->saldo,0) ?>
      </div>
      <br>
      @if($registro->secretaria_e != 3)
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
      @endif
  </div>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h3 class="text-center">{{ $registro->objeto }}</h3>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <hr>
    <div class="form-validation">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Tercero: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                    {{ $registro->persona->nombre }}
                </div>
                <small class="form-text text-muted">Persona asignada al registro</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Tipo de Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                    {{ $registro->tipo_doc }}
                </div>
                <small class="form-text text-muted">Tipo de Documento del registro</small>
            </div>
        </div>
        @if( $registro->tipo_doc == "Contrato" or $registro->tipo_doc == "Factura" or $registro->tipo_doc == "Resolución")
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Número de Documento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        {{ $registro->num_doc }}
                    </div>
                    <small class="form-text text-muted">Número del Documento</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Fecha del Documento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        {{ $registro->ff_doc }}
                    </div>
                    <small class="form-text text-muted">Fecha del Documento</small>
                </div>
            </div>
        @endif
        <div class="row">
            @if($registro->observacion == "" or $registro->jcontratacion_e == 0)
                @else
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Observación del Rechazo </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                        <textarea disabled class="form-control">{{ $registro->observacion }}</textarea>
                    </div>
                    <small class="form-text text-muted">Observación del rechazo del registro.</small>
                </div>
                @endif
        </div>
    </div>
</div>
<div class="col-md-12 align-self-center">
    <hr>
    <center>
        <h3>CDP's del Registro</h3>
    </center>
    <hr>
    <br>
    <div class="table-responsive" id="prog">
        @if($registro->cdpsRegistro->count() == 0 )
            @if($rol == 2)
                <div class="col-md-12 align-self-center">
                    <div class="alert alert-danger text-center">
                        El registro no tiene cdps asigandos. Desea borrar el registro? &nbsp;
                        {!! Form::open(['method' => 'DELETE','route' => ['registros.destroy', $registro->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-sm btn-danger">
                            Borrar Registro
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                @else
                <div class="col-md-12 align-self-center">
                    <div class="alert alert-danger text-center">El registro no tiene CDP's asigandos.</div>
                </div>
            @endif
        @else
        @endif
            @if($registro->cdpsRegistro->count() == 0 and $rol == 3)
            @else
                <form class="form" action="{{url('/administrativo/cdpsRegistro')}}" method="POST" class="form">
                    {{ csrf_field() }}
                    <table id="tabla_rubrosCdp" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th scope="col" class="text-center">Nombre CDP's</th>
                            <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($registro->cdpsRegistro->count() == 0)
                            <tr>
                                <td>&nbsp;</td>
                                <td class="text-center">
                                    <input type="hidden" name="registro_id" value="{{ $registro->id }}">
                                    <select name="cdp_id[]" class="form-group-lg" required>
                                        @foreach($cdps as $cdp)
                                            <option value="{{ $cdp['id'] }}">{{ $cdp['id'] }} - {{ $cdp['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                            </tr>
                        @endif
                        @for($i = 0; $i < $registro->cdpsRegistro->count(); $i++)
                            @php($cdpsRegistroData = $registro->cdpsRegistro[$i] )
                            <tr>
                                <td class="text-center">
                                    <button type="button" class="btn-sm btn-success" onclick="ver('fuente{{$i}}')" ><i class="fa fa-arrow-down"></i></button>
                                </td>
                                <td class="text-center">
                                    <div class="col-lg-6">
                                        <h4>
                                            <b>CDP : {{ $cdpsRegistroData->cdp->name }}</b>
                                        </h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4>
                                            Disponible:
                                            <b>$<?php echo number_format($cdpsRegistroData->cdp->saldo,0) ?></b>
                                        </h4>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($cdpsRegistroData->cdpRegistroValor->count() == 0)
                                        <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminar({{ $cdpsRegistroData->id }})" ><i class="fa fa-trash-o"></i></button>
                                    @endif
                                </td>
                            </tr>
                            <tr id="fuente{{$i}}" style="display: none">
                                <td style="vertical-align: middle">
                                    <b>Rubros del CDP</b>
                                </td>
                                <td>
                                    <div class="col-lg-12">
                                        @foreach($cdpsRegistroData->cdp->rubrosCdpValor as $RCV)
                                            @if($RCV->valor_disp != 0)
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="registro_id" value="{{ $registro->id }}">
                                                    <input type="hidden" name="fuente_id[]" value="{{ $RCV->fontsRubro->id }}">
                                                    <input type="hidden" name="cdp_id_s[]" value="{{ $RCV->cdp_id }}">
                                                    <input type="hidden" name="rubro_id[]" value="{{ $RCV->fontsRubro->rubro->id }}">
                                                    <input type="hidden" name="rubros_cdp_id[]" value="{{ $cdpsRegistroData->id }}">
                                                    @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                                                    <li style="list-style-type: none;">
                                                        Dinero Disponible del Rubro {{ $RCV->fontsRubro->rubro->name }} :
                                                        $<?php echo number_format( $RCV->valor_disp,0) ?>
                                                    </li>
                                                </div>
                                            @endif
                                            <div class="col-lg-6">
                                                @if($registro->secretaria_e == "3")
                                                    Valor Usado del Rubro {{ $RCV->fontsRubro->rubro->name }}:
                                                    @if($cdpsRegistroData->cdpRegistroValor->count() != 0)
                                                        @foreach($RCV->fontsRubro->cdpRegistrosValor as  $valoresRV)
                                                            @php($id_rubrosCdp = $cdpsRegistroData->id )
                                                            @if($valoresRV->registro_id == $registro->id)
                                                                @if($cdpsRegistroData->cdp->id == $valoresRV->cdp_id and $RCV->fontsRubro->rubro->id == $valoresRV->rubro_id)
                                                                    <input type="hidden" name="rubros_cdp_valor_id[]" value="{{ $valoresRV->id }}">
                                                                    @if($registro->secretaria_e == "0")
                                                                        <input type="number" required  name="valorFuenteUsar[]" id="id{{$RCV->font_id}}" class="valor{{ $valoresRV->cdps_registro_id }}" value="{{ $valoresRV->valor }}" max="{{ $cdpsRegistroData->cdp->saldo }}" style="text-align: center">
                                                                    @else
                                                                        $<?php echo number_format( $valoresRV->valor,0) ?>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if($registro->cdpRegistroValor->count() == 0)
                                                            <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                            <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $cdpsRegistroData->cdp->saldo }}" style="text-align: center">
                                                        @endif
                                                    @else
                                                        <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                        <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{  $cdpsRegistroData->cdp->saldo }}" style="text-align: center">
                                                    @endif
                                                @elseif($RCV->valor_disp > 0)
                                                    Valor Usado del Rubro {{ $RCV->fontsRubro->rubro->name }}:
                                                    @if($cdpsRegistroData->cdpRegistroValor->count() != 0 )
                                                        @foreach($RCV->fontsRubro->cdpRegistrosValor as  $valoresRV)
                                                            @php($id_rubrosCdp = $cdpsRegistroData->id )
                                                            @if($valoresRV->registro_id == $registro->id)
                                                                @if($cdpsRegistroData->cdp->id == $valoresRV->cdp_id and $RCV->fontsRubro->rubro->id == $valoresRV->rubro_id)
                                                                    <input type="hidden" name="rubros_cdp_valor_id[]" value="{{ $valoresRV->id }}">
                                                                    @if($registro->secretaria_e == "0")
                                                                        <input type="number" required  name="valorFuenteUsar[]" id="id{{$RCV->font_id}}" class="valor{{ $valoresRV->cdps_registro_id }}" value="{{ $valoresRV->valor }}" max="{{ $cdpsRegistroData->cdp->saldo }}" style="text-align: center">
                                                                    @else
                                                                        $<?php echo number_format( $valoresRV->valor,0) ?>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if($registro->cdpRegistroValor->count() == 0)
                                                            <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                            <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $cdpsRegistroData->cdp->saldo }}" min="0" style="text-align: center">
                                                        @endif
                                                    @else
                                                        <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                        <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $cdpsRegistroData->cdp->saldo }}" min="0" style="text-align: center">
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center">
                                    <b>Valor Total</b>
                                    <br>
                                    <b>
                                        @if($cdpsRegistroData->cdpRegistroValor->count() > 0)
                                            $<?php echo number_format( $cdpsRegistroData->cdpRegistroValor->sum('valor') ,0) ?>
                                        @else
                                            $0.00
                                        @endif
                                    </b>
                                    <br>
                                    &nbsp;
                                    <br>
                                    @if($rol == 2 and $registro->secretaria_e != 3)
                                        @if($cdpsRegistroData->cdpRegistroValor->count() > 0)
                                            <b>Liberar Dinero</b>
                                            <br>
                                            <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarV({{ $cdpsRegistroData->cdpRegistroValor->first()->cdps_registro_id }})" ><i class="fa fa-money"></i></button>
                                        @else
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                        @endfor
                        </tbody>
                    </table>
                    @if($registro->secretaria_e != 3)
                    <center>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <label>IVA: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control" id="iva" name="iva" value="{{ $registro->iva }}" required min="0" style="text-align: center">
                                </div>
                                <small class="form-text text-muted">Valor del iva con el que se va a regir el registro</small>
                            </div>
                        </div>
                    </center>
                    @endif
                    <br>
                    <center>
                        @if($rol == 2 and $registro->secretaria_e != 3)
                            @if($registro->cdpsRegistro->count() == 0)
                            <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                            @endif
                            <button type="submit" class="btn btn-primary">Actualizar Registro</button>
                            @if($registro->cdpRegistroValor->sum('valor') > 0 )
                                @php($valTot = $registro->iva + $registro->cdpRegistroValor->sum('valor'))
                                <a href="{{url('/administrativo/registros/'.$registro->id.'/'.$fechaActual.'/'.$registro->cdpRegistroValor->sum('valor').'/3/'.$valTot)}}" type="submit" class="btn btn-success">
                                    Finalizar Registro
                                </a>
                            @endif
                        @endif
                    </center>
                </form>
            @endif
    </div>
</div>
@include('modal.observacion')
@stop
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
                            '                                <td>&nbsp;</td>\n' +
                            '                                <td class="text-center">\n' +
                            '                                    <input type="hidden" name="registro_id" value="{{ $registro->id }}">\n' +
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