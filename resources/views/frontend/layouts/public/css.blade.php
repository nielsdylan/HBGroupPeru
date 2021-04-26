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

<!-- CSS Files -->

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" rel="stylesheet"> --}}

{{-- my css --}}

<link rel="stylesheet" href="{{asset('assets/css/frontend/menu.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/frontend/frontend.css')}}">
{{-- carrosel --}}
<link href="{{asset('assets/css/frontend/owl.carousel.css')}} " rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/frontend/animate.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/frontend/bootstrap.min.css')}}">

<link href="{{asset('assets/js/plugin/fancybox/jquery.fancybox.css?v=2.1.5')}}" rel="stylesheet" type="text/css" media="screen" />

<link href="{{asset('assets/css/owlcarousel/owlcarousel/assets/owl.carousel.min.css')}} " rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('assets/js/js/jquery.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />

{{-- --- --}}
{{-- <link href="{{asset('assets/js/plugin/fontawesome-5/css/all.css')}}"  rel="stylesheet"> --}}

