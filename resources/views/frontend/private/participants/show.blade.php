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
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Ver a {{$participante->name}}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-space">
                {{-- <div class="card-header">
                    <h4 class="card-title"> Información</h4>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" data-toggle="pill" href="#v-pills-info-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="true">
                                    <i class="flaticon-user-4"></i>

                                </a>
                                <a class="nav-link" data-toggle="pill" href="#v-pills-user-icons" role="tab" aria-controls="v-pills-user-icons" aria-selected="false">
                                    <i class="flaticon-agenda"></i>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade active show" id="v-pills-info-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
                                    <h5 class="mt-3">INFORMACIÓN</h5>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">Email: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="{{ $participante->email }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">Documento: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="{{ $participante->document }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">DNI: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="{{ $participante->dni }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">APELLIDOS Y NOMBRES: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="{{ $participante->last_name }}, {{ $participante->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">Telefono: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="+{{ $participante->prefixe_id }} {{ $participante->telephone }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                <label for="inlineinput" class="col-md-3 col-form-label">Whatsapp: </label>
                                                <div class="col-md-9 p-0">
                                                    <input type="text" class="form-control input-full" value="{{ $participante->whatsapp }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-user-icons" role="tabpanel" aria-labelledby="v-pills-user-tab-icons">
                                    <div class="d-flex align-items-center">
                                        <h5 class="mt-3">Lista de cursos</h5>

                                        <button class="btn btn-icon btn-primary btn-round btn-sm ml-auto" data-refresh="refresh">
                                            <i class="fa fas fa-sync-alt"></i>
                                        </button>
                                    </div>

                                    <hr />
                                    <input type="hidden" name="id" value="{{$participante->id}}">
                                    <div class="row" data-table="table">
                                    </div>
                                </div>
                            </div>
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
        route = '{{ route('get.pagination.participant') }}';

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
    $(document).on('click','[data-delete="participant"]',function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var participant_id = $('[name="id"]').val(),
            route = '{{ route('delete.participant.cours') }}';;
        swal({
            title: "Eliminar",
            text: "¿Esta seguro de elimnar este curso?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {id:id},
                beforeSend: function()
                {
                },
            }).done(function (response) {
                if (response.status == 200) {
                    swal({
                        title: "",
                        text: "Se elimino con éxito",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: '#78cbf2',
                        confirmButtonText: 'Aceptar',
                    },
                    function(){
                        getPagination(participant_id)
                    });

                }
            }).fail(function () {
                alert("Error");
            });
        });
    });
    $(document).on('click','[data-refresh="refresh"]',function () {
        var id = $('[name="id"]').val();
        getPagination(id)
    });
</script>

@endsection
