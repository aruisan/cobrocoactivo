@extends('layouts.dashboard')
@section('titulo')
    Plan de Desarrollo
@stop
@section('css')
    <style>
        table.table3{
            font-family:'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: normal;
            letter-spacing: 1px;
            line-height: 1.7em;
            border-collapse:collapse;
        }
        .table3 thead th{
            color:#444;
            border:2px solid #444;
        }
        .table3 tbody td{
            border:2px solid #444;
            color:#444;
            text-align: center !important;
        }
        .text-th {
            padding:20px;
            color:#444;
            border:2px solid #444;
            writing-mode: vertical-lr;
            transform: rotate(270deg);
            text-align: center !important;
        }
    </style>
@stop
@section('sidebar')
    @if($val != 0)
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Navegación</span>
            &nbsp
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ asset('/pdd') }}" class="btn btn-primary">Plan de Desarrollo</a></li>
            <li><a href="{{ asset('/pdd/data/create/'.$pdd->id) }}" class="btn btn-primary">Ejes y Programas</a></li>
            <li><a href="{{ asset('/pdd/proyecto/create/'.$pdd->id) }}" class="btn btn-primary">Proyectos</a></li>
        </ul>
    </li>
    <li> <a href="{{ asset('#') }}" class="btn btn btn-primary"><i class="fa fa-plus"></i><span class="hide-menu">&nbsp;Nuevo Plan de Desarrollo</span></a></li>
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Historico</span>
            &nbsp
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 1</a></li>
            <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 2</a></li>
            <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 3</a></li>
        </ul>
    </li>
    @else
        <li class="dropdown">
            <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
                <span class="hide-menu">Historico</span>
                &nbsp
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 1</a></li>
                <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 2</a></li>
                <li><a href="{{ asset('#') }}" class="btn btn-primary">PDD 3</a></li>
            </ul>
        </li>
    @endif
