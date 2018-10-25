@extends('layouts.dashboard')
@section('titulo')
    Acuerdos
@stop
@section('sidebar')
    <li> <a data-toggle="modal" data-target="#modal-busquedaAcuerdos" class="btn btn-primary"><i class="fa fa-search"></i><span class="hide-menu">&nbsp; Buscar</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">

        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Acuerdos</b></h4>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabAcuerdos">ACUERDOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabProyectos">PROYECTOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabActas">ACTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabRes">RESOLUCIONES</a>
                </li>
            </ul>
        <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabAcuerdos" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_Acuerdos">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del Documento</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Número</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha de Salida</th>
                                <th class="text-center">Comisión</th>
                                <th class="text-center">Fecha 1er Debate</th>
                                <th class="text-center">Fecha 2do Debate</th>
                                <th class="text-center">Fecha de Aprobación</th>
                                <th class="text-center">Fecha de Sanción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-dark">0</td>
                                    <td class="text-center text-dark">0</td>
                                    <td class="text-center text-dark">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="text-center">
                                        <a href="#" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="#" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <a href="{{ url('/dashboard/acuerdos/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nuevo Acuerdo</a>
                    </center>
                </div>
                <div id="tabActas" class="tab-pane fade">
                    <br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_Actas">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del Documento</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Número</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Comisión</th>
                                <th class="text-center">Fecha Aprobación</th>
                                <th class="text-center">Archivo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-center">
                                    <a href="#" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <a href="{{ url('#') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Acta</a>
                    </center>
                </div>
                <div id="tabRes" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_Res">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del Documento</th>
                                <th class="text-center">Fecha de Entrada</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Número</th>
                                <th class="text-center">Comisión</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-dark">0</td>
                                <td class="text-center">
                                    <a href="#" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <a href="{{ url('#') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Nueva Resolución</a>
                    </center>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>
            $('#tabla_Actas').DataTable( {
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_Acuerdos').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_Res').DataTable( {
                responsive: true,
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