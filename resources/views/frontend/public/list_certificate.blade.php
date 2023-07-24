@if ($certificado->total() > 0)
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th >N° Documento</th>
                      <th >Nombre</th>
                      <th>Curso</th>
                      <th >Fecha</th>
                      <th >Vigencia</th>
                      <th >Descarga</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($certificado as $certi)
                    @if ($certi->aprobado==1 && date("Y-m-d") <= $certi->fecha_vencimiento)
                        @php

                            $fecha_actual = date("Y-m-d",strtotime(date("Y-m-d")));
                            $estado='CADUCADO';
                            $color = 'primary';
                            
                            if (date("Y-m-d") >= date("Y-m-d",strtotime($certi->fecha_vencimiento."- 1 month"))) {
                                $estado='VIGENTE';
                                $color = 'warning';
                            }
                        @endphp
                        <tr>
                            <td>{{ $certi->numero_documento }}</td>
                            <td>{{ $certi->apellido_paterno.' '.$certi->apellido_materno.' '.$certi->nombres }}</td>
                            <td>{{ $certi->curso }}</td>
                            <td>{{ date('d/m/Y', strtotime($certi->fecha_curso)) }}</td>
                            <td>
                                <span class="badge badge-pill badge-{{$color}}">{{ ($certi->fecha_vencimiento? date("d/m/Y",strtotime($certi->fecha_vencimiento)) :'--/--/----') }}</span>
                            </td>
                            <td><a href="{{route('certificado.pdf',$certi->certificado_id )}}" class="text-{{$color}}"><i class="fas fa-cloud-download-alt"></i> PDF</a></td>
                        </tr>
                    @endif


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
                    <input type="hidden" value="{{ $certificado->total() }}">
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
