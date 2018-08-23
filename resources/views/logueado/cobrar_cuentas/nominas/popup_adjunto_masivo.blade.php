@section('modal_adjuntar_nomina_masivo')
    <div id="modal_adjuntar_nomina_masivo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Adjuntar documentos</h4>
                </div>
                {!! Form::open(['method' => 'POST','id' => 'form_adjunto','class'=>'','action' => 'CobrarController@adjuntar_doc_nomina_masiva','files' => true]) !!}
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">Nómina cargada con éxito, ¿Te gustaría adjuntar archivos?</div>
                    <div class="row">
                        <div class="alert alert-info" role="alert">
                            Formatos: pdf|excel - Tamaño máximo: 1mb
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputEmail3">Adjuntar</label>
                                <div class="col-sm-10">
                                    {!! Form::file('doc',['id' => 'doc']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_adjuntar_nominas" value="{{Session::get('ok_doc')}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline btn-success" type="submit">Adjuntar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection