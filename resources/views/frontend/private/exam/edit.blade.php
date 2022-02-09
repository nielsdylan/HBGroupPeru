@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Examenes</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Examenes</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Nuevo examen</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Nuevo examen</h4>


                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('examen.update',$examan)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Nombre del examen <span class="required-label">*</span></label>
                                    <input id="name" class="form-control" type="text" name="name" value="{{$examan->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="evaluation">Sobre: <span class="required-label">*</span></label>
                                    <input id="evaluation" class="form-control" type="number" name="evaluation" value="{{$examan->evaluation}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my-input">Descripción <span class="required-label">*</span></label>
                                    <textarea id="3" class="form-control" name="description" rows="3" required>{{$examan->description}}"</textarea>
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

<script>
</script>

@endsection
