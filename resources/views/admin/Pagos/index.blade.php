@extends('layouts.template_admin')

@include('admin.Pagos.editar')
@include('admin.Pagos.eliminar')

@include('admin.Pagos.TipoCuenta.editar')
@include('admin.Pagos.TipoCuenta.eliminar')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Formas de pago</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! Session::get('message') !!}
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
        <div class="col-lg-12">
            {!! Form::open(['method' => 'POST','id' => 'form_agregar_pago','class'=>'form-signin wow fadeInUp','action' => 'Admin\PagosController@agregar']) !!}
            <div class="form-group">
                <label class="control-label">Forma de pago</label>
                {!! Form::text('pago',null,['class' => 'form-control','placeholder' => 'Escriba la forma de pago']) !!}
            </div>

            <button class="btn btn-success pull-right" type="submit">Agregar</button>
            {!! Form::close() !!}
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Forma de pago</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tabla as $data)
                                <tr>
                                    <td>{{$data->idTipoPago}}</td>
                                    <td>{{$data->descripcion}}</td>
                                    <td>
                                        @if($data->editable == 1)
                                            <a href="javascript:;" class="modal_edit" attr-id="{{$data->idTipoPago}}">
                                                <i class="icono-verde fa fa-pencil-square-o "></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->editable == 1)
                                            <a href="javascript:;" class="delete_item" attr-id="{{$data->idTipoPago}}">
                                                <i class="icono-verde fa fa-minus-square">
                                                </i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla->appends(Request::only(['type']))->render()) !!}
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <!-- aca empieza editar tipos de cuenta-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tipos de cuenta</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @if (Session::has('message_cuenta'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
            {!! Session::get('message_cuenta') !!}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['method' => 'POST','id' => 'form_agregar_pago','class'=>'form-signin wow fadeInUp','action' => 'Admin\PagosController@agregarpost_cuenta']) !!}
            <div class="form-group">
                <label class="control-label">Tipo de pago</label>
                {!! Form::text('cuenta',null,['class' => 'form-control','placeholder' => 'Escriba el tipo de cuenta']) !!}
            </div>

            <button class="btn btn-success pull-right" type="submit">Agregar</button>
            {!! Form::close() !!}
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de cuenta</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tabla_cuenta as $data)
                                <tr>
                                    <td>{{$data->idTipoCuenta}}</td>
                                    <td>{{$data->descripcion}}</td>
                                    <td>
                                        @if($data->editable == 1)
                                            <a href="javascript:;" class="modal_edit_cuenta" attr-id-cuenta="{{$data->idTipoCuenta}}">
                                                <i class="icono-verde fa fa-pencil-square-o "></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->editable == 1)
                                            <a href="javascript:;" class="delete_item_cuenta" attr-id-cuenta="{{$data->idTipoCuenta}}">
                                                <i class="icono-verde fa fa-minus-square">
                                                </i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla_cuenta->appends(Request::only(['type']))->render()) !!}
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <script src="{{ asset('public/js/admin/pagos.js')}}"></script>

    @yield('modal_editar')
    @yield('modal_eliminar')

    @yield('modal_editar_cuenta')
    @yield('modal_eliminar_cuenta')


@endsection