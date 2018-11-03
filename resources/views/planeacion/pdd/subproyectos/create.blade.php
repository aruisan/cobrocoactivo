<!-- Modal -->
<div class="modal fade in" id="subProyectoModal" tabindex="-1"  role="dialog" aria-labelledby="subProyectoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-lg">
        <div class="container-fluid" id="crud">
            <form action="/pdd/subproyecto" method="POST"  class="form">
                <div class="modal-body">
                    <div class="row page-titles">
                        <div class="col-md-2 align-self-center">
                            <center>1q
                                <button class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </center>
                        </div>
                        <div class="col-md-8 align-self-center">
                            <center>
                                <h2>Creación de Subproyecto</h2>
                            </center>
                        </div>
                        <div class="col-md-2 align-self-center">
                            <center>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </center>
                        </div>
                    </div>
                    <br>&nbsp;<br>
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control"  name="proyecto_id" value="{{ $proyecto->id }}">
                    <div class="col-md-12 align-self-center">
                        <div class="col-md-6 align-self-center">
                            <div class="form-group">
                                <label class="control-label text-center col-md-4">Nombre</label>
                                <div class="col-md-8">
                                    <input type="text" name="name">
                                </div>
                            </div>
                            <br>&nbsp;<br>
                            <div class="form-group">
                                <label class="control-label text-center col-md-4">Unidad Medida</label>
                                <div class="col-md-8">
                                    <input type="text" name="unidad_medida">
                                </div>
                            </div>
                            <br>&nbsp;<br>
                            <label class="control-label text-center col-md-4">Dependencia</label>
                            <div class="col-md-8 text-center">
                                <select name="dependencia_id">
                                    @foreach($dep as $dependencia)
                                        <option value="{{ $dependencia->id }}">{{ $dependencia->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <label class="control-label text-center col-md-4">Indicador</label>
                            <div class="col-md-8">
                                <input type="text" name="indicador">
                            </div>
                            <br>&nbsp;<br>
                            <label class="control-label text-center col-md-4">Linea Base</label>
                            <div class="col-md-8">
                                <input type="text" name="linea_base">
                            </div>
                            <br>&nbsp;<br>
                                <label class="control-label text-center col-md-4">Tipo Meta</label>
                                <div class="col-md-8 text-center">
                                    <select name="tipo">
                                        <option value="1">Incremento</option>
                                        <option value="2">Mantenimiento</option>
                                        <option value="3">Reduccion</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <br>&nbsp;<br>
                    <table class="table table-bordered" id="tabla">
                                <thead style="background-color:#c6c8ca">
                                <th class="text-center">Nombre</th>
                                <th class="text-center"><input type="hidden" name="pd[]" value="1" >Año 1</th>
                                <th class="text-center"><input type="hidden" name="pd[]" value="2" >Año 2</th>
                                <th class="text-center"><input type="hidden" name="pd[]" value="3" >Año 3</th>
                                <th class="text-center"><input type="hidden" name="pd[]" value="4" >Año 4</th>
                                <th class="text-center">Cutrienio</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-dark">Meta Inicial</td>
                                    <td><input type="number" class="cuMi" name="mi[]" id="MI1" required></td>
                                    <td><input type="number" class="cuMi" name="mi[]" id="MI2" required></td>
                                    <td><input type="number" class="cuMi" name="mi[]" id="MI3" required></td>
                                    <td><input type="number" class="cuMi" name="mi[]" id="MI4" required></td>
                                    <td id="cuMi" class="text-center text-dark">0</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Modificación</td>
                                    <td><input type="number" class="cuMod" name="mod[]" id="MOD1" required></td>
                                    <td><input type="number" class="cuMod" name="mod[]" id="MOD2" required></td>
                                    <td><input type="number" class="cuMod" name="mod[]" id="MOD3" required></td>
                                    <td><input type="number" class="cuMod" name="mod[]" id="MOD4" required></td>
                                    <td id="cuMod" class="text-center text-dark">0</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">M. Definitiva</td>
                                    <td><input type="number" class="cuMd" name="md[]" id="MD1" required></td>
                                    <td><input type="number" class="cuMd" name="md[]" id="MD2" required></td>
                                    <td><input type="number" class="cuMd" name="md[]" id="MD3" required></td>
                                    <td><input type="number" class="cuMd" name="md[]" id="MD4" required></td>
                                    <td id="cuMd" class="text-center text-dark">0</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Valor Inicial</td>
                                    <td><input type="number" class="cuVi" name="vi[]" id="VI1" required></td>
                                    <td><input type="number" class="cuVi" name="vi[]" id="VI2" required></td>
                                    <td><input type="number" class="cuVi" name="vi[]" id="VI3" required></td>
                                    <td><input type="number" class="cuVi" name="vi[]" id="VI4" required></td>
                                    <td id="cuVi" class="text-center text-dark">0</td>
                                </tr>
                                </tbody>
                    </table>
                </div>
            </form>
        </div>

            
    </div>
  </div>
</div>

@section('js')
    <script>
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






















