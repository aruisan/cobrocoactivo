@extends('layouts.dashboard')
@section('titulo')
    Presupuesto
@stop
@section('css')
    <style>
        .tabs {
            max-width: max-content;
            margin: 0 auto;
        }
        #tab-button {
            display: table;
            table-layout: fixed;
            width: 100%;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        #tab-button li {
            display: table-cell;
            width: 20%;
        }
        #tab-button li a {
            display: block;
            padding: .5em;
            background: #eee;
            border: 1px solid #ddd;
            text-align: center;
            color: #000;
            text-decoration: none;
        }
        #tab-button li:not(:first-child) a {
            border-left: none;
        }
        #tab-button li a:hover,
        #tab-button .is-active a {
            border-bottom-color: transparent;
            background: #fff;
        }
        .tab-contents {
            padding: .5em 2em 1em;
            border: 1px solid #ddd;
        }
        .tab-button-outer {
            display: none;
        }
        .tab-contents {
            margin-top: 20px;
        }
        @media screen and (min-width: 768px) {
            .tab-button-outer {
                position: relative;
                z-index: 2;
                display: block;
            }
            .tab-select-outer {
                display: none;
            }
            .tab-contents {
                position: relative;
                top: -1px;
                margin-top: 0;
            }
        }
    </style>
@stop
@section('sidebar')
    @if($V != "Vacio")
        <li> <a href="{{ url('/presupuesto/level/create/'.$V) }}" class="btn btn-success"><i class="fa fa-edit"></i><span class="hide-menu">&nbsp;Editar Presupuesto</span></a></li>
    @else
    @endif
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
    <li> <a href="#" class="btn btn-primary"><i class="fa fa-server"></i><span class="hide-menu">&nbsp; Tabla de Retención</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <ol class="breadcrumb text-center">
            <strong><h4><b>Presupuesto Año 2018</b></h4></strong>
        </ol>
        <div class="tabs">
            <div class="tab-button-outer">
                <ul id="tab-button">
                    <li><a href="#tabHome">Principal</a></li>
                    <li><a href="#tabFuente">Fuente</a></li>
                    <li><a href="#tabPAC">PAC</a></li>
                    <li><a href="#tabCert">Certificado</a></li>
                    <li><a href="#tabReg">Registros</a></li>
                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown">
                            Adición
                            &nbsp;
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="dropdown1-tab" href="#tabAddIng" role="tab" data-toggle="tab" aria-controls="dropdown1">Ingresos</a>
                            <a class="dropdown-item" id="dropdown2-tab" href="#tabAddEgr" role="tab" data-toggle="tab" aria-controls="dropdown2">Egresos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown">
                            Reducción
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="dropdown1-tab" href="#tabRedIng" role="tab" data-toggle="tab" aria-controls="dropdown1">Ingresos</a>
                            <a class="dropdown-item" id="dropdown2-tab" href="#tabRedEgr" role="tab" data-toggle="tab" aria-controls="dropdown2">Egresos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown">
                            Más
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="dropdown1-tab" href="#tabCre" role="tab" data-toggle="tab" aria-controls="dropdown1">Creditos</a>
                            <a class="dropdown-item" id="dropdown2-tab" href="#tabApl" role="tab" data-toggle="tab" aria-controls="dropdown2">Aplazos</a>
                            <a class="dropdown-item" id="dropdown3-tab" href="#tabOP" role="tab" data-toggle="tab" aria-controls="dropdown3">Orden de Pago</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-select-outer">
                <select id="tab-select">
                    <option value="#tabHome">Principal</option>
                    <option value="#tabFuente">Fuente</option>
                    <option value="#tabPAC">PAC</option>
                    <option value="#tabCert">Certificados</option>
                    <option value="#tabReg">Registros</option>
                    <option value="#tabRed">Reducción</option>
                    <option value="#tabCre">Creditos</option>
                    <option value="#tabApl">Aplazos</option>
                    <option value="#tabOP">Orden Pago</option>
                </select>
            </div>
            <div id="tabHome" class="tab-contents">
                @if($V != "Vacio")
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
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
                        @else
                            <br>
                            <div class="alert alert-danger">
                                No se ha creado un presupuesto actual de egresos, para crearlo de click al siguiente link:
                                <a href="{{ url('presupuesto/vigencia/create/0') }}" class="alert-link">Crear Presupuesto de Egresos</a>.
                            </div>
                @endif
            </div>
            <div id="tabFuente" class="tab-contents">
                <h2 class="text-center">Fuente</h2>
            </div>
            <div id="tabPAC" class="tab-contents">
                <h2 class="text-center">PAC</h2>
            </div>
            <div id="tabCert" class="tab-contents text-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Certificado 1</td>
                            <td><span class="badge badge-pill badge-danger">Anulado</span></td>
                            <td>
                                <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Certificado 2</td>
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
            <div id="tabReg" class="tab-contents text-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Registro 1</td>
                            <td><span class="badge badge-danger">Anulado</span></td>
                            <td>
                                <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                        <tr>
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
            <div id="tabAddIng" class="tab-contents">
                <h2 class="text-center">Adiciones de Ingresos</h2>
            </div>
            <div id="tabAddEgr" class="tab-contents">
                <h2 class="text-center">Adiciones de Egresos</h2>
            </div>
            <div id="tabRedIng" class="tab-contents">
                <h2 class="text-center">Reducciones de Ingresos</h2>
            </div>
            <div id="tabRedEgr" class="tab-contents">
                <h2 class="text-center">Reducciones de Egresos</h2>
            </div>
            <div id="tabCre" class="tab-contents">
                <h2 class="text-center">Creditos y Contracreditos</h2>
            </div>
            <div id="tabApl" class="tab-contents">
                <h2 class="text-center">Aplazamientos</h2>
            </div>
            <div id="tabOP" class="tab-contents">
                <h2 class="text-center">Orden de Pago</h2>
            </div>
            <div id="tabTer" class="tab-contents text-center">
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
    </div>
@stop
@section('js')
    <script>
        $(function() {
            var $tabButtonItem = $('#tab-button li'),
                $tabSelect = $('#tab-select'),
                $tabContents = $('.tab-contents'),
                activeClass = 'is-active';

            $tabButtonItem.first().addClass(activeClass);
            $tabContents.not(':first').hide();

            $tabButtonItem.find('a').on('click', function(e) {
                var target = $(this).attr('href');

                $tabButtonItem.removeClass(activeClass);
                $(this).parent().addClass(activeClass);
                $tabSelect.val(target);
                $tabContents.hide();
                $(target).show();
                e.preventDefault();
            });

            $tabSelect.on('change', function() {
                var target = $(this).val(),
                    targetSelectNum = $(this).prop('selectedIndex');

                $tabButtonItem.removeClass(activeClass);
                $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                $tabContents.hide();
                $(target).show();
            });
        });
    </script>
@stop