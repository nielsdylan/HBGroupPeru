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
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de cursos</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-modal="save">
                            <i class="fa fa-plus"></i>
                            Nuevo curso
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CODE</th>
                                    <th>CURSO</th>
                                    <th>ASIGNATURA</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody data-tb="list">
                                @foreach ($results as $key=>$element )
                                    <tr>
                                        <td>{{$element->cours_id}}</td>
                                        <td>{{$element->code}}</td>
                                        <td>{{$element->course}}</td>
                                        <td>{{$element->asignature_name}}</td>
                                        <td>
                                            <div class="form-button-action">
                                                '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar el curso {{$element->course}}" data-id="{{$element->cours_id}}" data-edit="modal">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$element->course}}" data-id="{{$element->cours_id}}" data-delete="modal">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.private.courses.create')
@include('frontend.private.courses.edit')

<script>
    $(document).ready(function () {

    });
    function getBusiness() {
        var route   = '{{ route('get.business') }}',
            html    ='';
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},
            beforeSend: function()
            {
                $('[name="bussiness_id"]').attr('disabled','');
            },
        }).done(function (response) {
            $('[name="bussiness_id"]').removeAttr('disabled');
            if (response.status == 200) {

                html='<option value="">Seleccione...</option>';
                $.each(response.results, function (index, element) {
                    html+='<option value="'+element.business_id+'">'+element.name+'</option>';
                });
                $('[name="bussiness_id"]').html(html);
            }else{

            }
        }).fail(function () {
            // alert("Error");
            $('[name="bussiness_id"]').removeAttr('disabled');
        });
    }
    function getAsignature() {
        var route   = '{{ route('get.asignature') }}',
            html    ='';
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},
            beforeSend: function()
            {
                $('#asignature').attr('disabled','');
            },
        }).done(function (response) {
            $('#asignature').removeAttr('disabled');
            if (response.status == 200) {

                html='<option value="">Seleccione...</option>';
                $.each(response.results, function (index, element) {
                    html+='<option value="'+element.asignature_id+'">'+element.name+' ('+element.abbreviation+')</option>';
                });
                $('#asignature').html(html);
            }else{

            }
        }).fail(function () {
            // alert("Error");
            $('#asignature').removeAttr('disabled');
        });
    }
    $(document).on('click','[data-modal="save"]',function (e) {
        e.preventDefault();
        var html = '';
        $('#addRowModal').modal('show');
        html =''+
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<label for="bussiness_id">Empresas :</label>'+
                        '<select class="form-control" name="bussiness_id" id="bussiness_id" required>'+
                            '<option value="">Seleccione...</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<label for="asignature">Asignatura :</label>'+
                        '<select class="form-control" name="asignature" id="asignature" required>'+
                            '<option value="">Seleccione...</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label for="code">Codigo :</label>'+
                        '<input id="code" class="form-control" type="text" name="code" required>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label for="date_start">Fecha :</label>'+
                        '<input id="date_start" class="form-control" type="date" name="date_start" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<label for="course">Curso :</label>'+
                        '<input id="course" class="form-control" type="text" name="course" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label for="hour_start">Inicio :</label>'+
                        '<input id="hour_start" class="form-control" type="time" name="hour_start" required>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<label for="hour_end">Final :</label>'+
                        '<input id="hour_end" class="form-control" type="time" name="hour_end" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '';
        $('[data-form="form"] .modal-body').html(html);
        getAsignature();
        getBusiness();
    });


    $(document).on('click','[data-edit="modal"]',function () {
        $('#edit-modal').modal('show');
        var id = $(this).attr('data-id'),
            route = '{{ route('cursos.edit', ['curso' => '+id+'] ) }}';
            route = route.replace('id', id),
            html  =  '';
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},

        }).done(function (response) {
            if (response.status == 200) {
                html =''+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<label for="bussiness_id">Empresas :</label>'+
                                '<select class="form-control" name="bussiness_id" required>'+
                                    '<option value="">Seleccione...</option>';
                                    $.each(response.business, function (index, element) {
                                        html+='<option value="'+element.business_id +'" '+(element.business_id ==response.cours.business_id ? 'selected' : '' ) +'>'+element.name+' </option>';
                                    });
                                html+='</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<input type="hidden" value="'+response.cours.cours_id+'" name="id">'+
                                '<label for="asignature">Asignatura :</label>'+
                                '<select class="form-control" name="asignature" id="asignature" required>'+
                                    '<option value="">Seleccione...</option>';
                                    $.each(response.asignature, function (index, element) {
                                        html+='<option value="'+element.asignature_id+'" '+(element.asignature_id==response.cours.asignature_id ? 'selected' : '' ) +'>'+element.name+' ('+element.abbreviation+')</option>';
                                    });
                                html+='</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-6">'+
                            '<div class="form-group">'+
                                '<label for="code">Codigo :</label>'+
                                '<input id="code" class="form-control" type="text" name="code" value="'+response.cours.code+'" required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<div class="form-group">'+
                                '<label for="date_start">Fecha :</label>'+
                                '<input id="date_start" class="form-control" type="date" name="date_start" value="'+response.cours.date_start+'" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<label for="course">Curso :</label>'+
                                '<input id="course" class="form-control" type="text" name="course" value="'+response.cours.course+'" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-6">'+
                            '<div class="form-group">'+
                                '<label for="hour_start">Inicio :</label>'+
                                '<input id="hour_start" class="form-control" type="time" name="hour_start" value="'+response.cours.hour_start+'" required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                            '<div class="form-group">'+
                                '<label for="hour_end">Final :</label>'+
                                '<input id="hour_end" class="form-control" type="time" name="hour_end" value="'+response.cours.hour_end+'" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '';
                $('[data-form="form-edit"] .modal-body').html(html);

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
        });
    });

    $(document).on('click','[data-delete="modal"]',function () {
        var id = $(this).attr('data-id'),
            route = '{{ route('cursos.destroy', ['curso' => 'id'] ) }}';
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
            });
        });
    });

</script>

@endsection
