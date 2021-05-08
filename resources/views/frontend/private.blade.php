<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Azzara Bootstrap 4 Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	{{-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/> --}}

    @include('frontend.layouts.private.css')
</head>
<body data-background-color="bg3">
	<div class="wrapper">

		<div class="main-header" data-background-color="blue"
			<!-- Navbar Header -->
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
@include('frontend.layouts.private.js')
</body>
</html>
