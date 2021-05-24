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
                <a href="{{route('sede.index')}}">Sedes y turnos</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('sede.index')}}">Lista de sedes y turnos</a>
            </li>
        </ul>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de sedes y turnos</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>
                            Nueva sede y y turno
                        </button>
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover text-center" >
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Sede</th>
                                    <th>Turno</th>
                                    <th>Fecha</th>
                                    <th>Activo</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $key=>$item )
                                    <tr>
                                        <td>{{$item->sede_turn_id}}</td>
                                        <td>{{$item->sede}}</td>
                                        <td>{{$item->turn}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <input type="checkbox" {{ $item->enable ==1 ? 'checked' : '' }}  data-toggle="toggle" data-onstyle="success" data-style="btn-round" data-onstyle="success" data-offstyle="danger" data-id="{{$item->sede_turn_id}}" data-action="on-off" >
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar" data-id="{{$item->sede_turn_id}}" data-edit="modal">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar" data-id="{{$item->sede_turn_id}}" data-destroy="destroy-sede" >
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
            route = '{{ route('sede-turno.edit', ['sede_turno' => 'data'] ) }}';
            route = route.replace('data', data);
        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function()
            {
                $('[data-form="sede-edit"]').addClass('is-loading is-loading-lg');
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="sede-edit"]').removeClass('is-loading is-loading-lg');
                $('[data-form="sede-turn-edit"] [name="sede"] option[value="'+response.sede_turn.sede_id+'"]').attr("selected",'');
                $('[data-form="sede-turn-edit"] [name="turn"] option[value="'+response.sede_turn.turn_id+'"]').attr("selected",true);
                // $("#provincia option[value="+ valor +"]").attr("selected",true);

                $('[name="sede_turn_id"]').val(response.sede_turn.sede_turn_id);
            }else{
            }
        }).fail(function () {
            // alert("Error");
        });

    });


    $(document).on('click','[data-destroy="destroy-sede"]',function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'),
            route = '{{ route('sede-turno.destroy', ['sede_turno' => 'id'] ) }}';
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
    $( '[data-action="on-off"]' ).on( 'change', function() {
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            invoice = 1;
            console.log("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            invoice=0;
            console.log("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
        }
    });
</script>
<!-- Modal -->
@include('frontend.private.sede_turn.create')
@include('frontend.private.sede_turn.edit')
@endsection
