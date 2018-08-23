<?php
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@login');
Route::post('/login', 'HomeController@contacto_login');
Route::get('/logout', 'HomeController@logout');
Route::post('/cambiar_password', 'HomeController@cambiar_password');
Route::post('/cerrarpublicidad', 'HomeController@cerrar_publicidad');
Route::post('/resetpwd', 'HomeController@recuperar_password');
Route::get('/restablecer', 'HomeController@view_restablecer_password');
Route::post('/restablecer_post', 'HomeController@reset_post_password');
Route::get('/d', 'HomeController@descargar');
Route::get('/editarcuenta', 'HomeController@editar_mi_cuenta');
Route::post('/editarcuenta', 'HomeController@editar_cuenta');
Route::post('/editarbanco', 'HomeController@editar_cuenta_bancaria');
Route::get('/contacto', 'HomeController@contacto');
Route::post('/contacto/enviar', 'HomeController@contacto_post');

Route::get('/consultar', ['as' => 'consultar', 'uses' => 'HomeController@consultar']);

Route::post('/consultar/resultado', ['as' => 'consultar', 'uses' => 'HomeController@resultados']);
Route::get('/consultar/resultado', ['as' => 'consultar', 'uses' => 'HomeController@resultadosGet']);

Route::get('/confirmco', 'CobradoresController@confirmar');
Route::get('/active', 'HomeController@active');

Route::get('/registro', 'RegistroController@index');
Route::post('/registro', 'RegistroController@postRegistro');

Route::get('/nominas/exportar', 'CobrarController@exportar_nomina_excel');
Route::get('/individual/exportar', 'CobrarController@exportar_individuales_excel');
Route::get('/cobros/pagadas/exportar', 'CobrarController@exportar_pagadas');
Route::get('/cobrar-cuentas', 'CobrarController@indexCobro');
Route::get('/cobrar-cuentas/todo/exportar', 'CobrarController@exportar_todo');

Route::post('/cobrar-cuentas/individuales/adjuntar', 'CobrarController@adjuntar_doc_individual');
Route::post('/cobrar-cuentas/nominas/adjuntar', 'CobrarController@adjuntar_doc_nomina');
Route::post('/cobrar-cuentas/nominas/adjuntarmasivo', 'CobrarController@adjuntar_doc_nomina_masiva');

Route::get('/cobrar-cuentas/todo', ['as' => 'cobrarcuentastodo', 'uses' => 'CobrarController@todo']);
Route::post('/changeview', 'CobrarController@cambiar_vista');
Route::get('/cobrar-cuentas/nominas', ['as' => 'cobrarcuentas', 'uses' => 'CobrarController@index']);
Route::post('/cobrar-cuentas/nominas', 'CobrarController@nominas');
Route::delete('/eliminarnomina', 'CobrarController@eliminarnomina');
Route::get('/cobrar-cuentas/nominas/detalle/{id}', ['as' => 'cobrarcuentasdetalle', 'uses' => 'CobrarController@nominasdetalle']);
Route::delete('/eliminardetallenomina', 'CobrarController@eliminar_nomina_detalle');
Route::post('/buscarnomina/json', 'CobrarController@buscar_nomina');
Route::post('/editar_detalle_nomina', 'CobrarController@editar_detalle_nomina');
Route::post('/cuentas-cobrar-log/pagarnomina', 'CobrarController@pagarcuenta_nominas');

Route::get('/cobrar-cuentas/individuales', ['as' => 'puntales', 'uses' => 'CobrarController@puntales']);
Route::post('/cobrar-cuentas/individuales', 'CobrarController@puntualespost');
Route::delete('eliminarcobrospuntales', 'CobrarController@eliminarcobro');
Route::get('/cobrar-cuentas/individuales/detalle/{id}', ['as' => 'detallepuntuales', 'uses' => 'CobrarController@puntalesdetalle']);
Route::delete('eliminardetallecobro', 'CobrarController@eliminar_cobro_detalle');
Route::post('/cuentas-cobrar-log/editar', 'CobrarController@editar_puntuales');
Route::post('/cuentas-cobrar-log/json', 'CobrarController@buscar');
Route::post('/cuentas-cobrar-log/pagarcuenta', 'CobrarController@pagarcuenta_puntuales');


