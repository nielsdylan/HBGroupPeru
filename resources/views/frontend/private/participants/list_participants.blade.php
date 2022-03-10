<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<table id="add-row" class="display table table-striped table-hover" >
    <thead>
        <tr>
            <td>DNI</td>
            <td>APELLIDOS</td>
            <td>NOMBRE</td>
            {{-- <td>EMAIL</td>
            <td>CELULAR</td>
            <td>EMPRESA</td> --}}
            <th style="width: 10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($results)
            @foreach ($results as $key=>$item)
                <tr>
                    <td>{{$item->dni}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->name}}</td>
                    {{-- <td>{{$item->email}}</td>
                    <td>{{$item->telephone}}</td>
                    <td>{{$item->name_business}}</td> --}}
                    <td>
                        <div class="form-button-action">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input confirmation-email" id="{{'check_email'.$item->id}}" value="{{$item->id}}">
                                <label class="custom-control-label" data-toggle="tooltip" title="" for="{{'check_email'.$item->id}}" data-original-title="{{'Validar el email de '.$item->last_name}}"><i class="fas fa-envelope"></i></label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input confirmation-telephone" id="{{'check_telephone'.$item->id}}" value="{{$item->id}}">
                                <label class="custom-control-label" data-toggle="tooltip" data-original-title="{{'Validar el telefono de '.$item->last_name}}" for="{{'check_telephone'.$item->id}}"><i class="fas fa-phone"></i></label>
                            </div>
                            <a data-toggle="tooltip" title="" class="btn btn-link btn-warning btn-lg" data-original-title="Asignar cursos al participante"  href="{{route('asignacion-cursos.index').'?DNI='.$item->dni}}">
                                <i class="fas fa-project-diagram"></i>
                            </a>
                            <a data-toggle="tooltip" title="" class="btn btn-link btn-success btn-lg" data-original-title="Ver a {{$item->last_name}}"  href="{{route('participantes.show',$item->id)}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar {{$item->last_name}}"  data-id="{{$item->participant_id  }}" href="{{route('participantes.edit', $item->id)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Eliminar {{$item->last_name}}" data-delete="modal" data-id="{{$item->id  }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>
