@extends('layouts.dashboard')
@section('titulo')
    Correspondencia
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busqueda" class="btn btn-primary"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">

        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Correspondencia</b></h4>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabE">ENTRADA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabS">SALIDA</a>
                </li>
            </ul>
            <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabE" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Fecha de Entrada</th>
                                <th class="text-center">Fecha de Vencimiento</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Tercero</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-center text-dark">0</td>
                                    <td class="text-center text-dark">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="text-center">
                                        <a href="#" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#" title="Aprobar" class="btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="#" title="Rechazar" class="btn-sm btn-danger"><i class="fa fa-times-circle"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <a href="{{ url('/correspondencia/create/0') }}" title="Editar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Correspondencia de Entrada</a>
                    </center>
                </div>
                <div id="tabS" class="tab-pane fade">
                    <br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_corrS">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Fecha de Salida</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Tercero</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-center text-dark">0</td>
                                <td class="text-center text-dark">0</td>
                                <td>0</td>
                                <td class="text-center">
                                    <a href="#" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="#" title="Aprobar" class="btn-sm btn-success"><i class="fa fa-check"></i></a>
                                    <a href="#" title="Rechazar" class="btn-sm btn-danger"><i class="fa fa-times-circle"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <a href="{{ url('/correspondencia/create/1') }}" title="Editar" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Correspondencia de Salida</a>
                    </center>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
            $('#tabla_corrE').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_corrS').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

        $('#registros').on('click','tr td', function(evt){
            var target;
            target = $(event.target);
            url ="/presupuesto/"+ target.parent().data('idalumno');
            window.open(url, '_blank');
            return false;
        });

        $('#registros').css("cursor","pointer");
    </script>
@stop