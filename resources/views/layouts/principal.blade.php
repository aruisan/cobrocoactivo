<!DOCTYPE html>
<html lang="es">
<head>

    <title> SIEX - Providencia </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link href="{{asset('/assets/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet"> 
    <link href="{{asset('/assets/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/footer.css') }}">

    <link rel="shortcut icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logoSiex.png') }}" type="image/x-icon">

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
      color: white;

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
          background-color: #efb827;
          top: 20px;
          border-radius: 3%;
          border: 1px solid #efb827; 
          -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.28);
          }

.btn-info {
background-color: rgb(149, 8, 8) !important;
border: rgb(149, 8, 8) !important;
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
    color: #fff !important;
    background-color: rgb(149, 8, 8)  !important;
    border-color: rgb(149, 8, 8)  !important;
}

  .btn-primary:hover {
      color:rgb(149, 8, 8)  !important; 
      background-color: #efb827 !important;
  }

body{
    background-color: #def5f2;
    background-size:100%;
    background-repeat: no-repeat;
} 

#contenedor_buscar
{
    margin-top:80px;
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
    background-color: rgb(149, 8, 8) !important;
   

}

.text-foo{
      color: rgb(149, 8, 8) !important;
}
.navegacion{
  background: rgb(149, 8, 8) !important;
  border-style: none;
-webkit-box-shadow: -2px 17px 13px -1px rgba(69,69,65,1);
-moz-box-shadow: -2px 17px 13px -1px rgba(69,69,65,1);
box-shadow: -2px 17px 13px -1px rgba(69,69,65,1);
position: fixed;
    top: 30;
    width: 100%;
    z-index: 1;
  
}

.navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: white;
}


.navbar-default .navbar-nav .open .dropdown-menu  {
background: rgb(149, 8, 8) !important;
}



.item-menu:focus, 
.item-menu:hover {
    text-decoration: none;
    background-color: #efb827 !important;
    color:rgb(149, 8, 8) !important;
}

.item-menu {
    text-decoration: none;
   background-color: rgb(149, 8, 8) !important;
   color: #fff !important;
   margin-left: 0px;
    margin-right: 0px;
    border: none;
    /*box-shadow: none;*/
    border-radius: unset;
    width: 100%;
}



</style>
</head>
<white>
      <!-- Navigation -->
  
    <div class="navbar navbar-custom navegacion" >
        

        <div class="lema">
            <marquee class="col-12">
              <h4 class="text-center text-white">
                    Mesa Directiva: Presidente: Léri Aniseto Henry Taylor  - Primer Vicepresidente: Evis Livingston Howard  - Segundo Vicepresidente: Elsa Robinson Hawkins
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Mesa Directiva: Presidente: Léri Aniseto Henry Taylor  - Primer Vicepresidente: Evis Livingston Howard  - Segundo Vicepresidente: Elsa Robinson Hawkins
                </h4>
              </marquee>
        </div>

<nav class="navbar navbar-default navegacion" role="navigation" >
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
 
          <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <i class="fa fa-bars fa-2x text-white"></i>
                </button>
              </div><!--navbar-header-->        

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav navbar-left">
      <li class="page-scroll ">
                        <a class="btn btn-primary text-white dropdown-toggle item-menu" type="button" data-toggle="dropdown">
                            CONCEJO MUNICIPAL
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-md" href="">Mesa Directiva</a></li>
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-pres" href="">Presupuesto</a></li>
                            <!-- <li><a data-toggle="modal" data-target="#modal-rc" href="">Rendición de Cuentas</a></li> -->
                            <!-- <li><a data-toggle="modal" data-target="#modal-le" href="">Lista de Empleados</a></li> -->
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-lc" href="">Lista de Concejales</a></li>
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-boletines" href="">Boletines</a></li>
                        </ul>
                    </li>




             <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle item-menu" type="button" data-toggle="dropdown">
                            ACUERDOS
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-actas" href="">Actas</a></li>
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-acuerdos" href="">Acuerdos</a></li>
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-res" href="">Resoluciones</a></li>
                        </ul>
                    </li>

                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle item-menu" type="button" data-toggle="dropdown">
                            CONTRATACIÓN
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-manualcon" href="">Manual de Contratación</a></li>
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-adquisiciones" href="">Plan de Adquisiciones</a></li>
                            <!-- <li><a data-toggle="modal" data-target="#modal-pc" href="">Procesos de Contratación</a></li> -->
                        </ul>
                    </li>


                    <li class="page-scroll">
                        <a class="btn btn-primary text-white dropdown-toggle item-menu" type="button" data-toggle="dropdown">
                            SERVICIO AL CLIENTE
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="item-menu" data-toggle="modal" data-target="#modal-contacto" href="">Contactenos</a></li>
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
                      <a href="" class="btn btn-link text-white item-menu" data-toggle="modal" data-target="#modal-Politicas">POLITICAS</a>
                    </li>
                    @auth
                    <li class="page-scroll">
                        <a class="btn btn-link text-white item-menu" href="{{ url('/dashboard') }}">PLATAFORMA</a>
                    </li>
                    @else
                     <li class="page-scroll">
                        <a data-toggle="modal" class="btn btn-link text-white item-menu" data-target="#modal-ingresar">ENTRAR</a>
                    </li>
                    @endauth
                    <li class="page-scroll">
                        <a id="google_translate_element"></a>
                    </li>
                </ul>
          




              </div>


            </nav>



      </div>

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
             
              <div class="col-sm-4 text-center" style="padding: 10px 0">
                    <a href="http://siex.com.co/"><img src="{{ asset('/img/logo3.png') }}" width="350"/></a>
                
                <p class="text-foo">© 2018 Copyright Derechos Reservados 
            <a class="text-foo" href="http://altaespecialidad.co/"> Alta Especialidad SAS</a> </p>
      
                </div>
               
    <div class="col-sm-4 text-center" >
                </div>

                   <div class="col-sm-3 ">
                    <h5 class="text-right text-foo">Producto Elaborado Por</h5>
                </div>
                <div class="col-sm-1 text-left"  style="padding: 10px 0">
                    <a href="http://altaespecialidad.co/"><img src="{{ asset('/img/logoOrigin.png') }}" width="90"/></a>
                </div>

            </div>
        </div>
        <div >
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
