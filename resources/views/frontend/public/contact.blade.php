@extends('frontend.public')
@section('title','contacto')
@section('content')
    <section id="contact">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 text-white pl-5">
                    <p>&nbsp;</p>
                    <h1>Contáctenos</h1>
                    <h3>Para darle una solución a la medida</h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-8 d-none d-sm-none d-lg-block d-md-block">
                    <p>&nbsp;</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3801.868826203472!2d-71.3256665851199!3d-17.656370687917946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTfCsDM5JzIyLjkiUyA3McKwMTknMjQuNSJX!5e0!3m2!1ses!2spe!4v1619019370458!5m2!1ses!2spe" width="700" height="350" style="border: 0px solid #fff;
                        border-radius: 19px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-md-4 text-white d-none d-sm-none d-lg-block d-md-block">
                    <p>&nbsp;</p>
                    <ul class="list-unstyled-contac">
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{ asset('uploads/public/icon/gps-icon.png') }}" width="20">
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>HB Group Peru</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Nueva Victoria Mz 04 Lote 16Ilo, Moquegua, Perú 18601
                                            Ilo, Moquegua, Perú 18601
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="{{ asset('uploads/public/icon/mobile-icon.png') }}" width="20"> &nbsp;(+51) 932 777 533
                        </li>
                        <li>
                            <img src="{{ asset('uploads/public/icon/phone-icon.png') }}" width="20"> &nbsp;(+51) 53 474 805
                        </li>
                        <li>
                            <img src="{{ asset('uploads/public/icon/email-icon.png') }}" width="20"> &nbsp;<a href="mailto:info@hbgroup.pe?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia">info@hbgroup.pe</a>
                        </li>
                        <li>
                            <img src="{{ asset('uploads/public/icon/facebook-icon.png') }}" width="18"> &nbsp;
                            <a href="https://www.facebook.com/HBgroup.pe" target="_blank">HBgroup.pe</a>
                        </li>
                        <li class="">
                            <img src="{{ asset('uploads/public/icon/in-icon.png') }}" width="20"> &nbsp;
                            <a href="https://www.linkedin.com/company/hbgroupperu/about/" target="_blank">HBgroupperu</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-block d-sm-block d-lg-none d-md-none">
                    <p>&nbsp;</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3801.868826203472!2d-71.3256665851199!3d-17.656370687917946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTfCsDM5JzIyLjkiUyA3McKwMTknMjQuNSJX!5e0!3m2!1ses!2spe!4v1619019370458!5m2!1ses!2spe" width="330" height="350" style="border: 0px solid #fff;
                        border-radius: 19px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

    </section>
@endsection
