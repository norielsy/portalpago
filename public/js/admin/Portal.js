$(function(){
    $(".modal_edit").on('click',function(){
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/imagenportal/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#titulo_edit").val(obj.titulo);
                    $("#descripcion_edit").val(obj.descripcion);
                    $("#id_edit").val(id);
                    $("#modal_editar").modal('show');
                }
            }
        });
    });

});