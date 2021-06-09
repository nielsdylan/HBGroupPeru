@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Clientes</h4>
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
                <a href="{{route('cliente.index')}}">Clientes</a>
            </li>

        </ul>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de clientess</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Nuevo cliente
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>EMPRESA</td>
                                    <td>EMAIL</td>
                                    <td>FECHA</td>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($results)
                                    @foreach ($results as $key=>$item)
                                        <tr>
                                            <td>{{$item->client_id}}</td>
                                            <td>{{$item->business}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->nabusinessme}}" data-edit="modal" data-id="{{$item->client_id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->business}}" data-delete="modal" data-id="{{$item->client_id }}">
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
        $('[data-form="update"] input[name="id"]').val($(this).attr('data-id'));

        var data = $(this).attr('data-id'),
            route = '{{ route('cliente.edit', ['cliente' => '+data+'] ) }}';
            route = route.replace('data', data);

        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function()
            {
                $('[data-form="update"]').addClass('is-loading is-loading-lg');
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="update"]').removeClass('is-loading is-loading-lg');
                $('[data-form="update"] input[name="business"]').val(response.result.business);
                $('[data-form="update"] input[name="address"]').val(response.result.address);
                $('[data-form="update"] input[name="cell"]').val(response.result.cell);
                $('[data-form="update"] input[name="email"]').val(response.result.email);
                $('[data-form="update"] input[name="telephone"]').val(response.result.telephone);
                $('[data-form="update"] input[name="whatsapp"]').val(response.result.whatsapp);

            }else{
            }
        }).fail(function () {
            // alert("Error");
        });

    });
</script>
@include('frontend.private.clients.create')
@include('frontend.private.clients.edit')
@endsection
