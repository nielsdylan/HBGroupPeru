<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                    Nueva</span>
                    <span class="fw-light">
                        asignatura
                    </span>
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('certificado.store')}}" data-form="create">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="abbreviation">Abreviación</label>
                                <input id="abbreviation" name="abbreviation" type="text" class="form-control" placeholder="Abreviación..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Estado : </label>
                                <input data-status="check" type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" name="status" value="1">
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
    $(document).on('submit','[data-form="create"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            route = $(this).attr('action');

        data = data+'&status='+status;
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,

        }).done(function (response) {
            if (response.status == 200) {
                $('#addRowModal').modal('hide');
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
</script>
