<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('uploads/public/logo_snc.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
    @include('frontend.layouts.public.css')
    {{-- favicon --}}
</head>
<div class="centrado" id="loadhb">
    {{-- <div class="lds-ripple">
        <div></div>
        <div></div>
    </div> --}}
    {{-- <div class="corazon">&#x2665;</div> --}}
    <img src="{{asset('assets/img/hb_group_la.png')}}" alt="5" class="corazon">
</div>
<body class="hidden">

    {{-- header --}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @include('frontend.layouts.public.header')
    @include('frontend.layouts.public.menu')
    {{-- nav --}}

    @yield('content')
    {{-- footer --}}
    @include('frontend.layouts.public.footer')

    {{-- scrip --}}
    <script type="text/javascript"> var url="{{url('').'/'}}"; </script>
    @include('frontend.layouts.public.js')
</body>
</html>
