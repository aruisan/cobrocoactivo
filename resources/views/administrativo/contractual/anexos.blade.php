@extends('layouts.dashboard')
@section('titulo')
    Anexos de Contratación
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Anexos del Contrato: {{ $Contrato->asunto }}</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    @if(count($Anexos) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_Anexos">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fecha del Anexo</th>
                            <th class="text-center">Número del Anexo</th>
                            <th class="text-center">Fecha de Vencimiento</th>
                            <th class="text-center">Consecutivo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Anexos as $key => $data)
                            <tr class="text-center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->ff_doc }}</td>
                                <td>{{ $data->num_doc }}</td>
                                <td>{{ $data->ff_vence }}</td>
                                <td>{{ $data->consecutivo }}</td>
                                <td>
                                    @if($data->estado == "0")
                                        Pendiente
                                    @elseif($data->estado == "1")
                                        Aprobado
                                    @elseif($data->estado == "2")
                                        Rechazado
                                    @else
                                        Archivado
                                    @endif
                                </td>
                                <td>
                                    <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{ url('contractual/anexos/'.$data->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay anexos almacenados a este contrato.
                            </div>
                        </div>
                    @endif
                </div>
                <center>
                    <a href="anexos/create" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Anexo</a>
                </center>
            </div>
@stop

@section('js')
    <script>
            $('#tabla_Anexos').DataTable( {
                responsive: true,
                "searching": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
    </script>
@stop