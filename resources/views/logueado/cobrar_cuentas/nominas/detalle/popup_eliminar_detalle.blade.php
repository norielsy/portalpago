@section('modal_detalle_eliminar')
    <div id="modal_delete_items" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'DELETE','class'=>'modal-content','action' => 'CobrarController@eliminar_nomina_detalle']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar nómina</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar la nomina?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idnomina" id="id_item_delete" value="">
                <input type="hidden" name="id_params" value="{{$id}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Eliminar</button>
            </div>
            {!! Form::close() !!}}
        </div>
    </div>
@endsection