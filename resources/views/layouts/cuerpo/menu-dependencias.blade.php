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
  <a class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" title="Configuración">
    <i class="fa fa-cogs" aria-hidden="true"></i>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a id="google_translate_element"></a></li>
      <li class="disabled"><a tabindex="-1" href="#">Configuración basica</a></li>
    <li><a tabindex="-1" href="{{ route('dependencias.index') }}">Gestión de Dependencias</a></li>
    <li><a tabindex="-1" href="{{ route('rutas.index') }}">Rutas</a></li>
    @can('funcionario-list')
    <li><a tabindex="-1" href="{{ route('funcionarios.index') }}">Gestión de Funcionarios</a></li>
    @endcan
    @can('role-list')
    <li><a tabindex="-1" href="{{ route('roles.index') }}">Gestión de Roles</a></li>
    @endcan
    <li><a tabindex="-1" href="{{route('personas.index')}}">Terceros</a></li>
  </ul>
</li>