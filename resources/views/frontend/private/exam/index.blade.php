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
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de examenes</h4>
                        <a href="{{route('examen.create')}}" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i> Nuevo examen</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>NOMBRE</td>
                                    <td>SOBRE</td>
                                    <td>FECHA</td>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($results)
                                    @foreach ($results as $key=>$item)
                                        <tr>
                                            <td>00{{$item->exam_id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->evaluation}}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at))}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('question.exam',$item->exam_id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-secondary btn-lg" data-original-title="Agregar preguntas a {{$item->name}}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{route('examen.edit',$item->exam_id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->name}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->name}}" delete-id="{{$item->exam_id}}" data-delete="delete">
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

<script>
    $(document).on('click','[data-delete="delete"]',function (e) {
        e.preventDefault();
        var id = $(this).attr('delete-id'),
            route = '{{ route('examen.destroy', ['examan' => 'id'] ) }}';
        route = route.replace('id', id);

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
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: {},
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
