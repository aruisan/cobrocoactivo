@extends('layouts.dashboard')
@section('titulo')
    Creación Orden de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos') }}" class="btn btn-success">
            <span class="hide-menu">Ordenes de Pago</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nueva Orden de Pago</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-12 text-center">
                        <h2>Seleccione el registro correspondiente:</h2>
                    </div>
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="table-responsive">
                            @if(count($Registros) >= 1)
                                <br>
                                <table class="display" id="tabla_Registros">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-hashtag"></i></th>
                                        <th class="text-center">Objeto</th>
                                        <th class="text-center">Tercero</th>
                                        <th class="text-center hidden">NIT/CED</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center hidden">Valor</th>
                                        <th class="text-center hidden">Valor</th>
                                        <th class="text-center hidden">iva</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Registros as $key => $data)
                                        <tr onclick="ver('col{{$data->id}}','Obj{{$data->objeto}}','Name{{$data->persona->nombre}}','Cc{{$data->persona->num_dc}}','Val{{$data->saldo}}','ValTo{{$data->valor}}','Iva{{$data->iva}}');" style="cursor:pointer">
                                            <td id="col{{$data->id}}" class="text-center">{{ $data->id }}</td>
                                            <td id="Obj{{$data->objeto}}" class="text-center">{{ $data->objeto }}</td>
                                            <td id="Name{{$data->persona->nombre}}" class="text-center">{{ $data->persona->nombre }}</td>
                                            <td id="Cc{{$data->persona->num_dc}}" class="text-center hidden">{{ $data->persona->num_dc }}</td>
                                            <td class="text-center">$<?php echo number_format($data->saldo,0) ?></td>
                                            <td id="Val{{$data->saldo}}" class="text-center hidden">{{ $data->saldo }}</td>
                                            <td id="ValTo{{$data->valor}}" class="text-center hidden">{{ $data->valor }}</td>
                                            <td id="Iva{{$data->iva}}" class="text-center hidden">{{ $data->iva }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <br>
                                <div class="alert alert-danger">
                                    <center>
                                        No hay Registros.
                                        <a href="{{ url('administrativo/registros/create') }}" class="btn btn-success btn-block">Crear Registro</a>
                                    </center>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12" id="form" name="form" style="display: none">
                        <hr>
                        <br>
                        <b>
                        <div class="col-md-3 text-center">
                            <h4><b>Orden de pago No.</b></h4>
                        </div>
                        <div class="col-md-3">
                            <input type="number" style="text-align: center" class="form-control" value="{{ $numOP + 1 }}" disabled name="num_OP">
                            <input type="hidden"  class="form-control" name="IdR" id="IdR">
                        </div>
                        <div class="col-md-2 text-center">
                            <h4><b>Fecha:</b></h4>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="fecha" style="text-align: center" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4><b>Objeto:</b></h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" style="text-align: center" class="form-control" name="Objeto" id="Objeto" disabled>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4><b>Concepto:</b></h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" style="text-align: center" class="form-control" name="concepto" required>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4><b>Tercero:</b></h4>
                        </div>
                        <div class="col-md-3">
                            <input type="text" style="text-align: center" class="form-control" name="Name" id="Name" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <h4><b>NIT/CED:</b></h4>
                        </div>
                        <div class="col-md-4">
                            <input type="number" style="text-align: center" class="form-control" name="CC" id="CC" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Disponible del Registro:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="number" style="text-align: center" class="form-control" name="Val" id="Val" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>IVA:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="number" style="text-align: center" class="form-control" required name="iva" id="iva" disabled>
                        </div>
                        <div class="col-md-2 text-center">
                            <br>
                            <h4><b>Valor Total del Registro:</b></h4>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="number" style="text-align: center" class="form-control" name="ValTo" id="ValTo" disabled>
                        </div>
                        </b>
                        <input type="hidden" class="form-control" name="estado" value="0">
                        <center>
                            <div class="form-group row">
                                <div class="col-lg-12 ml-auto">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
@section('js')
    <script type="text/javascript">
        $('#tabla_Registros').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 5
        } );

        $(document).ready(function() {
            var table = $('#tabla_Registros').DataTable();

            $('#tabla_Registros tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            $('#button').click( function () {
                table.row('.selected').remove().draw( false );
            } );
        } );

        function ver(col, Obj, Name, CC, Val, ValTo, Iva){
            content = document.getElementById(col);
            var Obj = document.getElementById(Obj);
            var Name = document.getElementById(Name);
            var CC = document.getElementById(CC);
            var Val = document.getElementById(Val);
            var ValTo = document.getElementById(ValTo);
            var Iva = document.getElementById(Iva);
            var data = content.innerHTML;
            if (data) {
                $("#form").show();
                $("#Objeto").val(Obj.innerHTML);
                $("#Name").val(Name.innerHTML);
                $("#CC").val(CC.innerHTML);
                $("#Val").val(Val.innerHTML);
                $("#ValTo").val(ValTo.innerHTML);
                $("#iva").val(Iva.innerHTML);
                $("#IdR").val(content.innerHTML);
            } else {
                $("#form").hide();
            }
        }


    </script>
@stop
