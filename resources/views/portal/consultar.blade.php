@extends('template')

@section('title')
    Consultar Cobros | Portal de Pagos
    @endsection

    @section('content')
            <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
                    <h1 class="top10">
                        Gestión de Cobros
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container password_restablecer">

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
            <div class="col-md-12">
                {!! Form::open(['method' => 'post']) !!}
                <div class="form-group">
                    <label>Rut</label>
                    <input type="text" value="{{$rut}}" name="rut" placeholder="Ingrese su rut" class="form-control">
                </div>

                {!! app('captcha')->display() !!}

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="row">
            <table class="table listado-deudas table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Empresa</th>
                    <th>Descripción</th>
                    <th>Vencimiento
                        <a href="{{URL::route('consultar',array('fecha' => 'desc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                        </a>
                        <a href="{{URL::route('consultar',array('fecha' => 'asc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                        </a>
                    </th>
                    <th>Monto
                        <a href="{{URL::route('consultar',array('monto' => 'desc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                        </a>
                        <a href="{{URL::route('consultar',array('monto' => 'asc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($data != null)
                    @foreach($data as $fila)
                        <tr>
                            <td>{{$fila->idCobros}}</td>
                            <td>{{$fila->empresa}}</td>
                            <td>{{$fila->descripcion}}</td>
                            <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                            <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="nodata">Debe ingresar su rut para buscar los cobros</td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($data != null)
                {!! str_replace('/?', '?',$data->appends(Request::only(['fecha','monto','empresa','rut']))->render()) !!}
            @endif
        </div>

    </div>
@endsection
