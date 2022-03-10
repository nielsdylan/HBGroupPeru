<table id="" class="table">
    <thead>
        <tr>
            <th style="width: 5%">#</th>
            <td style="width: 25%">DNI</td>
            <td style="width: 25%">APELLIDOS</td>
            <td style="width: 25%">NOMBRES</td>
            <td style="width: 25%" class="text-center">TELEFONO</td>
            <td style="width: 25%" class="text-center">EMAIL</td>
        </tr>
    </thead>
    <tbody>

        @if ($results)
            @foreach ($results as $key=>$item)
            <tr>
                <td> {{ $item->id}}</td>
                <td> {{ $item->dni}}</td>
                <td> {{ $item->last_name}}</td>
                <td> {{ $item->name}}</td>
                <td class="text-center">
                    @if ($item->confirme_telephone==1)
                        <i class="fas fa-check text-success "></i>
                    @else
                        <i class="fas fa-times text-danger "></i>
                    @endif
                </td>
                <td class="text-center">
                    @if ($item->confirme_email==1)
                        <i class="fas fa-check text-success "></i>
                    @else
                        <i class="fas fa-times text-danger "></i>
                    @endif
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>Sin datos</td>
            </tr>
        @endif

    </tbody>
</table>
<div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div>
{{-- <div class="col-md-12 d-flex justify-content-center">{{ $results->links() }}</div> --}}
