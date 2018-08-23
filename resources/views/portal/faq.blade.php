@extends('template')

@section('title')
    Necesito Ayuda | Portal de Pagos
@endsection

@section('content')
<!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="top10 white">
                    Necesito Ayuda
                </h1>
            </div>

        </div>
    </div>
</div>
<!--breadcrumbs end-->


<!--container start-->

<section id="faq">

    <div class="container">



        <div class="row">

            <div class="col-md-10 col-md-offset-1 mar-b-30">

                <div id="heading">
                    <h1 class="">¿Necesitas Ayuda?</h1>
                    <p class="lead">Consulta nuestras <strong>preguntas frecuentes</strong></p>
                </div>

                <!--////////// Accordion Toggle //////////-->
                <div class="panel-group " id="accordion" >

                    <!-- PANEL 1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                   ¿Qué es Portal de Pagos?
                                </a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p>Somos una plataforma online, que busca facilitar el proceso y la gestión de las cuentas por pagar y por recibir de nuestros clientes.</p>
                                 <p>   Esto para que tengan más tiempo para dedicarse a lo más importante: <strong>¡Su Negocio!</strong>
                                    </p>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    ¿Cuáles son los beneficios de ocupar Portal de Pagos?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p>La verdad es que Portal de Pagos te entrega muchos beneficios. Los principales son:</p>
                                <p><strong>Para quien paga:</strong></p>
                                <ul>
                                    <li> Tus cuentas por pagar, disponibles 24h por día, desde cualquier dispositivo con internet</li>
                                    <li> Te recordamos la fecha de pago de tus cuentas</li>
                                    <li> Pagas sólo cuando (y por cuanto) lo usas. </li>
                                    <li> Tienes todas tus cuentas en el mismo lugar: las por pagar y las pagadas</li>



                                </ul>


                                <p><strong>Para quien cobra:</strong></p>
                                <ul>
                                    <li> Tus cuentas por cobrar, disponibles 24h por día, desde cualquier dispositivo con internet</li>
                                    <li> Recordamos el vencimiento de tus cuentas, contribuyendo para una menor morosidad</li>
                                    <li> No hay costo de implementación, mantención o integración.</li>



                                </ul>
                                <p>Conozca más en las secciones  <a href="cuentas-pagar" class="btn btn-primarynew btn-sm">Quiero Pagar</a>   y <a href="cuentas-cobrar"  class="btn btn-primarynew btn-sm">Quiero Cobrar</a> </p>

                            </div>
                        </div>
                    </div>

                    <!-- PANEL 3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    ¿Puedo ocupar Portal de Pagos?
                                </a>
                            </h4>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p>Nuestra solución puede ser utilizada por cualquier persona o empresa, independiente de su tamaño o rubro de actividad.</p>
                                <p>Para que puedas beneficiarse de todas nuestras funcionalidades, debes contar con una cuenta corriente o vista (o cuenta RUT) bajo tu RUT.</p>


                            </div>
                        </div>
                    </div>

                    <!-- PANEL 4 -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                   ¿Cómo funciona?
                                </a>
                            </h4>
                        </div>

                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p>Conozca todos las características de nuestros servicios, consultando,  según corresponda, las siguientes secciones: <br> <a href="cuentas-pagar" class="btn btn-primarynew btn-sm">Quiero Pagar</a>    <a href="cuentas-cobrar" class="btn btn-primarynew btn-sm">Quiero Cobrar</a> </p>


                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                    ¿Cuánto pago por utilizar Portal de Pagos?
                                </a>
                            </h4>
                        </div>

                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p> No hay costos</strong> para quien ocupa nuestra solución <strong>para pagar.</strong> </p>
                                <p>Quien cobra, paga <strong>{{$comision}} UF o CLP$ {{number_format($comision * $uf)}} </strong> por cada cobro ingresado en el mes (IVA incluido).</p>
                                <p><strong><i class="fa fa-arrow-right"></i> Si eres Persona Natural, no pagas por ingresar el cobro*</strong></p>
                                <p><strong><i class="fa fa-arrow-right"></i> Si eres Persona Jurídica, tienes 3 meses de uso grátis*</strong></p>
                                <p><small>*Promoción por tiempo limitado.</small></p>

                                <p><strong>Entienda cómo funciona:</strong></p>
                                <div class="table-responsive">
                                <table class="table table-bordered table_n">
                                      <thead>
                                        <tr>
                                          <th>
                                            Mes
                                          </th>
                                          <th>
                                            Cantidad de Cobros Ingresados
                                          </th>
                                          <th>
                                            Costo Unitario ($)
                                          </th>
                                          <th>
                                            Costo Total ($)
                                          </th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>
                                            Octubre
                                          </td>
                                          <td>
                                            10
                                          </td>
                                          <td>
                                            400
                                          </td>
                                          <td>
                                            4.000
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>
                                            Noviembre
                                          </td>
                                          <td>
                                            15
                                          </td>
                                          <td>
                                            400
                                          </td>
                                          <td>
                                            6.000
                                          </td>

                                        </tr>

                                        <tr>
                                          <td>
                                            Diciembre
                                          </td>
                                          <td>
                                            40
                                          </td>
                                          <td>
                                            400
                                          </td>
                                          <td>
                                            16.000
                                          </td>

                                        </tr>


                                      </tbody>
                                    </table>
                                    </div>



                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-faq">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                     ¿Cuándo pago por el uso de Portal de Pagos?
                                </a>
                            </h4>
                        </div>

                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="panel-body panel-faq">
                                <p>Nuestro periodo de facturación es mensual, es decir, consideramos la cantidad de clientes cobrados  entre el primero y el último día de cada mes.</p>
                                <p>Generamos nuestra factura hasta el 5º día hábil del mes.</p>
                                <p>La fecha de pago es todo día 15 del mes.</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!-- /col-md-10 -->


        </div>
    </div>

</section>


@endsection
