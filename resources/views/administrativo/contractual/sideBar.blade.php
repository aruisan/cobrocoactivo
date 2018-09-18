<li class="dropdown">
    <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
        <span class="hide-menu">Presupuesto</span>
        &nbsp;
        <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="{{ url('/presupuesto/rubro') }}" class="btn btn-primary">Rubros</a>
        </li>
        <li>
            <a href="{{ url('/administrativo/cdp') }}" class="btn btn-primary">CDP's</a>
        </li>
        <li>
            <a href="{{ url('/administrativo/registros') }}" class="btn btn-primary">Registros</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
        <span class="hide-menu">Contratación</span>
        &nbsp;
        <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="{{ route('contractual.index') }}" class="btn btn-primary">Contractuales</a>
        </li>
        <li>
            <a href="{{ route('contractual.create') }}" class="btn btn-primary">Nuevo Contractual</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
        <span class="hide-menu">Almacen</span>
        &nbsp;
        <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="#" class="btn btn-primary">Requisiciones</a>
        </li>
    </ul>
</li>

