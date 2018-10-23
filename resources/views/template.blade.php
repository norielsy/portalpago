<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="google-site-verification" content="6zJdx8QnvAtr7ThkKs_RxIx_7wUCP4e_99D5piHokbg"/>
    <link rel="shortcut icon" href="img/favicon.png">
    <title>
    @yield('title') </title>
    <script type="text/javascript">
        /*window.onload = function(){
     var scroll = localStorage.getItem("scrolls");
     document.body.scrollTop = document.documentElement.scrollTop = 100;
     //window.scrollTo(0,scroll);
 }*/
 var url = '{{asset("/")}}';
</script>

<link rel="stylesheet" href="">
<!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
<!--<link href="css/bootstrap-reset.css" rel="stylesheet">-->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

<!--external css-->
<link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/flexslider.css')}}"/>
<link href="{{ asset('assets/bxslider/jquery.bxslider.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/animate.css')}}">
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/owl.theme.css')}}">

<link href="{{ asset('css/superfish.css')}}" rel="stylesheet" media="screen">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->


<!-- Custom styles for this template -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/component.css')}}">
<link href="{{ asset('css/style.css')}}" rel="stylesheet">
<link href="{{ asset('css/style-responsive.css')}}" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="{{ asset('css/parallax-slider/parallax-slider.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/unslider/unslider.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/unslider/unslider-dots.css')}}"/>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113362821-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-113362821-1');
</script>

<script src="{{ asset('js/jquery-1.8.3.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/unslider-min.js')}}"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/south-street/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{ asset('js/select2/select2.full.min.js')}}"></script>
<link href="{{ asset('js/select2/select2.min.css')}}" rel="stylesheet">

<script src="{{ asset('js/validation.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/parallax-slider/modernizr.custom.28468.js')}}">
</script>

<!-- archivos para nuevo slider -->
<script src="{{ asset('js/plugins.js')}}"></script>
<script src="{{ asset('vendors/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{ asset('js/pageview/revusliderpages.js')}}"></script>

<link href="{{ asset('vendors/rs-plugin/css/settings.css')}}" rel="stylesheet">
<link href="{{ asset('vendors/animation/animated.css')}}" rel="stylesheet">
<link href="{{ asset('vendors/animation/animate.min.css')}}" rel="stylesheet">
<link href="{{ asset('vendors/animation/animate.css')}}" rel="stylesheet">
<link href="{{ asset('css/fileinput.min.css')}}" rel="stylesheet">

<script type="text/javascript">

    $(document).ready(function () {
        $('#myCarousel').carousel({
            interval: 4000
        });

        var clickEvent = false;
        $('#myCarousel').on('click', '.nav a', function () {
            clickEvent = true;
            $('.nav li').removeClass('active');
            $(this).parent().addClass('active');
        }).on('slid.bs.carousel', function (e) {
            if (!clickEvent) {
                var count = $('.nav').children().length - 1;
                var current = $('.nav li.active');
                current.removeClass('active').next().addClass('active');
                var id = parseInt(current.data('slide-to'));
                if (count == id) {
                    $('.nav li').first().addClass('active');
                }
            }
            clickEvent = false;
        });
    });
</script>
<script type="text/javascript" src="{{ asset('js/validaciones/validation_cambiar_password.js')}}"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js')}}">
    </script>
    <script src="{{ asset('js/respond.min.js')}}">
    </script>
