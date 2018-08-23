@extends('template')
@include('logueado.cobradores.agregar')
@include('logueado.cobradores.eliminar')
@include('logueado.cobradores.editar')

@section('title')
    Gestionar Usuarios | Portal de Pagos
    @endsection

    @section('content')
            <!--container start-->
    <div class="component-bg">
        <div class="container">

            @include('logueado.publicidad')
            @yield('content_publicidad')


            <div class="overflow">
                <div class="col-lg-9 col-md-9 col-xs-12">
                    <h1>Gestionar usuarios </h1>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <h1>
                        <button type="button" id="btn_add_x" class="btn btn-primarynew"> <i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo usuario</button>
                    </h1>
                </div>

            </div>

            <div class="bs-docs-section">
                <div class="tab-content">
                    <div id="nominas" class="tab-pane fade in active responsive-table">


                        <table class="table listado-deudas table-hover">
                            <thead>
                            <tr>
                                <th> Rut </th>
                                <th> Nombre Usuario </th>
                                <th> Email </th>
                                <th> Perfil </th>
                                <th> Estado</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($tabla->count() > 0)
                                    @foreach($tabla as $fila)
                                        <tr>
                                            <td>{{$fila->rut}}</td>
                                            <td>{{$fila->nombre}}</td>
                                            <td>{{$fila->email}}</td>
                                            <td>{{$fila->perfil}}</td>
                                            <td>
                                                @if($fila->confirmado == 0)
                                                    En espera
                                                @else
                                                    Aceptado
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" attr-id="{{\Illuminate\Support\Facades\Crypt::encrypt($fila->idVistaCobradores)}}" attr-nombre="{{$fila->nombre}}" attr-rut="{{$fila->rut}}" attr-idp="{{$fila->idperfiles_cobrado}}" class="btn btn-default btn-sm btn-edit">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </button>
                                                <button type="button" attr-id="{{\Illuminate\Support\Facades\Crypt::encrypt($fila->idVistaCobradores)}}"  class="btn btn-default btn-sm btn-delete">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="">
                                        <td class="empty_row info" colspan="6">No tienes cobradores registrados</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla->render()) !!}
                    </div> <!-- nominas -->
                </div><!--tab-content-->

            </div><!--docs section-->
        </div><!--container end-->
    </div><!--component-bg-->


    @yield('modal_agregar')
    @yield('modal_eliminar')
    @yield('modal_editar')
    <script src="{{ asset('public/js/services/cobradores.js')}}"></script>
@endsection
