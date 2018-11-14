@extends('layouts.dashboard')
@section('titulo')
    Registros
@stop
@section('sidebar')
    @include('administrativo.registros.cuerpo.aside')
    <li>
        <a href="{{ url('/administrativo/cdp') }}" class="btn btn-primary">
            <i class="fa fa-file"></i>
            <span class="hide-menu"> CDP's</span></a>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/almacen') }}" class="btn btn-primary">
            <i class="fa fa-inventory"></i>
            <span class="hide-menu">Almacen</span></a>
    </li>
@stop
@section('content')
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Registros</b></h4>
        </strong>
    </div>
    <div class="table-responsive">
@if(count($registros) > 0)
    <table class="table table-bordered" id="tabla_registros">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nombre Registro</th>
            <th class="text-center">Nombre Tercero</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Estado</th>
            <th class="text-center"><i class="fa fa-usd"></i></th>
            <th class="text-center"><i class="fa fa-edit"></i></th>
        </tr>
        @foreach ($registros as $key => $data)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">{{ $data->objeto }}</td>
                <td class="text-center">{{ $data->persona->nombre }}</td>
                <td class="text-center">$<?php echo number_format($data->valor,0) ?></td>
                <td class="text-center">
                    <span class="badge badge-pill badge-danger">
                        @if($data->secretaria_e == "0")
                            Pendiente
                        @elseif($data->secretaria_e == "1")
                            Rechazado
                        @elseif($data->secretaria_e == "2")
                            Anulado
                        @else
                            Enviado
                        @endif
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ url('administrativo/registros',$data->id) }}" title="Asignar Dinero al Registro" class="btn btn-sm btn-primary"><i class="fa fa-usd"></i></a>
                </td>                <td class="text-center">
                    @if($rol == 2)
                        @if($data->secretaria_e == 0)
                            <a href="{{ url('administrativo/registros/'.$data->id.'/edit') }}" class="btn btn-sm btn-info" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                        @elseif($data->secretaria_e == 3)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                            {!! Form::close() !!}
                        @endif
                    @elseif($rol == 3)
                        @if($data->secretaria_e == 0)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jcontratacion_e == 3 or $data->jcontratacion_e == 1)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @else
                            <a href="{{url('/administrativo/registros/'.$data->id.'/'.$rol.'/3')}}" title="Aprobar" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    @elseif($rol == 4)
                        @if($data->secretaria_e == 0)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jcontratacion_e == 0 or $data->jcontratacion_e == 1)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jpresupuesto_e == 0)
                            <a href="{{url('administrativo/registros/'.$data->id.'/'.$rol.'/3')}}" title="Aprobar" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                            @else
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $registros->render() !!}
@else
    </div>
    <div class="col-md-12 align-self-center">
        <div class="alert alert-danger text-center">
            Actualmente no hay registros creados, se recomienda crearlos.
        </div>
    </div>
@endif
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

        } );

        $(document).on('click', '.borrar', function (event) {

            event.preventDefault();
            $(this).closest('tr').remove();

        });
    </script>
@endsection