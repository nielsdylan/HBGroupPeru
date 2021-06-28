@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Participantes</h4>
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
                <a href="#">Lista de participantes</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Participantes</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-light" data-toggle="tooltip" data-original-title="Exportar la lista de los participantes" href="{{route('participant.excel.export')}}"><i class="fas fa-file-excel fon-z"></i></a>

                            <a class="btn btn-light" data-toggle="tooltip" data-original-title="Modelo del excel" href="{{route('export.model.excel')}}"><i class="fas fa-file-import fon-z"></i></a>

                            <a class="btn btn-light" data-toggle="tooltip" data-original-title="Importar excel de participantes" href="#" data-action="participant-import"><i class="fas fa-file-upload fon-z"></i></a>
                            <button class="btn btn-primary btn-round" >
                                <i class="fa fa-plus"></i>
                                Nuevo participante
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <td>DNI</td>
                                    <td>APELLIDOS</td>
                                    <td>NOMBRE</td>
                                    <td>EMAIL</td>
                                    <td>CELULAR</td>
                                    <td>EMPRESA</td>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($participants)
                                    @foreach ($participants as $key=>$item)
                                        <tr>
                                            <td>{{$item->dni}}</td>
                                            <td>{{$item->last_name}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->cell}}</td>
                                            <td>{{$item->name_business}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->last_name}}" data-edit="modal" data-id="{{$item->participant_id  }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->last_name}}" data-delete="modal" data-id="{{$item->participant_id  }}">
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
<div class="modal fade" id="import-excel-participant" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                    Importar lista de participantes</span>

                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('participantes.store')}}" method="post" enctype="multipart/form-data" data-form="save-excel">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="business">Empresa</label>
                                <select id="business" class="form-control" name="business" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($business as $item)
                                        <option value="{{$item->business_id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asignature">Asignatura</label>
                                <select id="asignature" class="form-control" name="asignature" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($asignatures as $item)
                                        <option value="{{$item->asignature_id}}">{{$item->name}} ({{$item->abbreviation}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="course">Curso</label>
                                <select id="course" class="form-control" name="course" required>
                                    <option value="">Seleccione...</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="participant">Agregar lista de los participantes:</label>
                                <input id="participant" class="form-control" type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('click','[data-action="participant-import"]',function (e) {
        e.preventDefault();
        $('#import-excel-participant').modal('show');

    });
    $(document).on('submit','[data-form="save-excel"]',function (e) {
        e.preventDefault();
        var data = new FormData($(this)[0]),

            route = $(this).attr('action');

        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function()
            {
                $('[data-form="save-excel"] .modal-footer button[type="submit"]').addClass('is-loading')
            },
        }).done(function (response) {
            $('[data-form="save-excel"] .modal-footer button[type="submit"]').removeClass('is-loading');
            if (response.status == 200) {
                $('#import-excel-participant').modal('hide');
                var placementFrom = 'top';
                var placementAlign = 'right';
                var state = 'success';
                var style = 'withicon';
                var content = {};

                content.message = 'Se guardo con Éxito';
                content.title = 'Guardar';
                content.icon = 'fas fa-check';
                content.url = url+'login';
                content.target = '_blank';

                $.notify(content,{
                    type: state,
                    placement: {
                        from: placementFrom,
                        align: placementAlign
                    },
                    time: 1000,
                    delay: 2,
                });
                setTimeout(function(){
                    location.reload();
                }, 3000);
                console.log(response);
            }else{
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = 'Ingrese correctamente los datos para la session para HB Group Perú';
                content.title = 'Session';
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
                        from: 'top',
                        align: 'center'
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
</script>
@endsection
