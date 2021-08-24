
<div class="col-md-12">
    <div class="card-list">
        @if ($results)
            @foreach ($results as $key=>$item)
            <div class="item-list">
                <div class="avatar d-none d-sm-none d-lg-block d-md-block">
                    <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->course,0,1)}}{{substr($item->code,0,1)}}</span>
                </div>
                <div class="info-user ml-3">
                    <div class="username">{{$item->course}} ({{$item->code}})</div>
                    <div class="status">{{$item->asignature_name}}</div>
                    <div class="status">{{ date("m/d/Y", strtotime($item->date_start))}}</div>
                    <div class="status">{{$item->hour_start}} - {{$item->hour_end}} </div>
                </div>
                @if ($item->meeting_active == 1)

                    <a href="{{$item->join_meeting}}" target="_blank" class="btn btn-secondary btn-round mr-2 btn-pulse"><i class="fas fa-chalkboard"></i> Unirse a la reunion</a>
                    {{-- <button class="btn btn-secondary btn-round mr-2 btn-pulse" data-action="organizer" data-cours="{{$item->cours_id}}">
                        <i class="fas fa-chalkboard"></i> Unirse a la reunion
                    </button> --}}
                    <input type="hidden" name="link" value="{{$item->join_meeting}}">
                    <button class="btn btn-light btn-round btn-icon btn-sm mr-2" type="button" data-action="copy"><i class="far fa-copy"></i></button>
                @else
                    <button class="btn btn-secondary btn-round mr-2 btn-pulse" data-action="organizer" data-cours="{{$item->cours_id}}" data-toggle="collapse" data-target="#collapseExample{{$item->cours_id}}" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chalkboard-teacher"></i> Generar reunion
                    </button>
                @endif


                <button class="btn btn-icon btn-info btn-round btn-sm mr-2" data-href="{{route('cursos.show', $item->cours_id)}}" data-location="href" >
                    <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-icon btn-warning btn-round btn-sm mr-2" data-href="{{route('cursos.edit', $item->cours_id)}}" data-location="href" >
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" data-toggle="tooltip" title="" class="btn btn-danger btn-icon btn-round btn-sm" data-original-title="Eliminar {{$item->course}}" data-id="{{$item->cours_id}}" data-delete="modal">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <div class="collapse" id="collapseExample{{$item->cours_id}}">
                <div class="card card-body">
                    <form action="" method="post" data-form="form-{{$item->cours_id}}" data-action="submit">
                        <input type="hidden" name="cours_id" value="{{$item->cours_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bussiness_id">Organizadores<span class="required-label">*</span>:</label>
                                    <table class="table table-responsive">
                                        <tbody>
                                            @foreach ($organizer as $key=>$item )
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-radio-input" type="radio" name="organizer" value="{{$item->organizer_id }}" required>
                                                    </div>
                                                </td>
                                                <td>{{$item->email}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bussiness_id">Asistentes<span class="required-label">*</span>:</label>
                                    <table class="table table-responsive">
                                        <tbody>
                                            @foreach ($attendee as $key=>$item )
                                            <tr>
                                                <td>
                                                    <label class="custom-checkbox custom-control checkbox-success">
                                                        <input type="checkbox" class="custom-control-input checkbox-click" name="attendee[]" value="{{$item->id}}" >
                                                        <span class="custom-control-label"></span>

                                                    </label>
                                                </td>
                                                <td>{{$item->email}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="my-textarea">Link :</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control" placeholder="" aria-label=""name="link" value="1112223369885522">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-default btn-border" type="button" data-action="copy"><i class="far fa-copy"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-round mr-2 btn-pulse submit">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                    {{$item->cours_id}}
                </div>
            </div>
            @endforeach
        @else

        @endif
    </div>
</div>
<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>
