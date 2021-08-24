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
                        <a href="{{route('cursos.create')}}" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i> Nuevo curso</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="asignature_id" required>
                                    <option value="">Asignaturas...</option>
                                    @foreach ($asignatures as $key=>$type )
                                        <option value="{{$type->asignature_id  }}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control date datepicker movil" name="date" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar-check"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="CODIGO/CURSO..." >
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <button type="button" class="btn btn-primary btn-round" data-action="search"><i class="fas fa-search"></i>  Buscar</button>
                        </div>
                    </div>

                    <div class="row table-responsive" data-table="table"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var data ={};
    $(document).ready(function () {
        getPagination();
    });
    $(document).on('click','.refresh',function () {
        getPagination();
    });
    $(document).on('click','.pagination a',function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPagination(page);
    });
    $(document).on('change','[name="asignature_id"]',function () {
        var asignature_id = $(this).val();
        data.asignature_id  =   asignature_id;
    });
    $(document).on('change','[name="name"]',function () {
        var name = $(this).val();
        data.name           =   name;

    });
    $(document).on('click','[data-action="search"]',function () {
        var asignature_id = $('[name="asignature_id"]').val(),
        date = $('.movil[name="date"]').val();
        data.date           =   date;
        console.log(date);
        getPagination();
    });
    function getPagination(page) {
        route = '{{ route('list.cursos.pagination') }}';
        console.log(route);
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
    $(document).on('click','[data-location="href"]',function () {
        location.href = $(this).attr('data-href');
    });
    $(document).on('click','[data-action="organizer"]',function () {
        var cours_id = $(this).attr('data-cours');
    });
    $(document).on('submit','[data-action="submit"]',function (e) {
        e.preventDefault();
        var data_form = $(this).attr('data-form');
        var data = $(this).serialize();
        var route = '{{ route('create.meeting') }}';
        swal({
                title: "¿Guardar?",
                text: "¿Está seguro de guardar?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: true
            },
            function(){
                $.ajax({
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                    url: route,
                    dataType: 'json',
                    data: data,
                    beforeSend: function()
                    {
                        $('.submit').addClass('is-loading is-loading-lg');
                        $('.submit').attr('disabled','');
                    },
                }).done(function (response) {
                    $('.submit').removeClass('is-loading is-loading-lg');
                    $('.submit').removeAttr('disabled');
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
                        getPagination();
                    }else{
                        swal(response.title,response.message,response.type);
                    }
                }).fail(function () {
                    $('.submit').removeClass('is-loading is-loading-lg');
                    $('.submit').removeAttr('disabled');
                });
            }
        );


    });

    $(document).on('click','[data-action="copy"]',function () {
        var $temp = $("<input>")
        $("body").append($temp);
        $temp.val($('[name="link"]').val()).select();
        document.execCommand("copy");
        $temp.remove();

    });
</script>

@endsection
