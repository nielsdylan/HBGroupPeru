<div class="main-header" data-background-color="purple">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HBGROUPP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <div class="dropdown">
                            <a class="btn btn-primary " href="{{route('dashboard')}}">
                                Dashboard
                            </a>

                        </div>
                        {{-- <a class="nav-link" href="{{route('dashboard')}}">Dashboard <span class="sr-only">(current)</span></a> --}}
                    </li>
                    <li class="nav-item ">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chalkboard-teacher"></i>
                                Administrador
                            </button>
                            <div class="dropdown-menu animated fadeIn" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('setting')}}"><i class="fas fa-cog"></i> Configuraci&oacute;n</a>
                                <a class="dropdown-item" href="{{ route('group.index')}}"><i class="
                                    fas fa-users
                                    "></i> Grupos</a>
                                <a class="dropdown-item" href="{{route('list_user')}}"><i class="fas fa-user-plus"></i> Usuario</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i>
                                Landing
                            </button>
                            <div class="dropdown-menu animated fadeIn" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('slider.index')}}"><i class="fas fa-images"></i> Sliders</a>
                                <a class="dropdown-item" href="{{route('business.index')}}"><i class="fas fa-list"></i> Empresas</a>
                                <a class="dropdown-item" target="_blank" href="{{route('index')}}"><i class="fas fa-globe-americas"></i> Vista previa</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav topbar-nav ml-md-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-alt"></i>

                            </button>
                            <div class="dropdown-menu animated fadeIn" aria-labelledby="dropdownMenuButton">


                                <a class="dropdown-item" href="{{route('logout.logout')}}"><i class="fas fa-power-off"></i> Cerrar session</a>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

    </nav>
</div>
