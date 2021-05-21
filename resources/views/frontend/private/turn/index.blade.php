@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Sedes</h4>
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
                <a href="{{route('turno.index')}}">Sedes y turnos</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('turno.index')}}">Lista de turnos</a>
            </li>
        </ul>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de turnos</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Nuevo turno
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Turno</th>
                                    <th>Fecha</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($turns as $key=>$item )
                                    <tr>
                                        <td>{{$item->turn_id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar turno ({{$item->name}})" data-edit="modal" data-id="{{$item->turn_id}}" data-href="{{route('turno.edit',$item->turn_id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-id="{{$item->turn_id}}" data-destroy="destroy-turn" data-original-title="Eliminar el turno ({{$item->name}})">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','[data-edit="modal"]',function (e) {
        e.preventDefault();
        $('#edit-modal').modal('show');
        var data = $(this).attr('data-id'),
            route = '{{ route('turno.edit', ['turno' => '+data+'] ) }}';
            route = route.replace('data', data);
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function()
            {
                $('[data-form="turno-edit"]').addClass('is-loading is-loading-lg');
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="turno-edit"]').removeClass('is-loading is-loading-lg');
                $('#name_edit').val(response.turn.name);
                $('[name="turn_id"]').val(response.turn.turn_id)
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
                content.url = url+'login';
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
    $(document).on('click','[data-destroy="destroy-turn"]',function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'),
            route = '{{ route('turno.destroy', ['turno' => '+id+'] ) }}';
            route = route.replace('id', id);
        swal({
            title: "¿Está seguro de eliminar??",
            text: "Se guardara su registro.",
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
                    content.url = url+'login';
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


    });
</script>
<!-- Modal -->
@include('frontend.private.turn.create')
@include('frontend.private.turn.edit')
@endsection
