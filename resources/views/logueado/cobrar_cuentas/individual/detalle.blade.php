@extends('template')

@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')
    <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}" />
        <!--container start-->
    <div class="component-bg">
        <div class="container">

            <div class="row logout">
                <div class="col-lg-8 col-sm-8">
                    <div class="bienvenido pull-left">
                        Bienvenido <strong class="azul">{{ Session::get('nombre') }}</strong>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="salir pull-right">
                        <a class="verde" href="{{asset('logout')}}">Salir <i class="fa fa-sign-out"></i></a>
                    </div>

                </div>
            </div>

            @if(Session::has('ok'))
                <br/>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! Session::get('ok') !!}
                </div>
            @endif

            <h1>Cobrar Cuentas</h1>

            <div class="bs-docs-section">
                <h3>Detalle cobro puntual</h3>

                <table class="table listado-deudas table-hover top50">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Empresa </th>
                            <th> Descripción </th>
                            <th>Rut</th>
                            <th>Email</th>
                            <th>Fecha Venc.</th>
                            <th>Monto
                                <a href="{{URL::route('detallepuntuales',array('monto' => 'desc','id' => $id,'page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                                <a href="{{URL::route('detallepuntuales',array('monto' => 'asc','id' => $id,'page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            </th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detalles as $detalle)
                            <tr>
                                <td>{{$detalle->idCobros}}</td>
                                <td>{{$detalle->empresa}}</td>
                                <td>{{$detalle->descripcion}}</td>
                                <td>{{$detalle->rut_empresa}}</td>
                                <td>{{$detalle->email}}</td>
                                <td>{{App\Extras\Utilidades::ImprimirFecha($detalle->fecha_vencimiento)}}</td>
                                <td>{{App\Extras\Utilidades::Moneda($detalle->monto)}}</td>
                                <td>
                                    @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                                    <a href="javascript:;" >
                                        <i attr-id="{{$detalle->idCobros}}" class="icono-verde fa fa-pencil-square-o editar_cobros_puntuales"></i>
                                    </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                                    <a class="delete_items" href="javascript:;" attr-id="{{$detalle->idCobros}}">
                                        <i class="icono-verde fa fa-minus-square"></i>
                                    </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! str_replace('/?', '?',$detalles->appends(Request::only(['monto','id']))->render()) !!}
                <a class="btn btn-primarynew btn-lg pull-right" href="{{ URL::action('CobrarController@puntales')}}">Volver a Cobrar Cuentas</a>

            </div> <!-- por pagar -->



        </div><!--docs section-->
    </div><!--container end-->


    <div id="modal_delete_items" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'DELETE','class'=>'modal-content','action' => 'CobrarController@eliminarcobro']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar cobro</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar el cobro?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idcobro" id="id_item_delete" value="">
                <input type="hidden" name="id_params" value="{{$id}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Eliminar</button>
            </div>
            {!! Form::close() !!}}
        </div>
    </div>



    <script src="{{ asset('public/js/validaciones/validation_cobrospuntales.js')}}"></script>
@endsection