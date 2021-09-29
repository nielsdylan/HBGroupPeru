@extends('frontend.public')
@section('title','HB Group Perú')
@section('active_menu','active')
@section('content')
    <section id="certificate-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center animated slideInUp">
                    <h4>Certificados</h4>
                </div>
            </div>
            <div class="row d-none d-sm-none d-lg-block d-md-block animated slideInUp">
                <div class="col-md-6 offset-3  text-justify">
                    <p>La empresa HB GROUP PERÚ S.R.L. brindar servicios de calidad, pone a disposición, el siguiente formulario en el cual pueden descargar los certificados correspondientes.</p>
                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none animated slideInUp">
                <div class="col-md-12 text-justify">
                    <p>La empresa HB GROUP PERÚ S.R.L. brindar servicios de calidad, pone a disposición, el siguiente formulario en el cual pueden descargar los certificados correspondientes.</p>
                </div>
            </div>
            <div class="row d-none d-sm-none d-lg-block d-md-block ">
                <div class="col-md-6 offset-3 animated slideInUp">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('certificate.list')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input id="dni" class="form-control" type="text" name="dni">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-certificate"></i> Verificar certificado</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none">
                <div class="col-md-12 animated slideInUp">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('certificate.list')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input id="dni" class="form-control" type="text" name="dni">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-certificate"></i> Verificar certificado</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-none d-sm-none d-lg-block d-md-block">
                <div class="col-md-6 offset-3 mt-5 animated slideInUp">
                    @if ($certificado)
                    <div class="card">
                        <div class="card-body">
                            @if ($message)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        <p>
                                            Si no encuentra su certificado comuniquese con el area de soporte academico, marcando al numero telefonico
                                            <a href="tel:992 933 603" class="email-contact" >{{$configurations->telephone}}</a>
                                            o enviando un correo electronico a
                                            <a href="mailto:{{$configurations->email}}?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;{{$configurations->email}}</a>.
                                            Gracias por su comprensión.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <h5 class="card-title">Listado de certificados</h5>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($certificado as $certi)
                                                <tr>
                                                    <td>{{ $certi->last_name.' '.$certi->name }}</td>
                                                    <td>{{ $certi->description_cours }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($certi->date)) }}</td>
                                                    <td><a href="{{route('certificado.pdf',$certi->certificado_id )}}"><i class="fas fa-cloud-download-alt"></i> PDF</a></td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    {{ $certificado->links() }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        <p>
                                            Si desea tener un certificado comuniquese con el area de soporte academico, marcando al numero telefonico
                                            <a href="tel:992 933 603" class="email-contact" >{{$configurations->telephone}}</a>
                                            o enviando un correo electronico a
                                            <a href="mailto:{{$configurations->email}}?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;{{$configurations->email}}</a>. Gracias por su comprensión.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none">
                <div class="col-md-12 mt-5 animated slideInUp">
                    @if ($certificado)
                    <div class="card">
                        <div class="card-body">
                            @if ($message)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        <p>
                                            Si no encuentra su certificado comuniquese con el area de soporte academico, marcando al numero telefonico
                                            <a href="tel:992 933 603" class="email-contact" >{{$configurations->telephone}}</a>
                                            o enviando un correo electronico a
                                            <a href="mailto:{{$configurations->email}}?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;{{$configurations->email}}</a>.
                                            Gracias por su comprensión.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <h5 class="card-title">Listado de certificados</h5>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($certificado as $certi)
                                                <tr>
                                                    <td>{{ $certi->last_name.' '.$certi->name }}</td>
                                                    <td>{{ $certi->description_cours }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($certi->date)) }}</td>
                                                    <td><a href="{{route('certificado.pdf',$certi->certificado_id )}}"><i class="fas fa-cloud-download-alt"></i> PDF</a></td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    {{ $certificado->links() }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        {{$message}}
                                        <p>
                                            Si desea tener un certificado comuniquese con el area de soporte academico, marcando al numero telefonico
                                            <a href="tel:992 933 603" class="email-contact" >{{$configurations->telephone}}</a>
                                            o enviando un correo electronico a
                                            <a href="mailto:{{$configurations->email}}?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;{{$configurations->email}}</a>. Gracias por su comprensión.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
