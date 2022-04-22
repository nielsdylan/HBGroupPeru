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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="dni" placeholder="DNI..." >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Apellidos/Nombres..." >
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <button type="button" class="btn btn-primary btn-round" data-action="search"><i class="fas fa-search"></i>  Buscar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                               <div class="table-responsive" data-table="table">

                                </div>
                            </div>
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
                                {{-- <div class="col-md-6">
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
                                </div> --}}
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
    var data ={};
    var count_text = 0;
    var data_excel = new Array();
    $(document).ready(function () {
        getPagination();
    });

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
                console.log(response.number_msm_text);
                data_excel=response.number_msm_text;
                numberText(0,10);
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


    $(document).on('click','[data-action="search"]',function () {
        getPagination();
    });
    $(document).on('click','.pagination a',function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPagination(page);
    });
    function getPagination(page) {
        route = '{{ route('participant.list') }}';
        data.page = page;
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
    $(document).on('change','[name="name"]',function () {
        var name=$(this).val();
        data.name = name;
        getPagination();
    });
    $(document).on('change','[name="dni"]',function () {
        var dni=$(this).val();
        data.dni = dni;
        getPagination();
    });
    $(document).on('click','.confirmation-email',function () {
        var id=$(this).val();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            oneValidation(id,1,"email")
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            oneValidation(id,0,"email")
        }

    });
    $(document).on('click','.confirmation-telephone',function () {
        var id=$(this).val();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            oneValidation(id,1,"telephone")

        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            oneValidation(id,0,"telephone")
        }
    });
    function oneValidation(id,confirmation,type) {
        route = '{{ route('one.validation') }}';
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {
                id:id,
                confirmation:confirmation,
                type:type
            },
            beforeSend: function()
            {
                // $('[data-table="table"]').addClass('is-loading is-loading-lg');
            },
        }).done(function (response) {
            // $('[data-table="table"]').removeClass('is-loading is-loading-lg');

        }).fail(function () {
            alert("Error");
        });
    }
    function numberText(inicio, fin) {
        var data_part=[],
            length_data = data_excel.length;
        for (let i = inicio; i < fin; i++) {
            console.log(data[i]);
        }
    }
</script>
@endsection
