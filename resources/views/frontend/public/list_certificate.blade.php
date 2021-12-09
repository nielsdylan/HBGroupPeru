@if ($certificado->total() > 0)
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th >Nombre</th>
                      <th>Curso</th>
                      <th >Fecha</th>
                      <th >Vigencia</th>
                      <th >Descarga</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($certificado as $certi)
                        <tr>
                            <td>{{ $certi->last_name.' '.$certi->name }}</td>
                            <td>{{ $certi->description_cours }}</td>
                            <td>{{ date('d/m/Y', strtotime($certi->date)) }}</td>
                            <td>
                                @if ($certi->status==1)
                                <span class="badge badge-pill badge-primary">{{'VIGENTE'}}</span>
                                @else
                                <span class="badge badge-pill badge-danger">{{'CADUCIDADO'}}</span>
                                @endif
                            </td>
                            <td><a href="{{route('certificado.pdf',$certi->certificado_id )}}"><i class="fas fa-cloud-download-alt"></i> PDF</a></td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $certificado->links() }}
        </div>
    </div>

@else
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <p>
                    Si no encuentra su certificado comuniquese con el area de soporte academico, marcando al numero telefonico
                    <a href="tel:992 933 603" class="email-contact" >{{$configurations->telephone}}</a>
                    o enviando un correo electronico a
                    <a href="mailto:{{$configurations->email}}?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact">&nbsp;{{$configurations->email}}</a>.
                    Gracias por su comprensión.
                </p>
            </div>
        </div>
    </div>
@endif
