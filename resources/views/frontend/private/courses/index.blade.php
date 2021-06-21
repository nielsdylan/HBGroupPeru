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
        getListCourses();
    });
    function getListCourses() {
        var route   = '{{ route('get.courses') }}',
            html    ='';
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
                console.log(response);
                html = '<tr>';
                    $.each(response.results, function (index, element) {

                        html+='<td>'+element.cours_id+'</td>'+
                        '<td>'+element.code+'</td>'+
                        '<td>'+element.+'</td>'+
                        '<td>'+element.asignature_id+'</td>'+
                        '<td>'+
                            '<div class="form-button-action">'+
                                '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar el curso '+element.course+'" data-id="'+element.cours_id+'">'+
                                    '<i class="fa fa-edit"></i>'+
                                '</button>'+
                                '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar '+element.name+'" data-id="'+element.cours_id+'">'+
                                    '<i class="fa fa-times"></i>'+
                                '</button>'+
                            '</div>'+
                        '</td>';
                    });

                html+='</tr>';
                $('[data-tb="list"]').html(html);
            }
        }).fail(function () {
            // alert("Error");
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
    });

</script>

@endsection
