@extends('layouts.dashboard')
@section('titulo')
    Registro
@stop
@section('sidebar')
  @include('administrativo.registros.cuerpo.aside')
  <br>
  <div class="card">
      <br>
      <center>
          <h4><b>Valor del Registro</b></h4>
      </center>
      <div class="text-center">
              $0.00
      </div>
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
                      <td>$<?php echo number_format($cdp['valor'],0) ?></td>
                  </tr>
              @endforeach
              </tbody>
          </table>
      </div>
  </div>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h3 class="text-center"> Registro: {{ $registro->objeto }}</h3>
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
                <label>Contrato: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                    {{ $registro->contrato->asunto }}
                </div>
                <small class="form-text text-muted">Contrato al que pertenece el registro</small>
            </div>
        </div>
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
        @endif
            <form class="form" action="{{url('/administrativo/cdpsRegistro')}}" method="POST" class="form">
                {{ csrf_field() }}
                <table id="tabla_rubrosCdp" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th scope="col" class="text-center">CDP's</th>
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
                                        <option value="{{ $cdp['id'] }}">{{ $cdp['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                        </tr>
                    @endif
                    @for($i = 0; $i < $registro->cdpsRegistro->count(); $i++)
                        @php($cdpsRegistroData = $registro->cdpsRegistro[$i] )
                        {{ dd($cdpsRegistroData->cdp->rubrosCdpValor) }}
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn-sm btn-success" onclick="ver('fuente{{$i}}')" ><i class="fa fa-arrow-down"></i></button>
                            </td>
                            <td class="text-center">
                                <div class="col-lg-6">
                                    <h4>
                                        <b>{{ $cdpsRegistroData->cdp->name }}</b>
                                    </h4>
                                </div>
                                <div class="col-lg-6">
                                    @php( $valorT = $cdpsRegistroData->cdpsRegistroValor->sum('valor') )
                                    <h4>
                                        <b>
                                            Valor:
                                            @if($cdpsRegistroData->cdpsRegistroValor->count() > 0)
                                                $<?php echo number_format( $cdpsRegistroData->cdpsRegistroValor->sum('valor') ,0) ?>
                                            @else
                                                $0.00
                                            @endif
                                        </b>
                                    </h4>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($cdpsRegistroData->cdpsRegistroValor->count() == 0)
                                    <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminar({{ $cdpsRegistroData->id }})" ><i class="fa fa-trash-o"></i></button>
                                @endif
                            </td>
                        </tr>
                        @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                        <tr id="fuente{{$i}}" style="display: none">
                            <td style="vertical-align: middle">
                                <b>Fuentes del CDP {{ $cdpsRegistroData->cdp->name }}</b>
                            </td>
                            <td>
                                <div class="col-lg-12">
                                    @foreach($rubrosCdpData->rubros->fontsRubro as $fuentesRubro)
                                        @if($fuentesRubro->valor_disp != 0)
                                            <div class="col-lg-6">
                                                <input type="hidden" name="fuente_id[]" value="{{ $fuentesRubro->id }}">
                                                <input type="hidden" name="cdp_id" value="{{ $cdp->id }}">
                                                <input type="hidden" name="rubros_cdp_id[]" value="{{ $rubrosCdpData->id }}">
                                                <li style="list-style-type: none;">
                                                    {{ $fuentesRubro->font->name }} : $<?php echo number_format( $fuentesRubro->valor_disp,0) ?>
                                                </li>
                                            </div>
                                        @endif
                                        <div class="col-lg-6">
                                            @if($fuentesRubro->valor_disp != 0)
                                                Valor usado de {{ $fuentesRubro->font->name }}:
                                                @if($fuentesRubro->rubrosCdpValor->count() != 0)
                                                    @foreach($fuentesRubro->rubrosCdpValor as  $valoresFR)
                                                        @php($id_rubrosCdp = $rubrosCdpData->id )
                                                        @if($valoresFR->cdp_id == $cdp->id)
                                                            <input type="hidden" name="rubros_cdp_valor_id[]" value="{{ $valoresFR->id }}">
                                                            @if($cdp->secretaria_e == "0")
                                                                <input type="number" required  name="valorFuenteUsar[]" id="id{{$fuentesRubro->font_id}}" class="valor{{ $valoresFR->rubrosCdp_id }}" value="{{ $valoresFR->valor }}" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                            @else
                                                                $<?php echo number_format( $valoresFR->valor,0) ?>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if($cdp->rubrosCdpValor->count() == 0)
                                                        <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                        <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                    @endif
                                                @else
                                                    <input type="hidden" name="rubros_cdp_valor_id[]" value="">
                                                    <input type="number" required  name="valorFuenteUsar[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
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
                                    @if($rubrosCdpData->rubrosCdpValor->count() > 0)
                                        $<?php echo number_format( $rubrosCdpData->rubrosCdpValor->sum('valor') ,0) ?>
                                    @else
                                        $0.00
                                    @endif
                                </b>
                                <br>
                                &nbsp;
                                <br>

                                @if($cdp->jefe_e != "3")
                                    @if($rol == 2)
                                        @if($rubrosCdpData->rubrosCdpValor->count() > 0)
                                            <b>Liberar Dinero</b>
                                            <br>
                                            <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarV({{ $rubrosCdpData->rubrosCdpValor->first()->rubrosCdp_id }})" ><i class="fa fa-money"></i></button>
                                        @else
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table><br>
                <center>
                    @if($rol == 2)
                        <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                        <button type="submit" class="btn btn-primary">Guardar Rubros</button>
                        @if($registro->cdpsRegistro->count() > 0 )
                            <a href="{{url('/administrativo/cdp/'.$cdp->id.'/'.$rol.'/'.$fechaActual.'/'.$cdp->rubrosCdpValor->sum('valor_disp').'/3')}}" class="btn btn-success">
                                Enviar CDP
                            </a>
                        @endif
                    @elseif($rol == 3)
                        @if($cdp->rubrosCdp->count() > 0 )
                            <a href="{{url('/administrativo/cdp/'.$cdp->id.'/'.$rol.'/'.$fechaActual.'/'.$cdp->rubrosCdpValor->sum('valor_disp').'/3')}}" class="btn btn-success">
                                Finalizar CDP
                            </a>
                            <a data-toggle="modal" data-target="#observacionCDP" class="btn btn-danger">
                                Rechazar
                            </a>
                        @endif
                    @endif
                </center>
            </form>
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
        alert(prueba);
        }

        $(document).ready(function() {

            $('#tabla_rubrosCdp').DataTable( {
                responsive: true,
                "searching": false,
                "ordering" : false
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
                        var urlcdpsRegistroValor = '/administrativo/cdpsRegistro/valor/'+dato;
                        axios.delete(urlcdpsRegistroValor).then(response => {
                            location.reload();
                    });
                    },

                    nuevaFilaPrograma: function(){
                        var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                        $('#tabla_rubrosCdp tbody tr:first').before('<tr>\n' +
                            '                            <td>&nbsp;</td>\n' +
                            '                            <td class="text-center">\n' +
                            '                                <input type="hidden" name="registro_id" value="{{ $registro->id }}">\n' +
                            '                                <select name="cdp_id[]" class="form-group-lg" required>\n' +
                            '                                    @foreach($cdps as $cdp)\n' +
                            '                                        <option value="{{ $cdp['id'] }}">{{ $cdp['name'] }}</option>\n' +
                            '                                    @endforeach\n' +
                            '                                </select>\n' +
                            '                            </td>\n' +
                            '                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '                        </tr>');

                    }
                }
            });
        } );
    </script>
@stop