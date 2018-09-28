@extends('template')
@include('logueado.cuentas_por_pagar.popup_detalle_cuenta')

@section('title')
    Portal de Pagos | Bienvenidos
@endsection

@section('content')
    <!--container start-->
    <div class="component-bg">
        <div class="container">

            @include('logueado.publicidad')
            @yield('content_publicidad')

            @if(Session::has('ok'))
                <br/>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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

            @if(Session::has('error'))
                <br/>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('error') !!}
                </div>
            @endif


            <div class="row">
                <div class="col-xs-12 col-md-12 clearfix">

                <!--
                    <div class="top25 hidden-xs">
                        <a href="{{asset('quiero-pagar')}}" class="btn btn-main custom-btn"><i class="fa fa-arrow-left"></i> </a>
                        <a href="{{asset('cuentas-por-pagar')}}" class="btn btn-main btn-lg custom-btn disabled">Cuentas por pagar</a>
                        <a href="{{asset('cuentas-por-pagar/pagadas')}}" class="btn btn-main btn-lg custom-btn">Cuentas pagadas</a>


                    </div>
-->
                </div>
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                    <a href="{{asset('cuentas-por-pagar')}}" class="btn btn-main custom-btn btn-block disabled">Cuentas
                        por pagar</a>
                    <a href="{{asset('cuentas-por-pagar/pagadas')}}" class="btn btn-main custom-btn btn-block">Cuentas
                        pagadas</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix"></div>
                    <h1>Pagos Pendientes</h1>
                    @if($total > 0)
                        <div class="alert top25 alert-danger">
                            <strong>¡Atención!</strong> Usted tiene <strong>{{$total}}</strong> deudas vencidas.
                        </div>
                    @endif</div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="tab-content">

                        @if($nopagadas->total() >= 11 || $item_seleccionado != "" || $buscar_rut != "")
                            {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla']) !!}
                            <div class="form-group">
                                <label for="exampleInputName2">Nombre</label>
                                {!! Form::select('empresa',['' => 'Seleccione Nombre/empresa'] + $empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">Rut</label>
                                <div class="input-group">

                                    {!! Form::text('rut',$buscar_rut,['class' => 'form-control input-sm']) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primarynew" type="submit">Buscar</button>
                                    </span>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endif

                        <div id="porpagar" class="tab-pane fade in active responsive-table">

                            <table class="table listado listado-deudas table-hover">
                                <thead>
                                <tr>
                                    {{--<th> #</th>--}}
                                    <th>Rut</th>
                                    <th>Nombre/Empresa</th>
                                    <th>Descripción</th>
                                    <th>Vencimiento
                                        @if(Input::get('fecha') != null && Input::get('fecha') == 'asc')
                                            <a href="{{URL::route('nopagadas',array('fecha' => 'desc','empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                                                <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                            </a>
                                        @else
                                            <a href="{{URL::route('nopagadas',array('fecha' => 'asc','empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                                                <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                            </a>
                                        @endif
                                    </th>
                                    <th>Monto ($)
                                        @if(Input::get('monto') != null && Input::get('monto') == 'asc')
                                            <a href="{{URL::route('nopagadas',array('monto' => 'desc','empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                                                <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                            </a>
                                        @else
                                            <a href="{{URL::route('nopagadas',array('monto' => 'asc','empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                                                <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                            </a>
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nopagadas as $fila)
                                    <tr @if($fila->fecha_vencimiento < date("Y-m-d")) class="danger" @endif>
                                        {{--<td>{{$fila->idCobros}}</td>--}}
                                        <td>{{App\Helper\Rut::rut($fila->rut)}}</td>
                                        <td>{{$fila->empresa}}</td>
                                        <td>{{$fila->descripcion}}</td>
                                        <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                                        <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primarynew btn-sm btn_item_pagado"
                                                    attr-id="{{$fila->idCobros}}" attr-type="{{$fila->tipo}}">Cómo Pagar
                                            </button>
                                        </td>
                                        <td>
                                            @if(!empty($ff[$fila->idCobros]))
                                                <a href="{{asset($ff[$fila->idCobros])}}" target="_blank"
                                                   class="btn btn-success btn-sm">Archivo adjunto</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! str_replace('/?', '?',$nopagadas->appends(Request::only(['fecha','monto','empresa','rut']))->render()) !!}
                        </div> <!-- por pagar -->

                    </div><!--tab-content-->
                </div>

            </div>
            <!--docs section-->
        </div><!--container end-->
    </div><!--component-bg-->

    <script src="{{ asset('public/js/validaciones/validation_marcapagado_pagar.js')}}"></script>
    @yield('modal_detalle_pagar_cuenta')

@endsection
