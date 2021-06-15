@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Calendario</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('cliente.index')}}">Cursos programados</a>
            </li>

        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <div id="calendar" class="col-md-12">
                    </div>

                <!-- /.row -->


                <!-- Modal -->
                    <div class="modal fade" id="ModalEdit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="form-horizontal" method="POST" action="editEventTitle.php">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Titulo</label>
                                            <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                            <select name="color" class="form-control" id="color">
                                                <option value="">Seleccionar</option>
                                                <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                                <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                                <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                                <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                                <option style="color:#000;" value="#000">&#9724; Negro</option>

                                                </select>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
                                                </div>
                                                </div>
                                            </div>

                                        <input type="hidden" name="id" class="form-control" id="id">


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('calendario.store')}}" data-form="course-program" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cursos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asignature">Asignatura</label>
                                <input id="asignature" class="form-control" type="text" name="asignature" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="course">Curso</label>
                                <input id="course" class="form-control" type="text" name="course" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_start">Fecha de inicio</label>
                                <input id="date_start" class="form-control" type="text" name="date_start" readonly>
                                <input type="hidden" id="date_hidden" name="date_hidden" value=""readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hour_start">Hora de inicio :</label>
                                <input id="hour_start" class="form-control" type="time" name="hour_start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hour_end">Hora de fin :</label>
                                <input id="hour_end" class="form-control" type="time" name="hour_end" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('calendario.store')}}" data-form="course-program" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cursos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asignature">Asignatura</label>
                                <input id="asignature" class="form-control" type="text" name="asignature" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="course">Curso</label>
                                <input id="course" class="form-control" type="text" name="course" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_start">Fecha de inicio</label>
                                <input id="date_start" class="form-control" type="text" name="date_start" readonly>
                                <input type="hidden" id="date_hidden" name="date_hidden" value=""readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hour_start">Hora de inicio :</label>
                                <input id="hour_start" class="form-control" type="time" name="hour_start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hour_end">Hora de fin :</label>
                                <input id="hour_end" class="form-control" type="time" name="hour_end" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>

	$(document).ready(function() {

        var date = new Date();
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
        var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
        var route = '{{ route('get.events' ) }}';
        var array_events = [];

        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},
        }).done(function (response) {

            $.each(response, function (index, element) {
                // var start = (element.start).split(' '),
                //     end = (element.end).split(' ');

                // if((element.start).split(' ')[1] == '00:00:00'){
                //     start = (element.start).split(' ')[0];
                // }else{
                //     start = element.start;
                // }
                // if((element.end).split(' ')[1] == '00:00:00'){
                //     end = (element.end).split(' ')[0];
                // }else{
                //     end = element.end;
                // }
                if (element.date_start) {
                    a={
                        id: element.id,
                        title: element.course+', '+element.asignature,
                        start: element.date_start,
                        end: element.date_start,
                        color: '#40E0D0',
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
                            route   = '{{ route('calendario.edit', ['calendario' => '+id_event+'] ) }}';
                            route   = route.replace('id_event', id_event);
                        $.ajax({
                            method: 'GET',
                            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                            url: route,
                            dataType: 'json',
                            data: {},
                        }).done(function (response) {
                            if (response.status == 200) {
                                console.log(response);
                                $('#ModalEdit #asignature').val(response.result.asignature);
                                $('#ModalEdit #course').val(response.result.course);
                                $('#ModalEdit #hour_end').val(response.result.hour_end);
                                $('#ModalEdit #hour_start').val(response.result.hour_start);
                                $('#ModalEdit #date_start').val((response.result.date_start).split('-').reverse().join('-'));
                                $('#ModalEdit #date_hidden').val(response.result.date_start);

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
</script>

@endsection
