@extends('layouts.dashboard')
@section('titulo')
    Boletines
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busquedaBoletines" class="btn btn-primary hidden"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Boletines</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    @if(count($Boletines) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha del Documento</th>
                            <th class="text-center">Consecutivo</th>
                            <th class="text-center">Responsable</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Boletines as $key => $data)
                            <tr class="text-center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->ff_document }}</td>
                                <td>{{ $data->cc_id }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>
                                    <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{ url('dashboard/boletines/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay boletines almacenados.
                            </div>
                        </div>
                    @endif
                </div>
                <center>
                    <a href="{{ url('/dashboard/boletines/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Boletin</a>
                </center>
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