@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Validación</h4>
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
                    <a href="#">Lista de los participantes validados</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Validación</h4>
                            </div>
                            <div class="col-md-6 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="dni" placeholder="DNI..." >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Apellidos/Nombres..." >
                                </div>
                            </div>
                            <div class="col-md-2 pt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="confirme_telephone" value="1">
                                    <label class="custom-control-label" for="confirme_telephone">Telefono</label>
                                </div>
                            </div>
                            <div class="col-md-2 pt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="confirme_email" value="1">
                                    <label class="custom-control-label" for="confirme_email">Email</label>
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
    </div>

</div>
<script>
    var data ={};
    $(document).ready(function () {
        getPagination();
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
        route = '{{ route('validation.list') }}';
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

    $('#confirme_telephone').click(function (e) {

        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            data.confirme_telephone = 1;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            data.confirme_telephone = 0;
        }
    });
    $('#confirme_email').click(function (e) {

        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            data.confirme_email = 1;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            data.confirme_email = 0;
        }
    });

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
</script>
@endsection