Route::get('/cobrar-cuentas/pagadas', ['as' => 'cuentas_pagadas', 'uses' => 'CobrarController@pagadas']);
Route::get('/cobrar-cuentas/pagadas/detalle/{id}', ['as' => 'detallepagadas', 'uses' => 'CobrarController@pagadas_detalle']);

Route::get('/cuentas-por-pagar', ['as' => 'nopagadas', 'uses' => 'PagarController@index']);
Route::get('/cuentas-por-pagar/pagadas', ['as' => 'pagadas', 'uses' => 'PagarController@pagadas']);
Route::get('/quiero-pagar', 'PagarController@inicio');
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'CobrarController@dashboard']);

Route::post('/buscarcuentapagar', 'PagarController@buscar_cuenta');
Route::post('/pagarcuenta', 'PagarController@pagarcuenta');


Route::get('/cobradores', 'CobradoresController@index');
Route::post('/cobradores/verificar', 'CobradoresController@json_verificar_cobrador');
Route::post('/cobradores/delete', 'CobradoresController@delete');
Route::post('/cobradores/edit', 'CobradoresController@edit');
Route::post('/cobradores/enviaremail_registro', 'CobradoresController@enviar_email_registro');


Route::group(['prefix' => 'admincp', 'middleware' => ['auth']], function () {

    Route::get('/', 'Admin\AdminController@index');
    Route::get('/accesos/exp', 'Admin\AdminController@exportar_log_acceso');
    Route::post('/', 'Admin\AdminController@anuncio');

    Route::get('/login', 'Admin\AdminController@login');
    Route::post('/login2', 'Admin\AdminController@login_post');

    Route::get('/usuarios', 'Admin\UsuarioController@index');
    Route::post('/usuarios/edit_deudor', 'Admin\UsuarioController@editar_deudor');
    Route::post('/usuarios/edit_deudor_nor', 'Admin\UsuarioController@editar_no_registrado');
    Route::post('/usuarios/eliminar', 'Admin\UsuarioController@eliminar');
    Route::post('/usuarios/buscar', 'Admin\UsuarioController@buscar');
    Route::post('/usuarios/buscarnoregistrados', 'Admin\UsuarioController@buscarnoregistrados');
    Route::get('/usuarios/agregar', 'Admin\UsuarioController@agregar');
    Route::post('/usuarios/agregar', 'Admin\UsuarioController@agregar_post');

    Route::get('/cobros/agregar', 'Admin\CobrosController@agregar');
    Route::get('/cobros/agregarnomina', 'Admin\CobrosController@agregar_nomina');
    Route::post('/cobros/agregar', 'Admin\CobrosController@agregar_post');
    Route::post('/cobros/buscar', 'Admin\CobrosController@buscar');
    Route::get('/cobros/pagadas', 'Admin\CobrosController@pagadas');
    Route::get('/cobros/pendientes', 'Admin\CobrosController@pendientes');

    Route::get('/pagadas', 'Admin\DeudasController@pagadas');
    Route::get('/pagadas/exportar', 'Admin\DeudasController@pagadas_export');
    Route::post('/pagadas/buscar', 'Admin\DeudasController@pagadas_buscar');

    Route::get('/pendientes', 'Admin\DeudasController@pendientes');
    Route::get('/pendientes/exportar', 'Admin\DeudasController@pendientes_export');
    Route::post('/pendientes/buscar', 'Admin\DeudasController@pendientes_buscar');
    Route::post('/deudas/eliminar', 'Admin\DeudasController@eliminar');
    Route::post('/deudas/editar', 'Admin\DeudasController@editar');

    Route::post('/nominas/agregar', 'Admin\NominasController@agregar_post');

    Route::get('/pagos', 'Admin\PagosController@index');
    Route::get('/pagos/agregar', 'Admin\PagosController@agregar');
    Route::post('/pagos/agregar', 'Admin\PagosController@agregarpost');
    Route::post('/pagos/buscar', 'Admin\PagosController@buscar');
    Route::post('/pagos/editar', 'Admin\PagosController@editar');
    Route::post('/pagos/eliminar', 'Admin\PagosController@eliminar');

    Route::post('/pagos/cuenta/agregar', 'Admin\PagosController@agregarpost_cuenta');
    Route::post('/pagos/cuenta/buscar', 'Admin\PagosController@buscar_cuenta');
    Route::post('/pagos/cuenta/editar', 'Admin\PagosController@editar_cuenta');
    Route::post('/pagos/cuenta/eliminar', 'Admin\PagosController@eliminar_cuenta');

    Route::get('/historial', 'Admin\HistorialController@index');
    Route::get('/historial/contenido', 'Admin\HistorialController@contenido');
    Route::get('/historial/reenviar', 'Admin\HistorialController@reenviar');
    Route::post('/historial/contenido/buscar', 'Admin\HistorialController@buscar_contenido');
    Route::post('/historial/contenido/editar', 'Admin\HistorialController@editar');

    Route::get('/publicidad', 'Admin\PublicidadController@index');
    Route::post('/publicidad/buscar', 'Admin\PublicidadController@buscar');
    Route::post('/publicidad/editar', 'Admin\PublicidadController@editar');
    Route::post('/publicidad/agregar', 'Admin\PublicidadController@agregar_post');
    Route::post('/publicidad/eliminar', 'Admin\PublicidadController@eliminar');

    Route::get('/imagenportal', 'Admin\ImagenPortalController@index');
    Route::post('/imagenportal/buscar', 'Admin\ImagenPortalController@buscar');
    Route::post('/imagenportal/editar', 'Admin\ImagenPortalController@editar');
    Route::post('/imagenportal/agregar', 'Admin\ImagenPortalController@agregar_post');
    Route::post('/imagenportal/eliminar', 'Admin\ImagenPortalController@eliminar');

    Route::get('/rubros', 'Admin\RubrosController@index');
    Route::get('/rubros/agregar', 'Admin\RubrosController@agregar');
    Route::post('/rubros/agregar', 'Admin\RubrosController@agregarpost');
    Route::post('/rubros/buscar', 'Admin\RubrosController@buscar');
    Route::post('/rubros/editar', 'Admin\RubrosController@editar');
    Route::post('/rubros/eliminar', 'Admin\RubrosController@eliminar');

    Route::get('/bancos', 'Admin\BancosController@index');
    Route::get('/bancos/agregar', 'Admin\BancosController@agregar');
    Route::post('/bancos/agregar', 'Admin\BancosController@agregarpost');
    Route::post('/bancos/buscar', 'Admin\BancosController@buscar');
    Route::post('/bancos/editar', 'Admin\BancosController@editar');
    Route::post('/bancos/eliminar', 'Admin\BancosController@eliminar');
    Route::get('/comision', 'Admin\ComisionController@index');
    Route::post('/comision', 'Admin\ComisionController@comisionSave');

});


Route::get('/cuentas-pagar', function () {
    return view('portal/cuentas-pagar');
});

Route::get('/cuentas-cobrar', function () {
    $comision = App\Configuration::where(['nombre_configuracion' => "comision"])->first();
    $uf = file_get_contents("http://mindicador.cl/api/uf");
    $uf = json_decode($uf);
    return view('portal/cuentas-cobrar', ['comision' => $comision->valor_configuracion, 'uf' => $uf->serie[0]->valor]);
});

Route::get('/faq', function () {
    $comision = App\Configuration::where(['nombre_configuracion' => "comision"])->first();
    $uf = file_get_contents("http://mindicador.cl/api/uf");
    $uf = json_decode($uf);
    return view('portal/faq', ['comision' => $comision->valor_configuracion, 'uf' => $uf->serie[0]->valor]);
});


Route::get('/quienes-somos', function () {
    return view('portal/quienes-somos');
});

Route::get('/politicas', function () {
    return view('portal/politicas');
});

Route::get('/ajaxEmailByRut', 'CobrarController@ajaxEmailByRut');
