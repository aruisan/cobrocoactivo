<li class="dropdown">
  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="AUDITORIA">
    <i class="fa fa-address-card-o" aria-hidden="true"></i>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li class="disabled"><a tabindex="-1" href="#">Contraloría</a></li>
    <li class="dropdown-submenu">
      <a class="test green-text" tabindex="-1" href="#">Control interno <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a tabindex="-1" href="{{ route('planmejoramiento.index') }}">Planes de Mejoramiento</a></li>
        <li class="disabled"><a tabindex="-1" href="#">Planes de Auditorias</a></li>
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
                    <li><a tabindex="-1" href="{{ route('contractual.index') }}">Contractual</a></li>
                    <li><a tabindex="-1" href="{{ route('registros.index') }}">registros</a></li>
                    <li><a tabindex="-1" href="{{ route('marcas-herretes.index') }}">marcas y herretes</a></li>
                    <li><a tabindex="-1" href="{{ route('pazysalvo.index') }}">paz y salvo</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">permisos</a></li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Vivienda <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="{{ route('titulacionpredios.index') }}">titulación de predios</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Deportes <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Escenarios</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Medio Ambiente <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">Censo Usuarios</a></li>
                        <li><a tabindex="-1" href="{{ route('podaarboles.index') }}">Poda Arboles</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Dirección Operativa <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">Talento humano</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Nómina</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Prensa</a></li>
                      </ul>
                    </li>
                     <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Gestión de calidad <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">Manual de Procesos y Procedimientos</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Manual de Contratación</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Manual de Funciones</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Manual de Cartera</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Manual de Firmas</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Manual NIIF</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Gestion documental <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="{{ route('correspondencia.index') }}">Correspondencia</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Trámites</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Archivo</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">Sistemas <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">Mesa de ayuda</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Vivelab</a></li>
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
                    <li class="disabled"><a tabindex="-1" href="#">Instituciones educativas</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="PLANEACION">
                    <i class="fa fa-map-o" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ route('licenciasplaneacion.index') }}">licencias planeación</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Nomenclatura</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Estratificacion</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Riesgos</a></li>
                    <li><a tabindex="-1" href="{{ url('/pdd') }}">Plan de Desarrollo</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="TRANSITO">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Comparendos</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Trámites</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="INFRAESTRUCTURA">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Personal</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                    <li><a tabindex="-1" href="{{ route('maquinaria.index') }}">Maquinaria</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="GOBIERNO">
                    <i class="fa fa-university" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Espacio Público</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li>  

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="SALUD">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Subsidiado</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Salud Pública</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Red hospitalaria</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="HACIENDA">
                    <span class="glyphicon glyphicon-usd"></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ url('/presupuesto') }}">Presupuesto</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">contabilidad</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">tesoreria</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">impustos <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="disabled"><a tabindex="-1" href="#">impuesto predial</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">industria y comercio</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">publicidad exterior visual</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">valorizacion</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">plusvalia</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">alumbrado publico</a></li>
                      </ul>
                    </li>
                    <li class="dropdown-submenu">
                      <a class="test green-text" tabindex="-1" href="#">cobro coactivo <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="http://protecsalud.co/views/secretaria.php">predial</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">transito</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">industria y comercio</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">ejecutivo</a></li>
                        <li class="disabled"><a tabindex="-1" href="#">Policivo</a></li>
                      </ul>
                    </li>
                    <li><a tabindex="-1" href="{{url('/almacen')}}">Almacen</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="DESARROLLO">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Desplazados</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Proyectos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"  title="SANSONATORIO">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ route('disciplinarios.index') }}">Disciplinarios</a></li>
                    <li><a tabindex="-1" href="{{ route('administrativos.index') }}">Administrativo</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="CONVIVENCIA">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ route('policivo.index') }}">Policivo</a></li>
                    <li><a tabindex="-1" href="{{ route('comisariafamilia.index') }}">Comisaria familia</a></li>
                    <li><a tabindex="-1" href="{{ route('comparendos.index') }}">Comparendos</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="JUDICIAL">
                    <i class="fa fa-gavel" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="{{ route('demandado.index') }}">Demandado</a></li>
                    <li><a tabindex="-1" href="{{ route('demandante.index') }}">Demandante</a></li>
                    <li><a tabindex="-1" href="{{ route('comiteconciliacion.index') }}">Comité de Conciliación</a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="Configuración">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li class="disabled"><a tabindex="-1" href="#">Configuración basica</a></li>
                    <li><a tabindex="-1" href="{{ route('dependencias.index') }}">Gestión de Dependencias</a></li>
                    @can('funcionario-list')
                    <li><a tabindex="-1" href="{{ route('funcionarios.index') }}">Gestión de Funcionarios</a></li>
                    @endcan
                    @can('role-list')
                    <li><a tabindex="-1" href="{{ route('roles.index') }}">Gestión de Roles</a></li>
                    @endcan
                  </ul>
                </li> 