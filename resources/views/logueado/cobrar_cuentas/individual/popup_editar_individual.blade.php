@section('modal_editar_individual')
<div id="modal_edit_cobro_puntual" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['method' => 'post','id' => 'form_cobrospuntuales','class'=>'modal-content form-horizontal','action' => 'CobrarController@editar_puntuales']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar cobro puntual</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="empresa">Empresa</label>
                    <div class="col-sm-6">
                        {!! Form::text('empresa',null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="rut_empresa">Rut</label>
                    <div class="col-sm-6">
                        {!! Form::text('rut_empresa',null,['class' => 'form-control rut_input_point']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="email">Email</label>
                    <div class="col-sm-6">
                        {!! Form::text('email',null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="monto">Monto</label>
                    <div class="col-sm-6">
                        {!! Form::text('monto',null,['class' => 'form-control moneda']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="fecha_vencimiento">Fecha Vencimiento</label>
                    <div class="col-sm-6">
                        {!! Form::text('fecha_vencimiento',null,['class' => 'form-control datepicker_all', 'autocomplete' => "off"]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="descripcion">Descripción</label>
                    <div class="col-sm-6">
                        <textarea name="descripcion" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            {{--

               --}}
           </div>
           <div class="modal-footer">
            {!! Form::hidden('id_cobro','',['id' => 'id_cobro']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        {!! Form::close() !!}}
    </div>
</div>
@endsection
