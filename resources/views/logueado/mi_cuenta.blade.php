@section('mi_cuenta')
    <div id="form_mi_cuenta" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mis datos</h4>
                </div>

                <div class="modal-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#banco" aria-controls="profile" role="tab"
                                                                  data-toggle="tab">Cuenta de cobro</a></li>
                        <li role="presentation"><a href="#account" aria-controls="home" role="tab" data-toggle="tab">Datos
                                Personales</a></li>

                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane " id="account">
                            {!! Form::open(['method' => 'POST','id' => 'form_mi_cuenta','class'=>'','action' => 'HomeController@editar_cuenta']) !!}

                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Rut</label>
                                        {!! Form::text('rutx',Session::get('rut'),['class' => 'form-control rut_data_main','id' => 'edit_rut','disabled' => '']) !!}

                                    </div>
                                    <div class="form-group">
                                        <label>Nombre/Razón Social</label>
                                        {!! Form::text('nombre',Session::get('mi_nombre'),['class' => 'form-control','id' => 'edit_nombre']) !!}
                                    </div>
                                <!--
                            <div class="form-group">
                                <label>Apellido</label>
                                {!! Form::text('apellido',Session::get('mi_apellido'),['class' => 'form-control','id' => 'edit_apellido']) !!}
                                        </div>
-->
                                    <div class="form-group">
                                        <label>Email</label>
                                        {!! Form::text('email',Session::get('email'),['class' => 'form-control','id' => 'edit_email']) !!}

                                    </div>

                                    <div class="form-group">
                                        <label>Celular</label>
                                        {!! Form::text('celular',Session::get('celular'),['class' => 'form-control','id' => 'edit_celular']) !!}

                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <div class="col-lg-6">
                                <!--
                            <div class="form-group">
                                <label>Nombre / Razón social</label>
                                {!! Form::text('razon_social',Session::get('razon_social'),['class' => 'form-control','id' => 'edit_razon_social']) !!}
                                        </div>
-->

                                    <div class="form-group">
                                        <label>Dirección</label>
                                        {!! Form::text('direccion',Session::get('direccion'),['class' => 'form-control','id' => 'edit_direccion']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label>Región</label>
                                        <select class="form-control input-sm " name="IDRegion" id="edit_IDRegion">
                                            @foreach(Session::get('lista_regiones') as $region)
                                                <option value="{{$region->IDRegion}}"
                                                        @if($region->IDRegion == Session::get('IDRegion')) selected="1" @endif>{{$region->region}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Comuna</label>
                                        {!! Form::text('comuna',Session::get('comuna'),['class' => 'form-control','id' => 'edit_comuna']) !!}

                                    </div>

                                    <div class="form-group">
                                        <label>Actividad</label>
                                        <select class="form-control input-sm " name="idrubros" id="edit_idrubros">
                                            @foreach(Session::get('lista_rubros') as $rubro)
                                                <option value="{{$rubro->idrubros}}"
                                                        @if($rubro->idrubros == Session::get('idrubros')) selected="1" @endif>{{$rubro->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id_edit" id="id_edit">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primarynew" id="btn_edit_cuenta" type="submit">Guardar</button>

                            </div>


                            {!! Form::close() !!}
                        </div>


                        <div role="tabpanel" class="tab-pane active" id="banco">

                            {!! Form::open(['method' => 'POST','id' => 'form_mi_cuenta_bancaria','class'=>'','action' => 'HomeController@editar_cuenta_bancaria']) !!}
                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Banco</label>
                                    <!--{!! Form::text('banco',Session::get('banco'),['class' => 'form-control']) !!}-->
                                        {!! Form::select('banco',\App\Extras\Utilidades::lista_bancos(),Session::get('banco'),['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tipo de cuenta</label>
                                        {!! Form::select('tipo_cuenta',\App\Extras\Utilidades::tipo_cuenta(),Session::get('tipo_cuenta'),['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>N° Cuenta</label>
                                        {!! Form::text('nro_cuenta',Session::get('nro_cuenta'),['class' => 'form-control', 'required' => true]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="alert top25 alert-info">
                                <strong>Recuerda</strong>
                                <p>- Sólo puedes utilizar 1 cuenta (corriente, vista) para realizar tus cobros.</p>
                                <p>- La cuenta informada debe estar bajo tu rut.</p>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id_edit" id="id_edit">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primarynew" id="btn_edit_cuenta" type="submit">Guardar</button>

                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="{{asset('public/js/validaciones/validation_cuenta.js')}}"></script>
@endsection