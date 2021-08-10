<div class="col-md-12">
    @if ($results)
        @foreach ($results as $key=>$item)
        <div class="card-list">
            <div class="item-list">
                <div class="avatar">
                    <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->course,0,1)}}{{substr($item->code,0,1)}}</span>
                </div>
                <div class="info-user ml-3">
                    <div class="username">{{$item->course}} ({{$item->code}})</div>
                    <div class="status">DOCENTE: {{$item->last_name}}, {{$item->name}} </div>
                    <div class="status">FECHA: {{date('d/m/Y', strtotime($item->date_start))}}</div>
                    <div class="status">HORA: {{$item->hour_start}} - {{$item->hour_end}} </div>
                </div>
                <button class="btn btn-icon btn-danger btn-round btn-sm" data-delete="participant" data-id="{{$item->cours_participant_id}}">
                    <i class="fa fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
        @endforeach
    @else

    @endif
</div>

<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>

