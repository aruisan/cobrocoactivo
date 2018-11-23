@extends('layouts.dashboard')
@section('titulo')
	Proyectos Pdd
@stop
@section('sidebar')
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
	<li> <a data-toggle="modal" data-target="#subProyectoModal" class="btn btn btn-primary"><i class="fa fa-plus"></i><span class="hide-menu">&nbsp;Nuevo SubProyecto</span></a></li>
@stop
@section('content')
	<div class="col-md-12 align-self-center">
		<center>
			<h2>Proyecto: {{ $proyecto->name }}</h2>
		</center>
		<br>
		@if( count($proyecto->subProyectos) == null )
			<div class="alert alert-danger">
				<center>
					Actualmente el proyecto {{ $proyecto->name }} no dispone de ningun subproyecto. Se recomienda crearlos.
				</center>
			</div>
		@else
		<center><h3>Sub Proyectos</h3></center>
            <br>
            <div class="table-responsive" id="crud">
                <table id="tabla_subPr" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Linea base</th>
                        <th class="text-center">Indicador</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Unidad de Medida</th>
                        <th class="text-center">Dependencia</th>
                        <th class="text-center"><i class="fa fa-pencil-square-o"></i></th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proyecto->subProyectos as $data)
                        <tr>
                            <td class="text-center">{{ $data->name }}</td>
                            <td class="text-center">{{ $data->linea_base }}</td>
                            <td class="text-center">{{ $data->indicador }}</td>
                            <td class="text-center">@if($data->tipo == 1) Incremento @elseif($data->tipo == 2) Mantenimiento @else Reducción @endif</td>
                            <td class="text-center">{{ $data->unidad_medida }}</td>
                            <td class="text-center">{{ $data->dependencia->name}}</td>
                            <td class="text-center" style="vertical-align:middle;"><a href="{{ url('/pdd/subproyecto/'.$data->id.'/edit') }}" class="btn-sm btn-success"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-center">
                                <button type="button" class="btn-sm btn-danger" v-on:click.prevent="eliminarDatos({{ $data->id }})" >
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
    </div>
    @include('planeacion.pdd.subproyectos.create')
@stop