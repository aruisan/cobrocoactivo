@extends('layouts.dashboard')
@section('titulo')
    Información del Rubro
@stop
@section('sidebar')
    <li> <a href="{{ url('/presupuesto') }}" class="btn btn-success"><i class="fa fa-money"></i><span class="hide-menu">&nbsp; Presupuesto</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>{{ $rubro->name }}</h2></center>
            <br>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Nombre:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $rubro->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Codigo Rubro:</label>
                            <div class="col-lg-6">
                                <input type="number" disabled class="form-control" style="text-align:center" name="valor" value="{{ $rubro->cod }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Subproyecto:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $rubro->SubProyecto->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Vigencia:</label>
                            <div class="col-lg-6">
                                <input type="number" disabled class="form-control" style="text-align:center" name="valor" value="{{ $rubro->vigencia->vigencia }}">
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Valor:</label>
                            <div class="col-lg-6">
                                <input type="number" disabled class="form-control" style="text-align:center" name="valor" value="{{ $rubro->cod }}">
                            </div>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center">
        <center>
            <h3>Fuentes del Rubro</h3>
        </center>
    <br>
    <div class="table-responsive">
        <br>
        <table class="table table-bordered" width="100%" id="tabla_FR">
            <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">valor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($fuentesR as  $fuentes)
                <tr>
                    <td>{{ $fuentes->id }}</td>
                    <td>{{ $fuentes->font->name }}</td>
                    <td class="text-center">$ <?php echo number_format($fuentes['valor'],0);?>.00</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @stop
@section('js')
    <script>
        $('#tabla_FR').DataTable( {
            responsive: true,
            "searching": false,
            "ordering": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
@stop
