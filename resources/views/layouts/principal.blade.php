<!DOCTYPE html>
<html lang="es">
<head>

    <title> SIEX - Providencia </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">

    <!-- DataTables CSS -->
    <link href="{{asset('/assets/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('/assets/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}">
     <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">

    <!-- Custom Fonts -->
 
    <!--   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">-->

<style type="text/css">
  
  .rojo{
    border: 1px solid red;
  }

   .amarillo{
    border: 1px solid yellow;
  }

   .azul{
    border: 1px solid blue;
  }

  #encabezado{
    height: 100%;
    width: 100%;
    position: relative;
   /* background-image: url('public/img/fondo2.jpeg');*/
    background-repeat: no-repeat;
    background-size:100% 100%;
    margin-bottom: 2%;
  }
  .text-white
  {
    color:white;
  }

   .text-black
  {
    color:black;
  }

  .text-principal
   {
    color:#009688;
  }

  .form_entrar
  {
          background-color: #009688;
          top: 20px;
          border-radius: 3%;
          border: 1px solid rgba(51,122,183,.5); 
          -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          }

.top-6{
    margin-top: 6%;
  }

.top-10{
    margin-top: 10%;
  }

  .btn-verde{
    background-color:#009688;
    border:solid 1px #009688;
    color:white;
  }


  .btn-primary {
    color: #fff;
    background-color :rgb(9,99,90);
    border-color: rgb(9,99,90);
}
  .btn-primary:hover{
      color:#0056b3;
      text-decoration:underline;
      background-color:transparent
  }

body{
    background-color: #def5f2;
    background-size:100%;
    background-repeat: no-repeat;
} 

#contenedor_buscar
{
  background-color:rgba(256,256,256,.7);
  padding:  3% 0px;
  border:1px solid #ababa6;;
    -webkit-box-shadow: -8px 12px 18px -6px rgba(0,0,0,0.75);
-moz-box-shadow: -8px 12px 18px -6px rgba(0,0,0,0.75);
box-shadow: -8px 12px 18px -6px rgba(0,0,0,0.75);
} 

.lema {
  /*position: absolute;*/
    width: 100%;
    height: 30px;
  background-color: rgb(9,99,90);
}

</style>
</head>

<white
      <!-- Navigation -->
  
    <nav class="navbar navbar-custom " style="background:rgb(9,99,90);">
        <div class="lema">
            <marquee><h4 class="text-center text-white">
                    Mesa Directiva: Presidente: Javier Rafael Rodriguez Archbold  - Primer Vicepresidente: Evis Livingston Howard  - Segundo Vicepresidente: Elsa Robinson Hawkins
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Mesa Directiva: Presidente: Javier Rafael Rodriguez Archbold  - Primer Vicepresidente: Evis Livingston Howard  - Segundo Vicepresidente: Elsa Robinson Hawkins
                </h4></marquee>
        </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="navPrincipal" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle" type="button" data-toggle="dropdown">
                            CONCEJO MUNICIPAL
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#modal-md" href="">Mesa Directiva</a></li>
                            <li><a data-toggle="modal" data-target="#modal-pres" href="">Presupuesto</a></li>
                            <!-- <li><a data-toggle="modal" data-target="#modal-rc" href="">Rendición de Cuentas</a></li> -->
                            <!-- <li><a data-toggle="modal" data-target="#modal-le" href="">Lista de Empleados</a></li> -->
                            <li><a data-toggle="modal" data-target="#modal-lc" href="">Lista de Concejales</a></li>
                            <li><a data-toggle="modal" data-target="#modal-boletines" href="">Boletines</a></li>
                        </ul>
                    </li>
                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle" type="button" data-toggle="dropdown">
                            ACUERDOS
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#modal-actas" href="">Actas</a></li>
                            <li><a data-toggle="modal" data-target="#modal-acuerdos" href="">Acuerdos</a></li>
                            <li><a data-toggle="modal" data-target="#modal-res" href="">Resoluciones</a></li>
                        </ul>
                    </li>
                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle" type="button" data-toggle="dropdown">
                            CONTRATACIÓN
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#modal-manualcon" href="">Manual de Contratación</a></li>
                            <li><a data-toggle="modal" data-target="#modal-adquisiciones" href="">Plan de Adquisiciones</a></li>
                            <!-- <li><a data-toggle="modal" data-target="#modal-pc" href="">Procesos de Contratación</a></li> -->
                        </ul>
                    </li>
                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle" type="button" data-toggle="dropdown">
                            SERVICIO AL CLIENTE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#modal-contacto" href="">Contactenos</a></li>
                            <!-- <li><a tabindex="-1" href="#">Información de Contactos</a></li> -->
                            <!-- <li><a tabindex="-1" href="#">Notificaciones</a></li> -->
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

                    <li class="page-scroll">
                      <a href="" class="btn btn-link text-white" data-toggle="modal" data-target="#modal-Politicas">POLITICAS</a>
                    </li>
                    @auth
                    <li class="page-scroll">
                        <a class="btn btn-link text-white" href="{{ url('/dashboard') }}">PLATAFORMA</a>
                    </li>
                    @else
                     <li class="page-scroll">
                        <a data-toggle="modal" class="btn btn-link text-white" data-target="#modal-ingresar">ENTRAR</a>
                    </li>
                    @endauth
                    <li class="page-scroll">
                        <a id="google_translate_element"></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->

    </nav>

          @include('alertas.errors')
          @include('alertas.success')
          @include('alertas.request')    
          @yield('contenido')
          @include('visitante.modal.ingresar')
          @include('visitante.modal.modals')
          @include('visitante.modal.presupuesto')

  <footer id="myFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 text-right">
                    <h5 class="text-center">Producto Elaborado Por</h5>
                </div>
                <div class="col-sm-2 text-left">
                    <a href="http://altaespecialidad.co/"><img src="{{ asset('/img/logo4.png') }}" width="90"/></a>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4 text-center" style="padding: 10px 0">
                    <a href="http://siex.com.co/"><img src="{{ asset('/img/logo3.png') }}" width="350"/></a>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2018 Copyright Derechos Reservados <a href="http://altaespecialidad.co/"> Alta Especialidad SAS</a> </p>
        </div>
    </footer>

 

   <!-- jQuery -->
    <script src="{{ asset('/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>

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
<script src="{{ asset('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit') }}"></script>
    
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function(){$('#myInput').focus(); });
    </script>
      <div id="fb-root"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'es',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>

      <script>

$(document).ready(function(){

  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });

    $('#tabla_presupuesto').DataTable( {
        responsive: true,
        "searching": false,
        "ordering": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_Actas').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_Proy').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_Acuerdos').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_Res').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_corrS').DataTable( {
        responsive: true,
        "searching": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );

    $('#tabla_PA').DataTable( {
        responsive: true,
        "searching": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );
});
</script>

</body>

</html>
