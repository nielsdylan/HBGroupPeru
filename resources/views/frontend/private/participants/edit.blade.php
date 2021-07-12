<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                    Editar participante</span>

                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  enctype="multipart/form-data" data-form="edit">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="id">
                                <label for="asignature">Asignatura</label>
                                <select class="form-control" name="asignature" select-cours="get-cours" data-select="edit-participant" required>
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
                                <select class="form-control" name="course" data-course="edit-participant" required>
                                    <option value="">Seleccione...</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_type_id">Tipo de documento :</label>
                                <select  class="form-control" name="document_type_id" required>
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
                                <input  class="form-control" type="number" name="dni" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Apellidos :</label>
                                <input  class="form-control" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombres :</label>
                                <input  class="form-control" type="text" name="name" required>
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
                                <a class="btn btn-link" data-toggle="collapse" href="#sendMail" role="button" aria-expanded="false" aria-controls="collapseExample" data-action="send-option">
                                    Más opciones.
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse" id="sendMail">
                                <div class="card card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="send_email">Enviar correo electronico : </label>
                                                <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_email" data-email="send" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="send_telephone">Enviar mensaje de texto : </label>
                                                <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" name="send_telephone" data-telephone="send" value="1">
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
$(document).on('submit','[data-form="edit"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            data_id = $('[name="id"]').val();
            route = '{{ route('participantes.update', ['participante' => '+data_id+'] ) }}';
            route = route.replace('data_id', data_id);

        swal({
            title: "¿Está seguro de guardar?",
            text: "Se guardara su registro.",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: false
        }, function () {
            $.ajax({
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: route,
                dataType: 'json',
                data: data,
            }).done(function (response) {

                if (response.status == 200) {
                    $('#edit-modal').modal('hide');
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
                        delay: 0,
                    });

                    setTimeout(function(){
                        location.reload();
                    }, 2000);
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

    });
</script>
