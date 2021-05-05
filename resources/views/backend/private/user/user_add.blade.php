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
                        <form action="" method="post" id="form-user">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group">Grupos</label>
                                        <select id="group" class="form-control" name="group">
                                            <option>Seleccione...</option>
                                            @if ($groups)
                                              @foreach ($groups as $key=>$item )
                                                    <option>{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type">Grupos</label>
                                        <select id="document_type" class="form-control" name="document_type">
                                            <option>Seleccione...</option>
                                            @if ($document_types)
                                                @foreach ($document_types as $key=>$item )
                                                    <option>{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">DNI</label>
                                        <input id="dni" class="form-control" type="number" name="dni">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Apellidos</label>
                                        <input id="last_name" class="form-control" type="text" name="last_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input id="name" class="form-control" type="text" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" class="form-control" type="password" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_double">Repita su contraseña</label>
                                        <input id="password_double" class="form-control" type="password" name="password_double">
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
@endsection
