@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Académico</h4>
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
                <a href="#">Mis cursos</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Mis cursos programados</h4>
                        <button class="btn btn-icon btn-primary btn-round btn-sm ml-auto" data-refresh="refresh">
                            <i class="fa fas fa-sync-alt"></i>
                        </button>

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
                    <input type="hidden" name="id" value="{{session('hbgroup')['user_id']}}">
                    <div class="row">
                        <div class="col-md-12 table-responsive" data-table="table">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var data ={};
    $(document).ready(function () {
        var id = $('[name="id"]').val();
        getPagination(id)
    });
    $(document).on('click','.pagination a',function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var id = $('[name="id"]').val();
        getPagination(id,page);
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
        var date = $('.movil[name="date"]').val();
        var id = $('[name="id"]').val();
        data.date           =   date;
        getPagination(id);
    });
    function getPagination(id,page) {
        route = '{{ route('get.mis.cursos.pagination') }}';
        data.id=id;
        data.page=page;
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
    $(document).on('click','[data-refresh="refresh"]',function () {
        var id = $('[name="id"]').val();
        getPagination(id)
    });
</script>

@endsection
