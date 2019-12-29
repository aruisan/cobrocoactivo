@extends('layouts.dashboard')
@section('titulo')
    Creación de Presupuesto
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <i class="fa fa-calendar-check-o"></i>
            <span class="hide-menu">Vigencia Actual</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{ url('/presupuesto') }}" class="btn btn-primary">Ingresos</a>
            </li>
            <li>
                <a href="{{ url('/presupuestoIng') }}" class="btn btn-primary">Egresos</a>
            </li>
        </ul>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nuevo presupuesto de @if($id == 1) ingresos @else egresos @endif para la vigencia {{ $year }}</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/presupuesto/vigencia')}}" method="POST" enctype="multipart/form-data">
                    <br>
                    <hr>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-lg-4 col-form-label text-right" for="vigencia">Año de Vigencia <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="hidden" name="tipo" value="{{ $id }}">
                            <input type="number" class="form-control" disabled value="{{ $year }}">
                            <input type="hidden" class="form-control" name="vigencia" value="{{ $year }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 col-form-label text-right" for="niveles">Cantidad de Niveles <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" name="niveles" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label text-right" for="valor">Presupuesto Inicial <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" name="valor">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label text-right" for="decreto">Número de Decreto <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="decreto">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label text-right" for="fechaDecreto">Fecha Decreto <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="fecha" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label text-right" for="file">Anexar PDF</label>
                                    <div class="col-lg-6 fallback">
                                        <input name="file" class="form-control" type="file" class="form-control" accept="application/pdf" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12 ml-auto text-center">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    @stop
