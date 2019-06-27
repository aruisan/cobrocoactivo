@extends('layouts.dashboard')
@section('titulo')
    Creación de PUC
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nuevo PUC</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/contabilidad/puc')}}" method="POST" enctype="multipart/form-data">
                    <br>
                    <hr>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-lg-4 col-form-label text-right" for="vigencia">Año de Vigencia <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" name="vigencia" min="2018" max="2100" value="2019">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 col-form-label text-right" for="niveles">Cantidad de Niveles <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" name="niveles" value="2" min="0">
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