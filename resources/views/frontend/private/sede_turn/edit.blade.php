<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Sedes y Turnos</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form data-form="sede-turn-edit">
                <div class="modal-body">
                    <input type="hidden" value=""name="sede_turn_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sede_edit">SEDES: </label>
                                <select id="sede_edit" class="form-control" name="sede" required>
                                    <option value="" >Seleccione...</option>
                                    @foreach ($sedes as $key=>$item )
                                        <option value="{{$item->sede_id}}" >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="turn_edit">TURNOS: </label>
                                <select id="turn_edit" class="form-control" name="turn" required>
                                    <option value="" >Seleccione...</option>
                                    @foreach ($turns as $key=>$item )
                                        <option value="{{$item->turn_id}}" >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                </div>
            </form>
		</div>
	</div>
</div>
<script>
    $(document).on('submit','[data-form="sede-turn-edit"]',function (e) {
        e.preventDefault();
        var data = $(this).serialize(),
            data_id = $('[name="sede_turn_id"]').val();
            route = '{{ route('sede-turno.update', ['sede_turno' => '+data_id+'] ) }}';
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
