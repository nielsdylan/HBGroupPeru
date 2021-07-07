@extends('frontend.public')
@section('title','HB Group Perú')
@section('content')

    <section id="autentication">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Verificación</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Correo electronico : </label>
                                        <div class="input-group has-validation">
                                            <input type="email" class="form-control" name="email" id="email">
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-check text-success"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="telephone">Telefono : </label>
                                        <div class="input-group has-validation">
                                            <input type="number" class="form-control" name="telephone" id="telephone">
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-check text-success"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

