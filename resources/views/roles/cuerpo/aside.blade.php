    <li class="dropdown">
      <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
          <i class="material-icons md-18">account_box</i> 
        Funcionarios
          <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li>
            <a href="{{route('funcionarios.index')}}" class="btn btn-primary"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
            <a href="{{route('funcionarios.create')}}" class="btn btn-primary"><i class="material-icons md-12ss">create</i> Crear</a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-success" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw "></i> 
                ROLES
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{route('roles.index')}}" class="btn btn-success"><i class="material-icons md-12ss">list</i> Ver </a>
            </li>
            <li>
                <a href="{{route('roles.create')}}" class="btn btn-success"><i class="material-icons md-12ss">create</i> Crear</a>
            </li>
        </ul>
    </li>