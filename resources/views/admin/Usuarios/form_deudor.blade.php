@section('form_deudor')
    <div id="form-cobrador" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"># ID cliente</h4>
                </div>
                {!! Form::open(['method' => 'POST','id' => 'form_edit_usuario_main','class'=>'form-signin wow fadeInUp','action' => 'Admin\UsuarioController@editar_deudor']) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Responsable de la cuenta</h3>


                                <div class="form-group">
                                    <label>Nombre</label>
                                    {!! Form::text('nombre',null,['class' => 'form-control','id' => 'edit_nombre']) !!}
                                </div>
                                <!--
                                <div class="form-group">
                                    <label>Apellido</label>
                                    {!! Form::text('apellido',null,['class' => 'form-control','id' => 'edit_apellido']) !!}
                                </div> -->

                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email',null,['class' => 'form-control','id' => 'edit_email']) !!}

                                </div>

                                <!--
                                <div class="form-group">
                                    <label>Teléfono Fijo</label>
                                    {!! Form::text('telefono',null,['class' => 'form-control','id' => 'edit_telefono']) !!}
                                </div>
                                -->

                                <div class="form-group">
                                    <label>Celular</label>
                                    {!! Form::text('celular',null,['class' => 'form-control','id' => 'edit_celular']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Clave</label>
                                    {!! Form::password('passwordp',['class' => 'form-control','id' => 'passwordp','placeholder' => 'Clave']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Confirmar Clave</label>
                                    {!! Form::password('passwordp_confirmation',['class' => 'form-control','placeholder' => 'Confirmar Clave']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Deudas asociadas</label>
                                    <input class="form-control input-sm" id="total_deudas_registro" id="disabledInput" disabled="">
                                </div>

                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="col-lg-6">
                            <h3>Información de la empresa</h3>

                            <div class="form-group">
                                <label>Rut</label>
                                {!! Form::text('rutx',null,['class' => 'form-control','id' => 'edit_rut','disabled' => '']) !!}

                            </div>
                            
                            <!--
                            <div class="form-group">
                                <label>Nombre / Razón social</label>
                                {!! Form::text('razon_social',null,['class' => 'form-control','id' => 'edit_razon_social']) !!}
                            </div> -->

                            <div class="form-group">
                                <label>Dirección</label>
                                {!! Form::text('direccion',null,['class' => 'form-control','id' => 'edit_direccion']) !!}
                            </div>

                            <div class="form-group">
                                <label>Región</label>
                                <select class="form-control input-sm " name="IDRegion" id="edit_IDRegion">
                                    @foreach($regiones as $region)
                                        <option value="{{$region->IDRegion}}">{{$region->region}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Giro</label>
                                <select class="form-control input-sm " name="idrubros" id="edit_idrubros">
                                    @foreach($rubros as $rubro)
                                        <option value="{{$rubro->idrubros}}">{{$rubro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tipo de usuario</label>
                                <select class="form-control" name="tipo_usuario">
                                    <option value="0">Cobrador / Deudor</option>
                                    <option value="operativo">Operativo</option>
                                    <option value="consultivo">Consultivo</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Rut asociado</label>
                                <input class="form-control input-sm" name="rut_hijo" id="edit_rut_asociado">
                            </div>

                            <div class="form-group">
                                <label>Último Log.</label>
                                <input class="form-control input-sm" id="ultimo_log" disabled="">
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection