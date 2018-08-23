@extends('template')

@section('title')
    Registro | Portal de Pagos
@endsection

@section('content')
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="top10 white">
                        Fomulario de registro
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <!--container start-->
    <div class="registration-bg">
        <div class="container">
            {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp']) !!}
            <h2 class="form-signin-heading">Organiza tus cobros y deudas con Portal de Pagos</h2>
            @if( $errors->count() > 0 )
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="login-wrap row">
                <div class="col-md-12"><p>Completa, por favor, los datos abajo:</p></div>
                <div class="col-md-12 top25">
                    <div class="form-group col-md-6 col-md-push-3">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                        <div class="form-dv">
                            <label class="col-sm-2 control-label" for="rut">Rut</label>
                            <div class="col-sm-10">
                                {!! Form::text('rut',null,['class' => 'form-control rut_input_point','placeholder' => '12.345.678-9']) !!}
                            </div>
                        </div>


                        <div class="form-dv">
                            <label class="col-sm-2 control-label" for="nombre">Nombre</label>
                            <div class="col-sm-10">
                                {!! Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre completo / Razon social']) !!}
                            </div>
                        </div>

                        {{--<div class="form-dv">
                            <label class="col-sm-2 control-label" for="inputEmail3">Celular</label>
                            <div class="col-sm-10">
                                {!! Form::text('celular',null,['class' => 'form-control','placeholder' => 'Celular']) !!}
                            </div>
                        </div>--}}

                        <div class="form-dv">
                            <label class="col-sm-2 control-label" for="inputEmail3">Email</label>
                            <div class="col-sm-10">
                                {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Email','id' => 'email_id']) !!}
                            </div>
                        </div>

                        <div class="form-dv hidden" id="confirmar_mail">
                            <label class="col-sm-2 control-label" for="inputEmail3">Confirmar Email</label>
                            <div class="col-sm-10">
                                {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder' => 'Confirmar Email']) !!}
                            </div>
                        </div>

                        <div class="form-dv">
                            <label class="col-sm-2 control-label top10" for="inputEmail3">Clave</label>
                            <div class="col-sm-10 top10">
                                {!! Form::password('passwordp',['class' => 'form-control','id' => 'passwordp','placeholder' => 'Clave']) !!}
                            </div>
                        </div>

                        <div class="form-dv hidden" id="confirmar_clave">
                            <label class="col-sm-2 control-label" for="inputEmail3">Confirmar Clave</label>
                            <div class="col-sm-10">
                                {!! Form::password('passwordp_confirmation',['class' => 'form-control','placeholder' => 'Confirmar Clave']) !!}
                            </div>
                        </div>
                        <div class="form-dv">
                            <div class="col-sm-10 col-md-offset-2">
                                <label class="checkbox">
                                    {!! Form::checkbox('condiciones') !!}Estoy de acuerdo con los <a href="#">Términos y
                                        condiciones</a>
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primarynew pull-right" type="submit">Enviar</button>

                        <div class="registration pull-right">
                            ¿Ya estas registrado?
                            <a style="margin-right:20px;" href="{{asset('dashboard')}}">
                                Ingresar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <!--container end-->

    <script src="{{ asset('public/js/validaciones/validation_registro.js')}}"></script>
@endsection
