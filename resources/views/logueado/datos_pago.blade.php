@section('cuenta_bancaria')
    <div id="form_cuenta_bancaria" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cuenta de cobro</h4>
                </div>
                {!! Form::open(['method' => 'POST','id' => 'form_mi_cuenta_bancaria','class'=>'','action' => 'HomeController@editar_cuenta_bancaria']) !!}
                <div class="modal-body">

                    <p>Ingresa, por favor, los datos de la cuenta que utilizas para recibir tus pagos.</p>
                    <p>Estos nos servirán para informar a tus clientes en que cuenta realizar el pago, cuando lo hagan vía transferencia electrónica.</p>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Banco</label>
                                {!! Form::text('banco',Session::get('banco'),['class' => 'form-control']) !!}

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
                                {!! Form::text('nro_cuenta',Session::get('nro_cuenta'),['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="alert top25 alert-info">
                        <strong>Recuerda</strong>
                        <p>- Sólo puedes utilizar 1 cuenta para realizar tus pagos.</p>
                        <p>- La cuenta informada debe estar bajo tu rut.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <button class="btn btn-outline btn-success" id="btn_edit_cuenta" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection