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
                    <a href="{{route('user.edit', $user)}}">Editar {{$user->name}}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Editar {{$user->name}}</h4>
                            </div>

                        </div>


                    </div>
                    <div class="card-body">
                        <form action="{{route('user.upload', $user)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group">Grupos</label>
                                        <select id="group" class="form-control" name="group_id" required>
                                            <option value="">Seleccione...</option>
                                            @if ($groups)
                                              @foreach ($groups as $key=>$item )
                                                    <option value="{{$item->group_id}}" {{ $item->group_id == $user->group_id ? 'selected' : '' }} >{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{$user->email}}" required>
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
                                                    <option value="{{$item->document_type_id}}" {{ $item->document_type_id == $user->document_type_id ? 'selected' : '' }} >{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">DNI</label>
                                        <input id="dni" class="form-control" type="number" name="dni" value="{{$user->dni}}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Apellidos</label>
                                        <input id="last_name" class="form-control" type="text" name="last_name" value="{{$user->last_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input id="name" class="form-control" type="text" name="name" value="{{$user->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" class="form-control password" type="password" name="password" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_double">Repita su contraseña</label>
                                        <input id="password_double" class="form-control" type="password" name="password_double" disabled >
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
            $(this).attr('required', '');
            $('[name="password_double"]').attr('required', '');
        }else{
            $('[name="password_double"]').attr('disabled', '');
            $(this).removeAttr('required');
            $('[name="password_double"]').removeAttr('required');
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

</script>
@endsection
