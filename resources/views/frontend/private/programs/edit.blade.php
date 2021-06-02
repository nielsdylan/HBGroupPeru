<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h2 class="modal-title">
                    <span class="fw-mediumbold">
                    Editar</span>
                    <span class="fw-light">
                        asignatura
                    </span>
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('asignatura.store')}}" data-form="edit">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <input type="hidden" name="id" value="">
                                <label for="code_edit">Código</label>
                                <input id="code_edit" name="code" type="text" class="form-control" placeholder="Código..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="name_edit">Nombre</label>
                                <input id="name_edit" name="name" type="text" class="form-control" placeholder="Nombre..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="abbreviation_edit">Abreviación</label>
                                <input id="abbreviation_edit" name="abbreviation" type="text" class="form-control" placeholder="Abreviación..." required>
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
        var data    = $(this).serialize(),
            id      = $('[data-form="edit"] [name="id"]').val(),
            route   = '{{ route('programa.update', ['programa' => '+id+'] ) }}';
            route   = route.replace('id', id);
        $.ajax({
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            url: route,
            dataType: 'json',
            data: data,
            beforeSend: function()
            {
                $('[data-form="edit"] button[type="submit"]').addClass('is-loading is-loading-lg');
                $('[data-form="edit"] button[type="submit"]').attr('disabled','');
            },

        }).done(function (response) {
            $('[data-form="edit"] button[type="submit"]').remove('is-loading is-loading-lg');
            $('[data-form="edit"] button[type="submit"]').remove('disabled');
            $('#edit-modal').modal('hide');
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
