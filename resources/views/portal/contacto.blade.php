@extends('template')

@section('title')
    Contacto | Portal de Pagos
@endsection

@section('content')
        <!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="top10 white">
                    Contáctanos
                </h1>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->



<!--container start-->
<div class="container">


    <div class="row">

        <div class="col-md-10 col-md-offset-1 mar-b-30">

            <div id="heading">
                <h1 class="">¿Necesitas escribirnos?</h1>

            </div>

        </div>


        <div class="col-lg-10 col-sm-10 col-md-offset-1 ">
            <p class="lead"><i class="fa fa-arrow-right" aria-hidden="true"></i> Recordamos que si tienes dudas sobre nuestros servicios, puedes consultar, según corresponda, las siguientes secciones:  <a href="cuentas-pagar" class="btn btn-primarynew btn-sm">Quiero Pagar</a> <a href="cuentas-cobrar" class="btn btn-primarynew btn-sm">Quiero Cobrar</a>
 </p>


                    <p class="lead mar-t-20"><i class="fa fa-arrow-right" aria-hidden="true"></i> Si necesitas alguna ayuda, consulte: <a href="faq" class="btn btn-primarynew btn-sm">Preguntas frecuentes</a></p>
            <p class="lead"><i class="fa fa-arrow-right" aria-hidden="true"></i> Para otros temas, escríbenos: </p>

            @if( $errors->count() > 0 )
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if(Session::has('ok'))
                <br/>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! Session::get('ok') !!}
                </div>
            @endif

            <div id="account_login" class="hide">
                {!! Form::open(['method' => 'post','id' => 'form_login_fast','action' => 'HomeController@contacto_login']) !!}
                <div class="col-md-12">
                    <button type="button" class="close cerrar_hover_p" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>Si ya tienes una cuenta, ingresa tu contraseña para autocompletar los otros campos</p>
                    <div class="form-group">
                        <label for="name">Contraseña</label>
                        <input type="hidden" name="rut" id="rut_hidden">
                        <input type="hidden" name="pagina" value="contacto">
                        <input type="password" name="passwordp" class="form-control"> <br/>
                        <button type="submit" class="btn btn-primarynew btn-group-sm"> Ingresar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="contact-form">
                {!! Form::open(['method' => 'POST','id' => 'form_contacto','action' => 'HomeController@contacto_post','role' => 'form']) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="name">Rut</label>
                                <?php $etiquetas = empty($rut) ? 'login_fast' : ""; ?>
                                <input type="text" placeholder="" value="{{$rut}}" name="rut" rel="popover" data-trigger="show" data-popover-content="#account_login" id="rut" class="form-control rut_input_point {{$etiquetas}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Celular</label>
                                <input type="text" id="phone" name="celular" value="{{$celular}}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row" id="solicitud_esperada" style="display: none;">
                        <div class="col-md-12">
                            <label for="sss">Solución esperada</label>
                            <textarea placeholder="" name="solucion_esperada" rows="5" class="form-control"></textarea>
                        </div>
                        <br/>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label for="name">Motivo de tu contacto</label>
                                <select name="motivo" id="motivo" class="form-control">
                                    <option value="Consulta">Consulta</option>
                                    <option value="Solicitud">Solicitud</option>
                                    <option value="Reclamo">Reclamo</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" placeholder="" value="{{$nombre}}" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" placeholder="" id="email" name="email" value="{{$email}}" class="form-control">
                            </div>

                        </div><!-- cierrre col 6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Mensaje</label>
                                <textarea placeholder="" name="mensaje" rows="8" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primarynew pull-right mar-b-30" type="submit">Enviar</button>
                        </div><!-- cierre col 6-->
                    </div>




                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/validaciones/validation_contacto.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_solopassword.js')}}"></script>
</div>
<!--container end-->
@endsection
