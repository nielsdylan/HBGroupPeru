@extends('frontend.private')
@section('title','HB Group Perú')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Académico</h4>
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
                <a href="{{route('programa.index')}}">Programas</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('programa.show', $programa)}}">{{$programa->name}}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="code">Código:</label>
                                <input id="code" class="form-control" type="text" name="code" value="{{$programa->code}}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="abbreviation">Abreviatura:</label>
                                <input id="abbreviation" class="form-control" type="text" name="abbreviation" value="{{$programa->abbreviation}}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{$programa->name}}" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Estado:</label>
                                <input id="status" class="form-control" type="text" name="status" value="{{$programa->status == 1 ? 'Activo' : 'Desactivo' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <button data-href="{{route('programa.index')}}" class="btn btn-icon btn-round btn-danger back-link" data-toggle="tooltip" data-placement="top" title="Volver a la lista de programas">
                                <i class="fas fa-arrow-left"></i></button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-icon btn-round btn-primary" data-modal="add-pensum" data-toggle="tooltip" data-placement="top" title="Agregar un nuevo pensum">
                                <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Acordion pensum --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lista de pensum</h4>

                        <button class="btn btn-link btn-round refres ml-auto" data-id="{{$programa->program_id}}" >
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" data-acordion="acordions-pensum">

                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal de agregar un pensum --}}
<div class="modal fade" id="add-pensum-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <form action="{{route('pensum.store')}}" method="POST" data-form="pensum-store">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar pensum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Nombre:</label>
                                <input id="description" class="form-control" type="text" name="description" required>
                                <input type="hidden" name="program_id" value="{{$programa->program_id}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-action>Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
		</div>
	</div>
</div>
{{-- --------------------------- --}}
<div class="modal fade" id="add-asignatura-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <form action="{{route('pensum-asignatura.store')}}" method="POST" data-form="pensum-asignatura-store">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" >Agregar asignatura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="pensum_id" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asignature_id">Asignatura</label>
                                <select id="asignature_id" class="form-control" name="asignature_id" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($asignature as $key=>$item )
                                        <option value="{{$item->asignature_id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciclo">Nivel: </label>
                                <select id="ciclo_id" class="form-control" name="ciclo_id" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($ciclo as $key=>$item )
                                    <option value="{{$item->ciclo_id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="credits">Creditos: </label>
                                <input id="credits" class="form-control" type="number" name="credits" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weekly_hour">Horas semanales: </label>
                                <input id="weekly_hour" class="form-control" type="number" name="weekly_hour" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_hour">Horas totales: </label>
                                <input id="total_hour" class="form-control" type="number" name="total_hour" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                </div>
            </form>
		</div>
	</div>
