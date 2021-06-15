

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calendario</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/calendar/css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- FullCalendar -->
	<link href="{{asset('assets/calendar/css/fullcalendar.css')}}" rel='stylesheet' />


    <!-- Custom CSS -->

</head>

<body>
    <div class="container">
                <h1>Curso programados</h1>
                <div id="calendar" class="col-md-12">
            </div>

        <!-- /.row -->

		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form class="form-horizontal" method="POST" action="addEvent.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
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
                            <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                            <div class="col-sm-10">
                            <input type="text" name="start" class="form-control" id="start" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                            <div class="col-sm-10">
                            <input type="text" name="end" class="form-control" id="end" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                </div>
            </div>
		</div>



		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="{{asset('assets/calendar/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/calendar/js/bootstrap.min.js')}}"></script>

	<!-- FullCalendar -->
	<script src="{{asset('assets/calendar/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/fullcalendar.js')}}"></script>
	<script src="{{asset('assets/calendar/js/fullcalendar/locale/es.js')}}"></script>


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

                if((element.start).split(' ')[1] == '00:00:00'){
                    start = (element.start).split(' ')[0];
                }else{
                    start = element.start;
                }
                if((element.end).split(' ')[1] == '00:00:00'){
                    end = (element.end).split(' ')[0];
                }else{
                    end = element.end;
                }

                a={
                    id: element.id,
                    title: element.title,
                    start: start,
                    end: end,
                    color: element.color,
                }
                array_events.push(a);
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
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit').modal('show');
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

    </script>

</body>

</html>
