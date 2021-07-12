@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Mi perfil</h4>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('perfil.update', $user)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row" id="galeria_imagenes">
                            <div class="col-md-6 text-center d-flex justify-content-center">
                                <div class="galeria_thumb col-md-6">
                                    <div class="form-group text-center">
                                        <label for="image">Imagen</label>
                                        <input id="image" type="file" onchange="changeLogoStore(event);" name="image" class="d-none" accept="image/*"/>
                                        <a href="#" onclick="updateLogoStore(event);"  id="cargarImagen" align="center" >
                                            @if ($user->image)
                                                <div id="previewImage" class="img-default rounded-circle" style="background-image: url('{{asset('assets/img/user/'.$user->image)}}');background-position: center;background-repeat: no-repeat; background-size: cover;"></div>
                                            @else
                                                <div id="previewImage" class="img-default rounded-circle" style="background-image: url('{{asset('assets/img/gallery.png')}}');background-position: center;background-repeat: no-repeat;"></div>
                                            @endif


                                        </a>
                                        <span data-action="delete-slider" class="circle-delete" style="display: none;cursor:pointer;"><i class="fa fa-trash-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Disponibilidad de créditos para el envio de mensajes de texto :</label>
                                            <input id="" class="form-control" type="text" name="" value="{{$credits}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-input">Cargo:</label>
                                            <input id="" class="form-control" type="text" name="" value="{{$user->group}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-input">Email:</label>
                                            <input id="" class="form-control" type="text" name="" value="{{$user->email}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document_type_id">Tipo de documento:</label>
                                    <select id="document_type_id" class="form-control" name="document_type_id" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($document_types as $key=>$type )
                                            <option value="{{$type->document_type_id }}" {{ $type->document_type_id == $user->document_type_id ? 'selected' : '' }}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input id="dni" class="form-control" type="number" name="dni" value="{{$user->dni}}" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos:</label>
                                    <input id="last_name" class="form-control" type="text" name="last_name" value="{{$user->last_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombres:</label>
                                    <input id="name" class="form-control" type="text" name="name" value="{{$user->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone">Telefono:</label>
                                    <input id="telephone" class="form-control" type="number" name="telephone" value="{{$user->telephone}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp:</label>
                                    <input id="whatsapp" class="form-control" type="number" name="whatsapp" value="{{$user->whatsapp}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth">Fecha de nacimiento:</label>
                                    <input id="birth" class="form-control" type="date" name="birth" value="{{$user->date_birth}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sexo">Sexo:</label>
                                    <select id="sexo" class="form-control" name="sexo" required>
                                        <option value="">Seleccione su sexo</option>
                                        <option value="M" {{ $user->sexo =='M' ? 'selected' : '' }} >Masculino</option>
                                        <option value="F" {{ $user->sexo =='F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateLogoStore(event) {
            event.preventDefault();
            document.getElementById('image').click();
        }
        function changeLogoStore(file) {

        var input = file.target;
        var reader = new FileReader();

        reader.onload = function() {
            var dataURL = reader.result;
            $("#previewImage").attr('style', 'background-image: url("'+dataURL+'");background-position: center;background-repeat: no-repeat;background-size: cover;');
        };

        reader.readAsDataURL(input.files[0]);

        };
        function Send() {
            var logo = $('#image').val();
            if(logo)
            {
                $('#loader').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Cargando</span>');
                $('#loader').attr('disabled','');
                $('#send').click();
            }else{
                swal('Error','Carga una imagen!','error')
            }
        }
    </script>
@endsection
