@section('modal_editar')
    <div id="modal_editar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['method' => 'POST','id' => 'form_editar','class'=>'form-signin','action' => 'Admin\ImagenPortalController@editar','files' => true]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar - recomendado: 1200x204</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="alert alert-info" role="alert">
                            Formatos: jpg,jpeg,gif,png - Tamaño máximo: 1mb
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Imagen </label>
                                {!! Form::file('doc') !!}
                            </div>

                            <div class="form-group">
                                <label>Título</label>
                                {!! Form::text('titulo',null,['class' => 'form-control','id' => 'titulo_edit']) !!}
                            </div>

                            <div class="form-group">
                                <label>Link (opcional)</label>
                                {!! Form::text('link',null,['class' => 'form-control','id' => 'link_edit']) !!}
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="2" name="descripcion" id="descripcion_edit" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection