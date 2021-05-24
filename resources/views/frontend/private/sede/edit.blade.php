<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Editar</span>
                    <span class="fw-light">
                        sede
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('sede.store')}}" data-form="sede-edit">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="sede_id" id="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="name_edit">Sede</label>
                                <input id="name_edit" name="name" type="text" class="form-control" placeholder="Sede..." required>
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
    $(document).on('submit','[data-form="sede-edit"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            data_id = $('[name="sede_id"]').val();
            route = '{{ route('sede.update', ['sede' => '+data_id+'] ) }}';
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
