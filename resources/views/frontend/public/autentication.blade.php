<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Niels Q.P.">
    <meta name="keywords" content="HB Group Perú">

    <!-- ANALYTICS -->

    <!-- ANALYTICS -->

    <?php if (!empty($configuracion['og_title'])): ?>
    <meta property="og:url"                content="{{ url('/') }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="HB Group Perú" />
    <meta property="og:description"        content="" />
    <meta property="og:image"              content="{{asset('uploads/public/logo_marco.png')}}" />
    <?php endif ?>
    <title>HB Group Perú S.R.L.</title>
</head>
<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
<script>
    WebFont.load({
        google: {"families":["Open+Sans:300,400,600,700"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ["{{asset('assets/css/fonts.css')}}"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<link rel="stylesheet" href="{{asset('assets/css/frontend/animate.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/frontend/bootstrap.min.css')}}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/autentication.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<body>
    <section class="header">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    @if ($configurations->schedule)
                        <div class="col-md-6 d-none d-md-block" align="left">
                            <ul class="list-inline mb-0">
                                    <a href="{{ url('/') }}" class="list-inline-item"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-6 d-none d-md-block" align="right">
                        <ul class="list-inline mb-0">
                            @if ($configurations->telephone)
                            <a href="tel:+51 {{$configurations->telephone}}" class="list-inline-item "><i class="fa fa-phone"></i> (+51) 53 474805</a>
                            @endif
                            @if ($configurations->whatsapp)
                            <a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=" target="_blank" class="list-inline-item"><i class="fab fa-whatsapp "></i> {{ $configurations->whatsapp}}</a>
                            @endif

                            {{-- <a href="https://www.facebook.com/HBgroup.pe" target="_blank" class="list-inline-item icon text-white"><i class="fab fa-facebook-f text-white"></i></a> --}}

                            {{-- <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a> --}}

                            <a href="{{route('index')}}" target="_blank" class="list-inline-item icon"><i class="fas fa-user-graduate "></i> Web HB Group Perú S.R.L</a>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-block d-md-none pt-2" align="center">
                @if ($configurations->schedule)
                    <div class="col-md-12">
                        <a href="{{ url('/') }}" class="list-inline-item"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                    </div>
                @endif
                <ul class="list-inline mb-0">
                    @if ($configurations->telephone)
                    <a href="tel:992 933 603" class="list-inline-item"><i class="fa fa-phone"></i> 946877806</a>
                    @endif
                    @if ($configurations->whatsapp)
                    <a href="https://wa.me/992933603?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> 946877806</a>
                    @endif
                    {{-- <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a> --}}
                    <a href="{{route('index')}}" target="_blank" class="list-inline-item icon"><i class="fas fa-user-graduate "></i> Web HB Group Perú S.R.L</a>
                </ul>
            </div>
        </div>
    </section>
    <section id="autentication">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control" type="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="telephone">Telefono</label>
                                    <input id="telephone" class="form-control" type="number" name="telephone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Primary</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>


        </div>
    </section>
    @if ($configurations->whatsapp)<a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=Mi consulta es..." target="_blank" id="whatsapp-floot" class="btn-whatsapp-link"><i class="fab fa-whatsapp"></i></a>@endif
</body>
<script src="{{asset('assets/js/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
</html>
