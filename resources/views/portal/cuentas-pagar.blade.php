
@extends('template')

@section('title')
    Quiero Pagar | Portal de Pagos
@endsection

@section('content')
<!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="top10 white">
                    Quiero Pagar
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
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/icono-compu.png")}}" />
                </div>
                <div class="clearfix"></div>
                    <h4>Ahora podrás tener todas tus cuentas en internet </h4>
                       <p class="text-center"> Así podrás consultarlas a cualquier hora del día, desde cualquier dispositivo con internet.


                    </p>

            </div>

             <div class="col-lg-4 col-sm-4">
                <div class="col-xs-12">
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/icono-adjunta.png")}}" />
                </div>
                <div class="clearfix"></div>

                    <h4>¡No más papeles! </h4>
                        <p class="text-center">Podrás consultar información relacionada a tus cuentas, como el detalle de consumo, de tus gastos comunes
y facturas.


                    </p>
            </div>




            <div class="col-lg-4 col-sm-4">
                <div class="col-xs-12">
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/icono-aviso.png")}}" />
                </div>
                <div class="clearfix"></div>

                    <h4>Aviso de Vencimiento</h4>
                        <p class="text-center">Recordamos el vencimiento de tus cuentas. Pagando al día, ahorrarás gastos innecesarios con multas e intereses.
                    </p>
            </div>







        </div>

        <div class="services text-center ">

            <div class="col-lg-4 col-sm-4">
                <div class="col-xs-12">
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/icono-seguro.png")}}" />
                </div>
                <div class="clearfix"></div>

                    <h4>Tus pagos seguros</h4>
                       <p class="text-center">Realiza tu pago de forma segura, vía transferencia bancaria, desde la página de tu banco.</p>
            </div>



            <div class="col-lg-4 col-sm-4">
                <div class="col-xs-12">
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/ico-listado.png")}}" />
                </div>
                <div class="clearfix"></div>

                    <h4>Más control sobre tus gastos</h4>
                     <p class="text-center">  Tendrás todas tus cuentas por pagar
y las pagadas en un único lugar.


                    </p>
            </div>






            <div class="col-lg-4 col-sm-4">
                <div class="col-xs-12">
                    <img class="zoomIn animated img-responsive center-block"  data-u="image" src="{{asset("public/images/icono-candado.png")}}" />
                </div>
                <div class="clearfix"></div>

                    <h4>Cuidamos tu información</h4>
                       <p class="text-center">Trabajamos con las mejores tecnologías
de seguridad y con proveedores internacionales para mantener
tus datos seguros.

                    </p>
            </div>

        </div>

    </div>
</div>

</div><!--bg-grey-->

<div class="container mar-b-30 mar-t-30">

    <div id="heading">
        <h1 class="m480">
            ¿Puedo utilizar Portal de Pagos?

          </h1>

          <h4 class="mar-t-20">Cualquier <strong>Persona o Empresa </strong>puede utilizar nuestros servicios. </h4>


    </div>


    <p class="text-center">Para que puedas beneficiarse de todas nuestras funcionalidades, debes contar una cuenta corriente o vista (o cuenta RUT) bajo tu RUT.<br>
Así, desde cualquier dispositivo con internet, podrás consultar tus cuentas a pagar y realizar pagos.</p>
<h4 class="text-center mar-t-20"><strong>¡No más papeles o cheques!</strong></h4>


    </div>
<!--container end-->


<div class="gray-bg">

<div class="container">
    <div class="row">
        <div id="heading">
            <h1 class="m480">¿Cómo lo hago? </h1>
        </div>



        <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
            <div class="col-md-1 col-md-offset-2 col-xs-3">

                <img class="zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-1.png")}}" />

            </div>
            <div class="col-md-9 col-xs-9">
              <h3 class="no-margin-top"> Regístrate</h3>
                <p>  No olvides ingresar tus datos de Banco y Cuenta. Con estos datos podemos registrar tus pagos de forma automática.</p>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
            <div class="col-md-1 col-md-offset-2 col-xs-3"><img class="zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-2.png")}}" /></div>
            <div class="col-md-9 col-xs-9">
                <h3 class="no-margin-top">Consulta tus cuentas por vencer</h3>
                <p>Encontrarás el monto, la fecha de vencimiento y los datos bancarios para realizar el pago a través
de transferencia electrónica. </p>
                <p>Podrás, además, encontrar información relativa a tu cuenta, como por ejemplo el detalle de
los consumos, de los gastos comunes o facturas.</p>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12 ">
            <div class="col-md-1 col-md-offset-2 col-xs-3"><img class="zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-3.png")}}" /></div>
            <div class="col-md-9 col-xs-9">
                <h3 class="no-margin-top">Realiza tu transferencia desde tu banco</h3>
                <p>Realiza tu transferencia bancaria, de forma segura, desde la página de tu banco. </p>
                <p>Ingresa el email <strong> pago@portaldepagos.cl </strong> en el campo de “e-mail del destinatario” al realizar la transferencia.</p>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1  mar-b-30 col-xs-12">
            <div class="col-md-1 col-md-offset-2 col-xs-3"><img class="zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-listo.png")}}" /></div>
            <div class="col-md-9 col-xs-9">
                <h3 class="no-margin-top">¡Listo!</h3>
                <p>Registraremos tu pago apenas recibamos el comprobante de transferencia desde tu banco.  </p>

            </div>
        </div>

        <div class="col-md-10 col-md-offset-1  col-xs-12 mar-b-30">
            <div class="col-md-1 col-md-offset-2 col-xs-3"><img class="zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-recuerda.png")}}" /></div>
            <div class="col-md-9 col-xs-9">
                <h3 class="no-margin-top">Recuerda</h3>
                <ul class="list-unstyled">
                    <li><p><i class="fa fa-arrow-right" aria-hidden="true"></i> Ingresa el email <strong>pago@portaldepagos.cl</strong> en el campo de <strong>“e-mail del destinatario” </strong> al realizar la transferencia en la página de tu banco.</p>
</li>
                    <li><p><i class="fa fa-arrow-right" aria-hidden="true"></i> Registraremos el pago sólo cuando recibamos el comprobante desde tu banco. <strong>No puedes reenviarlo desde otro e-mail.</strong></p>
</li>
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
@endsection
