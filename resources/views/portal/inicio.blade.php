@extends('template')

@section('title')
Portal de Pagos | Inicio
@endsection

@section('content')

@if (Auth::check())
@if( $errors->count() > 0 )
<br/>
<div class="alert alert-danger" role="alert">
    <strong>Se registro el(los) siguiente(s) error(es)</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endif



<!-- Sequence Modern Slider -->

<!--div class="content-slider hidden-xs hidden-sm"-->
<div class="content-slider">
    <div class="posicion-login">
        <div class="container caja-abajo">
            <div class=" col-md-12">
                @if(!Auth::check())
                <div class="caja-login col-md-12">
                    <span class="ingreso">Ingreso a Clientes</span>
                    <form class="form-horizontal" id="login" role="form" method="post">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Rut</label>
                            <div class="col-sm-9">
                                <input class="form-control input-sm rut_main" name="rut" id="rut_main" type="text"
                                placeholder="12.345.678-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputPassword">Clave</label>
                            <div class="col-sm-9">
                                <input type="password" name="passwordp" placeholder="Clave" id="inputPassword"
                                class="form-control input-sm">
                            </div>
                        </div>

                        <span class="text-right recuperar">
                          <a href="javascript:;" id="btn_recuperar_pwd">¿Olvidaste tu clave?</a>

                          <button class="btn btn-sm btn-primary" type="submit">Ingresar</button>
                      </span>
                  </form>
              </div>
              @endif
          </div>
      </div>
  </div><!-- cierre caja -->

</div> <!-- content slider -->


<!-- Responsive slider - START -->
<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
    <div class="slides" data-group="slides">
        <ul>
            <li>
                <div class="slide-body" data-group="slide">
                    <img src="{{asset("public/images/slider2.jpg")}}" class="hidden-xs">
                    <img src="{{asset("public/images/slider2xs.jpg")}}" class="hidden-lg hidden-md hidden-sm">
                    <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500"
                    data-length="300">
                    <h3 class="hidden-lg hidden-md hidden-sm">¿Qué tal dedicar más tiempo <br> a tu negocio?
                    </h3>
                    <h3 class="hidden-xs">¿Qué tal dedicar más tiempo a tu negocio?</h3>
                    <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800"
                    data-length="300">
                    <h4>Facilitamos la administración de tus cobros y pagos.</h4>
                    <a class="btn btn-registro send-click" href="{{ asset('cuentas-pagar')}}">
                    Conoce más</a>
                </div>
            </div>

        </div>
    </li>
    <li>
        <div class="slide-body" data-group="slide">
            <img src="{{asset("public/images/slider1.jpg")}}" class="hidden-xs">
            <img src="{{asset("public/images/slider1xs.jpg")}}" class="hidden-lg hidden-md hidden-sm">
            <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500"
            data-length="300">
            <h3>¿Qué tal administrar tus cuentas<br> desde cualquier lugar?</h3>
            <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800"
            data-length="300">
            <h4>Facilitamos la administración de tus cobros y pagos.</h4>
            <a class="btn btn-registro send-click" href="{{ asset('cuentas-pagar')}}">
            Quiero Pagar</a>
            <a class="btn btn-registro send-click" href="{{ asset('cuentas-cobrar')}}">
            Quiero Cobrar</a>
        </div>
    </div>
</div>
</li>
</ul>
</div>
<a class="slider-control left" href="#" data-jump="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>
</a>
<a class="slider-control right" href="#" data-jump="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
<div class="pages">
    <a class="page" href="#" data-jump-to="1">1</a>
    <a class="page" href="#" data-jump-to="2">2</a>
</div>
</div>
<!-- Responsive slider - END -->





