{{-- <table id="" class="table">
    <thead>
        <tr>
            <th style="width: 5%">#</th>
            <td style="width: 25%">DNI</td>
            <td style="width: 25%">APELLIDOS</td>
            <td style="width: 25%">NOMBRES</td>
            <td style="width: 25%">FECHA</td>
        </tr>
    </thead>
    <tbody>

        @if ($results)
            @foreach ($results as $key=>$item)
            <tr>
                <td>
                    {{$item->id}}
                </td>
                <td> {{$item->dni}}</td>
                <td>{{$item->last_name}}</td>
                <td>{{$item->name}}</td>
                <td>{{ date("d/m/Y", strtotime($item->created_at))}}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>Sin datos</td>
            </tr>
        @endif

    </tbody>
</table> --}}
<div class="col-md-12">
    @if ($results)
        @foreach ($results as $key=>$item)
        <div class="card-list">
            <div class="item-list">
                <div class="avatar">
                    <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->last_name,0,1)}}{{substr($item->name,0,1)}}</span>
                </div>
                <div class="info-user ml-3">
                    <div class="username">{{$item->last_name}}, {{$item->name}}</div>
                    <div class="status">DNI: {{$item->dni}} </div>
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

