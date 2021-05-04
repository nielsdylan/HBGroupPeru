<section class="header">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                @if ($configurations->schedule)
                    <div class="col-md-6 d-none d-md-block" align="left">
                        <ul class="list-inline mb-0">
                                <a href="{{ url('/') }}" class="list-inline-item text-white"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                        </ul>
                    </div>
                @endif

                <div class="col-md-6 d-none d-md-block" align="right">
                    <ul class="list-inline mb-0">
                        @if ($configurations->telephone)
                        <a href="tel:+51 {{$configurations->telephone}}" class="list-inline-item text-white"><i class="fa fa-phone"></i> (+51) 53 474805</a>
                        @endif
                        @if ($configurations->whatsapp)
                        <a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> {{ $configurations->whatsapp}}</a>
                        @endif

                        {{-- <a href="https://www.facebook.com/HBgroup.pe" target="_blank" class="list-inline-item icon text-white"><i class="fab fa-facebook-f text-white"></i></a> --}}

                        <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-block d-md-none pt-2" align="center">
            @if ($configurations->schedule)
                <div class="col-md-12">
                    <a href="{{ url('/') }}" class="list-inline-item text-white"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                </div>
            @endif
            <ul class="list-inline mb-0">
                @if ($configurations->telephone)
                <a href="tel:992 933 603" class="list-inline-item text-white"><i class="fa fa-phone"></i> 946877806</a>
                @endif
                @if ($configurations->whatsapp)
                <a href="https://wa.me/992933603?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> 946877806</a>
                @endif
                <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>
            </ul>
        </div>
    </div>
</section>



<nav id="menu_navbar" class="navbar navbar-expand-lg navbar-light bg-light text-white bg-dark">
    <div class="container">
        <a class="navbar-brand d-none d-sm-none d-lg-block d-md-block text-white pt-2 pb-2" href="{{ url('/') }}">
            {{-- <span class="img-logo"></span><span class="pl-5 ml-3"> HB GROUP PERÚ</span> --}}
            <img src="{{asset('uploads/public/logo_snc.png')}}" class="img-footer"height="50"> HB GROUP PERÚ
        </a>

        <a class="navbar-brand d-block d-sm-block d-lg-none d-md-none text-white mr-0 ml-3" href="{{ url('/') }}">
            {{-- <span class="img-logo"></span> --}}
            <img src="{{asset('uploads/public/logo_snc.png')}}" class="img-footer"height="50">
            {{-- <img src="{{asset('uploads/public/logo_snc.png')}}" height="50"> --}}
        </a>
        <button class="navbar-toggler mr-4 " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('/') }}">INICIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('us') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('/nosotros') }}">NOSOTROS</a>
                </li>
                <li class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('/servicios') }}">SERVICIOS</a>
                </li>
                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <a class="nav-link text-white" href="{{ url('/contacto') }}">CONTACTO</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