<![endif]-->
</head>
<body>
    <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}"/>
    <div class="loading2-bg loading2"></div>
    <div class="loading2-load loading2">
        Por favor espera, estamos procesando tu solicitud <br/>
        <img src="{{asset('images/loading.gif')}}" alt="loading...">
    </div>

    <?php $menu_activado_tpl = 9999; ?>
    <?php if (isset($menu_activado)) {
        $menu_activado_tpl = $menu_activado;
    } ?>

    <!--header start-->
    <header class="head-section">

        <nav class="navbar navbar-default">
            <div class="container-fluid head-container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if(Auth::check())
                <a class="navbar-brand" href="{{asset('dashboard')}}">
                    <img class="img-responsive" src="{{ asset('images/logo_portaldepagos_verde.png')}}">
                </a>
                @else
                <a class="navbar-brand" href="{{asset('/')}}">
                    <img class="img-responsive" src="{{ asset('images/logo_portaldepagos_verde.png')}}">
                </a>
                @endif
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                    <li class="welcome">
                        <div class="bienvenido">
                            Bienvenid@ <strong>{{ Session::get('nombre') }}</strong>
                        </div>
                        <br>
                        <div class="no-margin lastlog">
                            <span>Último acceso: {{\App\Extras\Utilidades::ImprimirFechaHora(Session::get('ultimo_acceso'))}}
                            h</span>
                        </div>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="p_mi_cuenta" href="javascript:;">
                            Mis datos
                        </a>
                    </li>
                    <li @if($menu_activado_tpl == 4) class="active hidden-lg hidden-md"
                    @endif class="hidden-lg hidden-md hidden-sm">
                    <a href="{{asset('/faq')}}">
                        Ayuda
                    </a>
                </li>
                <li class="hidden-lg hidden-md hidden-sm">
                    <a class="cambiarpwd">Cambiar Clave</a>
                </li>
                <li class=" hidden-lg hidden-md hidden-sm">
                    <a class="verde" href="{{asset('logout')}}">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                    </a>
                </li>

                <li class="dropdown hidden-xs ">
                    <a class="dropdown-toggle menubar" data-close-others="false" data-delay="0"
                    data-hover="dropdown" data-toggle="dropdown" href="{{ asset('consultar')}}"><i
                    class="fa fa-bars" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="p_mi_cuenta" href="javascript:;">
                                Mis datos
                            </a>
                        </li>
                        {{--<li @if($menu_activado_tpl == 3) class="active" @endif>
                            <a href="{{asset('/cobradores')}}">
                                Gestionar Usuarios
                            </a>
                        </li>--}}
                        <li @if($menu_activado_tpl == 4) class="active" @endif>
                            <a href="{{asset('/faq')}}">
                                Ayuda
                            </a>
                        </li>
                        {{--@if(isset($activar_cobrar) && isset($vista) && $activar_cobrar == 1)
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Cuentas</a>
                                <ul class="dropdown-menu fix-top menu-left">
                                    <li @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0) class="active disabled" @endif>
                                        <a tabindex="-1" href="#" data-id-vista="0">Principal</a>
                                    </li>
                                    @if(count($vista) > 0)
                                    @foreach($vista as $k => $vist)
                                    <li @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == $k) class="active disabled" @endif>
                                        <a tabindex="-1" href="#" data-id-vista="{{$k}}">{{$vist}}</a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </li>
                            @endif--}}
                            <li>
                                <a class="cambiarpwd">Cambiar Clave</a>
                            </li>
                            <li>
                                <a class="verde" href="{{asset('logout')}}">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                Salir</a>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a class="btn-bg send-click" href="{{ asset('cuentas-pagar')}}">Quiero Pagar</a>
                    </li>
                    <li>
                        <a class="btn-bg send-click" href="{{ asset('cuentas-cobrar')}}">Quiero Cobrar</a>
                    </li>
                    <li>
                        <a class="btn-bg send-click" href="{{ asset('consultar')}}">Pagos Pendientes</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="btn-bg" href="{{ asset('registro')}}">Regístrate ahora</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="btn-bg send-click-menu" href="{{asset('dashboard')}}">Ingresar</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="btn-bg send-click-menu" href="{{ asset('faq')}}">Necesito Ayuda</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="btn-bg send-click-menu" href="{{ asset('quienes-somos')}}">Acerca de nosotros</a>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a class="btn-bg send-click-menu" href="{{ asset('contacto')}}">Contáctanos</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle menubar hidden-xs" data-close-others="false" data-delay="0"
                        data-hover="dropdown" data-toggle="dropdown" href="{{ asset('consultar')}}"><i
                        class="fa fa-bars" aria-hidden="true"></i></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ asset('registro')}}" class="send-click-menu">Regístrate ahora</a>
                            </li>
                            <li>
                                <a href="{{asset('dashboard')}}" class="send-click-menu">Ingresar</a>
                            </li>
                            <li>
                                <a href="{{ asset('faq')}}" class="send-click-menu">Necesito Ayuda</a>
                            </li>
                            <li>
                                <a href="{{ asset('quienes-somos')}}" class="send-click-menu">Acerca de nosotros</a>
                            </li>
                            <li>
                                <a href="{{ asset('contacto')}}" class="send-click-menu">Contáctanos</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


