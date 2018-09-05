<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">



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
    background-color: #009688;
    border-color: #009688;
} 

body{
    background-color: #def5f2;
    color: #fff;
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
  background-color: rgba(0,0,0,.5);
}

</style>
</head>

<white
      <!-- Navigation -->
  
    <nav class="navbar navbar-custom " style="background:rgb(9,99,90);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navPrincipal">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <span class="text-white" href=""><img src="{{ asset('/img/escudoIslas.png') }}" width="40"/>&nbsp; Mas Por Las Islas</span>
    
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="navPrincipal" class="collapse navbar-collapse">
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
                    <li class="page-scroll">
                        <a class="btn btn-link text-white" href="{{ route('register') }}">REGISTRARSE</a>
                    </li>
                    @endauth
                    <li class="page-scroll">
                        <a href="" id="contactenos" class="btn btn-link text-white" data-toggle="modal" data-target="#modal-contactenos"><span>CONTACTENOS</span></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
        <div class="lema">
        <marquee><h4 class="text-center text-white">Bernardo Bent Alcalde Municipal
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Leri Aniseto Henry Taylor Presidente Concejo Municipal</h4></marquee>
        </div>
    </nav>
    

    <nav id="mainNav" class="navbar navbar-custom ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle pull-left btn btn-success" data-toggle="collapse" data-target="#navSecundario">
                    <span class="sr-only">Toggle navigation</span> Funciones <i class="fa fa-bars"></i>
                </button> 
            </div>
            <div id="navSecundario" class="collapse navbar-collapse">
                <div class="btn-group">
                  <button class="dropdown btn-verde">
                    <a href="" class="btn btn-verde btn-sm">Inicio</a>
                  </button>

                  <button class="dropdown btn-verde">
                      <a class="btn btn-verde btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Dependencias
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Despacho Alcalde</a></li>
                        <li><a tabindex="-1" href="#">Dirección Operativa</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Hacienda</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Desarrollo Comunitario</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Gobierno</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Planeación</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Educación</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Tránsito</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de Salud</a></li>
                        <li><a tabindex="-1" href="#">Secretaría de infraestructura</a></li>
                        <li><a tabindex="-1" href="#">Instituto Municipal de Turismo</a></li>
                        <li><a tabindex="-1" href="#">Instituto Municipal Prodesarrollo</a></li>
                        <li><a tabindex="-1" href="#">Serregionales</a></li>
                      </ul>
                  </button> 

                  <button class="dropdown btn-verde">
                      <a class="btn btn-verde btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Institucional
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Planes de Mejoramiento</a></li>
                        <li><a tabindex="-1" href="#">Banco de Proyectos</a></li>
                        <li><a tabindex="-1" href="#">Estados Financieros</a></li>
                        <li><a tabindex="-1" href="#">Presupuestos</a></li>
                        <li><a tabindex="-1" href="#">Rendición de cuentas</a></li>
                        <li><a tabindex="-1" href="#">Sistema de Gestión de Calidad</a></li>
                        <li><a tabindex="-1" href="#">Plan anticorrupción Municipal</a></li>
                        <li><a tabindex="-1" href="#">Eventos</a></li>
                        <li><a tabindex="-1" href="#">SIMI</a></li>
                      </ul>
                  </button> 

                  <button class="dropdown btn-verde">
                    <a href="" class="btn btn-verde btn-sm">Normatividad</a>
                  </button>

                  <button class="dropdown btn-verde">
                      <a class="btn btn-verde btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Publicaciones
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Nuestro Alcalde</a></li>
                        <li><a tabindex="-1" href="#">Formularios</a></li>
                        <li><a tabindex="-1" href="#">Informes Control Interno</a></li>
                        <li><a tabindex="-1" href="#">Estadísticas</a></li>
                        <li><a tabindex="-1" href="#">Prensa</a></li>
                        <li><a tabindex="-1" href="#">Galerías</a></li>
                      </ul>
                  </button> 

                   <button class="dropdown btn-verde">
                      <a class="btn btn-verde btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Contratación
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Manual de Contratación</a></li>
                        <li><a tabindex="-1" href="#">Procesos de contratación</a></li>
                        <li><a tabindex="-1" href="#">Plan de adquisiciones</a></li>
                        <li><a tabindex="-1" href="#">Remates y subastas</a></li>
                      </ul>
                  </button> 

                  <button class="dropdown btn-verde">
                      <a class="btn btn-verde btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        Servicio al Ciudadano
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Vivelab</a></li>
                        <li><a tabindex="-1" href="#">Canal digital</a></li>
                        <li><a tabindex="-1" href="#">Oportunidades</a></li>
                        <li><a tabindex="-1" href="#">lineas de emergencia</a></li>
                        <li><a tabindex="-1" href="#">lineas de atención al ciudadano</a></li>
                        <li><a tabindex="-1" href="#">Correo Institucional</a></li>
                        <li><a tabindex="-1" href="#">Notificaciones</a></li>
                      </ul>
                  </button>

                  <button class="dropdown btn-verde">
                    <a href="" class="btn btn-verde btn-sm">Comunas</a>
                  </button>

                  <button class="dropdown btn-verde">
                    <a href="" class="btn btn-verde btn-sm">Consejo Municipal</a>
                  </button>

                  <button class="dropdown btn-verde">
                    <a href="" class="btn btn-verde btn-sm">Personeria</a>
                  </button>  
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
          @include('alertas.errors')
          @include('alertas.success')
          @include('alertas.request')    
