<li class="dropdown">
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
    SECRETARIA
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a tabindex="-1" href="{{url('/dashboard/correspondencia')}}">Correspondencia</a></li>
    <li><a tabindex="-1" href="{{url('/dashboard/archivo')}}">Archivo</a></li>
    <li><a tabindex="-1" href="{{url('/dashboard/boletines')}}">Boletines</a></li>
    <li><a tabindex="-1" href="{{url('/dashboard/acuerdos')}}">Acuerdos</a></li>
  </ul>
</li>
<li class="dropdown">
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
    Cobro Coactivo
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a tabindex="-1" href="{{url('/predios')}}">Predial</a></li>
    <li><a tabindex="-1" href="{{url('/personas')}}">Personas</a></li>

  </ul>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="{{ url('/contractual') }}">
        CONTRATACIÓN
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="{{ url('/presupuesto') }}">
        PRESUPUESTO
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="{{ url('/admin/ordenDia') }}">
        ORDEN DEL DÍA
    </a>
</li>

<li class="dropdown">
    <a class="btn btn-default btn-sm" href="{{ url('/dashboard/concejales') }}">
        CONCEJALES
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        CONTABILIDAD
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a tabindex="-1" href="{{url('/administrativo/contabilidad/retefuente')}}">Retención en la Fuente</a></li>
        <li><a tabindex="-1" href="{{url('/administrativo/contabilidad/puc')}}">PUC</a></li>
        <li><a tabindex="-1" href="{{url('/administrativo/contabilidad/impumuni')}}">Impuestos Municipales</a></li>
        <li><a tabindex="-1" href="{{url('/administrativo/contabilidad/informes/lvl/1')}}">Informes</a></li>
    </ul>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        TESORERIA
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a tabindex="-1" href="#">Comprobante de Ingresos</a></li>
        <li><a tabindex="-1" href="#">Comprobante de Egresos</a></li>
        <li><a tabindex="-1" href="#">Informes</a></li>
        <li><a tabindex="-1" href="#">Bancos</a></li>
        <li><a tabindex="-1" href="#">PAC</a></li>
    </ul>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        Juridica
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-submenu">
            <a class="test" href="#">Cobro Coactivo <span class="fa fa-caret-right"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Predial</a></li>
                <li><a href="#">Industria y Comercio (ICA)</a></li>
                <li><a href="#">Comparendos</a></li>
                <li><a href="#">Convivencia</a></li>
                <li><a href="#">Otros</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a class="test" href="#">Demandas <span class="fa fa-caret-right"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Demandante</a></li>
                <li><a href="#">Demandado</a></li>
                <li><a href="#">Conciliaciones</a></li>
            </ul>
        </li>
        <li><a tabindex="-1" href="#">Policivos</a></li>
    </ul>
</li>
<li class="dropdown">
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="Configuración">
    <i class="fa fa-cogs" aria-hidden="true"></i>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a id="google_translate_element"></a></li>
      <li class="disabled"><a tabindex="-1" href="#">Configuración basica</a></li>
    <li><a tabindex="-1" href="{{ route('dependencias.index') }}">Gestión de Dependencias</a></li>
    <li><a class="hidden" tabindex="-1" href="{{ route('rutas.index') }}">Rutas</a></li>
    @can('funcionario-list')
    <li><a tabindex="-1" href="{{ route('funcionarios.index') }}">Gestión de Funcionarios</a></li>
    @endcan
    @can('role-list')
    <li><a tabindex="-1" href="{{ route('roles.index') }}">Gestión de Roles</a></li>
    @endcan
    <li><a tabindex="-1" href="{{route('personas.index')}}">Terceros</a></li>
    <li><a tabindex="-1" href="{{route('audits.index')}}">Logs</a></li>
  </ul>
</li>