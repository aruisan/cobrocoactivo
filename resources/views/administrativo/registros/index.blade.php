@extends('layouts.dashboard')
@section('titulo')
    Registros
@stop
@section('sidebar')
    @include('administrativo.registros.cuerpo.aside')
    <li>
        <a href="{{ url('/administrativo/cdp') }}" class="btn btn-primary">
            <i class="fa fa-file"></i>
            <span class="hide-menu"> CDP's</span></a>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/almacen') }}" class="btn btn-primary">
            <i class="fa fa-inventory"></i>
            <span class="hide-menu">Almacen</span></a>
    </li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <br>
            <h2 class="text-center">Registros</h2>
        <br>
        <hr>
    </div>
</div>
@if(count($registros) > 0)
    <table class="table table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nombre Registro</th>
            <th class="text-center">Nombre Tercero</th>
            <th class="text-center">Nombre CDP</th>
            <th class="text-center">Archivo</th>
            <th class="text-center">Acciones</th>
        </tr>
        @foreach ($registros as $key => $data)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">{{ $data->objeto }}</td>
                <td class="text-center">{{ $data->persona->nombre }}</td>
                <td class="text-center">{{ $data->cdp->name }}</td>
                <td class="text-center">{{ $data->ruta }}</td>
                <td class="text-center">
                    @if($rol == 2)
                        @if($data->secretaria_e == 0)
                            <a href="{{url('/administrativo/registros/'.$data->id.'/'.$rol.'/3')}}" title="Finalizar" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ url('administrativo/registros/'.$data->id.'/edit') }}" class="btn btn-sm btn-info" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['registros.destroy', $data->id],'style'=>'display:inline']) !!}
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        @elseif($data->secretaria_e == 3)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                            {!! Form::close() !!}
                        @endif
                    @elseif($rol == 3)
                        @if($data->secretaria_e == 0)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jcontratacion_e == 3 or $data->jcontratacion_e == 1)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @else
                            <a href="{{url('/administrativo/registros/'.$data->id.'/'.$rol.'/3')}}" title="Aprobar" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    @elseif($rol == 4)
                        @if($data->secretaria_e == 0)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jcontratacion_e == 0 or $data->jcontratacion_e == 1)
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @elseif($data->jpresupuesto_e == 0)
                            <a href="{{url('administrativo/registros/'.$data->id.'/'.$rol.'/3')}}" title="Aprobar" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                            @else
                            <a href="{{ url('administrativo/registros',$data->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $registros->render() !!}
@else
    <div class="col-md-12 align-self-center">
        <div class="alert alert-danger text-center">
            Actualmente no hay registros creados, se recomienda crearlos.
        </div>
    </div>
@endif
@endsection
@section('js')
    <script>
        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });
    </script>
@endsection