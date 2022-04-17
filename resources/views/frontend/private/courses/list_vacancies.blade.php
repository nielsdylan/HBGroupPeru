<div class="col-md-12">
    @if ($results)

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">N° DE VACANTES</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">USUARIO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $key=>$item)
                <tr>
                    <td>{{$item->number}}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                    <td>{{$item->last_name.' '.$item->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @else

    @endif
</div>

<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>
