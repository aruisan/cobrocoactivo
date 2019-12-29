<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('titulo')</title>

 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('/assets/adminLTE/bootstrap/css/bootstrap.min.css') }}">
   
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/assets/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme style -->
  
    <link rel="stylesheet" href="{{asset('/assets/adminLTE/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/assets/adminLTE/css/skins/_all-skins.min.css') }}">
  
    <link rel="shortcut icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">

     <!-- DataTables CSS -->
    
    <link href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link  rel="stylesheet"  href="{{asset('/assets/sb-admin/css/sb-admin-2.css')}}">

 
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/assets/adminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- Morris Charts CSS -->
    <link href="{{asset('/assets/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{asset('/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons"    rel="stylesheet">

    <!--alertas con toast-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Mi Estilo -->
    <link href="{{asset('/css/miStilo.css')}}" rel="stylesheet" type="text/css">

    <!-- Select 2 -->
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    
    <link href="https://cdn.datatables.net/v/bs-3.3.7/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/datatables.min.css" rel="stylesheet"/>

     <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
   
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
   
    {{-- <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
     <link href="{{asset('/assets/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
   
    <!-- DataTables Responsive CSS -->
    <link href="{{asset('/assets/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
  
    <!-- Bootstrap Material Design -->
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/css/mdb.min.css" /> --}}

     <!-- Dropdown.js -->
     {{-- <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{asset('/assets/adminLTE/style.css') }}">
    @yield('css')

    <style>


    </style>



</head>

<body style="display: flex">
    <div id="wrapper">
              <!-- Navigation -->
        <nav class="navbar  navbar-dark bg-default  fondo-menu" role="navigation"  data-offset-top="100">
          <div class="container-fluid">
         
          <div class="navbar-header">
             <header class="main-header fondo-menu">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">

           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                    <!-- Logo -->
                    <a href="http://siex.com.co/" class="logo fondo-menu">
                      <!-- mini logo for sidebar mini 50x50 pixels -->
                      <span class="logo-mini"><b>S</b>IEX</span>
                      <!-- logo for regular state and mobile devices -->
                      <span class="logo-lg"> <img src="{{ asset('/img/logoBlancoSiex.png') }}" width="90px"/></span>
                    </a>
                    </div>
 
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-9">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-dependencias">
                      <span class="sr-only">Toggle navigation</span>
                      <i class="fa fa-bars fa-2x "></i>
                    </button>
                             <br>
                                <br> <br>
                  </div>
             </div>
      </div>

                   </header>
              </div><!--navbar-header-->                    
       
            <!-- /.navbar-header -->
                  <div class="collapse navbar-collapse navbar-ex1-collapse fondo-menu" id="menu-dependencias">
                    
                        <ul class="nav navbar-nav navbar-left  fondo-menu">
                            @include('layouts.cuerpo.menu-dependencias')
                        </ul>

                  </div>

           
          </div>
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>


      
     


        <div class="navbar-default sidebar" role="navigation">
         
          <div class="sidebar-nav">
            <ul class="nav" id="side-menu">
              @yield('sidebar')     
            </ul>
          </div>
              
        </div>
  <!-- /.sidebar-collapse -->
        <div id="page-wrapper" class="fondo-wrapper">
         
          @include('alertas.request') 
          @yield('content')

        </div>
        <!-- /#page-wrapper -->
        {{-- modales--}}
        @include('modal.participantes')
        @include('modal.password')
        @include('administrativo.gestiondocumental.correspondencia.modals.modals')
        @include('administrativo.gestiondocumental.archivo.modals.modals')
        @include('administrativo.gestiondocumental.boletines.modals.modals')
        @include('administrativo.gestiondocumental.acuerdos.modals.modals')
  
  <footer id="myFooter">
   
            <div class="row">
             
              <div class="col-sm-12 col-md-4 text-center" style="padding: 5px 0">
                  
                
                <p class="text-foo">© 2018 Copyright Derechos Reservados 
            <a class="text-foo" href="http://altaespecialidad.co/"> Alta Especialidad SAS</a> </p>
      
                </div>
               
    <div class="col-sm-12 col-md-4 text-center" >
                </div>

                   <div class="col-sm-12 col-md-2 text-center" style="padding: 5px 0" >
                  
                    <h5 class=" text-foo">Producto Elaborado Por</h5>
                </div>
                <div class="col-sm-12 col-md-2 text-center"  style="padding: 5px 0">
                    <a href="http://altaespecialidad.co/"><img class="img-foo" src="{{ asset('/img/logoOrigin.png') }}"  /></a>
                </div>

      
        </div>
        <div >
              </div>
    </footer>
    </div>
    
    <!-- /#wrapper -->

<aside class="iconos-footer">
	<ul class="menu-footer">
	      
         
                
         <li class="social-item">
                 <span class="iconoNormatividad">  
                          <a data-toggle="modal" data-target="#modal-normas" title="NORMATIVIDAD">
                        <i class="fa fa-file-text text-white" style="padding-top:10px;"></i> </a>
                  </span>                           
                   
                  
               </li>  

              <!-- Notifications: style can be found in dropdown.less -->


              <li class="dropdown notifications-menu social-item">
                 <span class="iconoNotificaciones">  
                     <a href="{{route('notificaciones.index')}}"  class="btn btn-raised " title="NOTIFICACIONES">
                        <i class="fa fa-bell-o text-white"></i>
                  </span>
                                  @if ($count = Auth::user()->unreadnotifications->count())
                                    
                                    <span class="iconoNotificaciones">  
                                    <i class="fa fa-bell-o text-white" aria-hidden="true">{{$count}}</i>
                                    </span>
                                  
                                  @endif 
                            
                        </a>
                  
               </li>  
              
	</ul>
</aside><!-- .social-sharing -->





    <!-- Translate-->
    <script src="{{ asset('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit') }}"></script>
   
  <!-- jQuery 2.1.4 -->
    <script src="{{asset('/assets/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script> 

    <script src="{{asset('js/myJs.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    {{-- <script src="{{asset('/assets/adminLTE/bootstrap/js/bootstrap.min.js')}}"></script> --}}
    <script src="{{asset('/assets/adminLTE/script.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('/assets/adminLTE/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/assets/adminLTE/js/app.min.js')}}"></script>
    <!-- Select 2-->

    <script src="{{ asset('js/lib/select2/select2.min.js') }}"></script>
   

    <!-- DataTables -->
    <script src="{{ asset('/assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script> 

    <script src="{{ asset('/assets/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/js/mdb.min.js"></script>

     <!-- DataTables JavaScript -->
    <script src="{{asset('/assets/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    
    <!--data tables-->
   <script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script> 
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script> 
    

    <!--vue-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!--toast-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts/cuerpo/toastRequest')

    <!-- editor textarea -->
    <script src="{{asset('/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/assets/ckeditor/adapters/jquery.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('/assets/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('/assets/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('/assets/sb-admin/js/sb-admin-2.js')}}"></script>


     <!-- SlimScroll -->
    {{-- <script src="{{ asset('/assets/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script> --}}
    


    @yield('js')
    <script type="text/javascript">
   
    </script>

</body>

</html>