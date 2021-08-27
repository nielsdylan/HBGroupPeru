<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('uploads/public/logo_snc.png')}}" type="image/x-icon">

	<!-- Fonts and icons -->
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
    <script type="text/javascript"> var url="{{url('').'/'}}"; </script>
    {{-- <script type="text/javascript"> var route="{{route(')}}"; </script> --}}
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Inicia session</h3>
            <form action="" method="POST" data-login="session-start">
                <input type="hidden" name="token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="group">Tipo de usuario</label>
                    <select id="group" class="form-control" name="group_id" data-action="search-dni-group" required>
                        <option value="">Seleccione...</option>
                        @if ($groups)
                          @foreach ($groups as $key=>$item )
                                <option value="{{$item->group_id}}" {{ ($item->group_id==4?'selected':'') }} >{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="login-form">
                    <div class="form-group">
                        <label for="username" class="placeholder"><b>Correo</b></label>
                        <input id="username" name="username" type="text" class="form-control" placeholder="ejemplo@ejemplo..." required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="placeholder"><b>Contraseña</b></label>
                        {{-- <a href="#" class="link float-right">Forget Password ?</a> --}}
                        <div class="position-relative">
                            <input id="password" name="password" type="password" class="form-control" required>
                            <div class="show-password">
                                <i class="flaticon-interface"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        {{-- <div class="custom-control custom-checkbox"> --}}
                            {{-- <input type="checkbox" class="custom-control-input" id="rememberme"> --}}
                            {{-- <label class="custom-control-label m-0" for="rememberme">Remember Me</label> --}}
                        {{-- </div> --}}
                        <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Iniciar </button>
                    </div>
                </div>
            </form>

		</div>

		{{-- <div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
				<div class="form-group">
					<label for="fullname" class="placeholder"><b>Fullname</b></label>
					<input  id="fullname" name="fullname" type="text" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="email" class="placeholder"><b>Email</b></label>
					<input  id="email" name="email" type="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="passwordsignin" class="placeholder"><b>Password</b></label>
					<div class="position-relative">
						<input  id="passwordsignin" name="passwordsignin" type="password" class="form-control" required>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="confirmpassword" class="placeholder"><b>Confirm Password</b></label>
					<div class="position-relative">
						<input  id="confirmpassword" name="confirmpassword" type="password" class="form-control" required>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="agree" id="agree">
						<label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
					</div>
				</div>
				<div class="row form-action">
					<div class="col-md-6">
						<a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
					</div>
					<div class="col-md-6">
						<a href="#" class="btn btn-primary w-100 fw-bold">Sign Up</a>
					</div>
				</div>
			</div>
		</div> --}}
	</div>
	<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/ready.js')}}"></script>
    <script>
        $(document).on('submit','[data-login="session-start"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="token"]').val()},
                url: url+'login/session',
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.status == 200) {
                    location.href = '{!! route('perfil.index') !!}';
                }else{
                    var placementFrom = 'top';
                    var placementAlign = 'center';
                    var state = 'danger';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Ingrese correctamente los datos para la session para HB Group Perú';
                    content.title = 'Session';
                    // if (style == "withicon") {
                    //     content.icon = 'fas fa-times';
                    // } else {
                    //     content.icon = 'none';
                    // }
                    content.icon = 'fas fa-times';
                    content.url = url+'hbgroupp_web';
                    content.target = '_blank';

                    $.notify(content,{
                        type: state,
                        placement: {
                            from: placementFrom,
                            align: placementAlign
                        },
                        time: 1000,
                        delay: 0,
                    });

                    setTimeout(function(){
                        $('[data-notify="dismiss"]').click();
                    }, 3000);
                }
            }).fail(function () {
                // alert("Error");
            });

        });
    </script>
</body>
</html>
