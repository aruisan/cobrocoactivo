@extends('layouts.dashboard')
@section('titulo')
    Creación de CDP
@stop
@section('sidebar')
    <li> <a href="{{ url('/presupuesto') }}" class="btn btn-success"><i class="fa fa-money"></i><span class="hide-menu">&nbsp; Presupuesto</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nuevo CDP</h2></center>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/presupuesto/cdp')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="nombre">Nombre <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="valor">Valor <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" name="valor">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="fecha">Fecha <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}" min="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="dependencias">Dependencias <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select name="dependencia_id" class="form-control">
                                    @foreach($dependencias as  $dependencia)
                                        <option value="{{ $dependencia->id }}">{{ $dependencia->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="ejecucion">Ejecución <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="ejecucion">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="saldo">Saldo <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" name="saldo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="rubro_id">Rubros <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select name="rubro_id" class="form-control">
                                    @foreach($rubros as  $rubro)
                                        <option value="{{ $rubro->id }}">{{ $rubro->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label text-right" for="observacion">Observación<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea name="observacion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="estado" value="0">
                    <center>
                        <div class="form-group row">
                            <div class="col-lg-12 ml-auto">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </center>
                            </form>
                        </div>
                    </div>
                </div>
    @stop
