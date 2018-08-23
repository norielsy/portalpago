$(function(){

    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });


    $.validator.addMethod("rut", validarRut, "El rut ingresado no es válido, Ej: 12.345.678-9");

    $("#btn_add_x").on('click',function(){
        $("#rut_cobrador").val("");
        $("#email_notificacion_registro").val("");
        $("#modal_agregar_cobradores").modal('show');
    });

    $('#form_new_cobrador').validate({
        rules: {
            rut_cobrador: {
                rut: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block has-error',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#form_send_email').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-dv').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-dv').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block has-error',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#verificar_cobrador").on('click',function(){

        var bol_ = $("#form_new_cobrador").valid();
        if(bol_){
            $(".loading2").show();
            var rut_cobrador = $("#rut_cobrador").val();
            var perfil_cobrador = $("#perfil_cobrador").val();
            $("#modal_agregar_cobradores").modal('hide');

            var values = {
                "rut_cobrador": rut_cobrador,
                "perfil_cobrador":perfil_cobrador,
                "_token": _token
            };

            $.ajax({
                url: url + "cobradores/verificar",
                type: "post",
                data: values ,
                success: function (response) {
                    var obj = JSON.parse(response);
                    $(".loading2").hide();
                    if(obj.estado == 1){
                        location.reload();
                    }else if(obj.estado == 9){
                        $("#modal_no_registrado").modal('show');
                    }else{
                        $("#mensaje_json_show").html(obj.m);
                        $("#modal_advertencia_cobros").modal('show');
                    }
                }
            });
        }

    });

    $("#btn_enviar_email").on('click',function(){
        var bol_ = $("#form_send_email").valid();
        if(bol_) {
            $(".loading2").show();
            $("#modal_no_registrado").modal('hide');
            var values = {
                "email_notificacion_registro": $("#email_notificacion_registro").val(),
                "_token": _token
            };
            $.ajax({
                url: url + "cobradores/enviaremail_registro",
                type: "post",
                data: values,
                success: function (response) {
                    var obj = JSON.parse(response);
                    $(".loading2").hide();
                    $("#mensaje_json_show").html(obj.m);
                    $("#modal_advertencia_cobros").modal('show');
                }
            });
        }
    });

    $(".btn-delete").on("click",function(){
        $("#id_delete").val($(this).attr('attr-id'));
        $("#modal_eliminar").modal('show');
    });

    $(".btn-edit").on("click",function(){
        $("#perfil_cobrador_1").val($(this).attr('attr-idp'));
        $("#rut_cobrador_1").val($(this).attr('attr-rut'));
        $("#nombre_cobrador").val($(this).attr('attr-nombre'));
        $("#id_edit").val($(this).attr('attr-id'));
        $("#modal_edit").modal('show');
    });
});