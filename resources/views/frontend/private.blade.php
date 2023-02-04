<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>HB Group Peru</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	{{-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/> --}}

    @include('frontend.layouts.private.css')
    @include('frontend.layouts.private.js')
    @yield("links")
</head>
<body class="hidden" data-background-color="bg3">

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
<script>
    $('#datetime').datetimepicker({
        format: 'MM/DD/YYYY H:mm',
    });
    $('.form-control.datepicker').datetimepicker({
        format: 'DD/MM/YYYY',
    });
    $('.form-control.timepicker').datetimepicker({
        format: 'H:mm',
    });

    $('select.form-control').select2({
        theme: "bootstrap"
    });

    $('select.form-control.select2').select2({
        theme: "bootstrap"
    });

    $('#multiple-states').select2({
        theme: "bootstrap"
    });

    $('#tagsinput').tagsinput({
        tagClass: 'badge-info'
    });
    $('#editor').summernote({
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        tabsize: 2,
        height: 300
    });
    let csrf_token = '{{ csrf_token() }}';
    const idioma = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate":
        {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria":
        {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
</script>
@yield("scripts")
</html>
