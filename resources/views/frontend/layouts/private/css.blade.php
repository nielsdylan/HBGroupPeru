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
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/css/azzara.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/css/azzara_2.min.css')}}">
<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">

<link href="{{asset('assets/styles.css')}}" rel="stylesheet" />
<link href="{{asset('assets/prism.css')}}" rel="stylesheet" />

{{-- my css --}}
<link rel="stylesheet" href="{{asset('assets/js/plugin/sweetAlert2/dist/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugin/fancybox_backend/jquery.fancybox.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/js/plugin/protip/protip.min.css') }}">

<link rel="stylesheet" href="{{asset('assets/css/hbgroup.css')}}">
<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>

<script src="{{asset('assets/js/plugin/sweetAlert2/dist/sweetalert.js')}}"></script>

<!-- Bootstrap Core CSS -->
    {{-- <link href="{{asset('assets/calendar/css/bootstrap.min.css')}}" rel="stylesheet"> --}}

	<!-- FullCalendar -->
	<link href="{{asset('assets/calendar/css/fullcalendar.css')}}" rel='stylesheet' />

