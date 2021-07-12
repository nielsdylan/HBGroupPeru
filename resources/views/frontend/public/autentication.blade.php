@extends('frontend.public')
@section('title','HB Group Perú')
@section('content')

    <section id="autentication">
        <div class="container d-none d-sm-none d-lg-block d-md-block">
            <div class="row display-block-item animated zoomIn" data-steps="one">
                <div class="col-md-6 offset-3">
                    <div class="card" data-steps="one">
                        <div class="card-body">
                            <h5 class="card-title text-center">Información del Alumno</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Apellidos : </label>
                                            <label>{{$result['last_name']}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Nombres : </label>
                                            <label>{{$result['name']}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>N° de documento : </label>
                                            <label>{{$result['dni']}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <label for="my-input">¿Confirme si es su información?</label>
                                                <button class="btn btn-primary" data-response="success" data-value="true">Si</button>
                                                <button class="btn btn-danger" data-response="success" data-value="false">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-none-item" data-steps="two">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Verificación</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Correo electronico</td>
                                                <td>{{$result['email'].$result['confirme_email']}}</td>
                                                <td>
                                                    <i class="fas {{ $result['confirme_email']==0 ? 'fa-times text-danger' : 'fa-check text-success' }} "></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Número telefonico</td>
                                                <td>{{$result['telephone']}}</td>
                                                <td><i class="fas {{ $result['confirme_telephone']==0? 'fa-times text-danger' : 'fa-check text-success' }} "></i></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-none-item" data-steps="tre">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Contactar </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Comuniquese con el área de soporte academico por el inconveniente.</p>
                                    <p>Correo electronico: {{$configurations->email}}</p>
                                    <p>Número telefonico: {{$configurations->mobile}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-block d-sm-block d-lg-none d-md-none">
            <div class="row display-block-item animated zoomIn" data-steps="one">
                <div class="col-md-12">
                    <div class="card" data-steps="one">
                        <div class="card-body">
                            <h5 class="card-title text-center">Información del Alumno</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Apellidos : </label>
                                            <label>{{$result['last_name']}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Nombres : </label>
                                            <label>{{$result['name']}} </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>N° de documento : </label>
                                            <label>{{$result['dni']}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <label for="my-input">¿Confirme si es su información?</label>
                                                <button class="btn btn-primary" data-response="success" data-value="true">Si</button>
                                                <button class="btn btn-danger" data-response="success" data-value="false">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-none-item" data-steps="two">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Verificación</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Correo electronico</td>
                                                <td>{{$result['email'].$result['confirme_email']}}</td>
                                                <td>
                                                    <i class="fas {{ $result['confirme_email']==0 ? 'fa-times text-danger' : 'fa-check text-success' }} "></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Número telefonico</td>
                                                <td>{{$result['telephone']}}</td>
                                                <td><i class="fas {{ $result['confirme_telephone']==0? 'fa-times text-danger' : 'fa-check text-success' }} "></i></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-none-item" data-steps="tre">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Contactar </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Comuniquese con el área de soporte academico por el inconveniente.</p>
                                    <p>Correo electronico: {{$configurations->email}}</p>
                                    <p>Número telefonico: {{$configurations->mobile}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        $(document).on('click','[data-response="success"]',function (e) {
            e.preventDefault();
            var success = $(this).attr('data-value');
            switch (success) {
                case 'true':
                    $('[data-steps="one"]').removeClass('animated zoomIn');
                    $('[data-steps="one"]').removeClass('display-block-item');
                    $('[data-steps="one"]').addClass('animated zoomOut');
                    $('[data-steps="one"]').addClass('display-none-item');

                    $('[data-steps="two"]').removeClass('display-none-item');
                    $('[data-steps="two"]').addClass('display-block-item');
                    $('[data-steps="two"]').addClass('animated zoomIn');
                break;

                case 'false':
                    $('[data-steps="one"]').removeClass('animated zoomIn');
                    $('[data-steps="one"]').removeClass('display-block-item');
                    $('[data-steps="one"]').addClass('animated zoomOut');
                    $('[data-steps="one"]').addClass('display-none-item');

                    $('[data-steps="tre"]').removeClass('display-none-item');
                    $('[data-steps="tre"]').addClass('display-block-item');
                    $('[data-steps="tre"]').addClass('animated zoomIn');
                break;
            }

        });
    </script>

@endsection

