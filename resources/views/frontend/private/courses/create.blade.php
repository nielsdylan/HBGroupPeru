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
                    <a href="#">Nuevo Curso</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Nuevo curso</h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cursos.store')}}" method="POST" data-form="form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bussiness_id">Empresas<span class="required-label">*</span>:</label>
                                        <select class="form-control" name="bussiness_id" id="bussiness_id" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($business as $key=>$item)
                                                <option value="{{$item->business_id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="teacher">Docente<span class="required-label">*</span>:</label>
                                        <select class="form-control" name="teacher" id="teacher" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($teacher as $key=>$item)
                                                <option value="{{$item->id}}">{{$item->last_name}}, {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code">Codigo<span class="required-label">*</span>:</label>
                                        <input id="code" class="form-control" type="text" name="code" search="code-search" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="course">Curso<span class="required-label">*</span>:</label>
                                        <input id="course" class="form-control" type="text" name="course" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_start">Fecha<span class="required-label">*</span>:</label>
                                        {{-- <input id="date_start" class="form-control" type="date" name="date_start" required> --}}
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" id="date_start" name="date_start">
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
                                            <input type="text" class="form-control timepicker" id="hour_start" name="hour_start">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hour_end">Final<span class="required-label">*</span>:</label>
                                        {{-- <input id="hour_end" class="form-control" type="time" name="hour_end" required> --}}
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" id="hour_end" name="hour_end">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
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
    <script>
        $(document).on('change','[search="code-search"]',function () {
            var code = $(this).val(),
                this_input = $(this),
                route = '{{ route('get.cod.cours', ['code' => 'code'] ) }}';
                route = route.replace('code', code);
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {},
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
                method: 'POST',
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
    </script>
@endsection


