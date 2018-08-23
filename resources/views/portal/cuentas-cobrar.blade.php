@extends('template')

@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="top10 white">
                        Quiero Cobrar
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <div class="gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 ">

                    <div id="heading">
                        <h1 class="mar-b-30">Beneficios</h1>
                    </div>
                </div>
                <div class="services text-center">
                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/icono-compu.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Tus cobros en Internet</h4>
                        <p class="text-center"> Tus cuentas por cobrar disponibles a tus clientes desde cualquier
                            dispositivo con internet, 24h al día.

                        </p>

                    </div>


                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/icono-adjunta.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Información relevante para tu cliente</h4>
                        <p class="text-center"> Adjunta a tus cobros el detalle de tus servicios prestados, facturas,
                            gastos comunes u otro documento relevante.

                        </p>

                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/icono-aviso.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Aviso de Vencimiento</h4>
                        <p class="text-center">Recordamos el vencimiento de las cuentas a tus clientes, contribuyendo
                            para una menor morosidad.
                        </p>

                    </div>

                </div>

                <div class="services text-center ">

                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/icono-dinero.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Te ahorramos dinero</h4>
                        <p class="text-center">Reducimos tus gastos de impresiones y envíos de documentos por correo.

                            Pagas sólo cuando (y por cuanto) lo usas.
                            No hay costo de implementación, mantención o integración.

                        </p>

                    </div>

                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/ico-listado.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Todo en un único lugar</h4>
                        <p class="text-center">Tus cobros y pagos realizados, independiente del medio de pago utilizado,
                            en un solo lugar. Registramos de forma automática los pagos realizados por transferencia
                            electrónica. </p>

                    </div>


                    <div class="col-lg-4 col-sm-4">
                        <div class="col-xs-12">
                            <img class="zoomIn animated img-responsive center-block" data-u="image"
                                 src="{{asset("public/images/icono-nube.png")}}"/>
                        </div>
                        <div class="clearfix"></div>

                        <h4>Información segura en la nube</h4>
                        <p class="text-center">Despreocúpate de la pérdida de información en tu negocio: estará siempre
                            disponible, almacenada y respaldada en la nube.
                        </p>

                    </div>

                </div>

            </div>

            <div id="heading">
                <h1 class="m480">
                    ¿Puedo utilizar Portal de Pagos?

                </h1>


            </div>

            <div class="row">

                <div class="col-md-12 mar-t-30">

                    <h4><i class="fa fa-arrow-right" aria-hidden="true"></i> Nuestra solución fue pensada para empresas
                        de cualquier rubro o tamaño, para los trabajadores independientes y también para las personas.
                    </h4>


                    <p>Conozca algunos ejemplos de actividades que podrán facilitar la gestión y cobro de sus cuentas al
                        utilizar nuestros servicios:</p>


                    <ul class="list-unstyled col-md-6">
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Pagos entre personas</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Gastos Comunes o arriendos</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Transporte Escolar</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Cursos extra-programáticos, como inglés o
                                danza </p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Personal Trainner</p></li>

                    </ul>


                    <ul class="list-unstyled col-md-6">

                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Gimnasios</p></li>


                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Psicólogos</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Kinesiólogos</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Maestros de construcción</p></li>
                        <li><p><i class="fa fa-check" aria-hidden="true"></i> Jardineros</p></li>
                    </ul>

                    <h4 class="mar-b-30"><strong>¡Recuerda!:</strong> Para que puedas beneficiarse de todas nuestras
                        funcionalidades, debes contar con una cuenta corriente o vista (o cuenta RUT) bajo tu RUT.</h4>

                </div>
            </div>
        </div>

    </div><!--bg-grey-->

    <div class="container mar-b-30 mar-t-30">
        <div id="heading" class="services">
            <h1 class="m480">
                ¿Cuánto pago por utilizar Portal de Pagos?
            </h1>
        </div>


        <div class="col-md-12 mar-t-30 services">
            <h4> No hay costos</strong> para quien ocupa nuestra solución <strong>para pagar.</strong></h4><br>
            <h4>Quien cobra, paga <strong>{{$comision}} UF o CLP$ {{number_format($comision * $uf)}} </strong> por cada
                cobro ingresado en el mes (IVA incluido).</h4>
            <br>
            <h4><strong><i class="fa fa-arrow-right"></i> Si eres Persona Natural, no pagas por ingresar el
                    cobro*</strong></h4>
            <h4><strong><i class="fa fa-arrow-right"></i> Si eres Persona Jurídica, tienes 3 meses de uso
                    grátis*</strong></h4>
            <h4>
                <small>*Promoción por tiempo limitado.</small>
            </h4>
            <h4><strong> <i class="fa fa-arrow-right" aria-hidden="true"></i> Aprovecha para probar y hacer más fácil la
                    gestión de tu negocio </strong></h4>

        </div>

    </div>
    <!--container end-->


    <div class="gray-bg">

        <div class="container">
            <div class="row">
                <div id="heading">
                    <h1 class="">¿Cómo lo hago? </h1>
                </div>


                <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
                    <div class="col-md-1 col-md-offset-2 col-sm-2 col-xs-3"><img class="zoomIn animated img-responsive"
                                                                                 data-u="image"
                                                                                 src="{{asset("public/images/icono-1.png")}}"/>
                    </div>

                    <div class="col-md-9 col-xs-9">
                        <h3 class="no-margin-top">Regístrate</h3>
                        <p>No olvides ingresar los datos de tu Banco y Cuenta. Así tus clientes tendrán estos datos a
                            mano cuando quieran pagarte vía transferencia electrónica.</p>
                        <p>Además, al contar con esta información, podemos registrar estos pagos de forma automática en
                            nuestra plataforma, ahorrándote tiempo y recursos.</p>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
                    <div class="col-md-1 col-md-offset-2 col-sm-2 col-xs-3"><img class="zoomIn animated img-responsive"
                                                                                 data-u="image"
                                                                                 src="{{asset("public/images/icono-2.png")}}"/>
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <h3 class="no-margin-top">Ingresa tus cuentas por cobrar</h3>
                        <p>Puedes ingresar un cobro individual o un listado con varios cobros a la vez (nómina de
                            cobros).</p>
                        <p>Recuerda definir la fecha de pago: para el mismo día o una fecha futura.</p>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1  mar-b-30  col-xs-12">
                    <div class="col-md-1 col-md-offset-2 col-sm-2 col-xs-3"><img class="zoomIn animated img-responsive"
                                                                                 data-u="image"
                                                                                 src="{{asset("public/images/icono-3.png")}}"/>
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <h3 class="no-margin-top">Agrega información relevante para tu cliente</h3>
                        <p>Adjunta a tus cobros el detalle de los servicios prestados, facturas, gastos comunes u otro
                            documento relevante.</p>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1  mar-b-30  col-xs-12">
                    <div class="col-md-1 col-md-offset-2 col-sm-2 col-xs-3"><img class="zoomIn animated img-responsive"
                                                                                 data-u="image"
                                                                                 src="{{asset("public/images/icono-listo.png")}}"/>
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <h3 class="no-margin-top">¡Listo!</h3>
                        <p>¡Tus clientes ya pueden consultar tus cuentas!</p>

                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
                    <div class="col-md-1 col-md-offset-2 col-sm-2 col-xs-3"><img class="zoomIn animated img-responsive"
                                                                                 data-u="image"
                                                                                 src="{{asset("public/images/icono-recuerda.png")}}"/>
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <h3 class="no-margin-top">Recuerda</h3>
                        <ul class="list-unstyled">
                            <li><p><i class="fa fa-arrow-right" aria-hidden="true"></i> Si ingresas el e-mails de tus
                                    clientes, los notificaremos automáticamente que tu cuenta ya está disponible para
                                    pago.</p></li>
                            <li><p><i class="fa fa-arrow-right" aria-hidden="true"></i> Mientras tu cliente no pague,
                                    seguiremos recordándole del cobro y de la fecha de pago.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div> <!--bg-grey-->

    <div class="container" style="padding: 20px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center feature-head">
                    <h3 class="">
                        ¿Aún no utilizas Portal de Pagos?
                        <span class="top15 hidden-lg hidden-md"></span>
                        <a href="registro" class="btn btn-registro">
                            Regístrate ahora
                        </a>
                    </h3>
                </div>

            </div>
        </div>
    </div>


    <div class="container"></div>
@endsection
