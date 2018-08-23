@section('modal_editar')
    <div id="modal_edit" class="modal fade modal_new_g1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'post','class'=>'modal-content form-horizontal','action' => 'CobradoresController@edit']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Cobrador</h4>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rut_empresa">Nombre</label>
                        <div class="col-sm-6">
                            {!! Form::text('nombre',null,['disabled' => true,'id' => 'nombre_cobrador','class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rut_empresa">Rut</label>
                        <div class="col-sm-6">
                            {!! Form::text('rut',null,['disabled' => true,'id' => 'rut_cobrador_1','class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Perfil</label>
                        <div class="col-sm-6">
                            {!! Form::select('perfil',$categorias_popup,null,['class' => 'form-control','id' => 'perfil_cobrador_1']) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="id_edit">
                <button type="submit" class="btn btn-success">Editar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection