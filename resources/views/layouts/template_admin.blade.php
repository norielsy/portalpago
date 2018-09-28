<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Portal de Pagos </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/admin/bower_components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{ asset('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="{{ asset('public/admin/dist/css/timeline.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{ asset('public/admin/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <script>
        url='{{url()}}/'
    </script>
    <script src="{{ asset('public/js/jquery-1.8.3.min.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js')}}"> </script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/south-street/jquery-ui.css">
    <link href="{{ asset('public/css/fileinput.min.css')}}" rel="stylesheet">
    <script src="{{ asset('public/js/jquery-ui.min.js')}}"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('public/js/unslider-min.js')}}"> </script>
    <!-- jQuery -->
    <!--<script type="text/javascript" src="{{ asset('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>-->

    <script src="{{ asset('public/js/select2/select2.full.min.js')}}"></script>
    <link href="{{ asset('public/js/select2/select2.min.css')}}" rel="stylesheet">
    <script src="{{ asset('public/js/fileinput.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="{{ asset('public/admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="{{ asset('public/admin/dist/js/sb-admin-2.js')}}"></script>
    <script src="{{ asset('public/js/timer.js')}}"></script>
    <script src="{{ asset('public/js/validation.js')}}"></script>
    <script src="{{ asset('public/js/main.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/crear_usuario.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('public/js/html5shiv.js')}}">
    </script>
    <script src="{{ asset('public/js/respond.min.js')}}">
    </script>
    <![endif]-->

</head>

<body>
<input type="hidden" id="token_urf8881" name="_token" value="{{ csrf_token() }}" />
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ \Illuminate\Support\Facades\URL::action('Admin\AdminController@index')}}"><img src="{{ asset('public/images/logo_portaldepagos_verde.png')}}"></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  Bienvenido {{ \Illuminate\Support\Facades\Session::get('nombre') }}</i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{asset('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>

            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ \Illuminate\Support\Facades\URL::action('Admin\AdminController@index')}}"><i class="fa fa-dashboard fa-fw"></i> Escritorio</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Usuarios <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\UsuarioController@index')}}">Listado de usuarios</a>
                            </li>
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\UsuarioController@agregar')}}">Nuevo usuario</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-list-alt fa-fw"></i> Cobros <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\CobrosController@agregar')}}">
                                    Agregar Individual
                                </a>
                            </li>
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\CobrosController@agregar_nomina')}}">
                                    Agregar Nómina
                                </a>
                            </li>

                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Listado de Deudas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\DeudasController@pendientes')}}">Deudas pendientes de pago</a>
                            </li>
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\DeudasController@pagadas')}}">Deudas Pagadas</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <!--
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Listado de Cobros<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\CobrosController@pagadas')}}">Cobros pendientes depago</a>
                            </li>
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\CobrosController@pendientes')}}">Cobros pagados</a>
                            </li>
                        </ul>
                    </li>
                    -->
                    <li>
                        <a href="{{\Illuminate\Support\Facades\URL::action('Admin\PagosController@index')}}"><i class="fa fa-users fa-fw"></i> Pagos</a>

                    </li>
                    <li>
                        <a href="{{\Illuminate\Support\Facades\URL::action('Admin\HistorialController@index')}}">
                            <i class="fa fa-comments fa-fw"></i> Notificaciones
                        </a>
                            <!--
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\HistorialController@index')}}">Historial</a>
                            </li>
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::action('Admin\HistorialController@contenido')}}">Contenido</a>
                            </li>
                            -->
                    </li>
                    <li>
                        <a href="{{URL::action('Admin\PublicidadController@index')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Administración publicidad</a>
                    </li>

                    <li>
                        <a href="{{URL::action('Admin\ImagenPortalController@index')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Imagen Portal</a>
                    </li>

                    <li>
                        <a href="{{URL::action('Admin\RubrosController@index')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Rubro</a>
                    </li>

                    <li>
                        <a href="{{URL::action('Admin\BancosController@index')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Bancos</a>
                    </li>
                    <li>
                        <a href="{{URL::action('Admin\ComisionController@index')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Comision</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



</body>

</html>
