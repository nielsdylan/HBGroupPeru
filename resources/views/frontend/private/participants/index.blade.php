@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Participantes</h4>
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
                    <a href="#">Lista de participantes</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Participantes</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-light" data-toggle="tooltip" data-original-title="Exportar la lista de los participantes" href="{{route('participant.excel.export')}}"><i class="fas fa-file-excel fon-z"></i></a>

                                <a class="btn btn-light" data-toggle="tooltip" data-original-title="Exportar la lista de los participantes validados" href="{{route('participant.excel.validados')}}"><i class="fas fa-file-excel fon-z"></i></a>

                                {{-- <a class="btn btn-light" data-toggle="tooltip" data-original-title="Modelo del excel" href="{{route('export.model.excel')}}"><i class="fas fa-file-import fon-z"></i></a>

                                <a class="btn btn-light" data-toggle="tooltip" data-original-title="Importar excel de participantes" href="#" data-action="participant-import"><i class="fas fa-file-upload fon-z"></i></a> --}}
                                <a class="btn btn-primary btn-round" href="{{route('participantes.create')}}"> <i class="fa fa-plus"></i> Nuevo participante</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <td>DNI</td>
                                        <td>APELLIDOS</td>
                                        <td>NOMBRE</td>
                                        {{-- <td>EMAIL</td>
                                        <td>CELULAR</td>
                                        <td>EMPRESA</td> --}}
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($participants)
                                        @foreach ($participants as $key=>$item)
                                            <tr>
                                                <td>{{$item->dni}}</td>
                                                <td>{{$item->last_name}}</td>
                                                <td>{{$item->name}}</td>
                                                {{-- <td>{{$item->email}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td>{{$item->name_business}}</td> --}}
                                                <td>
                                                    <div class="form-button-action">
                                                        <a data-toggle="tooltip" title="" class="btn btn-link btn-warning btn-lg" data-original-title="Asignar cursos al participante"  href="{{route('asignacion-cursos.index').'?DNI='.$item->dni}}">
                                                            <i class="fas fa-project-diagram"></i>
                                                        </a>
                                                        <a data-toggle="tooltip" title="" class="btn btn-link btn-success btn-lg" data-original-title="Ver a {{$item->last_name}}"  href="{{route('participantes.show',$item->id)}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->last_name}}"  data-id="{{$item->participant_id  }}" href="{{route('participantes.edit', $item->id)}}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->last_name}}" data-delete="modal" data-id="{{$item->id  }}">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" data-table="response">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Importar participantes</h4>
                            </div>
                            <div class="col-md-6 text-right">

                                <a class="btn btn-light" data-toggle="tooltip" data-original-title="Modelo del excel" href="{{route('export.model.excel')}}"><i class="fas fa-cloud-download-alt fon-z"></i></a>

                                <a class="btn btn-light" data-toggle="tooltip" data-original-title="Importar excel de participantes" href="#" data-action="participant-import"><i class="fas fa-cloud-upload-alt fon-z"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('participantes.store')}}" method="post" enctype="multipart/form-data" data-form="save-excel">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="asignature">Asignatura <span class="required-label">*</span>:</label>
                                        <select class="form-control" name="asignature" select-cours="get-cours" data-select="get-course" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($asignatures as $item)
                                                <option value="{{$item->asignature_id}}">{{$item->name}} ({{$item->abbreviation}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="course">Curso <span class="required-label">*</span>:</label>
                                        <select class="form-control" name="course" data-course="get-course" required>
                                            <option value="">Seleccione...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="participant">Agregar lista de los participantes <span class="required-label">*</span>:</label>
                                        <input id="participant" class="form-control" type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-4">
                                    <div class="form-group">
                                        <label for="send_email">Enviar correo electronico : </label>
                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_email" value="1" checked>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-4">
                                    <div class="form-group">
                                        <label for="send_telephone">Enviar mensaje de texto : </label>
                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_telephone" value="1" checked>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
    $(document).on('click','[data-action="participant-import"]',function (e) {
        e.preventDefault();
        $('#import-excel-participant').modal('show');

    });

    $(document).on('change','[select-cours="get-cours"]',function (e) {
        e.preventDefault();
        var this_select = $(this),
            cours_id = $(this).val(),
            data_select = $(this).attr('data-select'),
            select = '[data-course="'+data_select+'"]';
        console.log(data_select);
        getCourseAsignature(cours_id,select);
    });
    function getCourseAsignature(id, select) {
        var html='',
            route   = '{{ route('get.courses.asignature') }}';
        data = {
            id:id
        }
        // get.courses
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            // processData: false,
            // contentType: false,
            data: data,
            beforeSend: function()
            {
                $(select).attr('disabled','')
            },
        }).done(function (response) {
            $(select).removeAttr('disabled');
            if (response.status == 200) {
                html = '<option value="">Seleccione...</option>';
                $.each(response.results, function (index, element) {
                    html+='<option value="'+element.cours_id+'">'+element.course+' ('+element.code+')</option>';
                });
                $(select).html(html);
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
                        from: 'top',
                        align: 'center'
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
            $(select).removeAttr('disabled');
        });
    }
    $(document).on('submit','[data-form="save-excel"]',function (e) {
        e.preventDefault();
        var data = new FormData($(this)[0]),
            html='',
            route = $(this).attr('action');

        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function()
            {
                $('[data-form="save-excel"] button[type="submit"]').addClass('is-loading');
                $('[data-form="save-excel"] button[type="submit"]').attr('disabled','');
            },
        }).done(function (response) {
            $('[data-table="response"]').html('');
            $('[data-form="save-excel"] button[type="submit"]').removeClass('is-loading');
            $('[data-form="save-excel"] button[type="submit"]').removeAttr('disabled');
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
                    location.reload();
                }, 3000);

            }else{
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = 'Ingrese correctamente los datos para la importación de los participantes';
                content.title = 'Importación';
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
                        from: 'top',
                        align: 'center'
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
    $(document).on('click','[data-modal="add-modal"]',function () {
        $('#add-modal').modal('show');
    });

    $(document).on('click','[data-delete="modal"]',function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'),
            route = '{{ route('participantes.destroy', ['participante' => 'id'] ) }}';
            route = route.replace('id', id);
        swal({
            title: "¿Está seguro de eliminar??",
            text: "Se eliminara su registro.",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }, function () {
            $.ajax({
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function()
                {
                },
            }).done(function (response) {
                if (response.status == 200) {

                    swal({
                        title: " ",
                        text: "Se elimino con éxito",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: '#78cbf2',
                        confirmButtonText: 'Aceptar',
                        },
                        function(){
                            location.reload();
                    });
                }else{
                    swal("Informativo", "Ocurrio un error", "warning")
                }
            }).fail(function () {
                // alert("Error");
                swal("Informativo", "Ocurrio un error", "warning");
            });
        });

    });
    $(document).on('click','.close-alert',function () {
        $('[data-table="response"]').html('');
    });
</script>
@endsection
