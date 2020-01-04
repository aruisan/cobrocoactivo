 <!-- Modal Mesa Directiva -->
 <div class="modal fade" id="modal-md" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Mesa Directiva
                 </h4>
             </div>
             <div class="modal-body">
                 <li>Presidente: <b></b> </li> 
                Léri Aniseto Henry Taylor
                 <li>Vicepresidenta Primera: <b></b> </li>
                 {{-- Evis Livingston Howard --}}
                 <li>Vicepresidenta Segunda: <b> </b> </li>
                 {{-- Elsa Robinson Hawkins --}}
             </div>
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Rendición de Cuentas -->
 <div class="modal" id="modal-rc" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Rendición de Cuentas
                 </h4>
             </div>
             <div class="modal-body">
                 Archivo 1
                 <hr>
                 Archivo 2

             </div>
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Lista de Empleados -->
 <div class="modal" id="modal-le" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Lista de Empleados
                 </h4>
             </div>
             <div class="modal-body">
                 Archivo 1
                 <hr>
                 Archivo 2

             </div>
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Lista de Concejales -->
 <div class="modal fade" id="modal-lc" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Lista de Concejales
                 </h4>
             </div>
             {{-- @if(count($Concejales) > 0)
                 <div class="modal-body">
                     <div class="row">
                         @foreach ($Concejales as $key => $data)
                             <div class="col-lg-10">
                                 <h7>&nbsp;</h7>
                                 <h4 class="media-heading"><b>{{$data->persona['nombre']}}</b></h4>
                                 <p class="f-s-12">No C.C {{ $data->persona['num_dc'] }} </p>
                             </div>
                             <div class="col-lg-2">
                                 <img src="{{ asset('img/concejales/'.$data->persona['num_dc'].'.png')}}" class="card-img-top" width="100%">
                             </div>
                             <br>
                         @endforeach
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay concejales almacenados.
                     </div>
                 </div>
             @endif --}}
              <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay concejales almacenados.
                     </div>
                 </div>

                
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <!-- Modal Alcalde -->
 <div class="modal fade" id="modal-Al" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Alcaldía
                 </h4>
             </div>
             {{-- @if(count($Concejales) > 0)
                 <div class="modal-body">
                     <div class="row">
                         @foreach ($Concejales as $key => $data)
                             <div class="col-lg-10">
                                 <h7>&nbsp;</h7>
                                 <h4 class="media-heading"><b>{{$data->persona['nombre']}}</b></h4>
                                 <p class="f-s-12">No C.C {{ $data->persona['num_dc'] }} </p>
                             </div>
                             <div class="col-lg-2">
                                 <img src="{{ asset('img/concejales/'.$data->persona['num_dc'].'.png')}}" class="card-img-top" width="100%">
                             </div>
                             <br>
                         @endforeach
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay concejales almacenados.
                     </div>
                 </div>
             @endif --}}
             <div class="col-md-10 ">
                                 <h7>&nbsp;</h7>
                                  <br><br>
                                 <h4 class="media-heading text-center"><b>Alcalde: </b>Jorge Norberto Gari Hooke</h4>
                                 
                                 <br><br>
                             </div>

                
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- MODAL DE BOLETINES -->
 <div class="modal fade" id="modal-boletines" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Boletines
                 </h4>
             </div>
             @if(count($Boletines) > 0)
                <div class="modal-body">
                     <div class="table-responsive">
                         <table class="table table-hover table-bordered" align="100%" id="tabla_corrE">
                             <thead>
                             <tr>
                                 <th class="text-center">Ver</th>
                                 <th class="text-center">Nombre</th>
                                 <th class="text-center">Fecha del Documento</th>
                                 <th class="text-center">Consecutivo</th>
                                 <th class="text-center">Responsable</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach ($Boletines as $key => $data)
                                 <tr class="text-center">
                                     <td>
                                         <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                     </td>
                                     <td>{{ $data->id }}</td>
                                     <td>{{ $data->name }}</td>
                                     <td>{{ $data->ff_document }}</td>
                                     <td>{{ $data->cc_id }}</td>
                                     <td>{{ $data->user->name }}</td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>
                </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay boletines almacenados.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Acuerdos -->
 <div class="modal fade" id="modal-acuerdos" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Acuerdos
                 </h4>
             </div>
             @if(count($Acuerdos) > 0)
                 <div class="modal-body">
                     <div class="table-responsive">
                         <table class="table table-hover table-bordered" align="100%" id="tabla_Acuerdos">
                             <thead>
                             <tr>
                                 <th class="text-center">Ver</th>
                                 <th class="text-center">Fecha del Documento</th>
                                 <th class="text-center">Nombre</th>
                                 <th class="text-center">Consecutivo</th>
                                 <th class="text-center">Estado</th>
                                 <th class="text-center">Fecha de Salida</th>
                                 <th class="text-center">Comisión</th>
                                 <th class="text-center">Fecha 1er Debate</th>
                                 <th class="text-center">Fecha 2do Debate</th>
                                 <th class="text-center">Fecha de Aprobación</th>
                                 <th class="text-center">Fecha de Sanción</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach ($Acuerdos as $key => $data)
                                 <tr class="text-center">
                                     <td>
                                         <a href="{{Storage::url($data->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                     </td>
                                     <td>{{ $data->ff_document }}</td>
                                     <td>{{ $data->name }}</td>
                                     <td>{{ $data->cc_id }}</td>
                                     <td>
                                         @if($data->estado == "0")
                                             Pendiente
                                         @elseif($data->estado == "1")
                                             Aprobado
                                         @elseif($data->estado == "2")
                                             Rechazado
                                         @else
                                             Archivado
                                         @endif
                                     </td>
                                     <td>{{ $data->ff_salida }}</td>
                                     <td>{{ $data->comision->name }}</td>
                                     <td>{{ $data->ff_primerdbte }}</td>
                                     <td>{{ $data->ff_segundodbte }}</td>
                                     <td>{{ $data->ff_aprobacion }}</td>
                                     <td>{{ $data->ff_sancion }}</td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay acuerdos almacenados.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Actas -->
 <div class="modal fade" id="modal-actas" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Actas
                 </h4>
             </div>
             @if(count($Actas) > 0)
                 <div class="table-responsive">
                     <table class="table table-hover table-bordered" align="100%" id="tabla_Actas">
                         <thead>
                         <tr class="text-center">
                             <th>Ver</th>
                             <th>Fecha del Documento</th>
                             <th>Nombre</th>
                             <th>Consecutivo</th>
                             <th>Estado</th>
                             <th>Comisión</th>
                             <th>Fecha de Aprobación</th>
                         </tr>
                         </thead>
                         <tbody>
                         @foreach ($Actas as $key => $data3)
                             <tr class="text-center">
                                 <td>
                                     <a href="{{Storage::url($data3->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                 </td>
                                 <td>{{ $data3->ff_document }}</td>
                                 <td>{{ $data3->name }}</td>
                                 <td>{{ $data3->cc_id }}</td>
                                 <td>
                                     @if($data3->estado == "0")
                                         Pendiente
                                     @elseif($data3->estado == "1")
                                         Aprobado
                                     @elseif($data3->estado == "2")
                                         Rechazado
                                     @else
                                         Archivado
                                     @endif
                                 </td>
                                 <td>{{ $data3->comision->name }}</td>
                                 <td>{{ $data3->ff_aprobacion }}</td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay actas almacenadas.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Resoluciones -->
 <div class="modal fade" id="modal-res" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Resoluciones
                 </h4>
             </div>
             @if(count($Resoluciones) > 0)
                 <div class="modal-body">
                     <div class="table-responsive">
                         <table class="table table-hover table-bordered" align="100%" id="tabla_Res">
                             <thead>
                             <tr class="text-center">
                                 <th>Ver</th>
                                 <th>Fecha del Documento</th>
                                 <th>Fecha de Entrada</th>
                                 <th>Nombre</th>
                                 <th>Consecutivo</th>
                                 <th>Comisión</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach ($Resoluciones as $key => $data4)
                                 <tr class="text-center">
                                     <td>
                                         <a href="{{Storage::url($data4->resource->ruta)}}" target="_blank" title="Ver" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                     </td>
                                     <td>{{ $data4->ff_document }}</td>
                                     <td>{{ $data4->created_at }}</td>
                                     <td>{{ $data4->name }}</td>
                                     <td>{{ $data4->cc_id }}</td>
                                     <td>{{ $data4->comision->name }}</td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay resoluciones almacenadas.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Manual de Contratación -->
 <div class="modal fade" id="modal-manualcon" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Manuales de Contratación
                 </h4>
             </div>
             @if(count($ManualC) > 0)
                 <div class="modal-body">
                     <div class="table-responsive">
                         <table class="table table-hover table-bordered" align="100%" id="tabla_corrS">
                             <thead>
                             <tr>
                                 <th class="text-center">Ver</th>
                                 <th class="text-center">Fecha del Manual</th>
                                 <th class="text-center">Nombre</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach ($ManualC as $key => $manual)
                                 <tr class="text-center">
                                     <td>
                                         <a href="{{Storage::url($manual->resource->ruta)}}" target="_blank" title="Archivo" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                     </td>
                                     <td>{{ $manual->ff_document }}</td>
                                     <td>{{ $manual->name }}</td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay manuales de contratación almacenados.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Planes de Adquisiciones -->
 <div class="modal fade" id="modal-adquisiciones" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Planes de Adquisición
                 </h4>
             </div>
             @if(count($PlanA) > 0)
                 <div class="modal-body">
                     <div class="table-responsive">
                         <table class="table table-hover table-bordered" align="100%" id="tabla_PA">
                             <thead>
                             <tr>
                                 <th class="text-center">Ver</th>
                                 <th class="text-center">Fecha del plan</th>
                                 <th class="text-center">Nombre</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach ($PlanA as $key => $plan)
                                 <tr class="text-center">
                                     <td>
                                         <a href="{{Storage::url($plan->resource->ruta)}}" target="_blank" title="Archivo" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                     </td>
                                     <td>{{ $plan->ff_document }}</td>
                                     <td>{{ $plan->name}}</td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             @else
                 <div class="col-md-12 align-self-center">
                     <div class="alert alert-danger text-center">
                         Actualmente no hay planes de adquisición almacenados.
                     </div>
                 </div>
             @endif
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Procesos de Contratación -->
 <div class="modal fade" id="modal-pc" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Procesos de Contratación
                 </h4>
             </div>
             <div class="modal-body">
                 Archivo 1
                 <hr>
                 Archivo 2

             </div>
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Contactenos -->
 <div class="modal fade" id="modal-contacto" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title text-center">
                     Formulario de Contacto
                 </h4>
             </div>
             <div class="modal-body">
                 <div class="basic-form">
                     <form>
                         <div class="form-group">
                             <label>Correo Electronico</label>
                             <input type="email" class="form-control" placeholder="Email">
                         </div>
                         <div class="form-group">
                             <label>Nombres y Apellidos</label>
                             <input type="text" class="form-control" placeholder="Nombres y Apellidos">
                         </div>
                         <div class="form-group">
                             <label>Número de Celular</label>
                             <input type="number" class="form-control" placeholder="Telefono">
                         </div>
                         <center>
                             <button type="submit" class="btn btn-primary">
                                 Enviar
                                 <i class="fa fa-check-circle"></i>
                             </button>
                         </center>
                     </form>
                 </div>
             </div>
             <div class="modal-footer">
                 <div class="row">
                     <div class="col-sm-6 text-right">
                         <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">
                     </div>
                     <div class="col-sm-6 text-left">
                         <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>