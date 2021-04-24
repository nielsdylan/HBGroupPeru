@extends('frontend.public')
@section('title','inicio')
@section('content')
    @include('frontend.public.slider')
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Soluciones a la medida de tu organización</h1>
                    <h3>Conoce más sobre nuestros servicios</h3>
                </div>
            </div>
            <div class="row pt-5">
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
            <div class="row pt-5">
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
                <a class=" btn btn-light us" href="{{ url('/nosotros') }}"> Nosotros</a>
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
                <a class=" btn btn-light us" href="{{ url('/nosotros') }}"> Nosotros</a>
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
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/AAQ.jpg')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{ asset('uploads/public/southern.png') }}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/antapaccay.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/servosa.png')}}" >
                </div>

            </div>
            <div class="row">
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/engie.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/tisur.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/tramarsa.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/consorcio.png')}}" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/securitas.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/seguroc.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/CSI.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/als.png')}}" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/consultoria.png')}}" >
                </div>
                <div class="col-md-3 text-center pb-5">
                    <img src="{{asset('uploads/public/sgs.png')}}" >
                </div>
            </div>

        </div>
    </section>

@endsection
