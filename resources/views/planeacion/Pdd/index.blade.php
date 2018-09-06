@extends('layouts.dashboard')
@section('titulo')
    Plan de Desarrollo
@stop
@section('sidebar')
    @if($pdd)
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
    <div class="row">
    @if($pdd)
        <div class="col-md-12 align-self-center" id="proyectos">
            <center>
                <h2>Plan de Desarrollo: {{ $pdd->name }}</h2>
                <div class="form-check-inline">
                    <a href="{{ asset('#') }}" class="btn-sm btn btn-success"><i class="fa fa-check"></i><span class="hide-menu">&nbsp; Aprobar Plan de Desarrollo</span></a>
                </div>
            </center>
            <br>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabHome">Ejes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabProg">Programas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabProy">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabSP">Sub Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabPP">Plan Plurianual de Inversion</a>
                </li>
            </ul>
            <div class="tab-content" style="background-color: white">
                <div id="tabHome" class="tab-pane active">
                    <div class="col-md-12 align-self-center">
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table id="tabla_EJ" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="6" class="text-center">EJES PROGRAMATICOS</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre del Eje</th>
                                        <th class="text-center">Valor inicial</th>
                                        <th class="text-center">Valor final</th>
                                        <th class="text-center">Valor ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pdd->ejes as $ejes)
                                    <tr class="text-center">
                                        <td>{{$ejes->id}}</td>
                                        <td>{{$ejes->name}}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
                <div id="tabProg" class="tab-pane">
                    <div class="col-md-12 align-self-center">
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table id="tabla_PG" class="table table-bordered" width="100%">
                                    <thead>
                                    <tr>
                                        <th colspan="7" class="text-center">EJES PROGRAMATICOS</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre del Programa</th>
                                        <th class="text-center">Nombre del Eje</th>
                                        <th class="text-center">Valor inicial</th>
                                        <th class="text-center">Valor final</th>
                                        <th class="text-center">Valor ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($programas as $prog)
                                        <tr class="text-center">
                                            <td>{{$prog['id']}}</td>
                                            <td>{{$prog['name']}}</td>
                                            <td>{{$prog->eje->name}}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
                <div id="tabProy" class="tab-pane">
                    <div class="col-md-12 align-self-center">
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table id="tabla_PY" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="text-center"></th>
                                        <th colspan="18" class="text-center">META DE RESULTADO DEL PROYECTO</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-center"></th>
                                        <th colspan="10" class="text-center">METAS</th>
                                        <th colspan="8" class="text-center">VALOR DEL PROYECTO</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Codigo del Proyecto</th>
                                        <th class="text-center">Nombre del Proyecto</th>
                                        <th class="text-center">Nombre del Programa</th>
                                        <th class="text-center">Linea Base</th>
                                        <th class="text-center">Indicador</th>
                                        <th class="text-center">Meta Inicial Resultado</th>
                                        <th class="text-center">Modificación Meta</th>
                                        <th class="text-center">Meta Definitiva</th>
                                        <th class="text-center">% ejecución Año 1</th>
                                        <th class="text-center">% ejecución Año 2</th>
                                        <th class="text-center">% ejecución Año 3</th>
                                        <th class="text-center">% ejecución Año 4</th>
                                        <th class="text-center">% ejec Total Cuatrienio</th>
                                        <th class="text-center">Valor Poyecto Inicial</th>
                                        <th class="text-center">Valor Proyecto Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor ejecución año 1</th>
                                        <th class="text-center">Valor ejecución año 2</th>
                                        <th class="text-center">Valor ejecución año 3</th>
                                        <th class="text-center">Valor ejecución año 4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ps as $proy)
                                        <tr class="text-center">
                                            <td>{{$proy['id']}}</td>
                                            <td>{{$proy['code']}}</td>
                                            <td>{{$proy['name']}}</td>
                                            <td>{{$proy->programa->name}}</td>
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
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
                <div id="tabSP" class="tab-pane">
                    <div class="col-md-12 align-self-center">
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table id="tabla_SP" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="27" class="text-center">METAS DE PRODUCTO DEL SUBPROYECTO</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-center"></th>
                                        <th colspan="4" class="text-center">BASE</th>
                                        <th colspan="4" class="text-center">AÑO 1</th>
                                        <th colspan="4" class="text-center">AÑO 2</th>
                                        <th colspan="4" class="text-center">AÑO 3</th>
                                        <th colspan="4" class="text-center">AÑO 4</th>
                                        <th colspan="4" class="text-center">TOTALES</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Núm</th>
                                        <th class="text-center">Nombre del Sub Proyecto</th>
                                        <th class="text-center">Nombre del Proyecto</th>
                                        <th class="text-center">Tipo Meta</th>
                                        <th class="text-center">Indicador</th>
                                        <th class="text-center">Unidad de Medida</th>
                                        <th class="text-center">Linea Base</th>
                                        <th class="text-center">Meta Inicial</th>
                                        <th class="text-center">Modificación</th>
                                        <th class="text-center">Meta Definitiva</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Meta Inicial</th>
                                        <th class="text-center">Modificación</th>
                                        <th class="text-center">Meta Definitiva</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Meta Inicial</th>
                                        <th class="text-center">Modificación</th>
                                        <th class="text-center">Meta Definitiva</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Meta Inicial</th>
                                        <th class="text-center">Modificación</th>
                                        <th class="text-center">Meta Definitiva</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor Inicial</th>
                                        <th class="text-center">Valor Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sps as $Sproy)
                                        <tr class="text-center">
                                            <td>{{$Sproy['id']}}</td>
                                            <td>{{$Sproy['name']}}</td>
                                            <td>{{$Sproy->proyecto->name}}</td>
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
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
                <div id="tabPP" class="tab-pane">
                    <div class="col-md-12 align-self-center">
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table id="tabla_PPI" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="2" class="text-center"></th>
                                        <th colspan="20" class="text-center">PLAN PLURIANUAL DE INVERSION</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center"></th>
                                        <th colspan="4" class="text-center">AÑO 1</th>
                                        <th colspan="4" class="text-center">AÑO 2</th>
                                        <th colspan="4" class="text-center">AÑO 3</th>
                                        <th colspan="4" class="text-center">AÑO 4</th>
                                        <th colspan="4" class="text-center">TOTAL INVERSION</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre SubProyecto</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor Inicial</th>
                                        <th class="text-center">Valor Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor Inicial</th>
                                        <th class="text-center">Valor Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor Inicial</th>
                                        <th class="text-center">Valor Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Valor Inicial</th>
                                        <th class="text-center">Valor Final</th>
                                        <th class="text-center">Valor Ejecución</th>
                                        <th class="text-center">% Ejecución</th>
                                        <th class="text-center">Total Inicial</th>
                                        <th class="text-center">Total Final</th>
                                        <th class="text-center">Total Ejecución</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sps as $Sproy)
                                        <tr class="text-center">
                                            <td>{{$Sproy['id']}}</td>
                                            <td>{{$Sproy['name']}}</td>
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
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
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
    <div class="form-group">
        <label class="col-lg-4 col-form-label text-right" for="file">Anexar PDF</label>
        <div class="col-lg-6 fallback">
            <input name="file" class="form-control" type="file" class="form-control" accept="application/pdf" >
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
@endif
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#tabla_PPI').DataTable( {
                responsive: true,
                "searching": true,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_SP').DataTable( {
                responsive: true,
                "searching": true,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_PY').DataTable( {
                responsive: true,
                "searching": true,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_PG').DataTable( {
                responsive: true,
                "searching": false,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tabla_EJ').DataTable( {
                responsive: true,
                "searching": false,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'copy', 'csv', 'excel', 'print'
                ]
            } );
        } );

    </script>
@stop