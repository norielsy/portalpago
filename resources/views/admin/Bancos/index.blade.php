@extends('layouts.template_admin')

@include('admin.Bancos.modal_editar')
@include('admin.Bancos.modal_eliminar')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bancos</h1>
        </div>
    </div>

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
            <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp','action' => 'Admin\BancosController@agregarpost']) !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Banco</label>
                                    {!! Form::text('banco',null,['class' => 'form-control','placeholder' => 'Ingresar nombre del banco']) !!}
                                </div>
                            </div>
                            <button class="btn btn-success pull-right" type="submit">Agregar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tabla as $data)
                                <tr>
                                    <td>{{$data->idBancos}}</td>
                                    <td>{{$data->nombre}}</td>
                                    <td>
                                        <a href="javascript:;" class="modal_edit" attr-id="{{$data->idBancos}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="modal_elimitar" attr-id="{{$data->idBancos}}">
                                            <i class="icono-verde fa fa-minus-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla->appends(Request::only(['type']))->render()) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('modal_editar')
    @yield('modal_eliminar')
    <script src="{{ asset('public/js/admin/bancos.js')}}"></script>
@endsection