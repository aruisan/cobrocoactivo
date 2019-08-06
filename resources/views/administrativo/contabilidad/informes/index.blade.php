@extends('layouts.dashboard')
@section('titulo')
    Informes
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Niveles</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            @foreach($niveles as $level)
                <li><a href="/administrativo/contabilidad/informes/lvl/{{$level->level}}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
            @endforeach
            <li><a href="/administrativo/contabilidad/informes/rubros/{{ $niveles[0]->puc_id }}" class="btn btn-primary">Rubros</a></li>
        </ul>
    </li>@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Informes</b></h4>
            </strong>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered hover" id="tabla">
                <hr>
                <thead>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Debito</th>
                    <th class="text-center">Credito</th>
                </thead>
                <tbody>
                @foreach($codes as $code)
                    <tr>
                        <td class="text-center">{{$code->code}}</td>
                        <td class="text-center">{{$code->name}}</td>
                        @foreach($data as $d)
                            @if($code->id == $d['id'])
                                <td>$ <?php echo number_format($d['Deb'],0);?></td>
                                <td>$ <?php echo number_format($d['Cred'],0);?></td>
                            @endif
                        @endforeach
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