@extends('template')

@section('title')
    Acerca de Nosotros | Portal de Pagos
@endsection

@section('content')
    <!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="top10 white">
                    Acerca de nosotros
                </h1>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->



<!--container start-->
<div class="container">


    <div class="row">

        <div class="col-md-10 col-md-offset-1 ">

            <div id="heading">
                <h1 class="">Nuestro Objetivo</h1>
                <p class="lead ">Facilitar el día a día de quien cobra y quien paga</p>
            </div>
        </div>

        <!--container start-->
        <div class="container mar-b-30">

            <div class="row">

          <div class="col-lg-12 col-sm-12">

            <div class="col-md-2">
              <img  class="title zoomIn animated img-responsive" data-u="image" src="{{asset("public/images/icono-equipo.png")}}" />
            </div>

            <div class="col-md-10">
            <h3 class="title ">
                ¿Quiénes somos?
              </h3>


              <p>Somos un equipo formado por chilenos y extranjeros, con experiencia en el mercado financiero tradicional y online, en Chile y en el exterior.</p>
              <p>Entregamos soluciones de pagos y cobros, para que nuestros clientes tengan más tiempo en enfocarse en lo más importante: <strong>su negocio.</strong></p>
              <p>Nuestras soluciones están dirigidas a las empresas de cualquier rubro o tamaño, principalmente a las PYMES, y a los profesionales independientes.</p>

              <p>Conozca algunos ejemplos de actividades que podrán facilitar la gestión y cobro de sus cuentas al utilizar nuestros servicios en <a href="cuentas-cobrar" class="btn btn-primarynew btn-sm">
                        <strong>Quiero Cobrar</strong>
                    </a></p>


            </div>


          </div>




          <div class="clearfix"></div>


          <div class="col-lg-12 col-sm-12">

            <div class="col-md-2">
              <img class="title zoomIn animated img-responsive"  data-u="image" src="{{asset("public/images/icono-valores.png")}}" />
            </div>

            <div class="col-md-10">


              <h3 class="title ">
                Valoramos
              </h3>
              <ul class="list-unstyled">
                        <li>
                            <p><i class="fa fa-check" aria-hidden="true"></i>
                            Cumplir lo acordado</p>
                        </li>

                        <li>
                            <p><i class="fa fa-check" aria-hidden="true"></i>
                            Seguir las reglas (leyes, normativas)</p>

                        </li>

                        <li>
                            <p><i class="fa fa-check" aria-hidden="true"></i>
                            La relación "gana- gana": ganamos nosotros, cuando ganan nuestros clientes</p>

                        </li>

                        <li>
                            <p><i class="fa fa-check" aria-hidden="true"></i>
                            Ser y actuar de forma transparente, justa y objetiva.</p>

                        </li>

                        <li>
                           <p> <i class="fa fa-check" aria-hidden="true"></i>
                            La innovación constante</p>

                        </li>

              </ul>

            </div>


          </div>

        </div>

        <div class="row mtop30" style="display:none;">

          <div id="heading">
        <h1 class="">
            Nuestro Equipo

          </h1>

    </div>

          <div class="col-md-10 col-md-offset-1">

            <div class="col-md-3">
                <img  class="title zoomIn animated img-responsive" data-u="image" src="{{asset("public/images/img-pedro.png")}}" />
            </div>

            <div class="col-md-9">
              <h3 class="title "> Pedro Fernandes </h3>

              <p><strong>CEO y Founder</strong></p>

              <p>Master en Finanzas por la ESE Business School (Chile) e Ingeniero Comercial por la UFRJ (Brasil).</p>
              <p>12 años de experiencia profesional en empresas como Santander (Brasil y Chile), ADP (LATAM) y VTR (Liberty Global).</p>
              <p>Ha liderado la innovación y el desarrollo de negocios en las áreas de Pagos, Medios de Pago, Créditos, Seguros, Cobranza y Experiencia de Clientes, a través de los canales Internet y Contact Center.</p>
            </div>


          </div>

          <div class="col-md-10 col-md-offset-1">



            <div class="col-md-9">
              <h3 class="title  text-right"> Catalina Jiménez </h3>
              <p class="text-right"><strong>Diseñadora web</strong></p>

              <p class="text-right">Diseñadora en comunicación visual. Diplomado Crossmedia creación gráfica digital.</p>
              <p class="text-right">6 años de experiencia en asesoría web para pequeñas empresas y liderazgo de proyectos.</p>

            </div>

            <div class="col-md-3">
                <img  class="title zoomIn animated img-responsive" data-u="image" src="{{asset("public/images/img-cata.png")}}" />
            </div>


          </div>

          <div class="col-md-10 col-md-offset-1">

            <div class="col-md-3">
                <img  class="title zoomIn animated img-responsive" data-u="image" src="{{asset("public/images/img-diego.png")}}" />
            </div>

            <div class="col-md-9">
              <h3 class="title "> Diego Valladares </h3>

              <p><strong>Desarrollador</strong></p>

              <p>Ingeniería en Informática y Postítulo en Arquitectura de TI.</p>
              <p>Experiencia en tecnologías de desarrollo, gestión de TI e investigación de temas relacionados con la ingeniería de software y la arquitectura de software. </p>
            </div>


          </div>




        </div>
      </div>



        </div>




    </div>

</div>
<!--container end-->


@endsection
