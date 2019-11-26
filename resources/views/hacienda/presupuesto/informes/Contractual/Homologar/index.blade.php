@extends('layouts.dashboard')
@section('titulo')
    Homologar
@stop
@section('sidebar')
    @if( $rol == 2)
        <li>
            <a href="{{ url('presupuesto/informes/contractual/homologar/create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>
                <span class="hide-menu"> Añadir Codigo Contractual</span></a>
        </li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Homologar</b></h4>
            </strong>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered hover" id="tabla">
                <hr>
                <thead>
                    <tr>
                        <th class="text-center">Código</th>
                        <th class="text-center">Rubro</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Valor Inicial</th>
                        <th class="text-center">Valor Disponible</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Rubros as $value)
                    <tr>
                        <td class="text-center">{{$value['codigo']}}</td>
                        <td class="text-center">{{$value['rubro']}}</td>
                        <td class="text-center">{{$value['name']}}</td>
                        <td class="text-center">$ <?php echo number_format($value['valor'],0);?></td>
                        <td class="text-center">$ <?php echo number_format($value['valor_disp'],0);?></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#tabla').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
    </script>
@stop