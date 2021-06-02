@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Asiganturas</h4>
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
                <a href="#">Académico</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('programa.index')}}">Programas</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de programas</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Nuevo programa
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <td>CÓDIGO</td>
                                    <td>NOMBRE</td>
                                    <td>ESTADO</td>
                                    <td>FECHA</td>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($results)
                                    @foreach ($results as $key=>$item)
                                        <tr>
                                            <td data-href="click" data-link="{{route('programa.show',$item->program_id )}}">{{$item->code}}</td>
                                            <td data-href="click" data-link="{{route('programa.show',$item->program_id )}}" >{{$item->name}}</td>
                                            <td >{{$item->status}}</td>
                                            <td data-href="click" data-link="{{route('programa.show',$item->program_id )}}">{{$item->created_at}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->name}}" data-edit="modal" data-id="{{$item->program_id  }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->name}}" data-delete="modal" data-id="{{$item->program_id  }}">
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
    $(document).on('click','[data-edit="modal"]',function () {
        $('#edit-modal').modal('show');
        var id = $(this).attr('data-id'),
            route = '{{ route('programa.edit', ['programa' => '+id+'] ) }}';
            route = route.replace('id', id);
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},

        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="edit"] [name="id"]').val(response.result.program_id);
                $('[data-form="edit"] [name="code"]').val(response.result.code);
                $('[data-form="edit"] [name="name"]').val(response.result.name);
                $('[data-form="edit"] [name="abbreviation"]').val(response.result.abbreviation);
            }else{
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = 'Intentelo mas tarde o contacte con el area de informatica';
                content.title = 'Error';
                // if (style == "withicon") {
                //     content.icon = 'fas fa-times';
                // } else {
                //     content.icon = 'none';
                // }
                content.icon = 'fas fa-times';
                content.url = url+'hbgroupp_web';
                content.target = '_blank';

                $.notify(content,{
                    type: state,
                    placement: {
                        from: placementFrom,
                        align: placementAlign
                    },
                    time: 1000,
                    delay: 0,
                });

                setTimeout(function(){
                    $('[data-notify="dismiss"]').click();
                }, 3000);
            }
        }).fail(function () {
            // alert("Error");
        });
    });
    $(document).on('click','[data-delete="modal"]',function () {
        var id = $(this).attr('data-id'),
            route = '{{ route('programa.destroy', ['programa' => 'id'] ) }}';
            route = route.replace('id', id);
        swal({
            title: "¿Está seguro de eliminar??",
            text: "Se eliminara su registro.",
            type: "info",
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
                beforeSend: function()
                {
                },
            }).done(function (response) {
                if (response.status == 200) {

                    swal({
                        title: " ",
                        text: "Se elimino con éxito",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: '#78cbf2',
                        confirmButtonText: 'Aceptar',
                        },
                        function(){
                            location.reload();
                    });
                }else{
                    swal("Informativo", "Ocurrio un error", "warning")
                }
            }).fail(function () {
                // alert("Error");
            });
        });
    });
    $(document).on('click','[data-href="click"]',function () {
        location.href = $(this).attr('data-link');
    });
</script>
@include('frontend.private.programs.create')
@include('frontend.private.programs.edit')
@endsection
