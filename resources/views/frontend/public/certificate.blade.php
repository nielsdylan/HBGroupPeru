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
                            <form action="{{route('certificate.list')}}" method="POST" data-form="certi-send">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input class="form-control" type="text" name="dni" required>
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
                            <form action="{{route('certificate.list')}}" method="POST" data-form="certi-send">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input class="form-control" type="text" name="dni" required>
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
                    <div class="card d-none" data-card="class-none">
                        <div class="card-body" data-table="table">

                        </div>
                    </div>

                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none">
                <div class="col-md-12 mt-5 animated slideInUp">
                    <div class="card d-none" data-card="class-none">
                        <div class="card-body" data-table="table">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        var data ={};
        $(document).ready(function () {
            // getPagination();
        });

        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getPagination(page);
        });

        function getPagination(page) {
            route = '{{ route('certificate.list') }}';
            data.page = page;

            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
                beforeSend: function()
                {
                    $('[data-table="table"]').addClass('is-loading is-loading-lg');
                },
            }).done(function (response) {
                $('[data-table="table"]').removeClass('is-loading is-loading-lg');
                $('[data-card="class-none"]').removeClass('d-none');

                if (response) {
                    $('[data-table="table"]').html(response);
                }
            }).fail(function () {
                alert("Error");
            });
        }
        $(document).on('submit','[data-form="certi-send"]',function (e) {
            e.preventDefault();
            data.dni= $('[name="dni"]').val();
            getPagination();


        });
    </script>
@endsection
