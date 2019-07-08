@extends('layouts.dashboard')
@section('titulo')
    PUC
@stop
@section('sidebar')
    @if(count($data) > 0)
        <li><a href="/administrativo/contabilidad/puc/level/create/{{ $data->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp; Modificar PUC</a></li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>PUC</b></h4>
            </strong>
        </div>
            <br>
                <div class="table-responsive">
                    <br>
                    @if(count($data) > 0)
                    <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                        <thead>
                        <tr>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Nombre Cuenta</th>
                            <th class="text-center">Codigo NIPS</th>
                            <th class="text-center">Nombre NIPS</th>
                            <th class="text-center">Naturaleza</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($codigos as $codigo)
                            <tr>
                                <td class="text-dark">{{ $codigo['codigo']}}</td>
                                <td class="text-dark">{{ $codigo['name'] }}</td>
                                <td class="text-dark">{{ $codigo['code_N'] }}</td>
                                <td class="text-dark">{{ $codigo['name_N'] }}</td>
                                <td class="text-dark">{{ $codigo['naturaleza'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="col-md-12 align-self-center">
                            <div class="alert alert-danger text-center">
                                Actualmente no hay un PUC almacenado.
                                <a href="{{ url('administrativo/contabilidad/puc/create') }}" title="Crear" class="btn-sm btn-primary"><i class="fa fa-plus"></i> Crear nuevo PUC</a>
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
                ordering: false

            } );
    </script>
@stop