</div>
<script>
    $(document).ready(function () {
        getPensumShow($('[data-form="pensum-store"] .modal-body [name="program_id"]').val())
    });
    $(document).on('click','.back-link',function (e) {
        e.preventDefault();
        location.href = $(this).attr('data-href');
    });
    $(document).on('click','[data-modal="add-pensum"]',function () {
        $('#add-pensum-modal').modal('show');
    });
    $(document).on('submit','[data-form="pensum-store"]',function (e) {
        e.preventDefault();
        var route = $(this).attr('action'),
            data = $(this).serialize();
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                $('[data-form="pensum-store"] .modal-footer button[type="submit"]').addClass('is-loading');
                $('[data-form="pensum-store"] .modal-footer button[type="submit"]').attr('disabled', true);
            },

        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="pensum-store"] .modal-footer button[type="submit"]').removeAttr('disabled');
                $('[data-form="pensum-store"] .modal-footer button[type="submit"]').removeClass('is-loading');
                $('[data-form="pensum-store"] .modal-body [name="description"]').val('');
                $('#add-pensum-modal').modal('hide');
                getPensumShow($('[data-form="pensum-store"] .modal-body [name="program_id"]').val());
            }else{
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = 'Intentelo mas tarde o contacte con el area de informatica';
                content.title = 'Error';
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
    $(document).on('click','.refres',function () {
        var program_id = $(this).attr('data-id');
        getPensumShow(program_id);
    });
    function getPensumShow(program_id) {
        var route = '{{ route('pensum.show', ['pensum' => 'program_id'] ) }}';
            route = route.replace('program_id', program_id),
            html = '';

        $.ajax({
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: {},
            beforeSend: function(){
                $('[data-acordion="acordions-pensum"]').addClass('is-loading is-loading-lg');
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-acordion="acordions-pensum"]').removeClass('is-loading is-loading-lg');
                html = ''
                    +'<div id="accordion" class="accordion-secondary">';
                        $.each(response.results, function (index, element) {
                            html +='<div class="card">'
                                +'<div class="card-header" id="headingThree" >'
                                    +'<div class="d-flex align-items-center">'
                                        +'<i class="flaticon-agenda-1"></i> '+element.description+''
                                        +'<button class="btn btn-link btn-round ml-auto" data-refresh="asignature" data-id="'+element.pensum_id+'" >'
                                            +'<i class="fas fa-sync-alt"></i>'
                                        +'</button>'
                                        +'<button class="btn btn-link btn-round add-asignature" data-id="'+element.pensum_id+'" >'
                                            +'<i class="fas fa-plus"></i>'
                                        +'</button>'
                                        +'<button class="btn btn-link btn-round refresh-asignature" data-id="" data-toggle="collapse" data-target="#collapse'+element.pensum_id+'" aria-expanded="false" aria-controls="collapse'+element.pensum_id+'">'
                                            +'<i class="fas fa-angle-down"></i>'
                                        +'</button>'
                                    +'</div>'
                                    +'<div class="span-mode"></div>'
                                +'</div>'
                                +'<div id="collapse'+element.pensum_id+'" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">'
                                    +'<div class="card-body" data-card="body-pensum" data-pensum="'+element.pensum_id+'">'
                                        +'texto'
                                    +'</div>'
                                +'</div>'
                            +'</div>';
                            getAsignatureShow(element.pensum_id)
                        });
                    html +='</div>'
                +'';
                $('[data-acordion="acordions-pensum"]').html(html);

            }
        }).fail(function () {
            // alert("Error");
        });
    }

    $(document).on('click','.add-asignature',function () {
        var pensum_id = $(this).attr('data-id');
        $('#add-asignatura-modal').modal('show');
        $('[data-form="pensum-asignatura-store"] input[name="pensum_id"]').val(pensum_id);



    });
    $(document).on('submit','[data-form="pensum-asignatura-store"]',function (e) {
        e.preventDefault();
        var route = $(this).attr('action'),
            data = $(this).serialize();
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                $('[data-form="pensum-asignatura-store"] .modal-footer button[type="submit"]').addClass('is-loading');
                $('[data-form="pensum-asignatura-store"] .modal-footer button[type="submit"]').attr('disabled', true);
            },

        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="pensum-asignatura-store"] .modal-footer button[type="submit"]').removeAttr('disabled');
                $('[data-form="pensum-asignatura-store"] .modal-footer button[type="submit"]').removeClass('is-loading');
                $('[data-form="pensum-asignatura-store"] .modal-body [name="description"]').val('');
                $('#add-asignatura-modal').modal('hide');

                getAsignatureShow($('[data-form="pensum-asignatura-store"] input[name="pensum_id"]').val());
            }else{
                var placementFrom = 'top';
                var placementAlign = 'center';
                var state = 'danger';
                var style = 'withicon';
                var content = {};

                content.message = 'Intentelo mas tarde o contacte con el area de informatica';
                content.title = 'Error';
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
    $(document).on('click','[data-refresh="asignature"]',function () {
        var pensum_id = $(this).attr('data-id');
        getAsignatureShow(pensum_id);
    });
    function getAsignatureShow(pensum_id) {
        var route = '{{ route('pensum.asignature.show') }}',
            html  ='',
            data = {
                "pensum_id":pensum_id,
            };
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function(){
                $('[data-pensum="'+pensum_id+'"]').addClass('is-loading');
            },

        }).done(function (response) {
            $('[data-pensum="'+pensum_id+'"]').removeClass('is-loading');
            if (response.status == 200) {

                html = '' +
                // '<ol class="activity-feed">';
                //     $.each(response.results, function (index, element) {
                //         html+='<li class="feed-item feed-item-info">'+
                //             '<time class="date" datetime="9-25">'+element.code+'</time>'+
                //             '<span class="text">'+element.name+' </span>'+
                //         '</li>';
                //     });


                // '</ol>'+
                // '';
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<div class="table-responsive table-hover table-sales">'+
                            '<table class="table">'+
                                '<tbody>';
                                    $.each(response.results, function (index, element) {
                                        html+='<tr>'+
                                            '<td>'+
                                                element.name
                                            '</td>'+
                                            '<td>'+
                                                element.name
                                            '</td>'+
                                        '</tr>';
                                    });

                                html+='</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                $('[data-pensum="'+pensum_id+'"]').html(html);
            }else{
                html = '<label>Sin asignaturas</label>' ;
                $('[data-pensum="'+pensum_id+'"]').html(html);
            }
        }).fail(function () {
            // alert("Error");
        });
    }
</script>
@endsection
