@extends('frontend.public')
@section('title','HB Group Perú')
@section('content')
    <section id="certificate-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Certificados</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3  text-justify">
                    <p>La empresa HB GROUP PERÚ S.R.L. brindar servicios de calidad, pone a disposición, el siguiente formulario en el cual pueden descargar los certificados correspondientes.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" data-form="certificado">
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
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{route('certificado.pdf')}}">pdf</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).on('submit','[data-form="certificado"]',function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);

        });
    </script>
@endsection
