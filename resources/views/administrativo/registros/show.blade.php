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
          $<?php echo number_format($registro->cdpsRegistro->sum('valor'),0) ?>
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
    @if($registro->secretaria_e != 3)
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
                        <th scope="col" class="text-center">Nombres CDP's</th>
                        <th scope="col" class="text-center">Asignar Dinero</th>
                        <th scope="col" class="text-center"><i class="fa fa-trash-o"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($registro->cdpsRegistro->count() == 0)
                        <tr>
                            <td class="text-center">
                                <input type="hidden" name="registro_id" value="{{ $registro->id }}">
                                <select name="cdp_id[]" class="form-group-lg" required>
                                    @foreach($cdps as $cdp)
                                        <option value="{{ $cdp['id'] }}">{{ $cdp['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">Guarda el rubro para poder seleccionar el respectivo dinero.</td>
                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>
                        </tr>
                    @endif
                    @for($i = 0; $i < $registro->cdpsRegistro->count(); $i++)
                        @php($cdpsRegistroData = $registro->cdpsRegistro[$i] )
                        <tr>
                            <td style="vertical-align: middle" class="text-center">
                                <h4>
                                    <b>{{ $cdpsRegistroData->cdp->name }}</b>
                                </h4>
                            </td>
                            <td class="text-center">
                                <div class="col-lg-6">
                                    <h4>
                                        Disponible:
                                        <b>$<?php echo number_format($cdpsRegistroData->cdp->saldo,0) ?></b>
                                    </h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4>
                                        <b>
                                            Valor:
                                            <input type="hidden" name="cdps_registro_id[]" value="{{ $cdpsRegistroData->id }}">
                                            <input type="number" required  name="valor[]" value="{{ $cdpsRegistroData->valor }}" max="{{ $cdpsRegistroData->cdp->saldo }}" style="text-align: center">
                                        </b>
                                    </h4>
                                </div>
                            </td>
                            <td style="vertical-align: middle" class="text-center">
                                <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminar({{ $cdpsRegistroData->id }})" ><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                        @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                    @endfor
                    </tbody>
                </table><br>
                <center>
                    <button type="button" v-on:click.prevent="nuevaFilaPrograma" class="btn btn-success">Agregar Fila</button>
                    <button type="submit" class="btn btn-primary">Guardar Rubros</button>
                    @if($registro->cdpsRegistro->sum('valor') > 0 )
                        <a href="{{url('/administrativo/registros/'.$registro->id.'/'.$fechaActual.'/'.$registro->cdpsRegistro->sum('valor').'/3')}}" class="btn btn-success">
                            Finalizar Registro
                        </a>
                    @endif
                </center>
            </form>
    </div>
    @else
        <table id="tabla_rubrosCdpFin" class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="text-center">Nombre del CDP</th>
                <th scope="col" class="text-center">Dinero</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < $registro->cdpsRegistro->count(); $i++)
                @php($cdpsRegistroData = $registro->cdpsRegistro[$i] )
                <tr>
                    <td style="vertical-align: middle" class="text-center">
                        <h4>
                            <b>{{ $cdpsRegistroData->cdp->name }}</b>
                        </h4>
                    </td>
                    <td class="text-center">
                        <div class="col-lg-6">
                            <h4>
                                Disponible:
                                <b>$<?php echo number_format($cdpsRegistroData->cdp->saldo,0) ?></b>
                            </h4>
                        </div>
                        <div class="col-lg-6">
                            <h4>
                                Asignado:
                                <b>$<?php echo number_format($cdpsRegistroData->valor,0) ?></b>
                            </h4>
                        </div>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    @endif
</div>
@include('modal.observacion')
@stop
@section('js')
    <script>

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

                    nuevaFilaPrograma: function(){
                        var nivel=parseInt($("#tabla_rubrosCdp tr").length);
                        $('#tabla_rubrosCdp tbody tr:last').after('<tr>\n' +
                            '                            <td class="text-center">\n' +
                            '                                <input type="hidden" name="registro_id" value="{{ $registro->id }}">\n' +
                            '                                <select name="cdp_id[]" class="form-group-lg" required>\n' +
                            '                                    @foreach($cdps as $cdp)\n' +
                            '                                        <option value="{{ $cdp['id'] }}">{{ $cdp['name'] }}</option>\n' +
                            '                                    @endforeach\n' +
                            '                                </select>\n' +
                            '                            </td>\n' +
                            '                            <td class="text-center">Guarda el rubro para poder seleccionar el respectivo dinero.</td>\n' +
                            '                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td>\n' +
                            '                        </tr>');

                    }
                }
            });
        } );
    </script>
@stop