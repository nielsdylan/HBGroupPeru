@extends('frontend.public')
@section('title','inicio')
@section('content')
    @include('frontend.public.slider')
    <section id="services">
        <div class="container">
            <div class="row services-title">
                <div class="col-md-12">
                    <h1>Soluciones a la medida de tu organización</h1>
                    <h3>Conoce más sobre nuestros servicios</h3>
                </div>
            </div>
            <div class="row pt-5 services-card">
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box">

                        <div class="pt-3"  style="
                            background: url('{{asset('uploads/public/trainings.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        >

                        </div>
                        <div class="card-body text-center">
                            <h5>Capacitación </h5>
                            <p>Brindamos conocimientos en materia </p>
                            <p>de seguridad, ambiente, protección y</p>
                            <p>calidad.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box">
                        <div style="
                            background: url('{{asset('uploads/public/training.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        ></div>
                        <div class="card-body text-center">
                            <h5>Entrenamiento </h5>
                            <p>Formamos habilidades y competencias</p>
                            <p>para realizar trabajos de alto riesgo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box">
                        <div style="
                            background: url('{{asset('uploads/public/advice.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        ></div>
                        <div class="card-body text-center">
                            <h5>Asesoramiento </h5>
                            <p>Asesoramos en la elaboración de</p>
                            <p>documentación del Sistema de</p>
                            <p>Gestión según requerimientos legales</p>
                            <p>y normas internacionales.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5 services-button">
                <div class="col-md-12 text-center">
                    <a href="{{ url('/servicios') }}" class=" btn btn-light button-services"> Todos los Servicios</a>
                </div>
            </div>
        </div>
    </section>
    <section id="solution">

        <div class="row">
            <div class="col-md-12 text-center text-white d-none d-sm-none d-lg-block d-md-block">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1>Te ofrecemos soluciones a la medida</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center d-none d-sm-none d-lg-block d-md-block">
                <p>&nbsp;</p>
                <a class=" btn btn-light us" href="{{ url('/contacto') }}"> Contactanos</a>
            </div>
        </div>


        <div class="row mr-0">
            <div class="col-md-12 text-center text-white d-block d-sm-block d-lg-none d-md-none">
                <p>&nbsp;</p>
                <h1>Te ofrecemos soluciones a la medida</h1>
            </div>
        </div>
        <div class="row mr-0">
            <div class="col-md-12 text-center d-block d-sm-block d-lg-none d-md-none">
                <p>&nbsp;</p>
                <a class=" btn btn-light us" href="{{ url('/contacto') }}"> Contactanos</a>
            </div>
        </div>
    </section>
    <section id="business">
        <div class="container">
            <div class="row pb-5">
                <div class="col-md-12">
                    <h1>Empresas que confían en nosotros</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-thumbs mt-5">
                        <div class="owl-carousel-second">
                        <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/AAQ.jpg')}}">
                                    <div style="background: url('{{asset('uploads/public/AAQ.jpg')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/southern.png')}}">
                                    <div style="background: url('{{asset('uploads/public/southern.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/antapaccay.png')}}">
                                    <div style="background: url('{{asset('uploads/public/antapaccay.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/servosa.png')}}">
                                    <div style="background: url('{{asset('uploads/public/servosa.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/engie.png')}}">
                                    <div style="background: url('{{asset('uploads/public/engie.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>

                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/tisur.png')}}">
                                    <div style="background: url('{{asset('uploads/public/tisur.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/tramarsa.png')}}">
                                    <div style="background: url('{{asset('uploads/public/tramarsa.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/consorcio.png')}}">
                                    <div style="background: url('{{asset('uploads/public/consorcio.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/securitas.png')}}">
                                    <div style="background: url('{{asset('uploads/public/securitas.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/seguroc.png')}}">
                                    <div style="background: url('{{asset('uploads/public/seguroc.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/CSI.png')}}">
                                    <div style="background: url('{{asset('uploads/public/CSI.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>

                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/als.png')}}">
                                    <div style="background: url('{{asset('uploads/public/als.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/consultoria.png')}}">
                                    <div style="background: url('{{asset('uploads/public/consultoria.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                            <div class="ficha_carousel_img" align="center">
                                <a  class="fancybox" rel="galeria1" href="{{asset('uploads/public/sgs.png')}}">
                                    <div style="background: url('{{asset('uploads/public/sgs.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                </a>
                            </div>
                        </div>
                        <a href="#" data-carousel="prev" class="owl-prev izquierda_ficha owl-carousel-product-left">
                        <i class="fa fa-angle-left" style="font-size: 14px; margin-left: 7px;"></i>
                        </a>
                        <a href="#" data-carousel="next" class="owl-next derecha_ficha owl-carousel-product-right">
                        <i class="fa fa-angle-right" style="font-size: 14px; margin-left: 8px;"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>





    </section>

@endsection
<script>

    window.onscroll = function() {
        var scroll = window.scrollY;

        var services_title = $('.row.services-title').offset();
        var left_services = services_title.left;

        if (scroll>=(left_services/2)) {
            $('.row.services-title').addClass('animated fadeInUp');
            // console.log(left_services);
        }

        var card_services = $('.services-card').offset();
        var left_card = card_services.left;
        if (scroll>=(left_card)) {
            // console.log(left_card);
            $('.services-card').addClass('animated fadeInUp');
        }

        var button_service = $('.services-button').offset();
        var left_button = button_service.left;
        var toop_button = button_service.top;
        if (scroll>=(toop_button)) {
            console.log(left_card);
            console.log(scroll);
            $('.services-card').addClass('animated fadeInUp');
        }

    };


</script>
