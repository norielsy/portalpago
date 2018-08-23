$(function(){
    $(".modal_edit").on('click',function(){
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/rubros/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#rubro_edit").val(obj.nombre);
                    $("#id_edit").val(id);
                    $("#modal_editar").modal('show');
                }
            }
        });
    });

    $(".modal_elimitar").on('click',function(){
        var id = $(this).attr('attr-id');
        $("#id_delete").val(id);
        $("#modal_delete").modal('show');
    });
});