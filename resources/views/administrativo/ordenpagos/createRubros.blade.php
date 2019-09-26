@extends('layouts.dashboard')
@section('titulo')
    Asignación de Montos
@stop
@section('sidebar')
    <div class="card">
        <br>
        <center>
            <h4><b>Estado Actual del Registro</b></h4>
            <br>
            Valor Registro: $<?php echo number_format($ordenPago->registros->valor,0) ?>
            <br>
            Valor Total(+IVA): $<?php echo number_format($ordenPago->registros->val_total,0) ?>
            <br>
            <hr>
            <h4><b>Valor Orden de Pago</b></h4>
            <br>
            <b>$<?php echo number_format($ordenPago->valor,0) ?></b>
        </center>
        <br>
    </div>
    @if(count($ordenPago->rubros) > 1)
        <li>
            <a href="{{ url('/administrativo/ordenPagos/'.$ordenPago->id) }}" class="btn btn-success">
                <i class="fa fa-eye"></i>
                <span class="hide-menu">Orden de Pago</span></a>
        </li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Asignación Montos Orden de Pago: {{ $ordenPago->nombre }}</h2></center>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    Registro Seleccionado: {{ $ordenPago->registros->objeto }}
                </div>
                <div class="col-md-6 text-center">
                    Tercero: {{ $ordenPago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            @if(count($ordenPago->rubros) > 1)
                <br>
                <hr>
                <center>
                    <h4> Actualmente la forma en la que se asigna el dinero del rubro a la orden de pago es la siguiente:</h4>
                </center>
                <br>
                <div class="form-validation">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Número CDP</th>
                                <th class="text-center">Nombre CDP</th>
                                <th class="text-center">Nombre Rubro</th>
                                <th class="text-center">Valor Tomado</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($ordenPago->rubros as $rubros)
                               <tr>
                                   <td class="text-center">{{ $rubros->cdps_registro->cdps->id }}</td>
                                   <td class="text-center">{{ $rubros->cdps_registro->cdps->name}}</td>
                                   <td class="text-center">{{ $rubros->cdps_registro->cdps->rubrosCdp[0]->rubros->name}}</td>
                                   <td class="text-center">$<?php echo number_format($rubros->valor,0) ?></td>
                               </tr>
                           @endforeach
                            </tbody>
                        </table>
                        <br>
                        <form class="form-valide" action="{{url('/administrativo/ordenPagos/monto/delete')}}" method="POST" enctype="multipart/form-data">
                            {!! method_field('PUT') !!}
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $ordenPago->id }}" name="id">
                            <center>
                                <button type="submit" class="btn btn-danger">Reasignar Valores</button>
                            </center>
                        </form>
                    </div>
                </div>
            @else
                <div class="form-validation">
                    <form class="form-valide" action="{{url('/administrativo/ordenPagos/monto/store')}}" method="POST" enctype="multipart/form-data">
                        <hr>
                        {!! method_field('PUT') !!}
                        {{ csrf_field() }}
                        <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $ordenPago->id }}">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Número CDP</th>
                                    <th class="text-center">Nombre CDP</th>
                                    <th class="text-center">Nombre Rubro</th>
                                    <th class="text-center">Valor Disponible Rubro</th>
                                    <th class="text-center">Valor Para Orden Pago</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td colspan="3">IVA de la Orden de Pago</td>
                                    <td>$<?php echo number_format($ordenPago->iva,0) ?></td>
                                    <td><input type="number" style="text-align: center" required name="ValorIva" value="{{ $ordenPago->iva }}"></td>
                                </tr>
                                @for($i=0;$i< count($cdps); $i++)
                                    <tr class="text-center">
                                        <td>{{$cdps[$i]->cdp_id}}</td>
                                        <td>{{$cdps[$i]->cdps->name}}</td>
                                        <td>{{$cdps[$i]->fontRubro->rubro->name}}</td>
                                        <td>$<?php echo number_format($cdps[$i]->valor,0) ?></td>
                                        <td><input type="number" style="text-align: center" required name="Valor[]" value="{{ $distri[$i] }}"></td>
                                        <input type="hidden" style="text-align: center" name="cdp_id[]" value="{{ $cdps[$i]->id }}">
                                    </tr>
                                @endfor
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
            @endif
        </div>
    </div>
@stop

