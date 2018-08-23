$(function(){
    $(".link_form_deudor").on('click',function(){
        var rut = $(this).attr('attr-rut');
        var values = {
            "rut": rut,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/usuarios/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){

                    $("#edit_nombre").val(obj.nombre);
                    $("#edit_email").val(obj.email);
                    $("#edit_telefono").val(obj.telefono);
                    $("#edit_celular").val(obj.celular);
                    $("#edit_rut").val(obj.rut);
                    $("#edit_direccion").val(obj.direccion);
                    $("#edit_IDRegion").val(obj.IDRegion);
                    $("#edit_idrubros").val(obj.idrubros);
                    $("#id_edit").val(obj.idUsuarios);
                    $("#ultimo_log").val(obj.ultimo_log);
                    $("#edit_razon_social").val(obj.razon_social);
                    $("#edit_apellido").val(obj.apellido);
                    $("#total_deudas_registro").val(obj.total_deudas);
                    $("#form-cobrador").modal('show');
                }
            }
        });
    });

    $(".link_form_noregistrado").on('click',function(){
        var rut = $(this).attr('attr-rut');
        var from = $(this).attr('attr-from');
        var rutno = $(this).attr('attr-rutno');
        var values = {
            "rut": rut,
            "from": from,
            "rutno": rutno,
            "_token": _token
        };
        $.ajax({
            url: url + "admincp/usuarios/buscarnoregistrados",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#nor_rut").val(obj.rut);
                    $("#nor_email").val(obj.email);
                    $("#nor_empresa").val(obj.nombre);
                    $("#nor_fecha_registro").val(obj.fecha_registro);
                    $("#nor_ingresado_por").val(obj.nombre_ing + " " + obj.apellido_ing);
                    $("#total_deudas_noregistrado").val(obj.total_deudas);
                    $("#rut_noregistrado").val(obj.rut);
                    $("#form_noregistrado").modal('show');
                }
            }
        });
    });

    $(".delete_item").on('click',function(){
        var id = $(this).attr('attr-id');
        $("#id_delete").val(id);
        $("#modal_delete").modal('show');
    });
});
