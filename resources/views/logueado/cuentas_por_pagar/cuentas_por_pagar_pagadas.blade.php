@extends('template')

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

            @if(Session::has('error'))
                <br/>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('error') !!}
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                    <a href="{{asset('cuentas-por-pagar')}}" class="btn btn-main btn-block custom-btn">Cuentas por
                        pagar</a>
                    <a href="{{asset('cuentas-por-pagar/pagadas')}}" class="btn btn-main btn-block custom-btn disabled">Cuentas
                        pagadas</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <h1>Pagos Realizados</h1>
            <div class="bs-docs-section">

                <div class="tab-content">

                    @if($pagadas->total() >= 11 || $item_seleccionado != "" || $buscar_rut != "")
                        {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla']) !!}
                        <div class="form-group">
                            <label for="exampleInputName2">Nombre/Empresa</label>
                            {!! Form::select('empresa',['' => 'Seleccione Nombre/empresa'] + $empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail2">Rut</label>
                            {!! Form::text('rut',$buscar_rut,['class' => 'form-control']) !!}
                        </div>

                        <button class="btn btn-sm btn-primarynew btn-filtro" type="submit">Filtrar</button>
                        {!! Form::close() !!}
                    @endif

                    <div id="pagadas" class="tab-pane fade in active">

                        <table class="table listado listado-pagadas table-hover">
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th style="min-width:100px;">Rut</th>
                                <th>Nombre/Empresa</th>
                                <th>Descripción</th>
                                <th>Vencimiento</th>
                                <th style="min-width:130px;">Fecha de pago
                                    @if(Input::get('fecha') != null && Input::get('fecha') == 'asc')
                                        <a href="{{URL::route('pagadas',array('fecha' => 'desc','empresa' => Request::get('empresa'),'page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                        </a>
                                    @else
                                        <a href="{{URL::route('pagadas',array('fecha' => 'asc','empresa' => Request::get('empresa'),'page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                        </a>
                                    @endif
                                </th>
                                <th>Forma de Pago</th>
                                <th style="min-width:85px;">Monto ($)
                                    @if(Input::get('monto') != null && Input::get('monto') == 'asc')
                                        <a href="{{URL::route('pagadas',array('monto' => 'desc','empresa' => Request::get('empresa'),'page' => Request::get('page'), 'fecha' => Request::get('fecha')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                        </a>
                                    @else
                                        <a href="{{URL::route('pagadas',array('monto' => 'asc','empresa' => Request::get('empresa'),'page' => Request::get('page'), 'fecha' => Request::get('fecha')))}}">
                                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                        </a>
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pagadas as $fila)
                                <tr>
                                    {{--<td>{{$fila->idCobros}}</td>--}}
                                    <td>{{App\Helper\Rut::rut($fila->rut_cobrador)}}</td>
                                    <td>{{$fila->empresa}}</td>
                                    <td>{{$fila->descripcion}}</td>
                                    <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                                    <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_pago)}}</td>
                                    <td>
                                        @if(empty($fila->forma_pago))
                                            TEF (Conc.Auto)
                                        @else
                                            {{@$fila->forma_pago}}
                                        @endif
                                    </td>
                                    <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                                    <td>
                                        @if(!empty($ff[$fila->idCobros]))
                                            <a href="{{asset($ff[$fila->idCobros])}}" target="_blank"
                                               class="btn btn-success btn-sm">Archivo adjunto</a>
                                        @endif
                                        {{--@if($fila->adjunto != 0 && $fila->adjunto != null)--}}
                                            {{--<a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->adjunto))}}"--}}
                                               {{--class="btn btn-success btn-sm">Descargar</a>--}}
                                        {{--@endif--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$pagadas->appends(Request::only(['monto','fecha','empresa','rut']))->render()) !!}
                    </div><!-- pagadas-->

                </div><!--tab-content-->
            </div><!--docs section-->
        </div><!--container end-->
    </div><!--component-bg-->
@endsection