<!--
    <div class="navbar navbar-default navbar-static-top container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{asset('/')}}"><img
                        src="{{ asset('images/logo_portaldepagos_verde.png')}}"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(Auth::check())
    <li class="bienvenido">Bienvenid@ <strong>{{ Session::get('nombre') }}</strong></li>
                    <li class="no-margin lastlog">
                        <span>Último acceso: {{\App\Extras\Utilidades::ImprimirFechaHora(Session::get('ultimo_acceso'))}}
            h</span></li>
@else
    <li>
        <a class="btn-bg" href="{{ asset('cuentas-pagar')}}">Quiero Pagar</a>
                    </li>
                    <li>
                        <a class="btn-bg" href="{{ asset('cuentas-cobrar')}}">Quiero Cobrar</a>
                    </li>
                    <li>
                        <a class="btn-bg" href="{{ asset('consultar')}}">Pagos Pendientes</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle menubar" data-close-others="false" data-delay="0"
                           data-hover="dropdown" data-toggle="dropdown" href="{{ asset('consultar')}}"><i
                                    class="fa fa-bars" aria-hidden="true"></i></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ asset('registro')}}">Regístrate ahora</a>
                            </li>
                            <li>
                                <a href="{{ asset('faq')}}">Necesito Ayuda</a>
                            </li>
                            <li>
                                <a href="{{ asset('quienes-somos')}}">Acerca de nosotros</a>
                            </li>
                            <li>
                                <a href="{{ asset('contacto')}}">Contáctanos</a>
                            </li>
                        </ul>
                    </li>
                @endif
        </ul>
    </div>
</div>
-->
</header>
<!--header end-->

@if (Auth::check())

@include('logueado.mi_cuenta')
@yield('mi_cuenta')

@include('logueado.datos_pago')
@yield('cuenta_bancaria')

