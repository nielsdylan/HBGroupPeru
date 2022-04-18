{{--

<!DOCTYPE html>
<html lang="es">

<head>

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
    <link rel="icon" href="{{asset('uploads/public/logo_snc.png')}}" type="image/x-icon">
    <title>HB Group Perú</title> --}}

    <!-- Bootstrap Core CSS -->
    {{-- <link href="{{asset('assets/calendar/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    {{-- @include('frontend.layouts.public.css') --}}
	<!-- FullCalendar -->
	{{-- <link href="{{asset('assets/calendar/css/fullcalendar.css')}}" rel='stylesheet' />
    <link href="{{asset('assets/css/calendar.css')}}" rel='stylesheet' /> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/css/frontend/animate.css')}}"> --}}

    <!-- Custom CSS -->

{{-- </head> --}}

{{-- <body> --}}
@extends('frontend.public')
@section('title','HB Group Perú')
@section('active_menu','active')
@section('content')
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
{{-- <link href="{{asset('assets/calendar/css/fullcalendar.css')}}" rel='stylesheet' />
<link href="{{asset('assets/css/calendar.css')}}" rel='stylesheet' /> --}}
    {{-- <section class="header">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    @if ($configurations->schedule)
                        <div class="col-md-6 d-none d-md-block" align="left">
                            <ul class="list-inline mb-0">
                                <a href="{{ url('/') }}" class="list-inline-item text-white"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-6 d-none d-md-block" align="right">
                        <ul class="list-inline mb-0">
                            @if ($configurations->telephone)
                            <a href="tel:+51 {{$configurations->telephone}}" class="list-inline-item text-white"><i class="fa fa-phone"></i> (+51) 53 474805</a>
                            @endif
                            @if ($configurations->whatsapp)
                            <a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> {{ $configurations->whatsapp}}</a>
                            @endif
                            <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>

                            <a href="{{route('index')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-globe-americas text-white"></i> HB GROUP PERÚ</a>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-block d-md-none pt-2" align="center">
                @if ($configurations->schedule)
                    <div class="col-md-12">
                        <a href="{{ url('/') }}" class="list-inline-item text-white"><i class="far fa-clock"></i> {{$configurations->schedule}}</a>
                    </div>
                @endif
                <ul class="list-inline mb-0">
                    @if ($configurations->telephone)
                    <a href="tel:992 933 603" class="list-inline-item text-white"><i class="fa fa-phone"></i> 946877806</a>
                    @endif
                    @if ($configurations->whatsapp)
                    <a href="https://wa.me/992933603?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> 946877806</a>
                    @endif
                    <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>
                    <a href="{{route('index')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-globe-americas text-white"></i> HB GROUP PERÚ</a>
                </ul>
            </div>
        </div>
    </section> --}}

    <section id="calendar-cours">

        <div class="container">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <h1>Curso programados</h1>
                        </div>
                    </div> --}}
                    <div class="row">
                        {{-- <div class="container"> --}}
                            <div id="calendar" class="col-md-12">
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" data-form="course-program-edit" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalle del curso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="asignature">Asignatura :</label>
                                            <label id="asignature"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="course">Curso :</label>
                                            <label id="course"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <i class="far fa-calendar-alt" data-toggle="tooltip" data-original-title="Fecha a dictarse el curso"></i>
                                            <label id="date_start"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <i class="far fa-clock" data-toggle="tooltip" data-original-title="Hora que iniciara y terminara el curso"></i>
                                            <label id="hour_start"></label> - <label id="hour_end"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <i class="fas fa-users" data-toggle="tooltip" data-original-title="Vacantes disponibles / Maximo de vacantes"></i>
                                            <label id="vacancies"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="hidden" name="id" id="id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            Separa tu vacante comunicandote al número <a href="tel:+51 932 777 533" class="email-contact"> 932 777 533</a> o al correo de
                                            <a href="mailto:{{$configurations->email}}?Subject=Inscripción%20del%20curso%20&body=Con%20urgencia" class="email-contact"> &nbsp;{{$configurations->email}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    {{-- @include('frontend.layouts.public.js') --}}

	{{-- <script src="{{asset('assets/calendar/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/fullcalendar.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/locale/es.js')}}"></script> --}}

    {{-- @if ($configurations->whatsapp)<a href="https://wa.me/+51{{ $configurations->whatsapp}}?text=Mi consulta es..." target="_blank" id="whatsapp-floot" class="btn-whatsapp-link"><i class="fab fa-whatsapp"></i></a>@endif
    <a href="#" id="back-to-top" class="btn btn-lg btn-back-top"><i class="fa fa-angle-up"></i></a> --}}
    {{-- <section id="footeer">
        <div class="pre-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('uploads/public/logo_snc.png')}}" width="140" class="img-footer">
                            </div>
                            <div class="col-md-12 pt-3 text-center">
                                <h3> <strong>HB Group Perú</strong></h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <h6 class="text-white ">SITIO</h6>
                        <ul class="list-unstyled color-list">
                            <li>
                                <a href="{{ url('/') }}" class="text-footer"><i class="fa fa-angle-right"></i> INICIO</a>
                            </li>
                            <li>
                                <a href="{{ url('/nosotros') }}" class="text-footer"><i class="fa fa-angle-right"></i> NOSOTROS</a>
                            </li>

                            <li>
                                <a href="{{ url('/servicios') }}" class="text-footer"><i class="fa fa-angle-right"></i> SERVICIOS</a>
                            </li>

                            <li>
                                <a href="{{ url('/contacto') }}" class="text-footer"><i class="fa fa-angle-right"></i> Contacto</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-white">CONTACTO</h6>
                        <ul class="list-unstyled color-list">
                            <li>
                                <ul class="list-unstyled">
                                    @if ($configurations->direction)
                                        <li><span class="text-footer"><i class="fas fa-map-marker-alt text-footer"></i> {{$configurations->direction}}</span></li>
                                    @endif
                                    @if ($configurations->whatsapp)
                                        <li><span class="text-footer"><i class="fab fa-whatsapp text-footer"></i> {{$configurations->whatsapp}}</span></li>
                                    @endif
                                    @if ($configurations->telephone)
                                        <li><span class="text-footer"><i class="fa fa-phone text-footer"></i> {{$configurations->telephone}}</span></li>
                                    @endif
                                    @if ($configurations->telephone)
                                        <li><span class="text-footer"><i class="fa fa-envelope text-footer"></i> {{$configurations->email}}</span></li>
                                    @endif

                                </ul>
                            </li>
                        </ul>
                        <div id="redes" >
                            <ul class="list-inline ml-5 d-none d-sm-none d-lg-block d-md-block">
                                <li class="list-inline-item">
                                    @if ($configurations->facebook)
                                    <a class="facebook pr-3 text-white" href="{{$configurations->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if ($configurations->linkedin)
                                    <a class="text-white" href="{{$configurations->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-inline text-center d-block d-sm-block d-lg-none d-md-none">
                                <li class="list-inline-item">
                                    @if ($configurations->facebook)
                                    <a class="facebook pr-3 text-white" href="{{$configurations->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if ($configurations->linkedin)
                                    <a href="{{$configurations->linkedin}}" class="text-white" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copy">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 copyright_text wow fadeInUp animated">
                        <div class="d-none d-lg-block text-white">
                            <center><span>&copy; {{ date("Y") }} HBGroupp - Todos los derechos reservados. </center>
                        </div>
                        <div class="d-block d-lg-none text-white">
                            <center><span>&copy; {{ date("Y") }}  HBGroupp - Todos los derechos reservados.</span></center>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section> --}}
	<script>

        $(document).ready(function() {

            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
            var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
            var route = '{{ route('get.events' ) }}';
            var array_events = [];

            setTimeout(function(){
                // $('#calendar').addClass('animated lightSpeedIn');
            }, 1000);

            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {},
            }).done(function (response) {

                $.each(response, function (index, element) {

                    if (element.date_start) {
                        a={
                            id: element.cours_id,
                            title: element.course+', '+element.asignature_name,
                            start: element.date_start,
                            end: element.date_start,
                            color: '#40E0D0',
                            asignature_id: element.asignature_id,
                        }
                        array_events.push(a);
                    }

                });
                $('#calendar').fullCalendar({
                    header: {
                        language: 'es',
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay',

                    },
                    defaultDate: yyyy+"-"+mm+"-"+dd,
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end) {

                        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #date_start').val(moment(start).format('DD-MM-YYYY'));

                        $('#ModalAdd #date_hidden').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd').modal('show');
                    },
                    eventRender: function(event, element) {
                        element.bind('dblclick', function() {

                            var id_event = event.id,
                                route   = '{{ route('events', ['event' => '+id_event+'] ) }}',
                                route   = route.replace('id_event', id_event),
                                h_start = '', h_end = '';
                            $.ajax({
                                method: 'GET',
                                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                                url: route,
                                dataType: 'json',
                                data: {},
                            }).done(function (response) {
                                if (response.status == 200) {
                                    console.log(response);
                                    $('#ModalEdit #id').val(response.result.id);
                                    $('#ModalEdit #asignature').text(response.result.asignature_name);
                                    $('#ModalEdit #course').text(response.result.course);
                                    h_end = response.result.hour_end;
                                    h_end = h_end.split(':');

                                    h_start = response.result.hour_start;
                                    h_start = h_start.split(':');

                                    $('#ModalEdit #hour_end').text(h_end[0]+':'+h_end[1]);
                                    $('#ModalEdit #hour_start').text(h_start[0]+':'+h_start[1]);
                                    $('#ModalEdit #date_start').text((response.result.date_start).split('-').reverse().join('-'));
                                    $('#ModalEdit #date_hidden').val(response.result.date_start);
                                    $('#ModalEdit #vacancies').html(response.result.number+'/20');

                                    $('#ModalEdit').modal('show');
                                }
                            }).fail(function () {
                                // alert("Error");
                            });


                        });
                    },
                    eventDrop: function(event, delta, revertFunc) { // si changement de position

                        edit(event);

                    },
                    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                        edit(event);

                    },
                    events: array_events
                });
            }).fail(function () {
                // alert("Error");
            });



            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                }else{
                    end = start;
                }

                id =  event.id;

                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                 url: 'editEventDate.php',
                 type: "POST",
                 data: {Event:Event},
                 success: function(rep) {
                        if(rep == 'OK'){
                            alert('Evento se ha guardado correctamente');
                        }else{
                            alert('No se pudo guardar. Inténtalo de nuevo.');
                        }
                    }
                });
            }

        });
        $(document).on('submit','[data-form="course-program"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize(),
                route = $(this).attr('action');

            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.status == 200) {
                    location.reload();
                }
            }).fail(function () {
                // alert("Error");
            });

        });
        $(document).on('submit','[data-form="course-program-edit"]',function (e) {
            e.preventDefault();
            var id_event    = $(this).find('#id').val(),
                data        = $(this).serialize(),
                route       = '{{ route('calendario.update', ['calendario' => '+id_event+'] ) }}';
                route       = route.replace('id_event', id_event);

            $.ajax({
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.status == 200) {
                    location.reload();
                }
            }).fail(function () {
                // alert("Error");
            });

        });
    </script>
{{--
</body>

</html> --}}
@endsection
