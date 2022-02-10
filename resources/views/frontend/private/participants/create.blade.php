@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Academico</h4>
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
                    <a href="#">Participantes</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Nuevo participante</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Nuevo participante</h4>
                            </div>
                            <div class="col-md-6 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('participantes.add')}}" method="post" enctype="multipart/form-data" data-form="save-add">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type_id">Tipo de documento :</label>
                                        <select class="form-control" data-document="select-type" name="document_type_id" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($document_types as $key=>$type )
                                                <option value="{{$type->document_type_id }}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni">Número de documento :</label>
                                        <input  class="form-control" type="number" name="dni" data-search="hbgroup" data-codument="codument" data-disabled="disabled" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Apellidos :</label>
                                        <input  class="form-control" data-disabled="disabled" type="text" name="last_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombres :</label>
                                        <input  class="form-control" data-disabled="disabled" type="text" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business">Empresa :</label>
                                        <input  class="form-control" type="text" name="business" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stall">Puesto :</label>
                                        <input  class="form-control" type="text" name="stall" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni">Email :</label>
                                        <input  class="form-control" type="email" name="email" data-search="search" data-type="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cell">Celular :</label>
                                        <input  class="form-control" type="number" name="cell" data-search="search" data-type="phone" required>
                                        {{-- <div class="row">
                                            <div class="col-md-4">
                                                <select id="document_type_id" class="form-control select2 my-select"  name="prefixe_id" required>
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($prefixes as $key=>$type )
                                                        <option value="{{$type->prefixe_id }}"
                                                            style='background:url("{{asset('assets/img/flags/pe.png')}}") ' data-img-src="{{asset('assets/img/flags/'.$type->iso3.'.png')}}">
                                                            <span>
                                                                {{$type->phone_code}} ({{$type->code}})
                                                                <img src="{{asset('assets/img/flags/'.$type->iso3.'.png')}}" height="50">
                                                            </span>

                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-8">
                                                <input  class="form-control" type="number" name="cell" data-search="search" data-type="email" required>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="separator-solid"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Cursos</h2>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                @foreach ($asignatures as $key=>$item )
                                    <div class="col-md-4">
                                        <div class="tasks-content">
                                        <span class="category-title mt-0">{{$item->name}}</span>
                                        <ul class="tasks-list">
                                            @foreach ($cours as $key_cour=>$cour )
                                                @if ($cour->asignature_id == $item->asignature_id)
                                                    <li>
                                                        <label class="custom-checkbox custom-control checkbox-secondary">
                                                            <input type="checkbox" class="custom-control-input" name="cours[]" value="{{$cour->cours_id}}" ><span class="custom-control-label">{{$cour->course}} ({{$cour->code}})</span>

                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Más opciones.
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="send_email">Enviar correo electronico : </label>
                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_email" value="1" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="send_telephone">Enviar mensaje de texto : </label>
                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_telephone" value="1" checked>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <h5 class="card-title"></h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="send_email">Enviar correo electronico : </label>
                                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_email" value="1" checked>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="send_telephone">Enviar mensaje de texto : </label>
                                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_telephone" value="1" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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

<script>
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
    $(document).on('change','[data-document="select-type"]',function () {
        var value = $(this).val();
        $('[data-disabled="disabled"]').removeAttr('disabled');
        switch (value) {
            case '2' :
                $('[data-codument="codument"]').attr('data-search','dni');
            break;
            case '4' :
                $('[data-codument="codument"]').attr('data-search','ruc');
            break;

            default:
                $('[data-codument="codument"]').attr('data-search','hbgroup');
            break;
        }

    });
    $(document).on('change','[data-codument="codument"]',function () {
        var slug = $(this).val(),
            search = $(this).attr('data-search'),
            route = '',
            input_this = $(this),
            question, type='dni';

        var route_validate = '{{ route('search.participant') }}';
        data = {
            slug:slug,
            type:"dni",
        }
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route_validate,
            dataType: 'json',
            // processData: false,
            // contentType: false,
            data: data,
            beforeSend: function()
            {

            },
        }).done(function (response) {
            if (response.success == false) {
                slug = slug+'-'+search;
                route = '{{ route('get.user', ['slug' => 'slug'] ) }}';
                route = route.replace('slug', slug);

                if (slug) {
                    switch (search) {
                        case 'dni':
                            APIReniec(route);
                        break;
                        case 'ruc':
                            APIReniec(route);
                        break;
                        case 'hbgroup':
                            APIReniec(route);
                        break;
                    }
                }
            }else{
                input_this.val('');
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = response.message;
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
                        from: 'top',
                        align: 'center'
                    },
                    time: 1000,
                    delay: 2,
                });
            }
        }).fail(function () {
            alert("Error");
        });


    });
    function APIReniec(route) {
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            // processData: false,
            // contentType: false,
            data: {},
            beforeSend: function()
            {
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="save-add"] [name="document_type_id"] option').removeAttr("selected");

                $('[data-form="save-add"] [name="document_type_id"] option[value="'+response.results.document_type_id+'"]').attr("selected","");

                $('[data-form="save-add"] [name="dni"]').val(response.results.dni);
                $('[data-form="save-add"] [name="email"]').val(response.results.email);
                $('[data-form="save-add"] [name="last_name"]').val(response.results.last_name);
                $('[data-form="save-add"] [name="cell"]').val(response.results.telephone);
                $('[data-form="save-add"] [name="name"]').val(response.results.name);

                // $('[data-disabled="disabled"]').attr('disabled','');

            }else{
                $('[data-form="save-add"] [name="document_type_id"] option').removeAttr("selected");
                $('[data-form="save-add"] [name="document_type_id"] option[value=""]').attr("selected",'');

                $('[data-form="save-add"] [name="email"]').val('');
                $('[data-form="save-add"] [name="last_name"]').val('');
                $('[data-form="save-add"] [name="cell"]').val('');
                $('[data-form="save-add"] [name="name"]').val('');

                // $('[data-disabled="disabled"]').removeAttr('disabled');
            }
        }).fail(function () {
        // alert("Error");
        });
    }
    $(document).on('submit','[data-form="save-add"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            route = $(this).attr('action'),
            index_off='';

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
                $('[data-form="save-add"] button[type="submit"]').addClass('is-loading');
                $('[data-form="save-add"] button[type="submit"]').attr('disabled','');
            },
        }).done(function (response) {
            $('[data-form="save-add"] button[type="submit"]').removeClass('is-loading');
            if (response.status == 200) {
                $('[data-form="save-add"] button[type="submit"]').removeAttr('disabled');
                $('#add-modal').modal('hide');
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
                    location.href=' {{ route('participantes.index') }}'
                }, 3000);
                console.log(response);
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
        });
    });
    $(document).on('change','[data-search="search"]',function () {
        var slug = $(this).val(),
            type = $(this).attr('data-type'),
            route_validate = '{{ route('search.participant') }}';

        data = {
            slug:slug,
            type:type,
        }
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route_validate,
            dataType: 'json',
            // processData: false,
            // contentType: false,
            data: data,
            beforeSend: function()
            {

            },
        }).done(function (response) {
            if (response.success == false) {

            }else{
                $('[data-type="'+type+'"]').val('');
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = response.message;
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
                        from: 'top',
                        align: 'center'
                    },
                    time: 1000,
                    delay: 2,
                });
            }
        }).fail(function () {
            alert("Error");
        });
    });

</script>
@endsection