<div class="col-xs-12">
    <!--<div class="content-slider hidden-lg hidden-md">
        @if (!Auth::check())
        <div class="caja-login col-md-12">
            <span class="ingreso">Ingreso a Clientes</span>
            <form class="form-horizontal" id="login" role="form" method="post">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Rut</label>
                    <div class="col-sm-9">
                        <input class="form-control input-sm rut_main" name="rut" id="rut_main" type="text"
                        placeholder="12.345.678-9">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputPassword">Clave</label>
                    <div class="col-sm-9">
                        <input type="password" name="passwordp" placeholder="Clave" id="inputPassword"
                        class="form-control input-sm">
                    </div>
                </div>

                <span class="text-right recuperar">
                    <a href="javascript:;" id="btn_recuperar_pwd">¿Olvidaste tu clave?</a>

                    <button class="btn btn-sm btn-primary" type="submit">Ingresar</button>
                </span>
            </form>
        </div>


    </div> <!-- content slider -->

    <div class="row">
        <div class="col-md-12">
            <div class="text-center feature-head wow fadeInDown">
                <h3 class="">
                    ¿Aún no utilizas Portal de Pagos? <a href="registro" class="btn btn-registro send-click">
                        Regístrate ahora
                    </a>
                </h3>
            </div>

        </div>
    </div>
    @endif
</div>


<div class="gray-bg">

    <div class="container">
        <div class="row mar-b-30 mtop30">

            <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
                <div class="feature-box-heading">


                    <a href="cuentas-cobrar" class="publicidad-dos send-click">
                        <img src="{{asset("public/images/beneficios_cobrar.jpg")}}" alt="" class="img-responsive">
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 text-center wow fadeInUp">
                <div class="feature-box-heading">


                    <a href="cuentas-pagar" class="publicidad-dos send-click">
                        <img src="{{asset("public/images/beneficios_pagar.jpg")}}" alt="" class="img-responsive">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="display:none;">
        <div class="row feature-box">
            <div class="col-md-3 col-sm-3 text-center wow fadeInUp">
                <div class="feature-box-heading">

                    <?php $data = \App\Extras\Portal::getImagenPortal(1); ?>
                    <?php $link = $data != null ? $data['link'] : "#"; ?>

                    <a href="{{$link}}" class="publicidad-dos">
                        <img src="{{ asset('public/images/portal/'.$data['imagen'])}}" alt=""
                        class="img-responsive">
                    </a>
                </div>
                <h4 class="text-center">
                    {{$data['titulo']}}
                </h4>
            </div>
            <div class="col-md-3 col-sm-3 text-center wow fadeInUp">
                <div class="feature-box-heading">

                    <?php $data = \App\Extras\Portal::getImagenPortal(2); ?>
                    <?php $link = $data != null ? $data['link'] : "#"; ?>

                    <a href="{{$link}}" class="publicidad-dos">
                        <img src="{{ asset('public/images/portal/'.$data['imagen'])}}" alt=""
                        class="img-responsive">
                    </a>

                </div>
                <h4 class="text-center">
                    {{$data['titulo']}}
                </h4>
            </div>
            <div class="col-md-3 col-sm-3 text-center wow fadeInUp">
                <div class="feature-box-heading">

                    <?php $data = \App\Extras\Portal::getImagenPortal(3); ?>
                    <?php $link = $data != null ? $data['link'] : "#"; ?>

                    <a href="{{$link}}" class="publicidad-dos">
                        <img src="{{ asset('public/images/portal/'.$data['imagen'])}}" alt=""
                        class="img-responsive">
                    </a>
                </div>
                <h4 class="text-center">
                    {{$data['titulo']}}
                </h4>
            </div>

            <div class="col-md-3 col-sm-3 text-center wow fadeInUp">
                <div class="feature-box-heading">

                    <?php $data = \App\Extras\Portal::getImagenPortal(4); ?>
                    <?php $link = $data != null ? $data['link'] : "#"; ?>

                    <a href="{{$link}}" class="publicidad-dos">
                        <img src="{{ asset('public/images/portal/'.$data['imagen'])}}" alt=""
                        class="img-responsive">
                    </a>
                </div>
                <h4 class="text-center">
                    {{$data['titulo']}}
                </h4>
            </div>
        </div>

        <!--feature end-->
    </div>
</div>



@if (!Auth::check())
@if( $errors->count() > 0 )
<div id="modal_error_login" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif

@if(Session::has('ok'))
<div id="modal_ok" class="modal fade mostrar_ok" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alerta</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                        {!! Session::get('ok') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
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
    <script src="{{ asset('public/js/validaciones/validation_email_password.js')}}"></script>--}}
    <script src="{{ asset('public/js/responsive-slider.js')}}"></script>
    <script src="{{ asset('public/js/jquery.event.move.js')}}"></script>
    @endsection
