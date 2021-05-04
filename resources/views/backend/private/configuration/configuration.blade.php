@extends('backend.private')
@section('title','HB Group Perú')
@section('content')
<div class="content">
    <div class="page-inner animated fadeInUp">
        <div class="page-header">
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
                    <a href="{{route('setting')}}">Administrador</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('setting')}}">Configuración</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-header">
                        <h4 class="card-title">Configuración</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('setting.save', $configurations)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Titulo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fa fa-heading"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="title" class="form-control" name="title" value="{{ $configurations ? $configurations->title : ''}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="far fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input id="email" class="form-control" type="email" name="email" value="{{ $configurations ?$configurations->email : ''}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-mobile-alt"></i>
                                                </span>
                                            </div>
                                            <input id="mobile" class="form-control" type="text" name="mobile" value="{{ $configurations ?$configurations->mobile :''}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone">Telfono</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                                </span>
                                            </div>
                                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ $configurations ? $configurations->telephone:'' }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sender">Remitente</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-reply"></i>
                                                </span>
                                            </div>
                                            <input id="sender" class="form-control" type="email" name="sender" value="{{ $configurations ?$configurations->sender :''}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="whatsapp">Whatsapp</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fab fa-whatsapp"></i>
                                                </span>
                                            </div>
                                            <input id="whatsapp" class="form-control" type="text" name="whatsapp" value="{{ $configurations ?$configurations->whatsapp :''}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fab fa-facebook-f"></i>
                                                </span>
                                            </div>
                                            <input id="facebook" class="form-control" type="text" name="facebook" value="{{ $configurations ?$configurations->facebook : ''}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkedin">Linkedin</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fab fa-linkedin-in"></i>
                                                </span>
                                            </div>
                                            <input id="linkedin" class="form-control" type="text" name="linkedin" value="{{ $configurations ?$configurations->linkedin :''}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="schedule">Horario</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input id="schedule" class="form-control" type="text" name="schedule" value="{{$configurations ?$configurations->schedule :''}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direction">Dirección</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-location-arrow"></i>
                                                </span>
                                            </div>
                                            <input id="direction" class="form-control" type="text" name="direction" value="{{ $configurations ?$configurations->direction :''}}" >
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-save"></i> Guardar</button>
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
