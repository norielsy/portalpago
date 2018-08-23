@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>UF/Pesos</h1>
        </div>
    </div>

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
                    <form method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="col-md-6">
                            <input type="text" placeholder="Ingrese la cantidad de pesos" name="pesos"
                                   class="form-control" value="{{$comision->valor_configuracion}}">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit"> Guardar</button>
                        </div>
                        <!--<div class="col-md-3">
                            UF: ${{$comision->valor_configuracion}} / {{$uf->valor}} = {{number_format($comision->valor_configuracion / $uf->valor, 4)}}
                        </div>-->
                          <div class="col-md-3">
            
                            UF: {{$comision->valor_configuracion}} * {{$uf->valor}} = ${{number_format($comision->valor_configuracion * $uf->valor)}}
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection