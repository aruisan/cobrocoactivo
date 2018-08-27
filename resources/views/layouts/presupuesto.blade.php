<!DOCTYPE html>
<html lang="en">
<head>
    <title>Presupuesto</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/presupuesto.ico') }}"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/helper.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('css')

</head>
<body class="fix-header fix-sidebar">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    <div class="header">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ asset('/presupuesto') }}">
                    <b><img src="{{ asset('img/presupuesto/2.png') }}" alt="homepage" class="dark-logo" /></b>
                    <span>Presupuesto</span>
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                </ul>
                <ul class="navbar-nav my-lg-0">
                    <!-- Search -->
                    <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search here"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                    </li>
                    <!-- Comment -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                            <ul>
                                <li>
                                    <div class="drop-title">Notifications</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <a href="#">
                                            <div class="btn btn-danger btn-circle m-r-10"><i class="fa fa-link"></i></div>
                                            <div class="mail-contnet">
                                                <h5>This is title</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="btn btn-success btn-circle m-r-10"><i class="ti-calendar"></i></div>
                                            <div class="mail-contnet">
                                                <h5>This is another title</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="btn btn-info btn-circle m-r-10"><i class="ti-settings"></i></div>
                                            <div class="mail-contnet">
                                                <h5>This is title</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="btn btn-primary btn-circle m-r-10"><i class="ti-user"></i></div>
                                            <div class="mail-contnet">
                                                <h5>This is another title</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Messages -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted  " href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-envelope"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn" aria-labelledby="2">
                            <ul>
                                <li>
                                    <div class="drop-title">You have 4 new messages</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="{{ asset('img/presupuesto/1.png') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Michael Qin</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="{{ asset('img/presupuesto/1.png') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>John Doe</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="{{ asset('img/presupuesto/1.png') }}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Mr. John</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="{{ asset('img/presupuesto/1.png') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Michael Qin</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item dropdown"> <p class="nav-link">Deivith</p></li>
                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/presupuesto/1.png') }}" alt="user" class="profile-pic" /></a>
                        <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                            <ul class="dropdown-user">
                                <li><a href="#"><i class="ti-user"></i> Profile</a></li>
                                <li><a href="#"><i class="ti-wallet"></i> Balance</a></li>
                                <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                <li><a href="#"><i class="ti-settings"></i> Setting</a></li>
                                <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End header header -->
    <!-- Left Sidebar  -->
    <div class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li> <a href="{{ asset('/presupuesto') }}"><i class="fa fa-home"></i><span class="hide-menu">Inicio</span></a></li>
                    <li> <a href="{{ asset('/') }}"><i class="fa fa-angle-double-left"></i><span class="hide-menu">Salir</span></a></li>
                    <li class="nav-label">Presupuesto</li>
                    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-calendar-check-o"></i><span class="hide-menu">Vigencia Actual</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#">Ingresos</a></li>
                            <li><a href="{{ asset('/presupuesto') }}">Egresos</a></li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-edit"></i><span class="hide-menu">Cambiar Vigencia</span></a></li>
                    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-plus"></i><span class="hide-menu">Nuevo Presupuesto</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ asset('/vigencia/create/1') }}">Ingresos</a></li>
                            <li><a href="{{ asset('/vigencia/create/0') }}">Egresos</a></li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-edit"></i><span class="hide-menu">Editar Presupuesto</span></a></li>
                    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Usuarios</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ asset('/user') }}">Lista de Usuarios</a></li>
                            <li><a href="{{ asset('/user/create') }}">Crear Usuarios</a></li>
                        </ul>
                    </li>
                    <li> <a href="#"><i class="fa fa-server"></i><span class="hide-menu">Tabla de Retención</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="page-wrapper">
    @yield('contenido')
        <footer class="footer"><center> © 2018 All rights reserved. SIEX </center></footer>
    </div>
</div>
@yield('footer')
<script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/datatables-init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 @include('layouts/cuerpo/toastRequest')
 @yield('js')
</body>
</html>