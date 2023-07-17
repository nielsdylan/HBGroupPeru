@extends('frontend.private')
@section('title','HB Group Perú')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Certificados</h4>
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
                <a href="{{route('certificado.index')}}">Certificados</a>
            </li>
        </ul>
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Gestion de certificados</h4>
                        </div>
                        <div class="col-md-6 text-right">

                            <a class="btn btn-light btn-sm" data-toggle="tooltip" data-original-title="Modelo del excel" href="{{route('certificado.export.model.excel')}}"><i class="fas fas fa-cloud-download-alt fon-z"></i> Modelo del ExcelL</a>

                            <a class="btn btn-light btn-sm" data-toggle="tooltip" data-original-title="Importar excel de participantes" href="#" data-action="participant-import"><i class="fas fas fa-cloud-upload-alt fon-z"></i> Importar Excel de certificados</a>
                            <button class="btn btn-primary btn-round nuevo-certificado btn-sm">
                                <i class="fa fa-plus"></i>
                                Nuevo Certificado
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover" id="tabla-data" width="100%">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Código de Certificado</td>
                                    <td>Número de Documento</td>
                                    <td>Apellidos y Nombres</td>
                                    <td>Curso</td>
                                    {{-- <td>Tipo de Curso</td> --}}
                                    <td>Empresa</td>
                                    <td>Email</td>
                                    <td>Nota</td>
                                    <td>Fecha de vencimiento</td>
                                    <td>Horas</td>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                    Importar listado a de certificados</span>

                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('certificado.store')}}" method="post" enctype="multipart/form-data" data-form="save-excel">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="participant">Agregar lista de los participantes a certificar:</label>
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

<div class="modal fade" id="certificado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                        Ingresar nuevo participante certificado
                    </span>

                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('academico.certificados.guardar')}}" method="post"  data-form="certificado">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="0">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="cod_certificado">Codigo Certificado :</label>
                                <input id="cod_certificado" class="form-control form-control-sm" type="text" name="cod_certificado" data-action="unico" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_curso">Fecha de curso :</label>
                                <input id="fecha_curso" class="form-control form-control-sm" type="date" name="fecha_curso" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="duracion">Duracion :</label>
                                <input id="curso" class="form-control form-control-sm" type="number" name="duracion" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nota" >Nota :</label>
                                <input id="nota" class="form-control form-control-sm" type="number" name="nota" value="" step="0.01" required>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_curso" >Tipo de Curso :</label>
                                <input id="tipo_curso" class="form-control form-control-sm" type="text" name="tipo_curso" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="curso">Curso :</label>
                                <input id="curso" class="form-control form-control-sm" type="text" name="curso" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_vencimiento">Fecha de Vencimiento :</label>
                                <input id="fecha_vencimiento" class="form-control form-control-sm" type="date" name="fecha_vencimiento" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_oficial" >Fecha Oficial :</label>
                                <input id="fecha_oficial" class="form-control form-control-sm" type="date" name="fecha_oficial" value="" required>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de Documento :</label>
                                <input id="tipo_documento" class="form-control form-control-sm" type="text" name="tipo_documento" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numero_documento">Número de Documento :</label>
                                <input id="numero_documento" class="form-control form-control-sm" type="text" name="numero_documento" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empresa" >Empresa :</label>
                                <input id="empresa" class="form-control form-control-sm" type="text" name="empresa" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_paterno" >Apellido Paterno :</label>
                                <input id="apellido_paterno" class="form-control form-control-sm" type="text" name="apellido_paterno" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_materno">Apellido Materno :</label>
                                <input id="apellido_materno" class="form-control form-control-sm" type="text" name="apellido_materno" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres"> Nombres :</label>
                                <input id="nombres" class="form-control form-control-sm" type="text" name="nombres" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cargo">Cargo :</label>
                                <input id="cargo" class="form-control form-control-sm" type="text" name="cargo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input id="email" class="form-control form-control-sm" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="supervisor_responsable" >Supervisor Responsable :</label>
                                <input id="supervisor_responsable" class="form-control form-control-sm" type="text" name="supervisor_responsable" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="acronimos">Acronimos :</label>
                                <input id="acronimos" class="form-control form-control-sm" type="text" name="acronimos" required>
                            </div>
                        </div> --}}
                        
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_curso_oficial">Nombre del curso oficial :</label>
                                <input id="nombre_curso_oficial" class="form-control form-control-sm" type="text" name="nombre_curso_oficial" required>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">Observaciones :</label>
                                <textarea name="observaciones" class="form-control form-control-sm" id="observaciones" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check mt-4">
                                <label class="form-check-label">
                                    <input id="aprobado" name="aprobado" class="form-check-input" type="checkbox" value="1">
                                    <span class="form-check-sign">Aprobado</span>
                                </label>
                            </div>
                        </div>
                        {{-- <div class="col-md-10">
                            <div class="form-group">
                                <label for="descripcion_corta" >Descripcion corta :</label>
                                <input id="descripcion_corta" class="form-control form-control-sm" type="text" name="descripcion_corta" value="" required>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_larga">Descripcion larga :</label>
                                <textarea name="descripcion_larga" class="form-control form-control-sm" id="" cols="3" rows="3" required></textarea>
                            </div>
                        </div> --}}
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
    var status =0;
