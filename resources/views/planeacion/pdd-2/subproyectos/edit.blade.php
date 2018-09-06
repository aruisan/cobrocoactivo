@extends('layouts.dashboard')
@section('titulo')
    SubProyectos Pdd
@stop
@section('sidebar')
    <li> <a href="{{ asset('/pdd/proyecto/'.$sub->proyecto_id) }}" class=" btn btn-primary" >Regresar</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Navegación</span>
            &nbsp
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ asset('/pdd') }}" class="btn btn-primary">Plan de Desarrollo</a></li>
            <li><a href="{{ asset('/pdd/data/create/'.$pdd->id) }}" class="btn btn-primary">Ejes y Programas</a></li>
            <li><a href="{{ asset('/pdd/proyecto/create/'.$pdd->id) }}" class="btn btn-primary">Proyectos</a></li>
        </ul>
    </li>
@stop
@section('content')
        <div class="col-md-12 align-self-center" id="crud">
            <center>
                <h2>Editar Subproyecto: {{ $sub->name }}</h2>
            </center>
            <br>
                <form action="{{ asset('/pdd/subproyecto/'.$sub->id) }}" method="POST"  class="form">
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <label class="control-label text-center col-md-4">Nombre</label>
                        <div class="col-md-8">
                            <input type="text" name="name" value="{{ $sub->name }}" style="text-align:center">
                        </div>
                        <br>&nbsp;<br>
                        <label class="control-label text-center col-md-4">Unidad de Medida</label>
                        <div class="col-md-8">
                            <input type="text" name="unidad_medida" value="{{ $sub->unidad_medida }}" style="text-align:center">
                        </div>
                        <br>&nbsp;<br>
                        <label class="control-label text-center col-md-4">Dependencia</label>
                        <div class="col-md-8">
                            <select name="dependencia_id" class="form-control">
                                @foreach($dep as $dependencia)
                                    <option value="{{ $dependencia->id }}" @if($sub->dependencia->id == $dependencia->id) selected @endif>{{ $dependencia->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <label class="control-label text-center col-md-4">Indicador</label>
                        <div class="col-md-8">
                            <input type="text" name="indicador" value="{{ $sub->indicador }}" style="text-align:center">
                        </div>
                        <br>&nbsp;<br>
                        <label class="control-label text-center col-md-4">Linea Base</label>
                        <div class="col-md-8">
                            <input type="text" name="linea_base" value="{{ $sub->linea_base }}" style="text-align:center">
                        </div>
                        <br>&nbsp;<br>
                        <label class="control-label text-center col-md-4">Tipo de Meta</label>
                        <div class="col-md-8">
                            <select name="tipo" class="form-control">
                                <option value="1" @if($sub->tipo == 1) selected @endif>Incremento</option>
                                <option value="2" @if($sub->tipo == 2) selected @endif>Mantenimiento</option>
                                <option value="3" @if($sub->tipo == 3) selected @endif>Reduccion</option>
                            </select>
                        </div>
                    </div>
                        <br>
                        <table class="table table-hover" id="tabla">
                            <thead style="background-color:#c6c8ca">
                            <th class="text-center">Nombre</th>
                            @foreach($sub->periodos as $pd)
                            <th class="text-center"><input type="hidden" name="pd[]" value="{{ $pd->id }}" >Año {{ $pd->periodo }}</th>
                            @endforeach
                            <th class="text-center">Cutrienio</th>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="text-dark">Meta Inicial</td>
                                @foreach($sub->periodos as $pd)
                                <td><input type="number" class="cuMi" name="mi[]" id="MI{{$pd->periodo}}" value="{{ $pd->metaInicial }}" style="text-align:center" required></td>
                                @endforeach
                                <td id="cuMi" class="text-center text-dark">0</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Modificación</td>
                                @foreach($sub->periodos as $pd)
                                <td><input type="number" class="cuMod" name="mod[]" id="MOD{{$pd->periodo}}" value="{{ $pd->modificacion }}" style="text-align:center" required></td>
                                @endforeach
                                <td id="cuMod" class="text-center text-dark">0</td>
                            </tr>
                            <tr>
                                <td class="text-dark">M. Definitiva</td>
                                @foreach($sub->periodos as $pd)
                                <td><input type="number" class="cuMd" name="md[]" id="MD{{$pd->periodo}}" value="{{ $pd->metaDefinitiva }}" style="text-align:center" required></td>
                                @endforeach
                                <td id="cuMd" class="text-center text-dark">0</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Valor Inicial</td>
                                @foreach($sub->periodos as $pd)
                                <td><input type="number" class="cuVi" name="vi[]" id="VI{{$pd->periodo}}" value="{{ $pd->valorInicial }}" style="text-align:center" required></td>
                                @endforeach
                                <td id="cuVi" class="text-center text-dark">0</td>
                            </tr>
                            </tbody>
                        </table>
                    <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                </form>
            </div>
    @stop

@section('js')
    <script>

        $(document).ready(function(){
            sumaMi();
            sumaMod();
            sumaMd();
            sumaVi();
        });

        $('.cuMi').change(function(){
            sumaMi();
        });

        $('.cuMod').change(function(){
            sumaMod();
        });

        $('.cuMd').change(function(){
            sumaMd();
        });

        $('.cuVi').change(function(){
            sumaVi();
        });

        function sumaMi(){
            val1 = $('#MI1').val(); 
            val2 = $('#MI2').val();
            val3 = $('#MI3').val(); 
            val4 = $('#MI4').val();          
            val1 = (val1 == null || val1 == undefined || val1 == "") ? 0 : val1; 
            val2 = (val2 == null || val2 == undefined || val2 == "") ? 0 : val2; 
            val3 = (val3 == null || val3 == undefined || val3 == "") ? 0 : val3;  
            val4 = (val4 == null || val4 == undefined || val4 == "") ? 0 : val4;  

            $('#cuMi').html( parseFloat(val1) + parseFloat(val2) + parseFloat(val3) + parseFloat(val4) );
        }

        function sumaMod(){
            val1 = $('#MOD1').val(); 
            val2 = $('#MOD2').val();
            val3 = $('#MOD3').val(); 
            val4 = $('#MOD4').val();          
            val1 = (val1 == null || val1 == undefined || val1 == "") ? 0 : val1; 
            val2 = (val2 == null || val2 == undefined || val2 == "") ? 0 : val2; 
            val3 = (val3 == null || val3 == undefined || val3 == "") ? 0 : val3;  
            val4 = (val4 == null || val4 == undefined || val4 == "") ? 0 : val4;  

            $('#cuMod').html( parseFloat(val1) + parseFloat(val2) + parseFloat(val3) + parseFloat(val4) );
        }

        function sumaMd(){
            val1 = $('#MD1').val(); 
            val2 = $('#MD2').val();
            val3 = $('#MD3').val(); 
            val4 = $('#MD4').val();          
            val1 = (val1 == null || val1 == undefined || val1 == "") ? 0 : val1; 
            val2 = (val2 == null || val2 == undefined || val2 == "") ? 0 : val2; 
            val3 = (val3 == null || val3 == undefined || val3 == "") ? 0 : val3;  
            val4 = (val4 == null || val4 == undefined || val4 == "") ? 0 : val4;  

            $('#cuMd').html( parseFloat(val1) + parseFloat(val2) + parseFloat(val3) + parseFloat(val4) );
        }

        function sumaVi(){
            val1 = $('#VI1').val(); 
            val2 = $('#VI2').val();
            val3 = $('#VI3').val(); 
            val4 = $('#VI4').val();          
            val1 = (val1 == null || val1 == undefined || val1 == "") ? 0 : val1; 
            val2 = (val2 == null || val2 == undefined || val2 == "") ? 0 : val2; 
            val3 = (val3 == null || val3 == undefined || val3 == "") ? 0 : val3;  
            val4 = (val4 == null || val4 == undefined || val4 == "") ? 0 : val4;  

            $('#cuVi').html( parseFloat(val1) + parseFloat(val2) + parseFloat(val3) + parseFloat(val4) );
        }
    </script>
    @stop