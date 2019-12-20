@extends('layouts.dashboard')
@section('titulo')
    Vigencia: {{ $añoActual }}
@stop
@section('sidebar')
    @if($V != "Vacio")
        <li> <a href="{{ url('/presupuesto/level/create/'.$V) }}" class="btn btn-success"><i class="fa fa-edit"></i><span class="hide-menu">&nbsp;Editar Presupuesto</span></a></li>
    @endif
    <li> <a href="#" class="btn btn-primary hidden"><i class="fa fa-edit"></i><span class="hide-menu">&nbsp; Cambiar Vigencia</span></a></li>
    @if($V != "Vacio")
        <li class="dropdown">
            <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown">
                Informes
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li class="dropdown-submenu">
                    <a class="test btn btn-primary text-left" href="#">Contractual &nbsp;<span class="fa fa-caret-right"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/presupuesto/informes/contractual/homologar') }}" class="btn btn-success text-left">Homologar</a></li>
                        <li><a data-toggle="modal" data-target="#reporteHomologar" class="btn btn-success text-left">Reporte</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="btn btn-primary text-left">FUT </a>
                </li>
                <li>
                    <a href="{{ url('/presupuesto/informes/lvl/1') }}" class="btn btn-primary text-left">Niveles</a>
                </li>
                <li>
                    <a href="#" class="btn btn-primary text-left">Comparativo (Ingresos - Gastos)</a>
                </li>
                <li>
                    <a href="#" class="btn btn-primary text-left">Fuentes</a>
                </li>
            </ul>
        </li>
    @endif
    @if($V == "Vacio")
        <li>
            <a href="{{ url('/presupuesto/vigencia/create/1') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span class="hide-menu"> Nuevo Presupuesto de Ingresos</span></a>
        </li>
    @endif