</script>
@include('frontend.private.certificados.create')
@include('frontend.private.certificados.edit')
@endsection
@section('scripts')
    {{-- <script src="{{ asset('assets/js/plugin/datatables/jquery.dataTables.min.js') }}"></script> --}}
    
    <script src="{{ asset('assets/js/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>


    <script>
        $(document).ready(function () {
            listar();
        });
        $(document).on('change','[select-cours="get-cours"]',function (e) {
            e.preventDefault();
            var this_select = $(this),
                cours_id = $(this).val(),
                data_select = $(this).attr('data-select'),
                select = '[data-course="'+data_select+'"]';
            console.log(data_select);
            getCourseAsignature(cours_id,select);
        });
        function getCourseAsignature(id, select) {
            var html='',
                route   = '{{ route('get.courses.asignature') }}';
            data = {
                id:id
            }
            // get.courses
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                // processData: false,
                // contentType: false,
                data: data,
                beforeSend: function()
                {
                    $(select).attr('disabled','')
                },
            }).done(function (response) {
                $(select).removeAttr('disabled');
                if (response.status == 200) {
                    html = '<option value="">Seleccione...</option>';
                    $.each(response.results, function (index, element) {
                        html+='<option value="'+element.cours_id+'">'+element.course+' ('+element.code+')</option>';
                    });
                    $(select).html(html);
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
                $(select).removeAttr('disabled');
            });
        }
        $(document).on('click','[data-action="participant-import"]',function (e) {
            e.preventDefault();
            $('#import-excel-participant').modal('show');
            $('[data-form="save-excel"]')[0].reset();
            
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
                    $('[data-form="save-excel"] .modal-footer button[type="submit"]').addClass('is-loading');
                    $('[data-form="save-excel"] .modal-footer button[type="submit"]').attr('disabled','');
                },
            }).done(function (response) {
                $('[data-form="save-excel"] .modal-footer button[type="submit"]').removeClass('is-loading');
                $('[data-form="save-excel"] .modal-footer button[type="submit"]').removeAttr('disabled');
                if (response.success == true) {
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
                    $('#tabla-data').DataTable().ajax.reload(null, false);
                    setTimeout(function(){
                    }, 3000);
                }else{
                    var placementFrom = 'top';
                    var placementAlign = 'center';
                    var state = 'danger';
                    var style = 'withicon';
                    var content = {};

                    content.message = 'Ingrese correctamente los datos';
                    content.title = 'Importar lista de certificados';
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
                $('[data-form="save-excel"]')[0].reset();
            }).fail(function () {
                // alert("Error");
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
                $('[data-form="save-excel"] .modal-footer button[type="submit"]').removeClass('is-loading');
                $('[data-form="save-excel"] .modal-footer button[type="submit"]').removeAttr('disabled');
                $('[data-form="save-excel"]')[0].reset();
            });

        });
        $(document).on('click','.eliminar',function () {
            var id = $(this).attr('data-id'),
                route = '{{ route('certificado.destroy', ['certificado' => 'id'] ) }}';
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
                                $('#tabla-data').DataTable().ajax.reload(null, false);
                        });
                    }else{
                        swal("Informativo", "Ocurrio un error", "warning")
                    }
                }).fail(function () {
                    // alert("Error");
                });
            });

        });
        function listar() {
            const $tabla = $('#tabla-data').DataTable({
                dom: 'Bfrtip',
                pageLength: 20,
                language: idioma,
                responsive: true,
                serverSide: true,
                initComplete: function (settings, json) {
                    const $filter = $('#tabla-data_filter');
                    const $input = $filter.find('input');
                    $filter.append('<button id="btnBuscar" class="btn btn-default btn-sm pull-right" type="button"><i class="fas fa-search"></i></button>');
                    $input.off();
                    $input.on('keyup', (e) => {
                        if (e.key == 'Enter') {
                            $('#btnBuscar').trigger('click');
                        }
                    });
                    $('#btnBuscar').on('click', (e) => {
                        $tabla.search($input.val()).draw();
                    });
                },
                drawCallback: function (settings) {
                    $('#tabla-data_filter input').prop('disabled', false);
                    $('#btnBuscar').html('<i class="fas fa-search"></i>').prop('disabled', false);
                    $('#tabla-data_filter input').trigger('focus');
                },
                order: [[0, 'desc']],
                ajax: {
                    url: '{{ route('academico.certificados.listar') }}',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token}
                },
                columns: [
                    {data: 'certificado_id'},
                    {data: 'cod_certificado'},
                    {data: 'numero_documento'},
                    // {
                    //     render: function (data, type, row, index) {
                    //         return row['apellido_paterno']+' '+row['apellido_materno'];
                    //     }, 
                    //     // className: 'text-center'
                    // },
                    {data: 'apellidos_nombres'},
                    {data: 'curso'},
                    // {data: 'tipo_curso'},
                    {data: 'empresa'},
                    {data: 'email'},
                    {data: 'nota'},
                    {data: 'fecha_vencimiento'},
                    {data: 'duracion'},
                    {data: 'accion', orderable: false, searchable: false, className: 'text-center'}
                ],
                buttons: [
                    // {
                    //     text: '<i class="fas fa-plus"></i> Nuevo',
                    //     action: function () {
                    //         $("#nuevo-formulario")[0].reset();
                    //         $("#nuevo-formulario h5").text('Nueva clasificación');
                    //         $("#nuevo-formulario").find('input[name="id"]').val(0);
                    //         $("#nuevo").modal("show");
                    //     },
                    //     className: 'btn btn-sm btn-primary nuevo',
                    // },
                ]
            });
            $tabla.on('search.dt', function() {
                $('#tabla-data_filter input').attr('disabled', true);
                $('#btnBuscar').html('<i class="fas fa-clock" aria-hidden="true"></i>').prop('disabled', true);
            });
            $tabla.on('init.dt', function(e, settings, processing) {
                $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            });
            $tabla.on('processing.dt', function(e, settings, processing) {
                if (processing) {
                    $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
                } else {
                    $(e.currentTarget).LoadingOverlay("hide", true);
                }
            });
        }
        $('.nuevo-certificado').click(function (e) {
            e.preventDefault();
            $('#certificado').modal('show');
            $('[data-form="certificado"]')[0].reset();
            $('[data-form="certificado"]').find('input[name="id"]').val(0);
            $('[data-form="certificado"]').find('input[name="aprobado"]').removeAttr('checked');
        });
        $('[data-form="certificado"]').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: $(this).attr('action'),
                dataType: 'json',
                // processData: false,
                // contentType: false,
                data: data,
                beforeSend: function()
                {
                    // $(select).attr('disabled','')
                },
            }).done(function (response) {
                console.log(response);
                if (response.success===true) {

                }
                $('#certificado').modal('hide');
                $('#tabla-data').DataTable().ajax.reload(null, false);
            }).fail(function () {
                // alert("Error");

            });
        });
        $(document).on('click','.editar',function () {
            var id = $(this).attr('data-id'),
                route = '{{ route('academico.certificados.editar',['id' => 'id'] ) }}';
            route = route.replace('id', id);
            $('[data-form="certificado"]')[0].reset();
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                // processData: false,
                // contentType: false,
                data: {},
                beforeSend: function()
                {
                    // $(select).attr('disabled','')
                },
            }).done(function (response) {
                if (response.success===true) {
                    $('[data-form="certificado"]').find('input[name="id"]').val(id);
                    $('[data-form="certificado"]').find('input[name="cod_certificado"]').val(response.data.cod_certificado);
                    $('[data-form="certificado"]').find('input[name="fecha_curso"]').val(response.data.fecha_curso);
                    $('[data-form="certificado"]').find('input[name="duracion"]').val(response.data.duracion);
                    $('[data-form="certificado"]').find('input[name="nota"]').val(response.data.nota);
                    $('[data-form="certificado"]').find('input[name="tipo_curso"]').val(response.data.tipo_curso);
                    $('[data-form="certificado"]').find('input[name="curso"]').val(response.data.curso);
                    // $('[data-form="certificado"]').find('input[name="fecha_oficial"]').val(response.data.fecha_oficial);
                    $('[data-form="certificado"]').find('input[name="tipo_documento"]').val(response.data.tipo_documento);
                    $('[data-form="certificado"]').find('input[name="numero_documento"]').val(response.data.numero_documento);
                    $('[data-form="certificado"]').find('input[name="empresa"]').val(response.data.empresa);
                    $('[data-form="certificado"]').find('input[name="apellido_paterno"]').val(response.data.apellido_paterno);
                    $('[data-form="certificado"]').find('input[name="apellido_materno"]').val(response.data.apellido_materno);
                    $('[data-form="certificado"]').find('input[name="nombres"]').val(response.data.nombres);
                    $('[data-form="certificado"]').find('input[name="cargo"]').val(response.data.cargo);
                    $('[data-form="certificado"]').find('input[name="email"]').val(response.data.email);
                    $('[data-form="certificado"]').find('input[name="supervisor_responsable"]').val(response.data.supervisor_responsable);
                    // $('[data-form="certificado"]').find('input[name="acronimos"]').val(response.data.acronimos);
                    $('[data-form="certificado"]').find('input[name="fecha_vencimiento"]').val(response.data.fecha_vencimiento);
                    // $('[data-form="certificado"]').find('input[name="nombre_curso_oficial"]').val(response.data.nombre_curso_oficial);
                    $('[data-form="certificado"]').find('textarea[name="observaciones"]').val(response.data.observaciones);
                    // $('[data-form="certificado"]').find('input[name="descripcion_corta"]').val(response.data.descripcion_corta);
                    // $('[data-form="certificado"]').find('textarea[name="descripcion_larga"]').val(response.data.descripcion_larga);

                    if (response.data.aprobado==1) {
                        $('[data-form="certificado"]').find('input[name="aprobado"]').attr('checked','true');
                    }else{
                        $('[data-form="certificado"]').find('input[name="aprobado"]').removeAttr('checked');
                    }
                    
                    $('#certificado').modal('show');
                }

            }).fail(function () {
                // alert("Error");

            });
        });
        $(document).on('change','[data-action="unico"]',function () {
            let value = $(this).val();
            let id = $('[data-form="certificado"]').find('input[name="id"]').val();
            let this_input = $(this);
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route('academico.certificados.codigo-unico'),
                dataType: 'json',
                // processData: false,
                // contentType: false,
                data: {
                    value:value,
                    id:id
                },
                beforeSend: function()
                {
                },
            }).done(function (response) {
                if (response.success===true) {
                    swal(
                        'Información',
                        'El código ingresado se encuentra en uso',
                        'info'
                    )
                    this_input.val('');
                }
            }).fail(function () {
            });
        });
    </script>
@endsection
