<li class="dropdown">
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
    SECRETARIA
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a tabindex="-1" href="{{url('/correspondencia')}}">Correspondencia</a></li>
    <li><a tabindex="-1" href="{{url('/archivo')}}">Archivo</a></li>
    <li><a tabindex="-1" href="{{url('/almacen')}}">Almacen</a></li>
    <li><a tabindex="-1" href="#">Boletines</a></li>
  </ul>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="#">
        CONTRATACIÓN
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="{{ url('/presupuesto') }}">
        PRESUPUESTO
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="#">
        ACUERDOS
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="#">
        ORDEN DEL DÍA
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
        COMISIONES
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><a tabindex="-1" href="#">Comisión del Plan</a></li>
        <li><a tabindex="-1" href="#">Comisión de Presupuesto</a></li>
        <li><a tabindex="-1" href="#">Comisión Administrativa</a></li>
        <li><a tabindex="-1" href="#">Comisiones Accidentales</a></li>
    </ul>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="#">
        CONCEJALES
    </a>
</li>
<li class="dropdown">
    <a class="btn btn-default btn-sm" href="#">
        MESA DIRECTIVA
    </a>
</li>
<li class="dropdown">
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="Configuración">
    <i class="fa fa-cogs" aria-hidden="true"></i>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li class="disabled"><a tabindex="-1" href="#">Configuración basica</a></li>
    <li><a tabindex="-1" href="{{ route('dependencias.index') }}">Gestión de Dependencias</a></li>
    <li><a tabindex="-1" href="{{ route('rutas.index') }}">Rutas</a></li>
    @can('funcionario-list')
    <li><a tabindex="-1" href="{{ route('funcionarios.index') }}">Gestión de Funcionarios</a></li>
    @endcan
    @can('role-list')
    <li><a tabindex="-1" href="{{ route('roles.index') }}">Gestión de Roles</a></li>
    @endcan
  </ul>
</li>