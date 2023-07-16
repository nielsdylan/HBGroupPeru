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
                                <a href="{{route('certificado.index')}}">
                                    <span class="sub-item">Certificados</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
