@extends('layouts.dashboard')
@section('titulo')
    Boletines
@stop
@section('sidebar')
    <li><a href="{{ url('/administrativo/contabilidad/retefuente/create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Nueva Retención en la Fuente</a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Retención en la Fuente</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    @if(count($data) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">UVT</th>
                            <th class="text-center">Base</th>
                            <th class="text-center">Tarifa</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Cuenta</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $retef)
                            <tr class="text-center">
                                <td>{{ $retef->id }}</td>
                                <td>{{ $retef->concepto }}</td>
                                <td>{{ $retef->uvt }}</td>
                                <td> $<?php echo number_format($retef->base,0);?></td>
                                <td>{{ $retef->tarifa }}</td>
                                <td>{{ $retef->codigo }}</td>
                                <td>{{ $retef->cuenta }}</td>
                                <td>
                                    <a href="{{ url('administrativo/contabilidad/retefuente/'.$retef->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay una retencion en la fuente almacenada.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
@stop

@section('js')
    <script>
            $('#tabla_corrE').DataTable( {
                responsive: true,
                "searching": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
    </script>
@stop