@extends('layouts.dashboard')
@section('titulo')
    Asignación de Montos
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
                    Monto a Pagar: $<?php echo number_format($pago->valor,0) ?>
                </div>
                <div class="col-md-4 text-center">
                    Tercero: {{ $pago->orden_pago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/pagos/monto/store')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $pago->orden_pago->id }}">
                    <br>

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