@stop
@section('content')
    @if($val == 0)
        <div class="col-md-12 align-self-center">
            <div class="row justify-content-center">
                <br>
                <div class="alert alert-danger">
                    <center>
                        Actualmente no hay un plan de desarrollo, llene el siguiente formulario para su respectiva creación.
                    </center>
                </div>
                <br>
                <center><h2>Nuevo Plan de Desarrollo</h2></center>
                <br>
                <hr>
                <div class="form-validation">
                    <form class="form-valide" action="/pdd" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="nombre">Nombre <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="ff_inicio">Fecha de Inicio <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="ff_inicio" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}" min="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="ff_final">Fecha Final <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="ff_final" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}" min="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
                            </div>
                        </div>
                        <center>
                        <div class="form-group row">
                            <div class="col-lg-12 ml-auto">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12 align-self-center" id="proyectos">
            <center>
                <h2>Plan de Desarrollo: {{ $pdd->name }}</h2>
            </center>
            <br>
                        <div class="table-responsive">
                            <table class="table3">
                                <thead>
                                <tr>
                                    <th colspan="56" class="text-center">PLAN INDICATIVO</th>
                                </tr>
                                <tr>
                                    <th colspan="12" class="text-center">EJES PROGRAMATICOS</th>
                                    <th colspan="18" class="text-center">META DE RESULTADO DEL PROYECTO</th>
                                    <th colspan="26" class="text-center">META DE PRODUCTO DEL SUBPROYECTO</th>
                                    <th colspan="20" class="text-center">PLAN PLURIANUAL DE INVERSION</th>
                                </tr>
                                <tr>
                                    <th colspan="12" class="text-center">&nbsp;</th>
                                    <th colspan="10" class="text-center">METAS</th>
                                    <th colspan="8" class="text-center">VALOR PROYECTO</th>
                                    <th colspan="2" class="text-center">&nbsp;</th>
                                    <th colspan="4" class="text-center">BASE</th>
                                    <th colspan="4" class="text-center">AÑO 1</th>
                                    <th colspan="4" class="text-center">AÑO 2</th>
                                    <th colspan="4" class="text-center">AÑO 3</th>
                                    <th colspan="4" class="text-center">AÑO 4</th>
                                    <th colspan="4" class="text-center">TOTALES</th>
                                    <th colspan="4" class="text-center">AÑO 1</th>
                                    <th colspan="4" class="text-center">AÑO 2</th>
                                    <th colspan="4" class="text-center">AÑO 3</th>
                                    <th colspan="4" class="text-center">AÑO 4</th>
                                    <th colspan="4" class="text-center">TOTAL INVERSION</th>
                                </tr>
                                <tr>
                                    <th class="text-th"><b>EJES</b></th>
                                    <th class="text-th">Valor inicial</th>
                                    <th class="text-th">Valor final</th>
                                    <th class="text-th">Valor ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th"><b>PROGRAMAS</b></th>
                                    <th class="text-th">Valor inicial</th>
                                    <th class="text-th">Valor final</th>
                                    <th class="text-th">Valor ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th"><b>Num Proyecto</b></th>
                                    <th class="text-th"><b>PROYECTOS</b></th>
                                    <th class="text-th">Linea Base</th>
                                    <th class="text-th">Indicador</th>
                                    <th class="text-th">Meta Inicial Resultado</th>
                                    <th class="text-th">Modificación Meta</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% ejecución Año 1</th>
                                    <th class="text-th">% ejecución Año 2</th>
                                    <th class="text-th">% ejecución Año 3</th>
                                    <th class="text-th">% ejecución Año 4</th>
                                    <th class="text-th">% ejec Total Cuatrienio</th>
                                    <th class="text-th">Valor Poyecto Inicial</th>
                                    <th class="text-th">Valor Proyecto Final</th>
                                    <th class="text-th">Valor Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Valor ejecución año 1</th>
                                    <th class="text-th">Valor ejecución año 2</th>
                                    <th class="text-th">Valor ejecución año 3</th>
                                    <th class="text-th">Valor ejecución año 4</th>
                                    <th class="text-th"><b>Num Subpropyecto</b></th>
                                    <th class="text-th"><b>SUB PROYECTO</b></th>
                                    <th class="text-th">Tipo Meta</th>
                                    <th class="text-th">Indicador</th>
                                    <th class="text-th">Unidad de Medida</th>
                                    <th class="text-th">Linea Base</th>
                                    <th class="text-th">Meta Inicial</th>
                                    <th class="text-th">Modificación</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Meta Inicial</th>
                                    <th class="text-th">Modificación</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Meta Inicial</th>
                                    <th class="text-th">Modificación</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Meta Inicial</th>
                                    <th class="text-th">Modificación</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Meta Inicial</th>
                                    <th class="text-th">Modificación</th>
                                    <th class="text-th">Meta Definitiva</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Valor Inicial</th>
                                    <th class="text-th">Valor Final</th>
                                    <th class="text-th">Valor Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Valor Inicial</th>
                                    <th class="text-th">Valor Final</th>
                                    <th class="text-th">Valor Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Valor Inicial</th>
                                    <th class="text-th">Valor Final</th>
                                    <th class="text-th">Valor Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Valor Inicial</th>
                                    <th class="text-th">Valor Final</th>
                                    <th class="text-th">Valor Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                    <th class="text-th">Total Inicial</th>
                                    <th class="text-th">Total Final</th>
                                    <th class="text-th">Total Ejecución</th>
                                    <th class="text-th">% Ejecución</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tables as $table)
                                    <tr>
                                        <td rowspan="">{{ $table->ejes }}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>{{ $table->programas }}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>{{ $table->Numproy }}</td>
                                        <td>{{ $table->Pname }}</td>
                                        <td>{{ $table->Plinea }}</td>
                                        <td>{{ $table->Pind }}</td>
                                        <td>{{ $table->Pini }}</td>
                                        <td>{{ $table->Pmod }}</td>
                                        <td>{{ $table->Pmetdef }}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>{{ $table->Numsub }}</td>
                                        <td>{{ $table->SPname }}</td>
                                        <td>{{ $table->SPtipo }}</td>
                                        <td>{{ $table->SPindi }}</td>
                                        <td>{{ $table->SPund }}</td>
                                        <td>{{ $table->SPlinea }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

    @endif
@stop