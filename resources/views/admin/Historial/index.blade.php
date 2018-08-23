@extends('layouts.template_admin')



@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Historial de notificaciones</h1>
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


    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            {!! Form::open(['method' => 'get','class' => 'form-inline']) !!}
                <div class="form-group">
                    {!! Form::select('b', $usuarios,Request::input('b'),['class' => 'form-control select2']) !!}
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <table class="table listado-deudas table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th>Fecha de creación</th>
                    <th>Título</th>
                    <th>Usuario</th>
                    <th>Para</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($tabla != null && $tabla->total() > 0)
                    @foreach($tabla as $fila)
                        <tr>
                            <td>{{$fila->idhistorial_envio_email}}</td>
                            <td>{{$fila->created_at}}</td>
                            <td>{{$fila->mensaje}}</td>
                            <td>{{$fila->nombre}} {{$fila->apellido}}</td>
                            <td>{{$fila->para}}</td>
                            <td>
                                @if($fila->tipo_email <= 7)
                                    <a href="{{ \Illuminate\Support\Facades\URL::action('Admin\HistorialController@reenviar')."?u=".$fila->idUsuarios."&p=".$fila->para."&email=".$fila->tipo_email."&de=".$fila->de}}" class="btn btn-success btn-xs btn_loading" >Reenviar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @elseif($tabla != null && $tabla->total() == 0)
                    <tr>
                        <td colspan="6" class="nodata" style="text-align: center">No se encontraron resultados</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6" class="nodata" style="text-align: center">Debe seleccionar un rut</td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($tabla != null)
                {!! str_replace('/?', '?',$tabla->appends(Request::only(['rut','b']))->render()) !!}
            @endif
        </div>
    </div>



@endsection