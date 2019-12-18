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
            <center><h2 class="tituloOrden">Nueva Orden de Pago</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-12 text-center">
                        <h2 class="tituloOrden">Seleccione el registro correspondiente:</h2>
                    </div>
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="table-responsive">
                          <div class="box">
                                <div class="box-header">
                                <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                            @if(count($Registros) >= 1)
                                <br>
                                <table class="display" id="tabla_Registros">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-hashtag"></i></th>
                                        <th class="text-center">Objeto</th>
                                        <th class="text-center">Tercero</th>
                                        <th class="text-center hidden">NIT/CED</th>
                                        <th class="text-center">Valor Total</th>
                                        <th class="text-center">Saldo Disponible</th>
                                        <th class="text-center hidden">Valor</th>
                                        <th class="text-center hidden">Valor</th>
                                        <th class="text-center hidden">iva</th>
                                        <th class="text-center hidden">ValorTot</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Registros as $key => $data)
                                        <tr onclick="ver('col{{$data->id}}','Obj{{$data->objeto}}','Name{{$data->persona->nombre}}','Cc{{$data->persona->num_dc}}','Sal{{$data->saldo}}','Val{{$data->valor}}','Iva{{$data->iva}}','ValTo{{ $data->val_total}}');" style="cursor:pointer">
                                            <td id="col{{$data->id}}" class="text-center">{{ $data->id }}</td>
                                            <td id="Obj{{$data->objeto}}" class="text-center">{{ $data->objeto }}</td>
                                            <td id="Name{{$data->persona->nombre}}" class="text-center">{{ $data->persona->nombre }}</td>
                                            <td id="Cc{{$data->persona->num_dc}}" class="text-center hidden">{{ $data->persona->num_dc }}</td>
                                            <td class="text-center">$<?php echo number_format($data->val_total,0) ?></td>
                                            <td class="text-center">$<?php echo number_format($data->saldo,0) ?></td>
                                            <td id="Sal{{$data->saldo}}" class="text-center hidden">{{ $data->saldo }}</td>
                                            <td id="Val{{$data->valor}}" class="text-center hidden">{{ $data->valor }}</td>
                                            <td id="Iva{{$data->iva}}" class="text-center hidden">{{ $data->iva }}</td>
                                            <td id="ValTo{{$data->val_total}}" class="text-center hidden">{{ $data->val_total}}</td>
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

                               </div><!-- /.box-body -->
                             </div><!-- /.box -->


                          </div>
                        </div>
                    </div>


                    <div class="col-md-12 " style="display: none; background-color: white" id="form" name="form">
                      <div class="row">
                        
                        <div class="col-md-5 formularioRegistro">
                            <br>
                            <h2 class="text-center  formularioRegistoTitulo">Registro</h2>
                            <hr>
                                <div class="row">
                                    
                                    <div class="col-md-3 ">
                                        <h4 class="formularioRegistoLabel"><b>Objeto:</b></h4>
                                    </div>

                                    <div class="col-md-9">
                                        <textarea type="text" style="text-align: center" class="form-control formularioRegistoLabel" name="Objeto" id="Objeto" columns="20" rows="7" disabled></textarea>
                                    </div>

                                </div>


                            <div class="row">
                            <br>
                                <div class="col-md-3 ">
                                    <h4 class="formularioRegistoLabel"><b>Tercero:</b></h4>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" style="text-align: center" class="form-control formularioRegistoLabel" name="Name" id="Name" disabled>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="formularioRegistoLabel"><b>NIT/CED:</b></h4>
                                </div>

                                <div class="col-md-9">
                                    <input type="number" style="text-align: center" 
                                    class="form-control formularioRegistoLabel" name="CC" id="CC" disabled>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-7 ">
                                    <h4 class="formularioRegistoLabel"><b>Valor Registro:</b></h4>
                                </div>

                                <div class="col-md-5">
                                    <input type="number" style="text-align: center" class="form-control formularioRegistoLabel" name="ValRegistro" id="ValRegistro" disabled>
                                </div>
                            </div>


                            <div class="row">
                                    <div class="col-md-7 ">
                                        <h4 class="formularioRegistoLabel"><b>IVA:</b></h4>
                                    </div>
                                 
                                    <div class="col-md-5">
                                        <input type="number" style="text-align: center" class="form-control formularioRegistroLabel" name="iva" id="iva" disabled>
                                    </div>
                            </div>


                            <div class="row">
                                <div class="col-md-7 ">
                                    <h4 class="formularioRegistoLabel"><b>Valor Total del Registro:</b></h4>
                                </div>
                               
                                <div class="col-md-5">
                                    <input type="number" style="text-align: center" class="form-control formularioRegistoLabel" name="Val" id="Val" disabled>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-7 ">
                                    <h4 class="formularioRegistoLabel"><b>Saldo del Registro:</b></h4>
                                </div>
                                
                                <div class="col-md-5">
                                    <input type="number" style="text-align: center" class="form-control formularioRegistoLabel" name="ValS" id="ValS" disabled>
                                </div>
                            </div>

                        </div>
                        
                  

                        <div class="col-md-2"><div class="row"><br></div></div>

                        <div class="col-md-5 formularioOrden">
                            <br>
                            <h2 class="text-center formularioOrdenTitulo">Orden de Pago</h2>
                            <hr>


                            <div class="row">
                                <div class="col-md-6 ">
                                    <br>
                                    <h4 class="formularioOrdenLabel"><b>Orden de Pago No:</b></h4>
                                </div>
                            <div class="col-md-6">
                                <br>
                                <input type="number" style="text-align: center" class="form-control formularioOrdenLabel" value="{{ $numOP + 1 }}" disabled name="num_OP">
                                <input type="hidden"  class="form-control" name="IdR" id="IdR">
                            </div>
                            </div>

                            <br> <br>
                            <div class="row">
                            <div class="col-md-3">
                                <h4 class="formularioOrdenLabel"><b>Fecha:</b></h4>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="fecha" style="text-align: center" class="form-control formularioOrdenLabel" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-md-3">
                                <h4 class="formularioOrdenLabel"><b>Concepto:</b></h4>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control formularioOrdenLabel" id="concepto" name="concepto" rows="5" required></textarea>
                            </div>
                            </div>
                            <br>

                            <div class="row">
                            <div class="col-md-7">
                                <h4 class="formularioOrdenLabel"><b>Valor Orden de Pago sin IVA:</b></h4>
                            </div>
                            <div class="col-md-5">
                                <input type="number" style="text-align: center" class="form-control formularioOrdenLabel" name="ValOP" id="ValOP" required onchange="sumar()">
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-md-7 ">
                                <h4 class="formularioOrdenLabel"><b>Valor IVA:</b></h4>
                            </div>
                            <div class="col-md-5">
                                <input type="number" style="text-align: center" class="form-control formularioOrdenLabel" name="ValIOP" id="ValIOP" required onchange="sumar()">
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-md-7">
                                <h4 class="formularioOrdenLabel"><b>Valor Total Orden de Pago:</b></h4>
                            </div>
                            <div class="col-md-5">
                                <input type="number" style="text-align: center" class="form-control formularioOrdenLabel" name="ValTOP" id="ValTOP" required>
                            </div>
                            </div>
                        </div>

                   </div>
                        
                      
                            <input type="hidden" class="form-control" name="estado" value="0">
                           
                            <center>
                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto">
                                    <br>
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
             language: {
			  "lengthMenu": "Mostrar _MENU_ registros",
			  "zeroRecords": "No se encontraron resultados",
			  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			  "sSearch": "Buscar:",
			  "oPaginate": {
				  "sFirst": "Primero",
				  "sLast":"Último",
				  "sNext":"Siguiente",
				  "sPrevious": "Anterior"
			   },
			   "sProcessing":"Procesando...",
		  },
	  //para usar los botones   
      "pageLength": 5,
      responsive: "true",
	  dom: 'Bfrtilp',       
	  buttons:[ 
			  {
			  extend:    'copyHtml5',
			  text:      '<i class="fa fa-clone"></i> ',
			  titleAttr: 'Copiar',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'excelHtml5',
			  text:      '<i class="fa fa-file-excel-o"></i> ',
			  titleAttr: 'Exportar a Excel',
			  className: 'btn btn-success'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX',
			  header :true,
              	exportOptions: {
				  columns: [ 0,1,2,3,4]
					},
			  pageSize: 'LEGAL',
			  className: 'btn btn-danger',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info'
		  },
	  ]	             

		 });

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

        function ver(col, Obj, Name, CC, Val, ValTo, Iva, Sal){
            content = document.getElementById(col);
            var Obj = document.getElementById(Obj);
            var Name = document.getElementById(Name);
            var CC = document.getElementById(CC);
            var Sal = document.getElementById(Sal);
            var Val = document.getElementById(Val);
            var ValTo = document.getElementById(ValTo);
            var Iva = document.getElementById(Iva);
            var data = content.innerHTML;
             
            if (data) {
                $("#form").show();
                $("#Objeto").val(Obj.innerHTML);
                $("#Name").val(Name.innerHTML);
                $("#CC").val(CC.innerHTML);
                $("#Val").val(Sal.innerHTML);
                $("#ValOP").val(ValTo.innerHTML);
                $("#ValRegistro").val(ValTo.innerHTML);
                $("#iva").val(Iva.innerHTML);
                $("#ValIOP").val(Iva.innerHTML);
                $("#IdR").val(content.innerHTML);
                $("#ValTOP").val(Sal.innerHTML);
                $("#ValS").val(Val.innerHTML);
                  
                document.getElementById("concepto").focus(); 
                
               } else {
                $("#form").hide();
            }
            
        }

        function sumar() {

            var num1 = document.getElementById("ValOP").value;
            var num2 = document.getElementById("ValIOP").value;

            var resultado = parseInt(num1) + parseInt(num2);
            document.getElementById("ValTOP").value = resultado;
        }


    </script>
@stop
