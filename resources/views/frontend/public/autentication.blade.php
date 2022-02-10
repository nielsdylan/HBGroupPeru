@extends('frontend.public')
@section('title','HB Group Perú')
@section('content')

    <section id="autentication">
        <input type="hidden" name="id" value="{{$result['id']}}">
        <div class="container d-none d-sm-none d-lg-block d-md-block">
            @if ($result['confirme_email']==1 && $result['confirme_telephone']==1)
                <div class="row animated zoomIn">
                    <div class="col-md-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Verificación</h5>
                                <div class="row">
                                    <div class="table-responsive col-md-12">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Correo electronico</td>
                                                    <td>{{$result['email']}}</td>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Señor {{$result['last_name']}}, {{$result['name']}} gracias por confirmar su identidad, usted puede ingresar a la plataforma del <a href="https://hb.q10.com/aulasvirtuales  " target="_blank" class="list-inline-item icon"><i class="fas fa-user-graduate"></i> Aula virtual</a> <p>Nombre de usuario : {{$result['dni']}} </p>
                                        <p>Contraseña : {{$result['dni']}}</p>
                                        <p>Si desea cambiar su contraseña ingrese aqui <a href="https://hb.q10.com/aulasvirtuales  /RecuperarContrasena?aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" rel="noopener noreferrer">Cambiar contraseña</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row display-block-item animated zoomIn" data-steps="one">
                    <div class="col-md-6 offset-3">
                        <div class="card" data-steps="one">
                            <div class="card-body">
                                <h5 class="card-title text-center">Información del Alumno</h5>
                                <div class="row">
                                    <div class="col-md-6 text-right">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Apellidos : </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nombres : </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>N° de documento : </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['last_name']}} </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['name']}} </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['dni']}} </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <label for="my-input">¿Confirme si es su información?</label>
                                                    <button class="btn btn-primary" data-response="success" data-value="true">Si</button>
                                                    <button class="btn btn-danger" data-response="success" data-value="false">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="table-responsive col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col">CONFIMACION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Correo electronico</td>
                                                    <td>{{$result['email']}}</td>
                                                    <td class="text-center" data-html="email">
                                                        @if ($result['confirme_email']==0)
                                                        <i class="fas fa-times text-danger " data-remove="remove"></i>
                                                        <button class="btn btn-primary" data-action="question" data-remove="remove" data-value="si" data-html="email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Si</button>
                                                        <button class="btn btn-danger" data-action="question" data-remove="remove" data-value="no" data-html="email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">No</button>
                                                        @else
                                                        <i class="fas fa-check text-success "></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Número telefonico</td>
                                                    <td>{{$result['telephone']}}</td>
                                                    <td class="text-center" data-html="phone">
                                                        @if ($result['confirme_telephone']==0)
                                                        <i class="fas fa-times text-danger " data-remove="remove"></i>
                                                        @if ($result['change_phone']==0)
                                                            <button class="btn btn-primary" data-action="question" data-remove="remove" data-value="si" data-html="phone" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Si</button>
                                                            <button class="btn btn-danger" data-action="question" data-remove="remove" data-value="no" data-html="phone" data-toggle="tooltip" data-placement="top" title="Tooltip on top">No</button>
                                                        @endif

                                                        @else
                                                        <i class="fas fa-check text-success "></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
        <div class="container d-block d-sm-block d-lg-none d-md-none">
            @if ($result['confirme_email']==1 && $result['confirme_telephone']==1)
                <div class="row animated zoomIn" data-steps="two">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Verificación</h5>
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
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
                                @if ($result['confirme_email']==1 && $result['confirme_telephone']==1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Señor {{$result['last_name']}}, {{$result['name']}} gracias por confirmar su identidad, usted puede ingresar a la plataforma del <a href="https://hb.q10.com/aulasvirtuales  /aulasvirtuales  " target="_blank" class="list-inline-item icon"><i class="fas fa-user-graduate"></i> Aula virtual</a> <p>Nombre de usuario : {{$result['dni']}} </p>
                                        <p>Contraseña : {{$result['dni']}}</p
                                        <p>Si desea cambiar su contraseña ingrese a qui <a href="https://hb.q10.com/aulasvirtuales  /RecuperarContrasena?aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" rel="noopener noreferrer"></a></p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row display-block-item animated zoomIn" data-steps="one">
                    <div class="col-md-12">
                        <div class="card" data-steps="one">
                            <div class="card-body">
                                <h5 class="card-title text-center">Información del Alumno</h5>
                                <div class="row">
                                    <div class="col-md-6 col-6 text-right">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Apellidos : </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Nombres : </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>N° de documento : </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['last_name']}} </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['name']}} </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{$result['dni']}} </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col">CONFIMACION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Correo electronico</td>
                                                    <td>{{$result['email']}}</td>
                                                    <td class="text-center" data-html="email">
                                                        @if ($result['confirme_email']==0)
                                                        <i class="fas fa-times text-danger "></i>
                                                        <button class="btn btn-primary" data-action="question" data-remove="remove" data-value="si" data-html="email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Si</button>
                                                        <button class="btn btn-danger" data-action="question" data-remove="remove" data-value="no" data-html="email" data-toggle="tooltip" data-placement="top" title="Tooltip on top">No</button>
                                                        @else
                                                        <i class="fas fa-check text-success "></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Número telefonico</td>
                                                    <td>{{$result['telephone']}}</td>
                                                    <td class="text-center" data-html="phone">
                                                        @if ($result['confirme_telephone']==0)
                                                        <i class="fas fa-times text-danger "></i>

                                                        @if ($result['change_phone']==0)
                                                            <button class="btn btn-primary" data-action="question" data-remove="remove" data-value="si" data-html="phone" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Si</button>
                                                            <button class="btn btn-danger" data-action="question" data-remove="remove" data-value="no" data-html="phone" data-toggle="tooltip" data-placement="top" title="Tooltip on top">No</button>
                                                        @endif
                                                        @else
                                                        <i class="fas fa-check text-success "></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
        $(document).on('click','[data-action="question"]',function () {
            var value = $(this).attr('data-value'),
                type = $(this).attr('data-html'),
                html='';
            if (value=='no') {
                switch (type) {
                    case 'email':
                        html=''+
                            '<form method="post" data-form="sent" data-remove="remove">'+
                                '<div class="form-group">'+
                                    '<input class="form-control" type="email" name="value" required>'+
                                    '<input type="hidden" name="type" value="email" required>'+
                                '</div>'+
                                '<button class="btn btn-primary" type="submit">Enviar</button>'+
                            '</form>'+
                        '';
                    break;

                    case 'phone':
                        html=''+
                            '<form method="post" data-form="sent" data-remove="remove">'+
                                '<div class="form-group">'+
                                    '<input class="form-control" type="text" name="value" required>'+
                                    '<input type="hidden" name="type" value="phone" required>'+
                                '</div>'+
                                '<button class="btn btn-primary" type="submit">Enviar</button>'+
                            '</form>'+
                        '';
                    break;
                }
                $('[data-remove="remove"]').remove();
                $('[data-html="'+type+'"]').html(html);

            }else{
                html=''+
                    '<i class="fas fa-times text-danger "></i>'+
                '';
                $('[data-html="'+type+'"]').html(html);
                $('[data-remove="remove"]').remove();
                changeValidation(type)
            }
        });
        function changeValidation(type) {
            var route = '{{ route('change.validation.afirmation') }}';
            data={
                id:$('[name="id"]').val(),
                type:type
            }
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

                },
            }).done(function (response) {
                if (response.success == true) {
                    html=''+
                            '<i class="fas fa-times text-danger "></i>'+
                        '';
                    $('[data-html="'+response.type+'"]').html(html);
                    $('[data-remove="remove"]').remove();
                }else{

                }
            }).fail(function () {
                alert("Error");
            });
        }
        $(document).on('submit','[data-form="sent"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var route = '{{ route('change.validation') }}',
                id = $('[name="id"]').val();
            data = data+'&id='+id;
            console.log(data);


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

                },
            }).done(function (response) {
                if (response.success == true) {
                    html=''+
                            '<i class="fas fa-times text-danger "></i>'+
                        '';
                    $('[data-html="'+response.type+'"]').html(html);
                    $('[data-remove="remove"]').remove();
                }else{

                }
            }).fail(function () {
                alert("Error");
            });



        });
    </script>

@endsection

