
<div class="col-md-12">
    <div class="card-list">
        @if ($results)
            @foreach ($results as $key=>$item)
            <div class="item-list">
                <div class="avatar">
                    <span class="avatar-title rounded-circle border border-white bg-info">{{substr($item->course,0,1)}}{{substr($item->code,0,1)}}</span>
                </div>
                <div class="info-user ml-3">
                    <div class="username">{{$item->course}} ({{$item->code}})</div>
                    <div class="status">{{$item->asignature_name}}</div>
                </div>
                {{-- <button class="btn btn-icon btn-primary btn-round btn-sm">
                    <i class="fa fa-plus"></i>
                </button> --}}

                <button class="btn btn-icon btn-info btn-round btn-sm mr-2" data-href="{{route('cursos.show', $item->cours_id)}}" data-location="href" >
                    <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-icon btn-warning btn-round btn-sm mr-2" data-href="{{route('cursos.edit', $item->cours_id)}}" data-location="href" >
                    <i class="fa fa-edit"></i>
                </button>

                {{-- <a href="{{route('cursos.show', $item->cours_id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-warning btn-lg" data-original-title="Ver el curso {{$item->course}}">
                    <i class="fa fa-eye"></i>
                </a> --}}
                {{-- <a href="{{route('cursos.edit', $item->cours_id)}}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Editar el curso {{$item->course}}" data-id="{{$item->cours_id}}">
                    <i class="fa fa-edit"></i>
                </a> --}}
                <button type="button" data-toggle="tooltip" title="" class="btn btn-danger btn-icon btn-round btn-sm" data-original-title="Eliminar {{$item->course}}" data-id="{{$item->cours_id}}" data-delete="modal">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            @endforeach
        @else

        @endif
    </div>
</div>
<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>
