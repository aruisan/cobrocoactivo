@extends('layouts.dashboard')
@section('titulo')
    Información del Rubro
@stop
@section('sidebar')
    <li> <a href="{{ url('/presupuesto') }}" class="btn btn-success"><i class="fa fa-money"></i><span class="hide-menu">&nbsp; Presupuesto</span></a></li>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor Total del Rubro</b></h4>
        </center>
        <div class="text-center">
            $ <?php echo number_format($valor,0);?>.00
        </div>
        <br>
            <center>
                <h4><b>Valor Disponible del Rubro</b></h4>
            </center>
        <div class="text-center">
            $ <?php echo number_format($valorDisp,0);?>.00
        </div>
        <br>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h2>{{ $rubro->name }}</h2></center>
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
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center">
        <hr>
        <center>
            <h3>Fuentes del Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaFuentesR">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Valor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fuentesR as  $fuentes)
                    <tr>
                        <td>{{ $fuentes->id }}</td>
                        <td>{{ $fuentes->font->code }}</td>
                        <td>{{ $fuentes->font->name }}</td>
                        <td class="text-center">$ <?php echo number_format($fuentes['valor'],0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 align-self-center" style="background-color: white">
        <br>
        <hr>
        <center>
            <h3>CDP's Asignados al Rubro</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaCDPs">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Valor Inicial</th>
                    <th class="text-center">Valor Disponible</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rubro->rubrosCdp as  $data)
                    <tr class="text-center">
                        <td>{{ $data->cdps->id }}</td>
                        <td>{{ $data->cdps->name }}</td>
                        <td>$ <?php echo number_format($data->cdps->valor,0);?>.00</td>
                        <td>$ <?php echo number_format( $data->cdps->saldo,0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaFuentesR').DataTable( {
                responsive: true,
                "searching": false,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tablaCDPs').DataTable( {
                responsive: true,
                "searching": false,
                "pageLength": 5,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
        } );
    </script>
@stop
