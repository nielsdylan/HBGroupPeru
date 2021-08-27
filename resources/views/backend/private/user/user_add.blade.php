@extends('backend.private')
@section('title','Usuario')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header animated fadeInUp">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{route('dashboard')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_user')}}">Administrador</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_user')}}">Lista de usuarios</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('user_add')}}">Nuevo usuario</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Nuevo usuario</h4>
                            </div>
                            <div class="col-md-6 text-right">

                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <form action="{{route('user.add')}}" method="post" id="form-user" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group">Grupos</label>
                                        <select id="group" class="form-control" name="group_id" data-action="search-dni-group" required>
                                            <option value="">Seleccione...</option>
                                            @if ($groups)
                                              @foreach ($groups as $key=>$item )
                                                    <option value="{{$item->group_id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="email" name="email"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type">Tipos de documentos</label>
                                        <select id="document_type" class="form-control" name="document_type_id" required>
                                            <option value="">Seleccione...</option>
                                            @if ($document_types)
                                                @foreach ($document_types as $key=>$item )
                                                    <option value="{{$item->document_type_id}}" >{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">DNI</label>
                                        <input id="dni" class="form-control" type="number" name="dni" data-action="search-dni-group" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Apellidos</label>
                                        <input id="last_name" class="form-control" type="text" name="last_name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input id="name" class="form-control" type="text" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" class="form-control password" type="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_double">Repita su contraseña</label>
                                        <input id="password_double" class="form-control" type="password" name="password_double" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-save"></i> Guardar</button>
                                    <a href="{{route('list_user')}}" class="btn btn-danger btn-round"><i class="fas fa-arrow-circle-left"></i> Volver</a>
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
    $(document).on('change keyup','.password',function () {
        var password = $(this).val();
        var password_double = $('[name="password_double"]').val();
        if (password) {
            $('[name="password_double"]').removeAttr('disabled');
        }else{
            $('[name="password_double"]').attr('disabled', '');
        }
    });
    $(document).on('change','[name="password_double"]',function () {
        var password_double = $(this).val();
        var password = $('[name="password"]').val();
        if (password == password_double) {
            $('[name="password"]').removeAttr('disabled');
        }else{
            swal("Password", "Las contraseñas no son iguales", "error")
            $(this).val('');
        }
    });
    $(document).on('change','.email',function () {
        var email = $(this).val(),
            input_this = $(this);
        data={
            email:email
        };
        if (email) {
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: url+'user/buscar',
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.status==200) {
                    swal("Informativo", "El correo que ingreso ya esxiste", "warning");
                    input_this.val('');
                }

            }).fail(function () {
                console.log('error');
            });
        }


    });
    $(document).on('change','[data-action="search-dni-group"]',function () {
        var group_id = $('[name="group_id"]').val(),
            dni = $('[name="dni"]').val(),
            route = '{{ route('user.dni.group') }}';
        if (group_id && dni) {
            data = {
                group_id:group_id,
                dni:dni
            }
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.status==200) {
                    swal(response.title, response.message, response.type);
                    $('[name="group_id"] option').removeAttr("selected");
                    $('[name="group_id"] option[value=""]').attr("selected",true);
                }

            }).fail(function () {
                console.log('error');
            });
        }
    });

</script>
@endsection
