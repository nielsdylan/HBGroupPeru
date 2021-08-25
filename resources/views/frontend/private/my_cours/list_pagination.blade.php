<div class="col-md-12">
    @if ($results)
        @foreach ($results as $key=>$item)

        <div class="d-flex">
            <div class="avatar d-none d-sm-none d-lg-block d-md-block">
                <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->course,0,1)}}{{substr($item->code,0,1)}}</span>
            </div>
            <div class="flex-1 ml-3 pt-1">
                <h3 class="text-uppercase fw-bold mb-1">{{$item->course}} ({{$item->code}})
                    <span class="text pl-3">

                    </span>
                </h3>
                <div><span class="text-muted">{{$item->asignature_name}}</span></div>
                <div><span class="text-muted">DOCENTE: {{$item->last_name}}, {{$item->name}}</span></div>

            </div>
            <div class="float-right pt-1">
                <div><small class="text-muted">Fecha: {{date('d/m/Y', strtotime($item->date_start))}} </small></div>
                <div><small class="text-muted">Hora: {{$item->hour_start}} - {{$item->hour_end}}</small></div>

                @if ($item->meeting_active)
                    <a href="{{$item->join_meeting}}" target="_blank" class="btn btn-secondary btn-round btn-sm btn-pulse mt-1">
                        <i class="fas fa-chalkboard"></i>
                        UNIRSE A LA REUNION
                    </a>
                @endif

            </div>
        </div>
        <div class="separator-dashed"></div>
        @endforeach
    @else

    @endif
</div>

<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>

