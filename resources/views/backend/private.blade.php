<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('backend.private.layout.css')
    {{-- favicon --}}
</head>
<body>
    {{-- header --}}
    @include('backend.private.layout.header')
    {{-- nav --}}
    <div class="main-panel content-dashboard">
        @yield('content')
    </div>
    {{-- gooter --}}
    {{-- scrip --}}
    @include('backend.private.layout.js')
</body>
</html>
