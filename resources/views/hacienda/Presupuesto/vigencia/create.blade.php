@extends('layouts.presupuesto')
@section('contenido')

    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{url('/vigencia')}}" method="POST" enctype="multipart/form-data">
                                <center><h2>Nuevo Presupuesto de @if($tipo == 1) Ingresos @else Egresos @endif</h2></center>
                                <hr>
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="vigencia">Año de Vigencia <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="tipo" value="{{ $tipo }}">
                                        <input type="number" class="form-control" name="vigencia" min="2018" max="2100" value="2018">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="niveles">Cantidad de Niveles <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" name="niveles" value="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="valor">Presupuesto Inicial <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" name="valor">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="decreto">Número de Decreto <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="decreto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="fechaDecreto">Fecha Decreto <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" name="fecha" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 text-center" for="file">Anexar PDF</label>
                                    <div class="col-lg-12 fallback">
                                        <input name="file" type="file" class="form-control" accept="application/pdf" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
