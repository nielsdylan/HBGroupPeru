<div class="main-header" data-background-color="purple">
    <nav class="navbar navbar-expand-lg bg-primary">
        <a class="navbar-brand" href="#">HBGROUPP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administrador
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('setting')}}">Configuración</a>
                            <a class="dropdown-item" href="{{ route('group.index')}}">Grupos</a>
                            <a class="dropdown-item" href="{{route('list_user')}}">Usuario</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Landing
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('slider.index')}}">Sliders</a>
                            <a class="dropdown-item" href="{{route('business.index')}}">Empresas</a>
                            <a class="dropdown-item" href="{{route('list_user')}}">Usuario</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item text-right">
                    <a href="{{route('logout.logout')}}" class="nav-link "> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
