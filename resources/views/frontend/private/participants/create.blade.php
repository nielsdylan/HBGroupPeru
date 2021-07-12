<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                    Nuevo participante</span>

                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('participantes.add')}}" method="post" enctype="multipart/form-data" data-form="save-add">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asignature">Asignatura</label>
                                <select class="form-control" name="asignature" select-cours="get-cours" data-select="add-participant" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($asignatures as $item)
                                        <option value="{{$item->asignature_id}}">{{$item->name}} ({{$item->abbreviation}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course">Curso</label>
                                <select class="form-control" name="course" data-course="add-participant" required>
                                    <option value="">Seleccione...</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_type_id">Tipo de documento :</label>
                                <select id="document_type_id" class="form-control" data-document="select-type" name="document_type_id" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($document_types as $key=>$type )
                                        <option value="{{$type->document_type_id }}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dni">Nùmero de documento :</label>
                                <input  class="form-control" type="number" name="dni" data-search="hbgroup" data-codument="codument" data-disabled="disabled" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Apellidos :</label>
                                <input  class="form-control" data-disabled="disabled" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombres :</label>
                                <input  class="form-control" data-disabled="disabled" type="text" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dni">Email :</label>
                                <input  class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cell">Celular :</label>
                                <input  class="form-control" type="number" name="cell" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Más opciones.
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="send_email">Enviar correo electronico : </label>
                                                <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_email" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="send_telephone">Enviar mensaje de texto : </label>
                                                <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_telephone" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    $(document).on('change','[data-document="select-type"]',function () {
        var value = $(this).val();
        $('[data-disabled="disabled"]').removeAttr('disabled');
        switch (value) {
            case '2' :
                $('[data-codument="codument"]').attr('data-search','dni');
            break;
            case '4' :
                $('[data-codument="codument"]').attr('data-search','ruc');
            break;

            default:
                $('[data-codument="codument"]').attr('data-search','hbgroup');
            break;
        }

    });
    $(document).on('change','[data-codument="codument"]',function () {
        var slug = $(this).val(),
            search = $(this).attr('data-search'),
            route = '';

        slug = slug+'-'+search;
        route = '{{ route('get.user', ['slug' => 'slug'] ) }}';
        route = route.replace('slug', slug);

        if (slug) {
            switch (search) {
                case 'dni':
                    APIReniec(route);
                break;
                case 'ruc':
                    APIReniec(route);
                break;
                case 'hbgroup':
                    APIReniec(route);
                break;
            }
        }

    });
    function APIReniec(route) {
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
            },
        }).done(function (response) {
            if (response.status == 200) {
                $('[data-form="save-add"] .modal-body [name="document_type_id"] option').removeAttr("selected");

                $('[data-form="save-add"] .modal-body [name="document_type_id"] option[value="'+response.results.document_type_id+'"]').attr("selected","");

                $('[data-form="save-add"] .modal-body [name="dni"]').val(response.results.dni);
                $('[data-form="save-add"] .modal-body [name="email"]').val(response.results.email);
                $('[data-form="save-add"] .modal-body [name="last_name"]').val(response.results.last_name);
                $('[data-form="save-add"] .modal-body [name="cell"]').val(response.results.telephone);
                $('[data-form="save-add"] .modal-body [name="name"]').val(response.results.name);

                // $('[data-disabled="disabled"]').attr('disabled','');

            }else{
                $('[data-form="save-add"] .modal-body [name="document_type_id"] option').removeAttr("selected");
                $('[data-form="save-add"] .modal-body [name="document_type_id"] option[value=""]').attr("selected",'');

                $('[data-form="save-add"] .modal-body [name="email"]').val('');
                $('[data-form="save-add"] .modal-body [name="last_name"]').val('');
                $('[data-form="save-add"] .modal-body [name="cell"]').val('');
                $('[data-form="save-add"] .modal-body [name="name"]').val('');

                // $('[data-disabled="disabled"]').removeAttr('disabled');
            }
        }).fail(function () {
        // alert("Error");
        });
    }
    $(document).on('submit','[data-form="save-add"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            route = $(this).attr('action'),
            index_off='';

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
                $('[data-form="save-add"] .modal-footer button[type="submit"]').addClass('is-loading');
                $('[data-form="save-add"] .modal-footer button[type="submit"]').attr('disabled','');
            },
        }).done(function (response) {
            $('[data-form="save-add"] .modal-footer button[type="submit"]').removeClass('is-loading');
            if (response.status == 200) {
                $('[data-form="save-add"] .modal-footer button[type="submit"]').removeAttr('disabled');
                $('#add-modal').modal('hide');
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
