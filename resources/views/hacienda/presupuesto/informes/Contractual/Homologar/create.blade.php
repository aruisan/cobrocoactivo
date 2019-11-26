@extends('layouts.dashboard')
@section('titulo')
    Añadir Código Contractual
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/presupuesto/informes/contractual/homologar') }}"><span class="hide-menu">Homologar</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Añadir Código Contractual</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered hover" id="tabla">
            <thead>
                <tr>
                    <th colspan="4" class="text-center">Códigos Contractuales Almacenados</th>
                </tr>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
            @foreach($codes as $value)
                <tr>
                    <td class="text-center">{{$value->id}}</td>
                    <td class="text-center">{{$value->code}}</td>
                    <td class="text-center">{{$value->name}}</td>
                    <td class="text-center">
                        <span class="badge badge-pill badge-danger">
                            @if($value->estado == "0")
                                Activado
                            @else
                                Desactivado
                            @endif
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    {!! Form::open(array('route' => 'homologar.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Código: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="code" required>
            </div>
            <small class="form-text text-muted">Código Contractual</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Nombre: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" required>
            </div>
            <small class="form-text text-muted">Nombre Contractual</small>
        </div>
    </div>
    <br>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-success btn-raised btn-lg">Añadir</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection
@section('js')
    <script>
        $('#tabla').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
    </script>
@stop