<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>HB Group Peru</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	{{-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/> --}}

    @include('frontend.layouts.private.css')
    @include('frontend.layouts.private.js')
</head>
<body data-background-color="bg3">
	<div class="wrapper">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <script type="text/javascript"> var url="{{url('').'/'}}"; </script>
		<div class="main-header" data-background-color="blue"
			>
			@include('frontend.layouts.private.navbar')
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('frontend.layouts.private.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                @yield('content')
			</div>

		</div>

	</div>
</div>

</body>
</html>
