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
                                <label for="asignature">Asignatura<span class="required-label">*</span>:</label>
                                <select class="form-control" name="asignature" id="asignature" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($asignature as $key=>$item)
                                        <option value="{{$item->asignature_id}}">{{$item->name}}({{$item->abbreviation}})</option>
                                    @endforeach
                                </select>
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
            <form action="" data-form="course-program-edit" method="POST">
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
                            <input type="hidden" name="id" id="id">
                                <label for="asignature">Asignatura</label>
                                <select class="form-control" name="asignature" required>
                                    {{-- <option value="">Seleccione...</option> --}}
                                    {{-- @foreach ($asignature as $key=>$item)
                                        <option value="{{$item->asignature_id}}">{{$item->name}}({{$item->abbreviation}})</option>
                                    @endforeach --}}
                                </select>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="0" name="active">
                                    <span class="form-check-sign">¿Eliminar?</span>
                                </label>
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
        var html ='';
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},
        }).done(function (response) {
            console.log(response);
            $.each(response, function (index, element) {

                if (element.date_start) {
                    a={
                        id: element.cours_id,
                        title: element.course+', '+element.asignature_name,
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
                                $('#ModalEdit #id').val(response.result.cours_id);
                                $.each(response.asignature, function (index, element) {
                                    console.log(element);
                                    html+='<option value="'+element.asignature_id+'" '+element.asignature_id==response.result.asignature_id?'selected':''+'>'+element.name+' ('+element.abbreviation+')</option>'
                                });
                                $('#ModalEdit [name="asignature"]').html(html);

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
            var route   = '{{ route('date.update' ) }}';
			start = event.start.format('YYYY-MM-DD');
			if(event.end){
				end = event.end.format('YYYY-MM-DD');
			}else{
				end = start;
			}

			id =  event.id;
            data_edit_event = {
                id:id,
                start:start,
                end:end
            };
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			$.ajax({
			    url: route,
			    type: "POST",
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                dataType: 'json',
                data: data_edit_event,
                success: function(rep) {
                    var placementFrom = 'top';
                    var placementAlign = 'right';
                    var state = 'danger';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Se guardo con Éxito';
                    content.title = 'Guardar';
                    content.icon = 'fas fa-times';
                    content.url = url+'login';
                    content.target = '_blank';

                    if (rep.status == 200) {
                        state='success';
                        content.icon = 'fas fa-check';
                    }




                    $.notify(content,{
                        type: state,
                        placement: {
                            from: placementFrom,
                            align: placementAlign
                        },
                        time: 1000,
                        delay: 2,
                    });
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

@endsection
