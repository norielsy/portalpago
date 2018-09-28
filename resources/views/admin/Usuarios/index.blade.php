@extends('layouts.template_admin')
@include('admin.Usuarios.form_deudor')
@include('admin.Usuarios.form_noregistrado')
@include('admin.Usuarios.eliminar')
@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Listado de usuarios</h1>
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

        <div class="col-lg-12 buscador_admin">
            {!! Form::open(['method' => 'get','class'=>'form-inline']) !!}
                <div class="form-group">
                    <label>Rut</label>
                    {!! Form::text('rut',Request::input('rut'),['class' => 'form-control']) !!}
                    <input type="hidden" name="type" value="{{Request::input('type')}}">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Para ver más detalles presione EDITAR

                    <span class="tipos-usuarios pull-right">
                        <a href="{{asset('/admincp/usuarios?type=deudor')}}"><i class="fa fa-user usuario-deudor"></i> Deudor</a> |
                        <a href="{{asset('/admincp/usuarios?type=cobrador')}}"><i class="fa fa-user usuario-cobrador"></i> Cobrador</a> |
                        <a href="{{asset('/admincp/usuarios?type=operador')}}"><i class="fa fa-user usuario-operador"></i> Operador</a> |
                        <a href="{{asset('/admincp/usuarios?type=consultor')}}"><i class="fa fa-user usuario-consultor"></i> Consultor</a>
                    </span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rut</th>
                                <th>Empresa</th>
                                <th>Email</th>
                                <th>Fecha Creación</th>
                                <th>Tipo de usuario</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tabla as $data)
                                <tr>
                                    <td>{{$data->idUsuarios}}</td>
                                    <td>{{$data->rut}}</td>
                                    <td>{{$data->nombre}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        @if($data->type == "usuario")
                                                <i class="fa fa-user usuario-cobrador"></i>
                                            @endif

                                        @if($data->consultor)
                                                <i class="fa fa-user usuario-consultor"></i>
                                            @endif

                                        @if($data->operativo)
                                                <i class="fa fa-user usuario-operador"></i>
                                            @endif
                                        @if($data->deudor1 || $data->deudor2)
                                                <i class="fa fa-user usuario-deudor"></i>
                                            @endif
                                    </td>
                                    <td>
                                        @if($data->type == "usuario")
                                        <a href="javascript:;" class="link_form_deudor" attr-rut="{{$data->rut}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
                                        </a>
                                        @endif

                                        @if($data->type == "noregistrado")
                                                <a href="javascript:;" class="link_form_noregistrado" attr-rut="{{$data->idUsuarios}}" attr-rutno="{{$data->rut}}" attr-from="{{$data->dest}}">
                                                    <i class="icono-verde fa fa-pencil-square-o "></i>
                                                </a>
                                            @endif
                                    </td>
                                    @if($data->type == "usuario")
                                    <td>
                                        <a href="javascript:;" class="delete_item" attr-id="{{$data->idUsuarios}}">
                                            <i class="icono-verde fa fa-minus-square">
                                            </i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla->appends(Request::only(['rut']))->render()) !!}
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <script src="{{ asset('public/js/admin/usuarios.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/val_editar_usuario.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/val_editar_no_registrado.js')}}"></script>
    @yield('form_deudor')
    @yield('form_noregistrado')
    @yield('modal_eliminar')
@endsection