@yield('contenido')
@include('visitante.modal.ingresar')

  <footer id="myFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <h5 class="text-center">CONTACTENOS</h5>
                    <ul>
                        <li class="text-center"><h6><small class="text-white">Carrera 37A 29 56 El Poblado Medellin</small></h6></li>
                        <li class="text-center"><h6><small class="text-white">Cel 3208858086  -  3144836423  -  3176433198</small></h6></li>
                        <li class="text-center"><h6><small class="text-white">info@siex.com.co   /  Girardot@siex.com.co</small></h6></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h5 class="text-center">PORTAFOLIO</h5>
                    <ul>
                        <li class="text-center"><small>Nuestros productos</small></li>
                        <li class="text-center"><small>Mesa de ayuda</small></li>
                        <li class="text-center"><small>Chat en Linea</small></li>
                        <li class="text-center"><small>Soporte@siex.com.co</small></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h5 class="text-center">POLITICAS</h5>
                    <ul>
                        <li class="text-center"><small>Políticas del Municipio</small></li>
                        <li class="text-center"><small>Políticas de SIEX</small></li>
                        <li class="text-center"><small>Gobierno en Línea</small></li>
                        <li class="text-center"><small>Convenio SIEX</small></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h5 class="text-center">SEGURIDAD</h5>
                    <ul>
                        <li class="text-center"><small>Seguridad de Datos</small></li>
                        <li class="text-center"><small>Reserva de Expedientes</small></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h5 class="text-center">EMPLEADOS</h5>
                    <ul>
                        <li class="text-center"><small>Personal a cargo</small></li>
                        <li class="text-center"><small>Oferta laboral</small></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <div class="social-networks">
                        <a href="https://www.facebook.com/AlcaldiadeGirardot/" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.facebook.com/AlcaldiadeGirardot/" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.facebook.com/AlcaldiadeGirardot/" class="google"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <a class="" href="http://siex.com.co/"><img src="{{ asset('/img/logo3.png') }}" width="180"/></a>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2017 Copyright Derechos Reservados <a href="http://altaespecialidad.co/"> Alta Especialidad SAS</a> </p>
        </div>
    </footer>

 

   <!-- jQuery -->
    <script src="{{ asset('/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function(){$('#myInput').focus(); });
    </script>
      <div id="fb-root"></div>
      <script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

</body>

</html>
