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
                    <a href="{{route('business.index')}}">Landing</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('business.index')}}">Lista de slider</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Sliders</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('business.new')}}" class="btn btn-primary btn-round"><i class="fas fa-plus"></i> Nueva empresa</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover text-center" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE</th>
                                        <th>IMAGEN</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($response)
                                        @foreach ($response as $key => $item)
                                        <tr>
                                            <td>{{ ($key+1) }}</td>
                                            <td>{{$item->name}}</td>

                                            <td>
                                                @if ($item->image)
                                                <a href="{{asset('uploads/business/'.$item->image)}}" class="fancybox btn btn-primary"><i class="fas fa-camera"></i></a>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('business.edit', $item->business_id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->name}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete" data-delete="{{$item->business_id}}"data-original-title="Eliminar {{$item->name}}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).on('click','.delete',function (e) {
        e.preventDefault();
        var id = $(this).attr('data-delete');
        data={
            active:1,
            id:id
        };
        swal({
            title: "Eliminar",
            text: "¿Esta seguro de eliminar este registro?",
            type: "info",
            cancelButtonClass: "btn-light",
            confirmButtonText: "Si",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: url+'empresas/eliminar',
                dataType: 'json',
                data: data,
            }).done(function (response) {
                if (response.success) {
                    swal({
                        title: "Éxito",
                        text: "Se elimino con éxito",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: '#78cbf2',
                        confirmButtonText: 'Aceptar',
                    },
                    function(){
                        location.reload();
                    });
                }

            }).fail(function () {
                // alert("Error");
            });
        });
    });
</script>
@endsection
