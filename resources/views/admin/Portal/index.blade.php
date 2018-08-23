@extends('layouts.template_admin')
@include('admin.Portal.modal_editar')
@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Imagenes Portal</h1>
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
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>título</th>
                                <th>Vista Previa</th>
                                <th>Editar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tabla as $data)
                                <tr>
                                    <td>{{$data->idimg_portal}}</td>
                                    <td>{{$data->titulo}}</td>
                                    <td><img src="{{asset("public/images/portal/".$data->path_imagen)}}" style="width: 200px;"/></td>
                                    <td>
                                        <a href="javascript:;" class="modal_edit" attr-id="{{$data->idimg_portal}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
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

    <script src="{{ asset('public/js/admin/validaciones/val_editar_portal.js')}}"></script>
    <script src="{{ asset('public/js/admin/Portal.js')}}"></script>
@endsection