<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('titulo')</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">

     <!-- Bootstrap Material Design -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/css/mdb.min.css" />

     <!-- Dropdown.js -->
    <!-- <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">-->

    <link rel="shortcut icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">

     <!-- DataTables CSS -->
    <link href="{{asset('/assets/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('/assets/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('/assets/sb-admin/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('/assets/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{asset('/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!--alertas con toast-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Mi Estilo -->
    <link href="{{asset('/css/miStilo.css')}}" rel="stylesheet" type="text/css">

    @yield('css')

    <style>
    .caption {
    position:absolute;
    top:0;
    right:0;
    background:rgba(66, 139, 202, 0.75);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;
    color:#fff !important;
    z-index:2;
}

.avatarThumbnail {
    position:relative;
    overflow:hidden;
}
 
.avatarCaption {
    position:absolute;
    top:0;
    right:0;
    background:rgba(66, 139, 202, 0.75);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;

    z-index:2;
}
 .avatarCaption button{
 	margin: 0;
 }

.avatarCaption .fa-cloud-upload,.avatarCaption .fa-user-circle{
	color:white;
}

.caption button {
	color: black;
}
    </style>


</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar  navbar-dark bg-default" role="navigation"  data-offset-top="100">
          <div class="container-fluid">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-dependencias">
                  <span class="sr-only">Toggle navigation</span>
                  <i class="fa fa-bars fa-2x text-white"></i>
                </button>
              </div><!--navbar-header-->                    

            <!-- /.navbar-header -->
              <div class="collapse navbar-collapse navbar-ex1-collapse" id="menu-dependencias">
                
                <ul class="nav navbar-nav btn-group">
                    @include('layouts.cuerpo.menu-dependencias')
                </ul>
                <ul class="nav navbar-nav navbar-right btn-group">
                  <li>
                    <a class="btn btn-danger btn-raised" data-toggle="modal" data-target="#modal-normas" title="NORMATIVIDAD">
                      <i class="fa fa-file-text" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('notificaciones.index')}}" class="btn btn-raised btn-primary" title="NOTIFICACIONES"><i class="fa fa-bell-o"></i>
                      @if ($count = Auth::user()->unreadnotifications->count())
                          <i class="fa fa-bell-o" aria-hidden="true">{{$count}}</i>
                      @endif
                    </a>
                  </li>  
                  <li class="dropdown">
                    @include('layouts.cuerpo.perfil')
                  </li>
                </ul>
              </div>
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
                <!-- /.sidebar-collapse -->
        </div>

        <div id="page-wrapper">
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

       

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/js/mdb.min.js"></script>

    <!-- Material Design for Bootstrap -->



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

    <!-- Translate-->
    <script src="{{ asset('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit') }}"></script>
    <script src="{{asset('js/myJs.js')}}"></script>
@yield('js')

</body>

</html>