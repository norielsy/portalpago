$(function(){
    $(".detalle_item").on('click',function(){
        var id = $(this).attr('attr-id');
        var tipo = $(this).attr('attr-type');
        var values = {
            "id": id,
            "tipo":tipo,
            "_token": _token
        };
        console.log(url+'/admincp/pendientes/buscar')
        $.ajax({
            url: url + "admincp/pendientes/buscar",
            type: "POST",
            data: values ,
            //success: function (response) {
               
            //}
        }).done(function(response){
            var obj = JSON.parse(response);
            if(obj != null){
                $("#id_edit").val(id);
                $("#tipo_edit").val(tipo);
                if(tipo == 1){
                    $("#rut_deudor_pen").val(obj.rut_empresa);
                    $("#empresa_deudor_pen").val(obj.empresa);
                    $("#email_pen").val(obj.email);
                    $("#descripcion_pen").val(obj.descripcion);
                    $("#monto_pen").val(obj.monto);
                    $("#rut_cobrador_pen").val(obj.rut_cobrador);
                    $("#empresa_cobrador_pen").val(obj.reg_nombre + " " + obj.reg_apellido);
                    $("#fecha_vencimiento_pen").datepicker("setDate",convertirFechaInput(obj.fecha_vencimiento));
                }else if(tipo == 2){
                    $("#rut_deudor_pen").val(obj.rut);
                    $("#empresa_deudor_pen").val(obj.nombre);
                    $("#email_pen").val(obj.email);
                    $("#descripcion_pen").val(obj.descripcion);
                    $("#monto_pen").val(obj.monto);
                    $("#rut_cobrador_pen").val(obj.rut_cobrador);
                    $("#empresa_cobrador_pen").val(obj.reg_nombre + " " + obj.reg_apellido);
                    $("#fecha_vencimiento_pen").datepicker("setDate",convertirFechaInput(obj.fecha_vencimiento));
                }
                $("#editar-deuda").modal('show');
            }
        })
    });

    $(".detalle_item_pagadas").on('click',function(){
        var id = $(this).attr('attr-id');
        var tipo = $(this).attr('attr-type');
        var values = {
            "id": id,
            "tipo":tipo,
            "_token": _token
        };
        $.ajax({
            url: url + "admincp/pagadas/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    if(tipo == 1){
                        $("#rut_deudor").val(obj.rut_empresa);
                        $("#empresa_deudor").val(obj.empresa);
                        $("#fecha_vencimiento").val(convertDate(obj.fecha_vencimiento));
                        $("#nomina_asociada").val();
                        $("#descripcion").val(obj.descripcion);
                        $("#rut_cobrador").val(obj.rut_cobrador);
                        $("#empresa").val(obj.reg_nombre + " " + obj.reg_apellido);
                        $("#fecha_pago").val(obj.fecha_pago);
                        $("#monto").val(obj.monto);
                        $("#nro_transaccion").val(obj.nro_transaccion);
                    }else if(tipo == 2){
                        $("#rut_deudor").val(obj.rut);
                        $("#empresa_deudor").val(obj.nombre);
                        $("#fecha_vencimiento").val(convertDate(obj.fecha_vencimiento));
                        $("#nomina_asociada").val();
                        $("#descripcion").val(obj.descripcion);
                        $("#rut_cobrador").val(obj.rut_cobrador);
                        $("#empresa").val(obj.reg_nombre + " " + obj.reg_apellido);
                        $("#fecha_pago").val(obj.fecha_pago);
                        $("#monto").val(obj.monto);
                        $("#nro_transaccion").val(obj.nro_transaccion);
                    }
                    $("#detalle-pago").modal('show');
                }
            }
        });
    });

    $(".delete_item").on('click',function(){
        var id = $(this).attr('attr-id');
        var type = $(this).attr('attr-type');
        $("#id_delete").val(id);
        $("#id_type").val(type);
        $("#modal_delete").modal('show');
    });
});