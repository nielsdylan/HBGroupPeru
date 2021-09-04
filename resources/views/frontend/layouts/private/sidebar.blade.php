<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (session('hbgroup')['image'])
                        <img src="{{asset('assets/img/user/'.session('hbgroup')['image'])}}" alt="..." class="avatar-img rounded-circle">
                    @else
                        <img src="{{asset('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                    @endif

                </div>
                <div class="info">
                    <a  href="{{route('perfil.index')}}" >
                        <span>
                            {{session('hbgroup')['name']}}
                            <span class="user-level">{{session('hbgroup')['group']}}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                </div>
            </div>
            <ul class="nav">
                @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5 || session('hbgroup')['group_id'] == 4)
                <li class="nav-item">
                    <a data-toggle="collapse" href="#cours">
                        <i class="fas fa-server"></i>
                        <p>Académico</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="cours">
                        <ul class="nav nav-collapse">
                            @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5)
                            <li>
                                <a href="{{route('cursos.index')}}">
                                    <span class="sub-item">Cursos</span>
                                </a>
                            </li>
                            @endif
                            @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5)
                            <li>
                                <a href="{{route('participantes.index')}}">
                                    <span class="sub-item">Participantes</span>
                                </a>
                            </li>
                            @endif
                            @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5)
                            <li>
                                <a href="{{route('asignatura.index')}}">
                                    <span class="sub-item">Asignatura</span>
                                </a>
                            </li>
                            @endif
                            @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5)
                            <li>
                                <a href="{{route('certificado.index')}}">
                                    <span class="sub-item">Certificados</span>
                                </a>
                            </li>
                            @endif
                            @if (session('hbgroup')['group_id'] == 4)
                            <li>
                                <a href="{{route('mis-cursos.index')}}">
                                    <span class="sub-item">Mis cursos</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if (session('hbgroup')['group_id'] == 1)
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sede-turn">
                        <i class="far fa-building"></i>
                        <p>Sedes y turnos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sede-turn">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('sede-turno.index')}}">
                                    <span class="sub-item">Sedes y Turnos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('sede.index')}}">
                                    <span class="sub-item">Sedes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('turno.index')}}">
                                    <span class="sub-item">Turnos</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                @endif
                @if (session('hbgroup')['group_id'] == 1 || session('hbgroup')['group_id'] == 5)
                <li class="nav-item">
                    <a data-toggle="collapse" href="#comercial">
                        <i class="fas fa-store-alt"></i>
                        <p>Comercial</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="comercial">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('cliente.index')}}">
                                    <span class="sub-item">Clientes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('calendario.index')}}">
                                    <span class="sub-item">Calendario</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item submenu">
                    <a  href="{{route('email.index')}}">
                        <i class="far fa-envelope"></i>
                        <p>Email</p>
                    </a>
                    {{-- <div class="collapse" id="email-app-nav">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('email.index')}}">
                                    <span class="sub-item">Correo nuevo</span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
            </ul>
        </div>
    </div>
</div>
