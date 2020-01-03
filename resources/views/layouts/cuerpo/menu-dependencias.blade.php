
<li class="page-scroll ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown">
    SECRETARIA
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu">
      <li><a class="item-menu" tabindex="-1" href="{{url('/dashboard/correspondencia')}}">Correspondencia</a></li>
      <li><a class="item-menu" tabindex="-1" href="{{url('/dashboard/archivo')}}">Archivo</a></li>
      <li><a class="item-menu" tabindex="-1" href="{{url('/dashboard/boletines')}}">Boletines</a></li>
      <li><a class="item-menu" tabindex="-1" href="{{url('/dashboard/acuerdos')}}">Acuerdos</a></li>
   </ul>
</li>
{{-- 
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
--}}
<li >
   <a class="btn btn-default btn-sm item-menu" href="{{ url('/contractual') }}">
    CONTRATACIÓN
   </a>
</li>

<li class="dropdown ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown" data-submenu="">
   PRESUPUESTO
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu">
       <li><a class="item-menu" tabindex="-1" href="{{ url('/presupuesto') }}">Presupuesto Gastos 2019</a></li>
      
      <li class="dropdown-submenu">
         <a class="dropdown-item item-menu " href="#">Informes</a>
         <ul class="dropdown-menu">
            <li><a class="item-menu" href="#">Contractual</a></li>
            <li><a class="item-menu" href="#">FUT</a></li>
            <li><a class="item-menu" href="#">Comparativo (Ingresos-Gastos)</a></li>
         </ul>
      </li>
   
   </ul>
</li>
  

    

<li class="dropdown ">
   <a class="btn btn-default btn-sm item-menu" href="{{ url('/admin/ordenDia') }}">
   ORDEN DEL DÍA
   </a>
</li>

<li class="dropdown ">
   <a class="btn btn-default btn-sm item-menu" href="{{ url('/dashboard/concejales') }}">
   CONCEJALES
   </a>
</li>

<li class="dropdown ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown">
   CONTABILIDAD
   <span class="caret"></span>
   </a>

   <ul class="dropdown-menu">
      <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/retefuente')}}">Retención en la Fuente</a></li>
      
      <li class="dropdown-submenu">
         <a class="dropdown-item item-menu" href="#" >PUC</a>
         <ul class="dropdown-menu">
         <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/puc/pucIndex')}}">PUC Res. 3832 de 2019</a></li>
          
            <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/puc/pucIndexAct')}}">PUC de vigencia</a></li>
         </ul>
      </li>
     
      {{-- <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/puc')}}">PUC</a></li> --}}
      <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/impumuni')}}">Impuestos Municipales</a></li>
      <li><a class="item-menu" tabindex="-1" href="{{url('/administrativo/contabilidad/informes/lvl/1')}}">Informes</a></li>
   </ul>
</li>

<li class="dropdown ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown">
   TESORERIA
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu">
      <li><a class="item-menu" tabindex="-1" href="#">Comprobante de Ingresos</a></li>
      <li><a class="item-menu" tabindex="-1" href="#">Comprobante de Egresos</a></li>
      <li><a class="item-menu" tabindex="-1" href="#">Informes</a></li>
      <li><a class="item-menu" tabindex="-1" href="#">Bancos</a></li>
      <li><a class="item-menu" tabindex="-1" href="#">PAC</a></li>
   </ul>
</li>

<li class="dropdown ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown" data-submenu="">
   JURIDICA
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu">
      <li class="dropdown-submenu">
         <a class="dropdown-item item-menu" href="#" >Cobro Coactivo </a>
         <ul class="dropdown-menu">
            <li><a class="item-menu" href="#">Predial</a></li>
            <li><a class="item-menu" href="#">Industria y Comercio (ICA)</a></li>
            <li><a class="item-menu" href="#">Comparendos</a></li>
            <li><a class="item-menu" href="#">Convivencia</a></li>
            <li><a class="item-menu" href="#">Otros</a></li>
         </ul>
      </li>
      <li class="dropdown-submenu">
         <a class="dropdown-item item-menu " href="#">Demandas</a>
         <ul class="dropdown-menu">
            <li><a class="item-menu" href="#">Demandante</a></li>
            <li><a class="item-menu" href="#">Demandado</a></li>
            <li><a class="item-menu" href="#">Conciliaciones</a></li>
         </ul>
      </li>
      <li><a class="item-menu" tabindex="-1" href="#">Policivos</a></li>
   </ul>
</li>
  
<li class="dropdown ">
   <a class="btn btn-default btn-sm dropdown-toggle item-menu" type="button" data-toggle="dropdown" title="Configuración">
   <i class="fa fa-cogs" aria-hidden="true"></i>
   <span class="caret"></span>
   </a>
   <ul class="dropdown-menu">
      
      <li><a class="item-menu" id="google_translate_element"></a></li>
      
      <li class="disabled item-menu" ><a tabindex="-1" href="#">Configuración basica</a></li>
     
      <li><a class="item-menu" tabindex="-1" href="{{ route('dependencias.index') }}">Gestión de Dependencias</a></li>
     
      <li><a class="hidden"  tabindex="-1" href="{{ route('rutas.index') }}">Rutas</a></li>
     
      @can('funcionario-list')
      <li><a class="item-menu" tabindex="-1" href="{{ route('funcionarios.index') }}">Gestión de Funcionarios</a></li>
      @endcan
     
      @can('role-list')
      <li><a class="item-menu" tabindex="-1" href="{{ route('roles.index') }}">Gestión de Roles</a></li>
      @endcan
     
       @can('role-list')
      <li><a class="item-menu" tabindex="-1" href="{{ route('modulos.index') }}">Gestión de Modulos</a></li>
      @endcan
    
      <li><a class="item-menu" tabindex="-1" href="{{route('personas.index')}}">Terceros</a></li>
     
      <li><a class="item-menu" tabindex="-1" href="{{route('audits.index')}}">Logs</a></li>
   </ul>
</li>
 <li class="dropdown messages-menu">
               
                 @include('layouts.cuerpo.perfil') 
</li>

