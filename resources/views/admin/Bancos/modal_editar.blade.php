@section('modal_editar')
    <div id="modal_editar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['method' => 'POST','id' => 'form_editar','class'=>'form-signin','action' => 'Admin\BancosController@editar']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar - banco</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Banco</label>
                                {!! Form::text('banco',null,['class' => 'form-control','id' => 'rubro_edit']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection