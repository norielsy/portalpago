@extends('template')
@include('logueado.cobrar_cuentas.individual.popup_adjuntar')
@include('logueado.cobrar_cuentas.nominas.detalle.popup_adjuntar')

@section('title')
    Quiero Cobrar | Portal de Pagos
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

            @if(Session::has('error'))
                <br/>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('error') !!}
                </div>
            @endif

            <h1 class="main-text">Cobros Realizados</h1>

            <div class="bs-docs-section">
                @include('logueado.cobrar_cuentas.menu_cobros')
                {{--@yield('menu_cobros')--}}

                <div class="tab-content">

                    @if($pagadas->total() >= 11 || Request::get('empresa') != "" || Request::get('rut'))
                        {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla add_cobros_v1']) !!}
                        <div class="form-group">
                            <label for="exampleInputName2">Empresa</label>
                            {!! Form::select('empresa',['' => 'Seleccione una empresa'] + $empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Rut</label>
                            {!! Form::text('rut',$buscar_rut,['class' => 'form-control']) !!}
                        </div>
                        <button class="btn btn-sm btn-primarynew btn-filtro" type="submit">Filtrar</button>
                        {!! Form::close() !!}
                    @endif


                    <div id="puntuales" class="tab-pane fade in active">
                        <table class="table listado listado-cobro-realizado table-hover">
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th style="min-width:100px;">Rut</th>
                                <th>Nombre/Empresa</th>
                                <th>Descripción</th>
                                <th>Monto ($)
                                    @if(Input::get('monto') != null && Input::get('monto') == 'asc')
                                        <a href="{{URL::route('cuentas_pagadas',array('monto' => 'desc','fecha' => Request::get('fecha'),'page' => Request::get('page'), 'vencimiento' => Request::get('vencimiento')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                        </a>
                                    @else
                                        <a href="{{URL::route('cuentas_pagadas',array('monto' => 'asc','fecha' => Request::get('fecha'),'page' => Request::get('page'), 'vencimiento' => Request::get('vencimiento')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                        </a>
                                    @endif
                                </th>
                                <th>Vencimiento
                                    @if(Input::get('vencimiento') != null && Input::get('vencimiento') == 'asc')
                                        <a href="{{URL::route('cuentas_pagadas',array('vencimiento' => 'desc','page' => Request::get('page'), 'fecha' => Request::get('fecha'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                        </a>
                                    @else
                                        <a href="{{URL::route('cuentas_pagadas',array('vencimiento' => 'asc','page' => Request::get('page'), 'fecha' => Request::get('fecha'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                        </a>
                                    @endif</th>
                                <th>Fecha Pago
                                    @if(Input::get('fecha') != null && Input::get('fecha') == 'asc')
                                        <a href="{{URL::route('cuentas_pagadas',array('fecha' => 'desc','page' => Request::get('page'), 'vencimiento' => Request::get('vencimiento'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                        </a>
                                    @else
                                        <a href="{{URL::route('cuentas_pagadas',array('fecha' => 'asc','page' => Request::get('page'), 'vencimiento' => Request::get('vencimiento'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                        </a>
                                    @endif
                                </th>

                                <th>Forma de pago</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pagadas as $fila)
                                <tr>
                                    {{--<td>{{$fila->idCobros}}</td>--}}
                                    <td>{{App\Helper\Rut::rut($fila->rut)}}</td>
                                    <td>{{$fila->empresa}}</td>
                                    <td>{{$fila->descripcion}}</td>
                                    <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                                    <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                                    <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_pago)}}</td>
                                    <td>
                                        @if(empty($fila->forma_pago))
                                            TEF (Conc.Auto)
                                        @else
                                            {{@$fila->forma_pago}}
                                        @endif
                                    </td>


                                    @if(!empty($ff[$fila->idCobros]))
                                        <td class="text-center">
                                            <a href="{{asset($ff[$fila->idCobros])}}" target="_blank"
                                               class="btn btn-success btn-sm">Archivo adjunto</a>
                                        </td>

                                    @endif
                                    {{--@if($fila->tipo == 1)
                                        @if(empty($fila->adjunto))
                                            @if(!empty($ff[$fila->idCobros]))
                                                <a href="{{asset($ff[$fila->idCobros])}}" target="_blank"
                                                   class="btn btn-success btn-sm">Archivo adjunto</a>
                                            @endif
                                        @else
                                            <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->adjunto))}}"
                                               class="btn btn-success btn-sm">Descargar</a>
                                        @endif
                                    @elseif($fila->tipo == 2)
                                        @if(empty($fila->adjunto))
                                            <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                               class="popup_adjuntar_nomina">
                                                <i class="icono-verde fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->adjunto))}}"
                                               class="btn btn-success btn-sm">Descargar</a>
                                        @endif
                                    @endif--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$pagadas->appends(Request::only(['monto','fecha','empresa', 'vencimiento']))->render()) !!}

                        <div class="separador-exportar">
                            <a class="btn btn-sm btn-primarynew pull-right"
                               href="{{ asset('cobrar-cuentas/todo/exportar')}}">Exportar Datos</a>
                        </div>
                    </div> <!-- por pagar -->
                </div><!--tab-content-->

            </div><!--docs section-->
        </div><!--container end-->
    </div><!--component-bg-->
    <script src="{{ asset('public/js/services/cobros.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_adjunto.js')}}"></script>
    @yield('modal_adjuntar_individual')
    @yield('modal_detalle_adjuntar_nomina')
@endsection
