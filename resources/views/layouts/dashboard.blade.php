<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('titulo')</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">

     <!-- Bootstrap Material Design -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/css/mdb.min.css" />

     <!-- Dropdown.js -->
    <!-- <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">-->

    <!-- MetisMenu CSS -->
   

     <!-- DataTables CSS -->
    <link href="{{asset('/assets/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">
   


    <!-- DataTables Responsive CSS -->
    <link href="{{asset('/assets/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('/assets/sb-admin/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('/assets/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{asset('/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!--alertas con toast-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Mi Estilo -->
    <link href="{{asset('/css/miStilo.css')}}" rel="stylesheet" type="text/css">

    @yield('css')


</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-default" role="navigation" style="">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
   
                                        

            <!-- /.navbar-header -->
              <ul class="nav navbar-top-links navbar-left btn-group col-md-10">
                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="AUDITORIA">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Contraloría</a></li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Control interno <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Planes de Mejoramiento</a></li>
                        <li><a tabindex="-1" href="#">Planes de Auditorias</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="ADMINISTRATIVO">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Contractual</a></li>
                    <li><a tabindex="-1" href="#">registros</a></li>
                    <li><a tabindex="-1" href="#">paz y salvo</a></li>
                    <li><a tabindex="-1" href="#">permisos</a></li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Vivienda <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">titulación de predios</a></li>
                        <li><a tabindex="-1" href="#">Proyectos</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Deportes <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Proyectos</a></li>
                        <li><a tabindex="-1" href="#">Escenarios</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Medio Ambiente <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Censo Usuarios</a></li>
                        <li><a tabindex="-1" href="#">Poda Arboles</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Operativa <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Talento humano</a></li>
                        <li><a tabindex="-1" href="#">Nómina</a></li>
                        <li><a tabindex="-1" href="#">Prensa</a></li>
                      </ul>
                    </li>
                     <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Gestión de calidad <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Manual de Procesos y Procedimientos</a></li>
                        <li><a tabindex="-1" href="#">Manual de Contratación</a></li>
                        <li><a tabindex="-1" href="#">Manual de Funciones</a></li>
                        <li><a tabindex="-1" href="#">Manual de Cartera</a></li>
                        <li><a tabindex="-1" href="#">Manual de Firmas</a></li>
                        <li><a tabindex="-1" href="#">Manual NIIF</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Gestion documental <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Correspondencia</a></li>
                        <li><a tabindex="-1" href="#">Trámites</a></li>
                        <li><a tabindex="-1" href="#">Archivo</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Sistemas <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Mesa de ayuda</a></li>
                        <li><a tabindex="-1" href="#">Vivelab</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>    

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="EDUCACION">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Instituciones educativas</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="PLANEACION">
                    <i class="fa fa-map-o" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">licencias planecacion</a></li>
                    <li><a tabindex="-1" href="#">Nomenclatura</a></li>
                    <li><a tabindex="-1" href="#">Estratificacion</a></li>
                    <li><a tabindex="-1" href="#">Riesgos</a></li>
                    <li><a tabindex="-1" href="{{ url('/pdd') }}">Plan de Desarrollo</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="TRANSITO">
                    <i class="fa fa-car" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Comparendos</a></li>
                    <li><a tabindex="-1" href="#">Trámites</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="INFRAESTRUCTURA">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Personal</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                    <li><a tabindex="-1" href="#">Maquinaria</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="GOBIERNO">
                    <i class="fa fa-university" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Espacio Público</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="SALUD">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Subsidiado</a></li>
                    <li><a tabindex="-1" href="#">Salud Pública</a></li>
                    <li><a tabindex="-1" href="#">Red hospitalaria</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="HACIENDA">
                    <span class="glyphicon glyphicon-usd"></span>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ url('/presupuesto') }}">Presupuesto</a></li>
                    <li><a tabindex="-1" href="#">contabilidad</a></li>
                    <li><a tabindex="-1" href="#">tesoreria</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">impustos <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">impuesto predial</a></li>
                        <li><a tabindex="-1" href="#">industria y comercio</a></li>
                        <li><a tabindex="-1" href="#">publicidad exterior visual</a></li>
                        <li><a tabindex="-1" href="#">valorizacion</a></li>
                        <li><a tabindex="-1" href="#">plusvalia</a></li>
                        <li><a tabindex="-1" href="#">alumbrado publico</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">cobro coactivo <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="{{url('/predios')}}">predial</a></li>
                        <li><a tabindex="-1" href="#">transito</a></li>
                        <li><a tabindex="-1" href="#">industria y comercio</a></li>
                        <li><a tabindex="-1" href="#">ejecutivo</a></li>
                        <li><a tabindex="-1" href="#">Policivo</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">almacen <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Entradas</a></li>
                        <li><a tabindex="-1" href="#">Salidas</a></li>
                        <li><a tabindex="-1" href="#">Plan de Compras</a></li>
                        <li><a tabindex="-1" href="#">activos fijos</a></li>
                      </ul>
                    </li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="DESARROLLO">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Desplazados</a></li>
                    <li><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"  title="SANSONATORIO">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Disciplinarios</a></li>
                    <li><a tabindex="-1" href="#">Administrativo</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="CONVIVENCIA">
                    <i class="fa fa-users" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Policivo</a></li>
                    <li><a tabindex="-1" href="#">Comisaria familia</a></li>
                    <li><a tabindex="-1" href="#">Comparendos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="JUDICIAL">
                    <i class="fa fa-gavel" aria-hidden="true"></i>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Demandado</a></li>
                    <li><a tabindex="-1" href="#">Demandante</a></li>
                    <li><a tabindex="-1" href="#">Comité de Conciliación</a></li>
                  </ul>
                </li> 
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li><button class="btn btn-danger btn-sm" id="verNormatividad" data-toggle="modal" data-target="#modal-normas" ><span>Normatividad</span></button></li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                        {{Auth::user()->name }}<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{url('kk')}}"><i class="material-icons md-18">settings</i> Editar Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="#"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons md-18">input</i> Salir
                          </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                          </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                          @yield('sidebar')     
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
           
          @yield('content')
           
        </div>
        <!-- /#page-wrapper -->


        <!-- Modal -->
        <div class="modal fade" id="modal-demandado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Relaciona un participante al proceso</h4>
              </div>
              <div class="modal-body">
              <div id="formModalDemandado"></div>
                <!--  formulario de participantes -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary ocultar" data-dismiss="modal" id="relacionar">Relacionar</button>
                <button type="button" class="btn btn-primary " data-dismiss="modal" id="relacionar2">Relacionar y Guardar</button>
              </div>
            </div>
          </div>
        </div>




         <!-- Modal -->
        <div class="modal fade" id="modal-dueno" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Dueños del Predio</h4>
              </div>
              <div class="modal-body">
              <div id="formModalDueno"></div>
                <!--  formulario de participantes -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary ocultar" data-dismiss="modal" id="relacionar_dueno">Relacionar</button>
                <button type="button" class="btn btn-primary " data-dismiss="modal" id="relacionar_dueno2">Relacionar y Guardar</button>
              </div>
            </div>
          </div>
        </div>


           <!-- Modal -->
        <div class="modal fade" id="modal-create-archivos" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Formulario de Archivos</h4>
              </div>
              <div class="modal-body-2">
                <!--  formulario de participantes -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary ocultar" data-dismiss="modal" id="updateArchivo">Editar Archivo</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="storeArchivo">Subir Archivo</button>
              </div>
            </div>
          </div>
        </div>

          <!-- Modal -->
        <div class="modal fade modal-impulso1" id="" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Formulario de Impulsos</h4>
              </div>
              <div class="modal-body">
                <div id="formulario-impulso"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade modal-impulso2" id="" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Formulario de Impulsos</h4>
              </div>
              <div class="modal-body">
                <div id="editarPredio"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modal-normas" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                        <div id="tabla_norma" class="col-md-12">
        
                        </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="modal-ver-normas" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <div id="verNormasDiv"></div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
  <div class="modal fade" id="modal-aprobar-impulso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="aprobarImpulso"></div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
            

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/js/mdb.min.js"></script>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function(){$('#myInput').focus(); });
    </script>

    <!-- Material Design for Bootstrap -->



     <!-- DataTables JavaScript -->
    <script src="{{asset('/assets/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    
    <!--data tables-->
    <script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
    

    <!--vue-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!--toast-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts/cuerpo/toastRequest')

    <!-- editor textarea -->
    <script src="{{asset('/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/assets/ckeditor/adapters/jquery.js')}}"></script>


    <!-- Morris Charts JavaScript -->
    <script src="{{asset('/assets/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('/assets/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('/assets/sb-admin/js/sb-admin-2.js')}}"></script>
    
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
@yield('js')

    
</body>

</html>