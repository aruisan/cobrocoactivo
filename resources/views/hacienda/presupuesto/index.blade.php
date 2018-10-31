@extends('layouts.dashboard')
@section('titulo')
    Presupuesto - 2018
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
                <h4><b>Presupuesto Año 2018</b></h4>
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
                                <th class="text-center">Modificación</th>
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
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
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
                                <th class="text-center">valor</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Rubros as  $Rubro)
                            <tr>
                                <td>{{ $Rubro['codigo'] }}</td>
                                <td>{{ $Rubro['name'] }}</td>
                                <td class="text-center">$ <?php echo number_format($Rubro['valor'],0);?>.00</td>
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
                            <a href="{{ url('administrativo/cdp/create') }}" class="btn btn-primary btn-block m-b-12">Crear Nuevo CDP</a>
                            <br>
                            <table class="table table-bordered" id="tabla_CDP">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cdps as $cdp)
                                    <tr>
                                        <td class="text-center">{{ $cdp->id }}</td>
                                        <td class="text-center">{{ $cdp->name }}</td>
                                        <td class="text-center"><span class="badge badge-pill badge-danger">
                                                @if($cdp->estado == 0)
                                                    Pendiente
                                                @elseif($cdp->estado == 1)
                                                    Rechazado
                                                @elseif($cdp->estado == 2)
                                                    Anulado
                                                @else
                                                    Aprobado
                                                @endif
                                            </span></td>
                                        <td class="text-center">
                                            <a href="{{ url('administrativo/cdp/'.$cdp->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#" title="Aprobar" class="btn-sm btn-success"><i class="fa fa-check"></i></a>
                                            <a href="#" title="Rechazar" class="btn-sm btn-danger"><i class="fa fa-times-circle"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                @else
                                <br><br>
                                <div class="alert alert-danger">
                                    <center>
                                        No hay CDP's, para crear uno nuevo de click al siguiente link:
                                        <a href="{{ url('administrativo/cdp/create') }}" class="alert-link">Crear CDP</a>.
                                    </center>
                                </div>
                            @endif
                    </div>
                </div>
                <div id="tabReg" class=" tab-pane fade"><br>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="registros">
                            <tr data-idalumno="1">
                                <td>1</th>
                                <td>Registro 1</td>
                                <td><span class="badge badge-danger">Anulado</span></td>
                                <td>
                                    <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            <tr data-idalumno="2">
                                <th scope="row">2</th>
                                <td>Registro 2</td>
                                <td><span class="badge badge-success">Aprobado</span></td>
                                <td>
                                    <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary btn-block m-b-10"><i class="fa fa-plus"></i></button>
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
                <div id="tabTer" class=" tab-pane fade"><br>
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Identificación</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Regimen</th>
                                <th class="text-center">Descuentos Defectos</th>
                                <th class="text-center">Descuentos Adicionales</th>
                                <th class="text-center"><i class="fa fa-trash"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Deivith</td>
                                <td>1019128310</td>
                                <td></td>
                                <td>Girardot</td>
                                <td>3212420644</td>
                                <td>deivith.1@hotmail.com</td>
                                <td>Común</td>
                                <td>10%</td>
                                <td>20%</td>
                                <td><button type="button" class="btn btn-danger btn-block m-b-10"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Deivith</td>
                                <td>1019128310</td>
                                <td></td>
                                <td>Girardot</td>
                                <td>3212420644</td>
                                <td>deivith.1@hotmail.com</td>
                                <td>Común</td>
                                <td>10%</td>
                                <td>20%</td>
                                <td><button type="button" class="btn btn-danger btn-block m-b-10"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
            $('#tabla_CDP').DataTable( {
                responsive: true,
                "searching": true,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'pdf' ,'copy', 'csv', 'excel', 'print'
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

        $('#registros').on('click','tr td', function(evt){
            var target;
            target = $(event.target);
            url ="/presupuesto/"+ target.parent().data('idalumno');
            window.open(url, '_blank');
            return false;
        });

        $('#registros').css("cursor","pointer");

            function datosTextos() {
                var textos = '';
                for (var i=1;i<document.getElementById('tabla_presupuesto').rows.length;i ++){
                    for (var j=0;j<=4;j++){
                        if (j==4){
                            textos = textos + document.getElementById('tabla_presupuesto').rows[i].cells[j].innerHTML;
                        }else{
                            textos = textos + document.getElementById('tabla_presupuesto').rows[i].cells[j].innerHTML + '-';
                        }
                    }
                    textos = textos + '/';
                }
                alert(textos);

                return textos;
            }
    </script>
@stop