@stop
@section('content')
    @if($V != "Vacio")
        @include('modal.Informes.reporte')
    @endif
    <div class="col-md-12 align-self-center">
        @if($V != "Vacio")
            <div class="breadcrumb col-md-2 text-center">
                <strong>
                    <h4>
                        <a href="{{ url('/presupuesto') }}" class="btn btn-success"><span class="hide-menu"> Presupuesto de Egresos</span></a>
                    </h4>
                </strong>
            </div>
            <div class="breadcrumb col-md-8 text-center">
                <strong>
                    <h4><b>Presupuesto de Ingresos {{ $añoActual }}</b></h4>
                </strong>
            </div>
            <div class="breadcrumb col-md-2 text-center">
                <strong>
                    @if($mesActual == 12)
                        <h4>
                            <a href="{{ url('/newPreIng/1',$añoActual+1) }}" class="btn btn-success"><span class="hide-menu"> Presupuesto de Ingresos {{ $añoActual + 1 }}</span></a>
                        </h4>
                    @else
                        <h4><b>&nbsp;</b></h4>
                    @endif
                </strong>
            </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabHome"><i class="fa fa-home"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill"  href="@can('fuentes-list') #tabFuente @endcan">Fuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('rubros-list') #tabRubros @endcan">Rubros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hidden" data-toggle="pill" href="@can('pac-list') #tabPAC @endcan">PAC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('adiciones-list') #tabAddIng @endcan">Adiciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('adiciones-list') #tabRedIng @endcan">Reducciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="@can('creditos-list') #tabCre @endcan">Creditos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" data-toggle="pill" href="#tabApl">Aplazamientos</a>
                </li>
            </ul>
            <div class="tab-content" style="background-color: white">
                <div id="tabHome" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" align="100%" id="tabla_presupuesto" style="text-align: center">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">P. Inicial</th>
                                <th class="text-center">Adición</th>
                                <th class="text-center">Reducción</th>
                                <th class="text-center">Credito</th>
                                <th class="text-center">CCredito</th>
                                <th class="text-center">P.Definitivo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($codigos as $codigo)
                                <tr>
                                    @if($codigo['valor'])
                                        <td class="text-dark" style="vertical-align:middle;"><a href="{{ url('presupuesto/rubro/'.$codigo['id_rubro']) }}">{{ $codigo['codigo']}}</a></td>
                                    @else
                                        <td class="text-dark" style="vertical-align:middle;">{{ $codigo['codigo']}}</td>
                                    @endif
                                    <td class="text-dark" style="vertical-align:middle;">{{ $codigo['name']}}</td>
                                     <!-- PRESUPUESTO INICIAL-->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorInicial['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    @if($codigo['valor'])
                                        <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($codigo['valor'],0);?></td>
                                    @endif
                                    <!-- ADICIÓN -->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ 0</td>
                                        @endif
                                    @endforeach
                                    @foreach($valoresAdd as $valorAdd)
                                        @if($codigo['id_rubro'] == $valorAdd['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorAdd['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <!-- REDUCCIÓN -->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ 0</td>
                                        @endif
                                    @endforeach
                                    @foreach($valoresRed as $valorRed)
                                        @if($codigo['id_rubro'] == $valorRed['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorRed['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <!-- CREDITO -->
                                        @foreach($valoresIniciales as $valorInicial)
                                            @if($valorInicial['id'] == $codigo['id'])
                                                <td class="text-center text-dark" style="vertical-align:middle;">$ 0</td>
                                            @endif
                                        @endforeach
                                        @foreach($valoresCred as $valorCred)
                                            @if($codigo['id_rubro'] == $valorCred['id'])
                                                <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorCred['valor'],0);?></td>
                                            @endif
                                        @endforeach
                                    <!-- CONTRACREDITO -->
                                        @foreach($valoresIniciales as $valorInicial)
                                            @if($valorInicial['id'] == $codigo['id'])
                                                <td class="text-center text-dark" style="vertical-align:middle;">$ 0</td>
                                            @endif
                                        @endforeach
                                        @foreach($valoresCcred as $valorCcred)
                                            @if($codigo['id_rubro'] == $valorCcred['id'])
                                                <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorCcred['valor'],0);?></td>
                                            @endif
                                        @endforeach
                                    <!-- PRESUPUESTO DEFINITIVO -->
                                    @foreach($valoresDisp as $valorDisponible)
                                        @if($valorDisponible['id'] == $codigo['id'])
                                            <td class="text-center" style="vertical-align:middle;">$ <?php echo number_format($valorDisponible['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    @foreach($ArrayDispon as $valorPD)
                                        @if($codigo['id_rubro'] == $valorPD['id'])
                                            <td class="text-center text-dark" style="vertical-align:middle;">$ <?php echo number_format($valorPD['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA DE FUENTES -->

                <div id="tabFuente" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_fuente">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">P. Inicial</th>
                                @foreach($fuentes as $fuente)
                                    <th class="text-center">{{ $fuente['name'] }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($codigos as $codigo)
                                <tr>
                                    <td class="text-dark">{{ $codigo['codigo']}}</td>
                                    <td class="text-dark">{{ $codigo['name']}}</td>
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorInicial['valor'],0);?>.00</td>
                                        @endif
                                    @endforeach
                                    @if($codigo['valor'])
                                        <td class="text-center text-dark">$ <?php echo number_format($codigo['valor'],0);?>.00</td>
                                    @endif
                                    @foreach($FRubros as $FRubro)
                                        @if($FRubro['rubro_id'] == $codigo['id_rubro'])
                                            <td class="text-center text-dark">$ <?php echo number_format($FRubro["valor"],0);?>.00</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA DE RUBROS -->

                <div id="tabRubros" class="tab-pane fade"><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla_Rubros">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Valor Inicial</th>
                                <th class="text-center">Valor Disponible</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Rubros as  $Rubro)
                            <tr>
                                <td>{{ $Rubro['codigo'] }}</td>
                                <td>{{ $Rubro['name'] }}</td>
                                <td class="text-center">$ <?php echo number_format($Rubro['valor'],0);?>.00</td>
                                <td class="text-center">$ <?php echo number_format($Rubro['valor_disp'],0);?>.00</td>
                                <td class="text-center">
                                    <a href="{{ url('presupuesto/rubro/'.$Rubro['id_rubro']) }}" class="btn-sm btn-success"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA DE PAC -->

                <div id="tabPAC" class="tab-pane fade"><br>
                    <h2 class="text-center">PAC</h2>
                </div>

                <!-- TABLAS DE ADICIONES -->

                <div id="tabAddIng" class=" tab-pane fade"><br>
                    <h2 class="text-center">Adiciones de Ingresos</h2>
                </div>


                <br>
                <div id="tabAddEgr" class=" tab-pane fade"><br>
                    <h2 class="text-center">Adiciones de Egresos</h2>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla_AddE">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Valor Adición</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Rubros as  $Rubro)
                                @foreach($valoresAdd as $valAdd)
                                    @if($valAdd['id'] == $Rubro['id_rubro'] and $valAdd['valor'] > 0)
                                        <tr>
                                            <td>{{ $Rubro['codigo'] }}</td>
                                            <td>{{ $Rubro['name'] }}</td>
                                            <td class="text-center">$ <?php echo number_format($valAdd['valor'],0);?>.00</td>
                                            <td class="text-center">
                                                <a href="{{ url('presupuesto/rubro/'.$Rubro['id_rubro']) }}" class="btn-sm btn-success"><i class="fa fa-info"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLAS DE REDUCCIONES -->

                <div id="tabRedIng" class=" tab-pane fade"><br>
                    <h2 class="text-center">Reducciones de Ingresos</h2>
                </div>
                <div id="tabRedEgr" class=" tab-pane fade"><br>
                    <h2 class="text-center">Reducciones de Egresos</h2>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla_RedE">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Valor Reducción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Rubros as  $Rubro)
                                @foreach($valoresRed as $valRed)
                                    @if($valRed['id'] == $Rubro['id_rubro'] and $valRed['valor'] > 0)
                                        <tr>
                                            <td>{{ $Rubro['codigo'] }}</td>
                                            <td>{{ $Rubro['name'] }}</td>
                                            <td class="text-center">$ <?php echo number_format($valRed['valor'],0);?>.00</td>
                                            <td class="text-center">
                                                <a href="{{ url('presupuesto/rubro/'.$Rubro['id_rubro']) }}" class="btn-sm btn-success"><i class="fa fa-info"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA DE CREDITOS Y CONTRACREDITOS -->

                <div id="tabCre" class=" tab-pane fade"><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla_Cyc">
                            <thead>
                            <tr>
                                <th class="text-center">Rubro</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Valor Credito</th>
                                <th class="text-center">Valor Contracredito</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Rubros as  $Rubro)
                                @foreach($valoresCyC as $valCyC)
                                    @if($valCyC['id'] == $Rubro['id_rubro'])
                                        @if($valCyC['valorC'] == 0 and $valCyC['valorCC'] == 0)
                                        @else
                                            <tr>
                                                <td>{{ $Rubro['codigo'] }}</td>
                                                <td>{{ $Rubro['name'] }}</td>
                                                <td class="text-center">$ <?php echo number_format($valCyC['valorC'],0);?>.00</td>
                                                <td class="text-center">$ <?php echo number_format($valCyC['valorCC'],0);?>.00</td>
                                                <td class="text-center">
                                                    <a href="{{ url('presupuesto/rubro/'.$Rubro['id_rubro']) }}" class="btn-sm btn-success"><i class="fa fa-info"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA DE APLAZAMIENTOS  -->

                <div id="tabApl" class=" tab-pane fade"><br>
                    <h2 class="text-center">Aplazamientos</h2>
                </div>

            </div>
        @else
            <div class="breadcrumb text-center">
                <strong>
                    <h4><b>Presupuesto de Ingresos Año {{ $añoActual }}</b></h4>
                </strong>
            </div>
            <br><br>
            <div class="alert alert-danger">
                No se ha creado un presupuesto actual de ingresos, para crearlo de click al siguiente link:
                <a href="{{ url('presupuesto/vigencia/create/1') }}" class="alert-link">Crear Presupuesto de Ingresos</a>.
            </div>
        @endif
        </div>
@stop
@section('js')
    <script>
        $('#tabla_Registros').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );


        $('#tabla_Rubros').DataTable( {
            responsive: true,
            "searching": true,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'pdf' ,'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_presupuesto').DataTable( {
            responsive: true,
            "searching": false,
            "ordering": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_fuentes').DataTable( {
            responsive: true,
            "searching": false,
            dom: 'Bfrtip',
            buttons: [
                'pdf' ,'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_AddE').DataTable( {
            responsive: true,
            "searching": true,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'pdf' ,'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_RedE').DataTable( {
            responsive: true,
            "searching": true,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'pdf' ,'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_Cyc').DataTable( {
            responsive: true,
            "searching": true,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'pdf' ,'copy', 'csv', 'excel', 'print'
            ]
        } );
    </script>
@stop