<input type="hidden" id="token_urf8881" name="_token" value="{{ csrf_token() }}"/>
<!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <ol class="breadcrumb">
                    <li @if($menu_activado_tpl == 1) class="active hidden-lg hidden-md hidden-sm "
                    @endif class="hidden-lg hidden-md hidden-sm">
                    <a class="btn-bg" href="{{ URL::action('PagarController@inicio')}}">Quiero Pagar</a>
                </li>
                <li @if($menu_activado_tpl == 1) class="active dropdown hidden-xs" @endif class="hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">Quiero pagar <span class="caret"></span></a>
                    <ul class="dropdown-menu menu-main">
                        <li>
                            <a href="{{ URL::action('PagarController@inicio')}}" class="sub-li">Resumen de
                            Pagos</a>
                        </li>
                        <li><a href="{{asset('cuentas-por-pagar')}}" class="sub-li">Pagos Pendientes</a></li>
                        <li><a href="{{asset('cuentas-por-pagar/pagadas')}}" class="sub-li">Pagos Realizados</a>
                        </li>
                    </ul>
                </li>
                <li @if($menu_activado_tpl == 2) class="active hidden-lg hidden-md hidden-sm "
                @endif class="hidden-lg hidden-md hidden-sm">
                <a class="btn-bg" href="{{ URL::action('CobrarController@indexCobro')}}">Quiero Cobrar</a>
            </li>
            <li @if($menu_activado_tpl == 2) class="active dropdown hidden-xs" @endif class="hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Quiero cobrar <span class="caret"></span></a>
                <ul class="dropdown-menu  menu-main">
                    <li>
                        <a href="{{ URL::action('CobrarController@indexCobro')}}" class="sub-li">Resumen de
                        Cobros</a>
                    </li>
                    <li><a href="{{asset("cobrar-cuentas/individuales")}}" class="sub-li">Cargar cobro
                    individual</a></li>
                    <li><a href="{{asset("cobrar-cuentas/nominas")}}" class="sub-li">Cargar nómina de
                    cobros</a></li>
                    <li>
                        <a href="{{asset('cobrar-cuentas/todo')}}" class="sub-li">Cobros Pendientes</a>
                    </li>
                    <li>
                        <a href="{{asset('cobrar-cuentas/pagadas')}}" class="sub-li">Cobros Realizados</a>
                    </li>
                </ul>
            </li>

            <li @if($menu_activado_tpl != 1 && $menu_activado_tpl != 2) class="active" @endif>
                <a class="btn-bg" href="{{asset('dashboard')}}">Resumen</a>
            </li>

            {{--<li>
                @if(isset($activar_cobrar) && isset($vista) && $activar_cobrar == 1)
                {!! Form::open(['method' => 'post','class'=>'form-horizontal','action' => 'CobrarController@cambiar_vista','id' => 'formview'])!!}
                {!! Form::select('view',['0' => 'Vista cuenta principal'] + $vista,\Illuminate\Support\Facades\Session::get('idvista_cobrador'),['class' => 'form-control input-xs','id' => 'change_views']) !!}
                {!! Form::close() !!}
                @endif
            </li>--}}

            {{--//TODO: corregir estilo--}}
            {{--@if(isset($activar_cobrar) && isset($vista) && $activar_cobrar == 1 && count($vista) > 0)
                <li>

                    <div class="btn-group">
                        <a class="dropdown-toggle " data-close-others="false" data-delay="0"
                        data-toggle="dropdown" href="#"><div class="hidden-xs">
                           Usuario <span class="caret"></span>
                       </div>
                       <div class="hidden-lg hidden-md hidden-sm">
                        <i class="fa fa-user" aria-hidden="true"></i> <span class="caret"></span>
                    </div>
                </a>
                <ul class="dropdown-menu cuenta-menu">
                    <li @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0) class="active disabled" @endif>
                        <a tabindex="-1" href="#" data-id-vista="0" class="sub-li">Principal</a>
                    </li>

                    @foreach($vista as $k => $vist)
                    <li @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == $k) class="active disabled" @endif>
                        <a tabindex="-1" href="#" data-id-vista="{{$k}}" class="sub-li">{{$vist}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>

        </li>
        @endif--}}
    </ol>
</div>
</div>
</div>
</div>
<!--breadcrumbs end-->


<div id="modal_cambiar_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        {!! Form::open(['method' => 'post','class'=>'modal-content form-horizontal','id' => 'form_cambiar_password','action' => 'HomeController@cambiar_password']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Cambiar Clave</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="empresa">Clave Actual</label>
                    <div class="col-sm-6">
                        {!! Form::password('password_1',['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="empresa">Nueva Clave</label>
                    <div class="col-sm-6">
                        {!! Form::password('nueva_password',['class' => 'form-control','id' => 'nueva_password']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="empresa">Confirmar Nueva Clave </label>
                    <div class="col-sm-6">
                        {!! Form::password('confirmar_password',['class' => 'form-control','id' => 'confirmar_password']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primarynew">Cambiar Clave</button>
        </div>
        {!! Form::close() !!}}
    </div>
</div>
@endif

<div id="recuperar_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        {!! Form::open(['method' => 'POST','id' => 'modal_password_email','action' => 'HomeController@recuperar_password']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">¿Olvidaste tu clave?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Para recuperar clave, favor ingresar tu RUT</label>
                            <input name="rut" class="form-control rut_input_point" placeholder="12.345.678-9">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Recuperar Clave</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div class="content">
    @yield('content')
</div>
<!--container end-->

<!--footer start-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3" data-wow-duration="2s" data-wow-delay=".3s">

                <ul class="page-footer-list">
                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="/index.php">Inicio</a>
                    </li>
                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="{{ asset('registro')}}" class="send-click">Regístrate ahora</a>
                    </li>

                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="{{ asset('faq')}}" class="send-click">Necesito Ayuda</a>
                    </li>


                </ul>

            </div>

            <div class="col-lg-3 col-sm-3 " data-wow-duration="2s" data-wow-delay=".1s">

                <ul class="page-footer-list">


                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="{{ asset('quienes-somos')}}" class="send-click"> Acerca de nosotros</a>
                    </li>


                    <li>
                        <i class="fa fa-angle-right"></i>
                        <a href="{{ asset('contacto')}}" class="send-click">Contáctanos</a>
                    </li>


                </ul>

            </div>


            <div class="col-lg-3 col-sm-3 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".3s">
                <p>Con el apoyo de</p>
                <img class="img-responsive center-block" src="{{ asset('images/sc_logo.png')}}">
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="text-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".7s">
                    <ul class="social-link-footer list-unstyled">
                        <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".4s"><a href="https://www.linkedin.com/company/portal-de-pagos
                            " target="_blank" class="send-click"><i class="fa fa-linkedin"></i></a></li>

                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".4s"><a href="https://www.facebook.com/PortaldePagos/
                                " target="_blank" class="send-click"><i class="fa fa-facebook"></i></a></li>
                                <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="https://www.youtube.com/channel/UCDoNrfGq_Fnrki-lYHa8m6Q
                                    " target="_blank" class="send-click"><i class="fa fa-youtube"></i></a></li>


                                </ul>


                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="copyright">
                                <p>&copy; Copyright - Todos los derechos reservados - Portal de Pagos </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end -->


            <script type="text/javascript" src="{{ asset('js/hover-dropdown.js')}}"></script>
            <script defer src="{{ asset('js/jquery.flexslider.js')}}">
            </script>
            <script type="text/javascript" src="{{ asset('assets/bxslider/jquery.bxslider.js')}}">
            </script>

            <script type="text/javascript" src="{{ asset('js/jquery.parallax-1.1.3.js')}}">
            </script>
            <script src="{{ asset('js/wow.min.js')}}">
            </script>
            <script src="{{ asset('assets/owlcarousel/owl.carousel.js')}}">
            </script>

            <script src="{{ asset('js/jquery.easing.min.js')}}">
            </script>
            <script src="{{ asset('js/link-hover.js')}}">
            </script>
            <script src="{{ asset('js/superfish.js')}}">
            </script>
            <script src="{{ asset('js/parallax-slider/jquery.cslider.js')}}">
            </script>
            <script src="{{ asset('js/fileinput.min.js')}}">
            </script>
            <script src="{{ asset('js/locales/es.js')}}">
            </script>

            <script type="text/javascript">
                $(function () {
                    $('#da-slider').cslider({
                        autoplay: true,
                        bgincrement: 100
                    });
                });
            </script>

            <!--common script for all pages-->
            <script src="{{ asset('js/common-scripts.js')}}">
            </script>

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    $('.bxslider1').bxSlider({
                        minSlides: 5,
                        maxSlides: 6,
                        slideWidth: 360,
                        slideMargin: 2,
                        moveSlides: 1,
                        responsive: true,
                        nextSelector: '#slider-next',
                        prevSelector: '#slider-prev',
                        nextText: 'Onward →',
                        prevText: '← Go back'
                    });
                });
            </script>


            <script>
                $('a.info').tooltip();
                $(window).load(function () {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        start: function (slider) {
                            $('body').removeClass('loading');
                        }
                    });
                });

                $(document).ready(function () {
                    $("#owl-demo").owlCarousel({
                        items: 4
                    });
                });

                jQuery(document).ready(function () {
                    jQuery('ul.superfish').superfish();
                });
                new WOW().init();
            </script>


            <script>
                $(document).ready(function () {
        //Set the carousel options
        $('#quote-carousel').carousel({
            pause: true,
            interval: 4000,
        });
    });

</script>
<script src="{{ asset('js/validaciones/validation_email_password.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".send-click-menu").click(function () {
            console.log('gtag', ($(this).text() || $(this).attr('href')));
            gtag('event', 'click en ' + ($(this).text() || $(this).attr('href')) + ' menu');
        })
        $(".send-click").click(function () {
            console.log('gtag', ($(this).text() || $(this).attr('href')));
            gtag('event', 'click en ' + ($(this).text() || $(this).attr('href')));
        })
        $(".btn-consultar").click(function (event) {
            event.preventDefault();
            gtag('event', 'click_consultar_pago_pendiente')
            $("#consultar_deuda").submit();
        })
    })
</script>

</body>
</html>
