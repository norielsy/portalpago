@extends('template')

@section('title')
    Completar Datos Faltantes
@endsection

@section('content')
    <div class="container">
        <div class="row col-md-6 col-md-push-3">
            <h1>Completar Datos</h1>
            <small>Para poder cobrar necesitamos que completes los siguientes datos.</small>
            {!! Form::open(['method' => 'POST','id' => 'form_mi_cuenta','class'=>'','action' => 'HomeController@editar_cuenta']) !!}

            <br/>
            <div class="row">
               <div class="col-xs-12">
                   <div class="data">
                       Datos personales
                   </div>
               </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Rut</label>
                        {!! Form::text('rutx',Session::get('rut'),['class' => 'form-control rut_data_main','id' => 'edit_rut','disabled' => '']) !!}

                    </div>
                    <div class="form-group">
                        <label>Nombre/Razón Social</label>
                        {!! Form::text('nombre',Session::get('mi_nombre'),['class' => 'form-control','id' => 'edit_nombre', 'required' => true]) !!}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        {!! Form::text('email',Session::get('email'),['class' => 'form-control','id' => 'edit_email', 'required' => true]) !!}

                    </div>

                    <div class="form-group">
                        <label>Celular</label>
                        {!! Form::text('celular',Session::get('celular'),['class' => 'form-control','id' => 'edit_celular', 'required' => true]) !!}

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Dirección</label>
                        {!! Form::text('direccion',Session::get('direccion'),['class' => 'form-control','id' => 'edit_direccion', 'required' => true]) !!}
                    </div>

                    <div class="form-group">
                        <label>Región</label>
                        <select class="form-control" name="IDRegion" id="edit_IDRegion">
                            @foreach(Session::get('lista_regiones') as $region)
                                <option value="{{$region->IDRegion}}"
                                        @if($region->IDRegion == Session::get('IDRegion')) selected="1" @endif>{{$region->region}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Comuna</label>
                        {!! Form::text('comuna',Session::get('comuna'),['class' => 'form-control','id' => 'edit_comuna', 'required' => true]) !!}

                    </div>

                    <div class="form-group">
                        <label>Actividad</label>
                        <select class="form-control" name="idrubros" id="edit_idrubros">
                            @foreach(Session::get('lista_rubros') as $rubro)
                                <option value="{{$rubro->idrubros}}"
                                        @if($rubro->idrubros == Session::get('idrubros')) selected="1" @endif>{{$rubro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="data">
                        Datos Bancarios
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Banco</label>
                <!--{!! Form::text('banco',Session::get('banco'),['class' => 'form-control']) !!}-->
                    {!! Form::select('banco',\App\Extras\Utilidades::lista_bancos(),Session::get('banco'),['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label>Tipo de cuenta</label>
                    {!! Form::select('tipo_cuenta',\App\Extras\Utilidades::tipo_cuenta(),Session::get('tipo_cuenta'),['class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>N° Cuenta</label>
                        {!! Form::text('nro_cuenta',Session::get('nro_cuenta'),['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
                <!-- /.col-lg-6 (nested) -->
            </div>
            <button class="btn btn-primarynew pull-right" id="btn_edit_cuenta" type="submit">Guardar</button>
            <span>* Todos los campos son requeridos.</span>
            {!! Form::close() !!}
            <div class="clearfix top50"></div>
        </div>
    </div>
@endsection
