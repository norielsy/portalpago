@section('modal_detalle_editar')
<div id="modal_edit_detalle_nomina" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['method' => 'post','id' => 'form_edit_detalle_nomina','class'=>'modal-content form-horizontal','action' => 'CobrarController@editar_detalle_nomina']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Nómina</h4>
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="empresa">Empresa</label>
                    <div class="col-sm-6">
                        {!! Form::text('nombre',null,['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="rut_empresa">Rut</label>
                    <div class="col-sm-6">
                        {!! Form::text('rut',null,['class' => 'form-control']) !!}
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

<!--
                    <h5>Transpasar deuda</h5>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="rut_empresa">Rut</label>
                            <div class="col-sm-6">
                                {!! Form::text('rut_traspaso',null,['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="email">Email</label>
                            <div class="col-sm-6">
                                {!! Form::text('email_traspaso',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                -->
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::hidden('id_nomina','',['id' => 'id_nomina']) !!}
            {!! Form::hidden('id_nomina_detalle','',['id' => 'id_nomina_detalle']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        {!! Form::close() !!}}
    </div>
</div>
@endsection
