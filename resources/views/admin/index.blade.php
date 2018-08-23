@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Escritorio</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_usuarios}}</div>
                            <div>Nuevos usuarios!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ asset('admincp/usuarios') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_deudas_pagadas}}</div>
                            <div>Deudas Pagadas</div>
                        </div>
                    </div>
                </div>
                <a href="{{asset('admincp/pagadas')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_deudas_pendientes}}</div>
                            <div>Cobros Pendientes</div>
                        </div>
                    </div>
                </div>
                <a href="{{asset('admincp/pendientes')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_login_activos}}</div>
                            <div>Total de ingresos</div>
                        </div>
                    </div>
                </div>
                <a href="{{asset('admincp/accesos/exp')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_pagadores_activos}}</div>
                            <div>Pagadores Activos</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total_deudores_activos}}</div>
                            <div>Deudores Activos</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Anuncio</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @if (Session::has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! Session::get('ok') !!}
        </div>
    @endif
    @if( $errors->count() > 0 )
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        {!! Form::open(['method' => 'POST']) !!}
        <div class="col-md-4">
            <label for="inicio">Fecha inicio</label>
            {!! Form::text('inicio',\App\Extras\Utilidades::ImprimirFechaHora($anuncio->fecha_inicio),['class' => 'form-control','id' => 'from-timer']) !!}
        </div>
        <div class="col-md-4">
            <label for="termino">Fecha Término</label>
            {!! Form::text('termino',\App\Extras\Utilidades::ImprimirFechaHora($anuncio->fecha_termino),['class' => 'form-control','id' => 'to-timer']) !!}
        </div>
        <div class="col-md-10">
            <label for="termino">Mensaje</label>
            {!! Form::textarea('mensaje',$anuncio->mensaje,['class' => 'form-control','rows' => 5]) !!}
        </div>
        <div class="col-md-2">
            <input class="btn btn-default btn-configurar" type="submit" value="Configurar">
        </div>
        {!! Form::close() !!}
    </div>

    <script>
        $(function(){

            $( "#from-timer" ).datetimepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
                onClose: function( selectedDate ) {
                    $( "#to-timer" ).datetimepicker( "option", "minDate", selectedDate );
                }
            });
            $( "#to-timer" ).datetimepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
                onClose: function( selectedDate ) {
                    $( "#from-timer" ).datetimepicker( "option", "maxDate", selectedDate );
                }
            });
        });
    </script>
@endsection