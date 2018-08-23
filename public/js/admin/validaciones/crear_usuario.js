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


    $.validator.addMethod("rut", validarRut, "El rut ingresado no es válido, Ej: 12345678-9");
    $('#form_registro_main').validate({
        rules: {
            rut: {
                rut: true
            },
            nombre: {
                minlength: 3,
                maxlength: 100,
                required: true
            },
            apellido: {
                minlength: 3,
                maxlength: 50,
                required: true
            },
            razon_social: {
                minlength: 3,
                maxlength: 50,
                required: true
            },
            direccion: {
                minlength: 3,
                maxlength: 255,
                required: true
            },
            email: {
                required: true,
                email: true
            },/*
            telefono: {
                minlength: 6,
                maxlength: 8,
                required: true,
                number: true
            },*/
            celular: {
                minlength: 6,
                maxlength: 9,
                required: true,
                number: true
            },
            passwordp: {
                minlength: 6,
                maxlength: 35,
                required: true,
            },
            passwordp_confirmation: {
                equalTo: "#passwordp2"
            },
            razon_social:{
                required: true,
                minlength: 3,
                maxlength: 50,
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

});

