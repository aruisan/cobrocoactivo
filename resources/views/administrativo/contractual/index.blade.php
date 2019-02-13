@extends('layouts.dashboard')
@section('titulo')
    Contratación
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/contractual/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu">Crear Contractual</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Contractual</b></h4>
            </strong>
        </div>
        <br>
        <div class="table-responsive">
            <br>
            @if(count($consulta)>0)
            <table class="table table-hover table-bordered" align="100%" id="tabla_Contractual">
                <thead>
                    <th>PROCESO</th>
                    <th>RESPONSABLE</th>
                    <th>VALOR</th>
                    <th>ASUNTO</th>
                    <th>ACCIONES</th>

                </thead>
                <tbody>
                    @foreach($consulta as $data )

                    <tr>
                        <td>{{$data->modulo}}</td>
                        <td>{{$data->responsable}}</td>
                        <td>$ <?php echo number_format($data->valor,0);?></td>
                        <td>{{$data->asunto}}</td>
                        <td class="text-center">
                            <a href="contractual/{{$data->id}}/edit " class="btn-sm btn-success" title="Editar"><span class="fa fa-edit"></span></a>
                            <a href="contractual/{{$data->id}}/anexos " class="btn-sm btn-primary" title="Anexos"><span class="glyphicon glyphicon-open-file"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-danger">
                    Actualmente no hay contratos creados, para crearlos de clic en el siguiente enlace:
                    <a href="{{ route('contractual.create') }}" class="alert-link">Nuevo Contrato</a>.
                </div>
            @endif
        </div>
    </div>
@stop
@section('js')
    <script>
        $('#tabla_Contractual').DataTable( {
            responsive: true,
            "searching": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
    </script>
@stop