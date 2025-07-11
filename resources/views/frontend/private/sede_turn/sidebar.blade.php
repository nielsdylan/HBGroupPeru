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
                <li class="nav-item">
                    <a data-toggle="collapse" href="#cours">
                        <i class="fas fa-server"></i>
                        <p>Cursos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="cours">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('cursos.index')}}">
                                    <span class="sub-item">Lista de cursos</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#sede-turn">
                        <i class="far fa-building"></i>
                        <p>Sedes y turnos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sede-turn">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('sede.index')}}">
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


            </ul>
        </div>
    </div>
</div>
