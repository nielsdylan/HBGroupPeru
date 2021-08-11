<div class="col-md-12">
    @if ($results)
        @foreach ($results as $key=>$item)

        <div class="d-flex">
            <div class="avatar ">
                <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->course,0,1)}}{{substr($item->code,0,1)}}</span>
            </div>
            <div class="flex-1 ml-3 pt-1">
                <h3 class="text-uppercase fw-bold mb-1">{{$item->course}} ({{$item->code}})
                    <span class="text-warning pl-3">
                        <button class="btn btn-secondary btn-round btn-sm btn-pulse mt-1" data-delete="participant" data-id="{{$item->cours_participant_id}}">
                            UNIRSE A LA REUNION
                        </button>
                    </span></h3>
                <span class="text-muted">DOCENTE: {{$item->last_name}}, {{$item->name}}</span>
            </div>
            <div class="float-right pt-1">
                <div><small class="text-muted">Fecha: {{date('d/m/Y', strtotime($item->date_start))}} </small></div>
                <div><small class="text-muted">Hora: {{$item->hour_start}} - {{$item->hour_end}}</small></div>

            </div>
        </div>
        <div class="separator-dashed"></div>
        @endforeach
    @else

    @endif
</div>

<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>

