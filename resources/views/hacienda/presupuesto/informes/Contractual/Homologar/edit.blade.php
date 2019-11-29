@extends('layouts.dashboard')
@section('titulo')
    Editar Código Contractual
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/presupuesto/informes/contractual/homologar') }}"><span class="hide-menu">Homologar</span></a></li>
@stop
@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="row">


                <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 ">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formularioContractual">

                        <div class="row">
                            <br>
                            <div class="col-lg-12 margin-tb">
                                <h2 class="text-center"> Editar Código Contractual</h2>
                            </div>
                        </div>


                    <div class="row inputCenter" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
                        <hr>
                        <br>
                        <form action="{{ asset('presupuesto/informes/contractual/homologar/'.$codigo->id) }}" method="POST"  class="form" enctype="multipart/form-data">
                            {!! method_field('PUT') !!}
                            {{ csrf_field() }}
                            @if( $codigo->rubro == null)
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <label>Código: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="code" value="{{ $codigo->code }}" required>
                                        </div>
                                        <small class="form-text text-muted">Código Contractual</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <label>Nombre: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="name" value="{{ $codigo->name }}" required>
                                        </div>
                                        <small class="form-text text-muted">Nombre Contractual</small>
                                    </div>
                                </div>
                                <div class="row"><div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3"></div></div>
                                <div class="row">
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <label>Estado: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                            <select class="form-control text-center" name="estado" required>
                                                <option value="0" @if ($codigo->estado == 0) selected @endif> Activado</option>
                                                <option value="1" @if ($codigo->estado == 1) selected @endif> Desactivado</option>
                                            </select>
                                        </div>
                                        <small class="form-text text-muted">Estado del Código Contractual</small>
                                    </div>
                                </div>
                                <div class="row"><div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3"></div></div>
                            @else
                                <div class="row"><div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3"></div></div>
                                <div class="row">
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <label>Estado: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                            <select class="form-control text-center" name="estado" required>
                                                <option value="0" @if ($codigo->estado == 0) selected @endif> Activado</option>
                                                <option value="1" @if ($codigo->estado == 1) selected @endif> Desactivado</option>
                                            </select>
                                        </div>
                                        <small class="form-text text-muted">Estado del Código Contractual</small>
                                    </div>
                                </div>
                                <div class="row"><div class="form-group col-xs-3 col-sm-3 col-md-3 col-lg-3"></div></div>
                            @endif
                        <br>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <button class="btn btn-success btn-raised btn-lg">Actualizar</button>
                        </div>
                        {!! Form::close() !!}
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <form action="{{ asset('/presupuesto/informes/contractual/homologar/'.$codigo->id) }}" method="post">
                                {!! method_field('DELETE') !!}
                                {{ csrf_field() }}
                                <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
                            </form>
                        </div>
                     </div>

                </div>


                <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 ">
                </div>
        </div>
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