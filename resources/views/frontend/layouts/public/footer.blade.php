@if ($configurations->whatsapp)<a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=Mi consulta es..." target="_blank" id="whatsapp-floot" class="btn-whatsapp-link"><i class="fab fa-whatsapp"></i></a>@endif
<a href="#" id="back-to-top" class="btn btn-lg btn-back-top"><i class="fa fa-angle-up"></i></a>
<section id="footer">
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{asset('uploads/public/logo_snc.png')}}" width="140" class="img-footer">
                        </div>
                        <div class="col-md-12 pt-3 text-center">
                            <h3> <strong>HB Group Perú</strong></h3>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 ">
                    <h6 class="text-white ">SITIO</h6>
                    <ul class="list-unstyled color-list">
                        <li>
                            <a href="{{ url('/') }}" class="text-footer"><i class="fa fa-angle-right"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="{{ url('/nosotros') }}" class="text-footer"><i class="fa fa-angle-right"></i> NOSOTROS</a>
                        </li>

                        <li>
                            <a href="{{ url('/servicios') }}" class="text-footer"><i class="fa fa-angle-right"></i> SERVICIOS</a>
                        </li>

                        <li>
                            <a href="{{ url('/contacto') }}" class="text-footer"><i class="fa fa-angle-right"></i> Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white">CONTACTO</h6>
                    <ul class="list-unstyled color-list">
                        <li>
                            <ul class="list-unstyled">
                                @if ($configurations->direction)
                                    <li><span class="text-footer"><i class="fas fa-map-marker-alt text-footer"></i> {{$configurations->direction}}</span></li>
                                @endif
                                @if ($configurations->whatsapp)
                                    <li><span class="text-footer"><i class="fab fa-whatsapp text-footer"></i> {{$configurations->whatsapp}}</span></li>
                                @endif
                                @if ($configurations->telephone)
                                    <li><span class="text-footer"><i class="fa fa-phone text-footer"></i> {{$configurations->telephone}}</span></li>
                                @endif
                                @if ($configurations->telephone)
                                    <li><span class="text-footer"><i class="fa fa-envelope text-footer"></i> {{$configurations->email}}</span></li>
                                @endif

                            </ul>
                        </li>
                    </ul>
                    <div id="redes" >
                        <ul class="list-inline ml-5 d-none d-sm-none d-lg-block d-md-block">
                            <li class="list-inline-item">
                                @if ($configurations->facebook)
                                <a class="facebook pr-3 text-white" href="{{$configurations->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if ($configurations->linkedin)
                                <a class="text-white" href="{{$configurations->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </li>
                        </ul>
                        <ul class="list-inline text-center d-block d-sm-block d-lg-none d-md-none">
                            <li class="list-inline-item">
                                @if ($configurations->facebook)
                                <a class="facebook pr-3 text-white" href="{{$configurations->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if ($configurations->linkedin)
                                <a href="{{$configurations->linkedin}}" class="text-white" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 copyright_text wow fadeInUp animated">
                    <div class="d-none d-lg-block text-white">
                        <center><span>&copy; {{ date("Y") }} HBGroupp - Todos los derechos reservados. </center>
                    </div>
                    <div class="d-block d-lg-none text-white">
                        <center><span>&copy; {{ date("Y") }}  HBGroupp - Todos los derechos reservados.</span></center>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
