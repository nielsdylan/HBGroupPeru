@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Cursos</h4>
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
                    <a href="#">Cursos</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Editar Curso</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Editar curso</h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cursos.update',$curso)}}" method="POST" data-form="form">
                            <input type="hidden" name="id" value="{{$curso->cours_id}}">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bussiness_id">Empresas<span class="required-label">*</span>:</label>
                                        <select class="form-control" name="bussiness_id" id="bussiness_id" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($business as $key=>$item)
                                                <option value="{{$item->business_id}}" {{ $curso->business_id == $item->business_id ? 'selected' : '' }} >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asignature">Asignatura<span class="required-label">*</span>:</label>
                                        <select class="form-control" name="asignature" id="asignature" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($asignature as $key=>$item)
                                                <option value="{{$item->asignature_id}}"{{ $curso->asignature_id == $item->asignature_id ? 'selected' : '' }}>{{$item->name}}({{$item->abbreviation}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="teacher">Docente<span class="required-label">*</span>:</label>
                                        <select class="form-control" name="teacher" id="teacher" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($teacher as $key=>$item)
                                                <option value="{{$item->id}}"{{ $curso->user_id == $item->id ? 'selected' : '' }}>{{$item->last_name}}, {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Codigo<span class="required-label">*</span>:</label>
                                        <input id="code" class="form-control" type="text" name="code" search="search" value="{{$curso->code}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course">Curso<span class="required-label">*</span>:</label>
                                        <input id="course" class="form-control" type="text" name="course" value="{{$curso->course}}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_start">Fecha<span class="required-label">*</span>:</label>
                                        {{-- <input id="date_start" class="form-control" type="date" name="date_start" required> --}}
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" id="date_start" name="date_start" value="{{ date('d/m/Y', strtotime($curso->date_start))}}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar-check"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hour_start">Inicio<span class="required-label">*</span>:</label>
                                        {{-- <input id="hour_start" class="form-control" type="time" name="hour_start" required> --}}

                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" id="hour_start" name="hour_start" value="{{$curso->hour_start}}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hour_end">Final<span class="required-label">*</span>:</label>
                                        {{-- <input id="hour_end" class="form-control" type="time" name="hour_end" required> --}}
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" id="hour_end" name="hour_end" value="{{$curso->hour_end}}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="vacancies">Vacantes <span class="required-label">*</span>:</label>
                                        <i class="fas fa-info-circle
                                        vacancies" data-toggle="tooltip" data-placement="top" title="Click para ver el historial de las vacantes" > </i><input id="vacancies" class="form-control" type="number" name="vacancies" value="{{$vacancies->number}}" max="20" required>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="max_vacancies">Maximo de vacantes<span class="required-label">*</span>:</label>
                                        <input id="max_vacancies" class="form-control" type="number" name="max_vacancies" value="{{$curso->max_vacancies}}" required>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="calendar">Calendario <span class="required-label">*</span>:</label>
                                        <input type="checkbox" {{$curso->calendar==1?'checked':''}} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="btn-round" data-on="Si" data-off="No" name="calendar" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="separator-solid"></div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary "><i class="fa fa-save"></i> Guardar</button>
                                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button> --}}
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DE HISTORIAL --}}
    <div class="modal fade" id="modalHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Historial de vacantes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"data-table="table">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data ={};
        $(document).on('change','[search="search"]',function () {
            var code = $(this).val(),
                id = $('[data-form="form"] [name="id"]').val(),
                this_input = $(this),
                route = '{{ route('get.cod.cours.id') }}';

            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {id:id,code:code},
                beforeSend: function()
                {
                },
            }).done(function (response) {
                if (response.status == 200) {
                    this_input.val('');
                    swal("Informativo", "Este codigo ya se encuentra en uso", "warning")
                }
            }).fail(function () {
                // alert("Error");
            });


        });

        $(document).on('submit','[data-form="form"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize(),
                route = $(this).attr('action');
            $.ajax({
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
                beforeSend: function()
                {
                    $('[data-form="form"] button[type="submit"]').addClass('is-loading')
                },
            }).done(function (response) {
                $('[data-form="form"] button[type="submit"]').removeClass('is-loading');
                if (response.status == 200) {

                    var placementFrom = 'top';
                    var placementAlign = 'right';
                    var state = 'success';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Se guardo con Éxito';
                    content.title = 'Guardar';
                    content.icon = 'fas fa-check';
                    content.url = url+'login';
                    content.target = '_blank';

                    $.notify(content,{
                        type: state,
                        placement: {
                            from: placementFrom,
                            align: placementAlign
                        },
                        time: 1000,
                        delay: 2,
                    });
                    setTimeout(function(){
                        location.href = '{!! route('cursos.index') !!}';
                    }, 3000);

                }else{
                    var placementFrom = 'top';
                    var placementAlign = 'center';
                    var state = 'danger';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Intentelo mas tarde o contacte con el area de informatica';
                    content.title = 'Error';
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
                $('[data-form="form"] button[type="submit"]').removeClass('is-loading')
            });

        });
        $(document).on('click','.vacancies',function () {
            $('#modalHistory').modal('show');
            getVacanciesPagination();

        });

        // paginacion de vacantes gistorial
        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getVacanciesPagination(page);
        });
        function getVacanciesPagination(page) {
            id = $('[data-form="form"] [name="id"]').val(),
            route = '{{ route('vacancies.pagination') }}',

            data.page = page;
            data.id = id;
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
                beforeSend: function()
                {
                    $('[data-table="table"]').addClass('is-loading is-loading-lg');
                },
            }).done(function (response) {
                $('[data-table="table"]').removeClass('is-loading is-loading-lg');
                if (response) {
                    $('[data-table="table"]').html(response);
                }
            }).fail(function () {
                alert("Error");
            });
        }
    </script>
@endsection


