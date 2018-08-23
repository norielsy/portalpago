@extends('layouts.template_admin')

@include('admin.Publicidad.modal_editar')
@include('admin.Publicidad.modal_eliminar')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Publicidad</h1>
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


    {!! Form::open(['method' => 'POST','class'=>'form-horizontal','id' => 'form_agregar','action' => 'Admin\PublicidadController@agregar_post','files' => true]) !!}
    <div class="row box-blanca">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="empresa">Título</label>
                <div class="col-sm-10">
                    {!! Form::text('titulo',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="empresa">Link (opcional)</label>
                <div class="col-sm-10">
                    {!! Form::text('link',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="rut_empresa">Imagen</label>
                <div class="col-sm-10">
                    {!! Form::file('imagen',null,['class' => 'form-control']) !!}
                    <div class="alert alert-info" role="alert">
                        Formatos: jpg,jpeg,gif,png - Tamaño máximo: 1mb
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">Fecha Inicio</label>
                <div class="col-sm-10">
                    {!! Form::text('fecha_inicio',null,['class' => 'form-control','id' => 'from']) !!}
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="descripcion">Descripción</label>
                <div class="col-sm-10">
                    <textarea rows="2" name="descripcion" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="monto">Fecha Término</label>
                <div class="col-sm-10">
                    {!! Form::text('fecha_fin',null,['class' => 'form-control','id' => 'to']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn  pull-right" type="submit">Subir</button>
                </div>
            </div>
        </div>
    </div><!-- box blaca -->
    {!! Form::close() !!}


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>título</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Término</th>
                                <th>Vista Previa</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tabla as $data)
                                <tr>
                                    <td>{{$data->idpublicidad}}</td>
                                    <td>{{$data->titulo}}</td>
                                    <td>{{$data->fecha_inicio}}</td>
                                    <td>{{$data->fecha_termino}}</td>
                                    <td><img src="{{asset("public/images/p/".$data->path_imagen)}}" style="width: 200px;"/></td>
                                    <td>
                                        <a href="javascript:;" class="modal_edit_p" attr-id="{{$data->idpublicidad}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="modal_elimitar" attr-id="{{$data->idpublicidad}}">
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

    <script src="{{ asset('public/js/admin/publicidad1.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/val_editar_publicidad.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/val_agregar_publicidad.js')}}"></script>

@endsection