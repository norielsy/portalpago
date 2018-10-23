@extends('template') @include('logueado.cobrar_cuentas.individual.popup_adjuntar') @include('logueado.cobrar_cuentas.individual.popup_eliminar_individual') @include('logueado.cobrar_cuentas.individual.popup_editar_individual') @include('logueado.cobrar_cuentas.individual.popup_pagar_cuenta') @section('title') Cargar Cobro Individual | Portal de Pagos @endsection @section('content') <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}"/>
<!--container start-->
<div class="component-bg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                <a class="btn btn-main disabled btn-block custom-btn" disabled="disabled" href="{{asset("cobrar-cuentas/individuales")}}">Cargar cobro individual</a>
                <a class="btn btn-main btn-block custom-btn" href="{{asset("cobrar-cuentas/nominas")}}">Cargar Nómina de cobros</a>
            </div>
        </div>
        @include('logueado.publicidad') @yield('content_publicidad')
        <div class="bs-docs-section">
            @include('logueado.cobrar_cuentas.menu_cobros') {{--@yield('menu_cobros')--}}
            <h1 class="main-text">Cargar cobro individual</h1>
            <div class="tab-content">
                <div class="row">
                    <div class="col-xs-12 clearfix">
                        <div id="puntuales" class="tab-pane fade in active">
                            @if( $errors->count() > 0 )
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif @if(Session::has('ok')) <br/>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {!! Session::get('ok') !!}
                            </div>
                            @endif @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2) @if(Session::get('nro_cuenta') != null || Session::get('nro_cuenta') != "") {!! Form::open(['method' => 'POST','class'=>'form-horizontal add_cobros_v1','id' => 'form_cobrospuntuales_main', 'files' => true]) !!}
                            <div class="well clearfix myform">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group hg">
                                                    <label class="control-label" for="empresa">Nombre</label>
                                                    {!! Form::text('empresa',null,['class' => 'form-control','placeholder' => 'Nombre/Empresa']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group hg">
                                                    <label class="control-label" for="rut_empresa">Rut</label>
                                                    {!! Form::text('rut_empresa',null,['class' => 'form-control rut_input_point','placeholder' => 'Rut', 'id' => 'rutCobroIndividual']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group hg">
                                                    <label class="control-label" for="email">Email <i class="fa fa-spin fa-spinner hide" id="loading_email"></i> <small id="email_hide"></small></label>
                                                    {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Email', 'id' => 'email_cobro']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox hide" id="check_email_container">
                                                        <label>
                                                            <input type="checkbox" id="check_email"> Usar email guardado en el sistema
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group hg">
                                                    <label class="control-label" for="monto">Monto</label>
                                                    {!! Form::text('monto',null,['class' => 'form-control moneda','placeholder' => '$100']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group hg">
                                                    <label class="control-label" for="fecha_vencimiento">Fecha Vencimiento</label>
                                                    {!! Form::text('fecha_vencimiento',null,['class' => 'form-control datepicker_all','placeholder' => '20/10/2015', 'autocomplete' => "off"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group lb">
                                                    <label class="control-label" for="descripcion">Descripción</label>
                                                    <textarea rows="4" name="descripcion" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="form group lb">
                                                    <label class="control-label">¿Quieres agregar un documento como Factura, Orden de compra, Gasto común?</label>
                                                    {!! Form::file('voucher', ['class' => 'file_upload file', 'data-show-preview' =>"false"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 clearfix">
                                        <br>
                                        <button class="btn btn-primarynew pull-right btn-sm" type="submit" id="btn_cobro_individual">
                                        Agregar Cobro </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!} @else @include('logueado.cobrar_cuentas.advertencia_banco') @yield('alerta_banco') @endif @endif
                        </div>
                        <!-- por pagar -->
                    </div>
                </div>
            </div>
            <!--tab-content-->
        </div>
        <!--docs section-->
    </div>
    <!--container end-->
</div>
<!--component-bg-->
<script src="{{ asset('public/js/services/cobros.js')}}"></script>
<script src="{{ asset('public/js/validaciones/validation_cobrospuntales.js')}}"></script>
<script src="{{ asset('public/js/validaciones/validation_adjunto.js')}}"></script>
<script src="{{ asset('public/js/validaciones/validation_marcapagado_pagar.js')}}"></script>
@yield('modal_adjuntar_individual')
@yield('modal_editar_individual')
@yield('modal_pagar_cuenta_individual')
@yield('modal_eliminar_individual')
@endsection
