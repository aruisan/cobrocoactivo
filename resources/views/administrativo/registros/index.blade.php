@extends('layouts.dashboard')
@section('titulo')
    Registros
@stop
@section('sidebar')
    {{-- @if( $rol == 2)
        <li>
            <a href="{{ url('/administrativo/registros/create/'.$vigencia) }}" class="btn btn-success">
                <i class="fa fa-plus"></i>
                <span class="hide-menu"> Crear Registros</span></a>
        </li>
    @endif
    <li>
        <a href="{{ url('/administrativo/cdp/'.$vigencia) }}" class="btn btn-primary">
            <span class="hide-menu"> CDP's</span></a>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/ordenPagos/'.$vigencia) }}" class="btn btn-primary">
            <span class="hide-menu"> Orden de Pago</span></a>
    </li> --}}
@stop
@section('content')
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Registros</b></h4>
        </strong>
    </div>
    <ul class="nav nav-pills">
      <li class="nav-item">
            <a class="nav-link regresar"  href="{{url('/presupuesto') }}">Volver a Presupuesto</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " data-toggle="pill" href="#tabTareas">TAREAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tabHistorico">HISTORICO</a>
        </li>
         @if( $rol == 2)
        <li class="nav-item">
            <a class="nav-link"  href="{{route('registros.create')}}">NUEVO REGISTRO</a>
        </li>
          @endif
    </ul>
    <div class="tab-content" style="background-color: white">
        <div id="tabTareas" class="tab-pane active"><br>
            <div class="table-responsive">
        @if(isset($registros))
            <table class="table table-bordered" id="tabla_registros">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre Registro</th>
                    <th class="text-center">Nombre Tercero</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center"><i class="fa fa-usd"></i></th>
                    <th class="text-center"><i class="fa fa-edit"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($registros as $data)
                    <tr>
                        <td class="text-center">{{ $data['id'] }}</td>
                        <td class="text-center">{{ $data['objeto'] }}</td>
                        <td class="text-center">{{ $data['nombre'] }}</td>
                        <td class="text-center">$<?php echo number_format($data['valor'],0) ?></td>
                        <td class="text-center">
                            <span class="badge badge-pill badge-danger">
                                @if($data['estado'] == "0")
                                    Pendiente
                                @elseif($data['estado'] == "1")
                                    Rechazado
                                @elseif($data['estado'] == "2")
                                    Anulado
                                @else
                                    Aprobado
                                @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('administrativo/registros/show',$data['id']) }}" title="Asignar Dinero al Registro" class="btn-sm btn-primary"><i class="fa fa-usd"></i></a>
                        </td>                <td class="text-center">
                            @if($data['estado'] == 0)
                                <a href="{{ url('administrativo/registros/'.$data['id'].'/edit') }}" class="btn-sm btn-info" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @elseif($data['estado'] == 3)
                                <a href="{{ url('administrativo/registros/show',$data['id']) }}" class="btn-sm btn-info" title="Visualizar">
                                    <i class="fa fa-eye"></i>
                                </a>
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="col-md-12 align-self-center">
                <div class="alert alert-danger text-center">
                    Actualmente no hay registros pendientes.
                </div>
            </div>
        @endif
            </div>
        </div>
        <div id="tabHistorico" class="tab-pane fade">
            <br>
            <div class="table-responsive">
                @if(isset($registrosHistorico))
                    <table class="table table-bordered" id="tabla_registrosH">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Nombre Registro</th>
                            <th class="text-center">Nombre Tercero</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Ver</th>
                            <th class="text-center">PDF</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($registrosHistorico as $data)
                            <tr>
                                <td class="text-center">{{ $data['id'] }}</td>
                                <td class="text-center">{{ $data['objeto'] }}</td>
                                <td class="text-center">{{ $data['nombre'] }}</td>
                                <td class="text-center">$<?php echo number_format($data['valor'],0) ?></td>
                                <td class="text-center">$<?php echo number_format($data['saldo'],0) ?></td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($data['estado'] == "0")
                                            Pendiente
                                        @elseif($data['estado'] == "1")
                                            Rechazado
                                        @elseif($data['estado'] == "2")
                                            Anulado
                                        @else
                                            Aprobado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/registros/show',$data['id']) }}" title="Ver Registro" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/registro/pdf/'.$data['id'].'/'.$vigencia) }}" title="Ver Archivo" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                <div class="col-md-12 align-self-center">
                    <div class="alert alert-danger text-center">
                        Actualmente no hay registros finalizados.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>

        $(document).ready(function() {

            $('#tabla_registros').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_registrosH').DataTable( {
                responsive: true,
                "searching": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

        } );
    </script>
@endsection