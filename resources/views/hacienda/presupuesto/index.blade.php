@extends('layouts.dashboard')
@section('titulo')
    Presupuesto - 2019
@stop
@section('sidebar')
    @if($V != "Vacio")
        <li> <a href="{{ url('/presupuesto/level/create/'.$V) }}" class="btn btn-success"><i class="fa fa-edit"></i><span class="hide-menu">&nbsp;Editar Presupuesto</span></a></li>
        <li class="dropdown">
            <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
                <i class="fa fa-calendar-check-o"></i>
                <span class="hide-menu">Vigencia Actual</span>
                &nbsp;
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#" class="btn btn-primary">Ingresos</a>
                </li>
                <li>
                    <a href="{{ url('/presupuesto') }}" class="btn btn-primary">Egresos</a>
                </li>
            </ul>
        </li>
        <li> <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i><span class="hide-menu">&nbsp; Cambiar Vigencia</span></a></li>
    @else
    @endif
    <li>
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <i class="fa fa-plus"></i>
            <span class="hide-menu">Nuevo Presupuesto</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ url('/presupuesto/vigencia/create/1') }}" class="btn btn-primary">Ingresos</a></li>
            <li><a href="{{ url('/presupuesto/vigencia/create/0') }}" class="btn btn-primary">Egresos</a></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        @if($V != "Vacio")
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Presupuesto Año 2019</b></h4>
                <div class="form-check-inline">
                    <a href="{{ asset('#') }}" class="btn-sm btn btn-success"><i class="fa fa-check"></i><span class="hide-menu">&nbsp; Aprobar Presupuesto</span></a>
                </div>
            </strong>
        </div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabHome"><i class="fa fa-home"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabFuente">Fuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabRubros">Rubros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabPAC">PAC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabCert">CDP's</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabReg">Registros</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Adiciones &nbsp;
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu text-center">
                        <center>
                        <h5><a type="button" class="dropdown-item btn btn-primary" data-toggle="pill" href="#tabAddIng">Ingresos</a></h5>
                        <h5><a type="button" class="dropdown-item btn btn-primary" data-toggle="pill" href="#tabAddEgr">Egresos</a></h5>
                        </center>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Reducciones &nbsp;
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu text-center">
                        <center>
                        <h5><a type="button" class="dropdown-item btn btn-primary" data-toggle="pill" href="#tabRedIng">Ingresos</a></h5>
                        <h5><a type="button" class="dropdown-item btn btn-primary" data-toggle="pill" href="#tabRedEgr">Egresos</a></h5>
                        </center>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabCre">Creditos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabApl">Aplazamientos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabOP">Orden de Pago</a>
                </li>
            </ul>
            <br>
            <div class="tab-content" style="background-color: white">
                <div id="tabHome" class="tab-pane active"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover table-bordered" align="100%" id="tabla_presupuesto">
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
                                <th class="text-center">CDP's</th>
                                <th class="text-center">Saldo Disponible</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($codigos as $codigo)
                                <tr>
                                    @if($codigo['valor'])
                                        <td class="text-dark"><a href="{{ url('presupuesto/rubro/'.$codigo['id_rubro']) }}">{{ $codigo['codigo']}}</a></td>
                                    @else
                                        <td class="text-dark">{{ $codigo['codigo']}}</td>
                                    @endif
                                    <td class="text-dark">{{ $codigo['name']}}</td>
                                     <!-- PRESUPUESTO INICIAL-->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorInicial['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    @if($codigo['valor'])
                                        <td class="text-center text-dark">$ <?php echo number_format($codigo['valor'],0);?></td>
                                    @endif
                                    <!-- ADICIÓN -->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark">$ 0</td>
                                        @endif
                                    @endforeach
                                    @foreach($valoresAdd as $valorAdd)
                                        @if($codigo['id_rubro'] == $valorAdd['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorAdd['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <!-- REDUCCIÓN -->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark">$ 0</td>
                                        @endif
                                    @endforeach
                                    @foreach($valoresRed as $valorRed)
                                        @if($codigo['id_rubro'] == $valorRed['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorRed['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <td>$0</td>
                                    <td>$0</td>
                                    <!-- PRESUPUESTO DEFINITIVO -->
                                    @foreach($valoresDisp as $valorDisponible)
                                        @if($valorDisponible['id'] == $codigo['id'])
                                            <td class="text-center">$ <?php echo number_format($valorDisponible['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    @foreach($ArrayDispon as $valorPD)
                                        @if($codigo['id_rubro'] == $valorPD['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorPD['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <!-- CDP'S -->
                                    @foreach($valoresIniciales as $valorInicial)
                                        @if($valorInicial['id'] == $codigo['id'])
                                            <td class="text-center text-dark">$ 0</td>
                                        @endif
                                    @endforeach
                                    @foreach($valoresCdp as $valorCdp)
                                        @if($codigo['id_rubro'] == $valorCdp['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($valorCdp['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    <!-- SALDO DISPONIBLE -->
                                    @foreach($valorDisp as $vDisp)
                                        @if($vDisp['id'] == $codigo['id'])
                                            <td class="text-center">$ <?php echo number_format($vDisp['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                    @foreach($saldoDisp as $salD)
                                        @if($codigo['id_rubro'] == $salD['id'])
                                            <td class="text-center text-dark">$ <?php echo number_format($salD['valor'],0);?></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                <div id="tabRubros" class="tab-pane fade"><br>
                <br>
                    <div class="table-responsive">
                        <br>
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
                <div id="tabPAC" class="tab-pane fade"><br>
                    <h2 class="text-center">PAC</h2>
                </div>
                <div id="tabCert" class=" tab-pane fade"><br>
                    <div class="table-responsive">
                            @if(count($cdps) >= 1)
                            <br>
                            <a href="{{ url('administrativo/cdp') }}" class="btn btn-primary btn-block m-b-12">CDP's</a>
                            <br>
                            <table class="table table-bordered" id="tabla_CDP">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Objeto</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Estado Secretaria</th>
                                    <th class="text-center">Estado Jefe</th>
                                    <th class="text-center">Ver</th>
                                    <th class="text-center">Archivo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cdps as $cdp)
                                    <tr>
                                        <td class="text-center">{{ $cdp->id }}</td>
                                        <td class="text-center">{{ $cdp->name }}</td>
                                        <td class="text-center">$ <?php echo number_format($cdp->valor,0);?>.00</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill badge-danger">
                                                @if($cdp->secretaria_e == "0")
                                                    Pendiente
                                                @elseif($cdp->secretaria_e == "1")
                                                    Rechazado
                                                @elseif($cdp->secretaria_e == "2")
                                                    Anulado
                                                @else
                                                    Enviado
                                                @endif
                                            </span>
                                                </td>
                                                <td class="text-center">
                                            <span class="badge badge-pill badge-danger">
                                                @if($cdp->jefe_e == "0")
                                                    Pendiente
                                                @elseif($cdp->jefe_e == "1")
                                                    Rechazado
                                                @elseif($cdp->jefe_e == "2")
                                                    Anulado
                                                @elseif($cdp->jefe_e == "3")
                                                    Aprobado
                                                @else
                                                    En Espera
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('administrativo/cdp/'.$cdp->id) }}" title="Ver" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('cpd-pdf', $cdp->id) }}" title="certificado" class="btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                @else
                                <br><br>
                                <div class="alert alert-danger">
                                    <center>
                                        No hay CDP's.
                                    </center>
                                </div>
                            @endif
                    </div>
                </div>
                <div id="tabReg" class=" tab-pane fade"><br>
                    <div class="table-responsive">
                        @if(count($registros) >= 1)
                            <br>
                            <a href="{{ url('administrativo/registros') }}" class="btn btn-primary btn-block m-b-12">Registros</a>
                            <br>
                            <table class="table table-bordered" id="tabla_Registros">
                                <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Nombre Registro</th>
                                    <th class="text-center">Nombre Tercero</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center"><i class="fa fa-eye"></i></th>
                                    <th class="text-center">Archivo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($registros as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $data->id }}</td>
                                        <td class="text-center">{{ $data->objeto }}</td>
                                        <td class="text-center">{{ $data->persona->nombre }}</td>
                                        <td class="text-center">$<?php echo number_format($data->valor,0) ?></td>
                                        <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($data->secretaria_e == "0")
                                            Pendiente
                                        @elseif($data->secretaria_e == "1")
                                            Rechazado
                                        @elseif($data->secretaria_e == "2")
                                            Anulado
                                        @else
                                            Aprobado
                                        @endif
                                    </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('administrativo/registros',$data->id) }}" title="Ver Registro" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('registro-pdf', $data->id) }}" title="certificado-registro" class="btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <br><br>
                            <div class="alert alert-danger">
                                <center>
                                    No hay Registros.
                                </center>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="tabAddIng" class=" tab-pane fade"><br>
                    <h2 class="text-center">Adiciones de Ingresos</h2>
                </div>
                <div id="tabAddEgr" class=" tab-pane fade"><br>
                    <h2 class="text-center">Adiciones de Egresos</h2>
                </div>
                <div id="tabRedIng" class=" tab-pane fade"><br>
                    <h2 class="text-center">Reducciones de Ingresos</h2>
                </div>
                <div id="tabRedEgr" class=" tab-pane fade"><br>
                    <h2 class="text-center">Reducciones de Egresos</h2>
                </div>
                <div id="tabCre" class=" tab-pane fade"><br>
                    <h2 class="text-center">Creditos y Contracreditos</h2>
                </div>
                <div id="tabApl" class=" tab-pane fade"><br>
                    <h2 class="text-center">Aplazamientos</h2>
                </div>
                <div id="tabOP" class=" tab-pane fade"><br>
                    <h2 class="text-center">Orden de Pago</h2>
                </div>
            </div>
        @else
            <br><br>
            <div class="alert alert-danger">
                No se ha creado un presupuesto actual de egresos, para crearlo de click al siguiente link:
                <a href="{{ url('presupuesto/vigencia/create/0') }}" class="alert-link">Crear Presupuesto de Egresos</a>.
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

        $('#tabla_CDP').DataTable( {
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
    </script>
@stop