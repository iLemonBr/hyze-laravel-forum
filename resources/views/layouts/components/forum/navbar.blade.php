<header>
    <div class="container">
        <nav class="navbar navbar-expand-md bd-navbar navbar-dark navbar-hyze mt-3 mb-3">
            <a class="navbar-brand mr-0 mr-md-2" href="{{ route('home') }}">
                <span></span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link mr-3 ml-3" href="{{ route('home') }}">Início</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('forums.*') ? 'active' : '' }}">
                        <a class="nav-link mr-3 ml-3" href="{{ route('forums.home') }}">
                            Comunidade
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mr-3 ml-3" href="https://loja.hyze.net" target="_blank">
                            Loja
                        </a>
                    </li>

                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-white ml-3 bg-primary rounded-pill px-3">
                            Entrar
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle ml-3 bg-primary rounded-pill px-3" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nick }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->isSuperAdmin())
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tools fa-fw text-secondary  mr-2"></i> Admin
                            </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('profile.details') }}">
                                <i class="far fa-id-card fa-fw text-secondary  mr-2"></i> Perfil
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw text-secondary  mr-2"></i> Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>