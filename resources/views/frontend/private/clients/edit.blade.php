<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Editar</span>
                    <span class="fw-light">
                        cliente
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form data-form="update">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="business_copi">Empresa: </label>
                                <input id="business_copi" name="business" type="text" class="form-control" placeholder="Nombre de la empresa..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="email_copi">Email: </label>
                                <input id="email_copi" name="email" type="email" class="form-control" placeholder="ejemplo@ejemplo.com..." required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="whatsapp_copi">Whatsapp</label>
                                <input id="whatsapp_copi" name="whatsapp" type="number" class="form-control" placeholder="Número de whatsapp...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="cell_copi">Celular:</label>
                                <input id="cell_copi" name="cell" type="number" class="form-control" placeholder="Número de celular..." >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="telephone_copi">Telefono:</label>
                                <input id="telephone_copi" name="telephone" type="number" class="form-control" placeholder="Número de telefono..." >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="address_copi">Dirección:</label>
                                <textarea name="address" id="address_copi" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('submit','[data-form="update"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            data_id = $('[data-form="update"] input[name="id"]').val();
            route = '{{ route('cliente.update', ['cliente' => '+data_id+'] ) }}';
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
                console.log(response);
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
