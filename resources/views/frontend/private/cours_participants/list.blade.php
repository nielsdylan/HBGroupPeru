<form action="{{route('asignacion-cursos.store')}}" method="post" data-submit="form">
    <table id="" class="table">
        <thead>
            <tr>
                <th style="width: 5%"> </th>
                <td>CODIGO</td>
                <td>CURSO</td>
                <td>FECHA</td>
                <td>HORA</td>
            </tr>
        </thead>
        <tbody>

            @if ($results)
                @foreach ($results as $key=>$item)
                <tr data-id="{{$item->cours_id}}">
                    <td>
                        <label class="custom-checkbox custom-control checkbox-success">
                            <input type="checkbox" class="custom-control-input checkbox-click" name="cours[]" value="{{$item->cours_id}}" >
                            <span class="custom-control-label"></span>

                        </label>
                    </td>
                    <td> {{$item->code}}</td>
                    <td>{{$item->course}}</td>
                    <td>{{ date("d/m/Y", strtotime($item->date_start))}}</td>
                    <td>{{$item->hour_start}} - {{$item->hour_end}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td>Sin datos</td>
                </tr>
            @endif

        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary btn-round cours-list"><i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
</form>
{{ $results->links() }}
