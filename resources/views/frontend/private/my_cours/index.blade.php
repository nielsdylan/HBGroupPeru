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
                    <input type="hidden" name="id" value="{{session('hbgroup')['user_id']}}">
                    <div class="row">
                        <div class="col-md-12" data-table="table">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    function getPagination(id,page) {
        route = '{{ route('get.mis.cursos.pagination') }}';

        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {id:id,page:page},
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
