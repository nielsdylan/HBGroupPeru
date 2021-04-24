<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('frontend.layouts.public.css')
    {{-- favicon --}}
</head>
<body>
    {{-- header --}}

    @include('frontend.layouts.public.header')
    @include('frontend.layouts.public.menu')
    {{-- nav --}}

    @yield('content')
    {{-- footer --}}
    @include('frontend.layouts.public.footer')

    {{-- scrip --}}
    @include('frontend.layouts.public.js')
</body>
</html>
