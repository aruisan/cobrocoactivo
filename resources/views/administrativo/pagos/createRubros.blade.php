@extends('layouts.dashboard')
@section('titulo')
    Asignación de Montos
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos') }}" class="btn btn-success">
            <span class="hide-menu">Pagos</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Asignación de Montos para el Pago</h2></center>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    Orden de Pago: {{ $pago->orden_pago->nombre }}
                </div>
                <div class="col-md-4 text-center">
                    <b>Monto a Pagar: $<?php echo number_format($pago->valor,0) ?></b>
                </div>
                <div class="col-md-4 text-center">
                    Tercero: {{ $pago->orden_pago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/pagos/asignacion/store')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <input type="hidden" name="ordenPago_id" value="{{ $pago->orden_pago->id }}">
                    <input type="hidden" name="pago_id" value="{{ $pago->id }}">
                    <center> <h4>Se debe asignar que monto tomar de los rubros que han sido afectados por el registro y la orden de pago, el valor a tomar debe ser igual al valor del pago.</h4></center>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla_Pago">
                            <thead>
                            <tr>
                                <th class="text-center">Nombre Rubro</th>
                                <th class="text-center">Valor Disponible Rubro</th>
                                <th class="text-center">Valor a Tomar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pago->orden_pago->rubros as $rubros)
                                <tr class="text-center">
                                    <td>{{ $rubros->cdps_registro->rubro->name }}</td>
                                    <td>$<?php echo number_format($rubros->saldo,0) ?></td>
                                    <td>
                                        <input type="number" name="valor[]" value="0" style="text-align: center" min="0" max="{{ $rubros->saldo }}">
                                        <input type="hidden" name="idR[]" value="{{  $rubros->cdps_registro->rubro->id }}" style="text-align: center">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="col-md-12 align-self-center text-center">
                        <br>
                        <button type="submit" class="btn btn-success">Siguiente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#tabla_Pago').DataTable( {
            responsive: true,
            "searching": false
        } );
    </script>
@stop
