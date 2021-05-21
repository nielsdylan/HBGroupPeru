<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Editar</span>
                    <span class="fw-light">
                        turno
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST"  data-form="turno-edit">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <input type="hidden" name="turn_id"  value="">
                                <label for="name_edit">Turno</label>
                                <input id="name_edit" name="name" type="text" class="form-control" placeholder="Turno..." required>
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
    $(document).on('submit','[data-form="turno-edit"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            data_id = $('[name="turn_id"]').val();
            route = '{{ route('turno.update', ['turno' => '+data_id+'] ) }}';
            route = route.replace('data_id', data_id);

        swal({
            title: "¿Está seguro de guardar?",
            text: "Se guardara su registro.",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
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
                    location.reload();
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
