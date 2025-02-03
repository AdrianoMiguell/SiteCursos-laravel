<nav class="navbar">
    <a href="{{ isset(Auth::user()->id) ? route('dashboard') : '\\' }}" class="nav-brand">
        <img src="{{asset('storage/permanent/logo_curso.png')}}" alt="logo do site cursos play" class="brand">
        <span>Cursos Play</span>
    </a>

    <div class="nav-container">

        @if (Auth::check() && Auth::user()->type == 1)
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item nav-item-control">
                        <a href="{{ route('workspace') }}">
                            <i class="bi bi-eye-fill"></i>
                            <span>Cursos</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="{{ route('curso.view', ['curso_id' => null]) }}">
                            <i class="bi bi-plus"></i>
                            <span>Curso</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="{{route('curso.insoon')}}">
                            <i class="bi bi-patch-check"></i>
                            <span>Certificados</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="{{route('curso.insoon')}}">
                            <i class="bi bi-person-workspace"></i>
                            <span>Matriculas</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="{{route('curso.insoon')}}">
                            <i class="bi bi-envelope-check-fill"></i>
                            <span>Termos</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item nav-item-name">
                        <a href="{{ route('profile.view') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item nav-item-offcanvas">
                        @include('components.offcanvas-navbar-user')
                    </li>
                </ul>
            @endauth
        @else
            <ul class="navbar-nav justify-content-center" style="flex: 1;">
                <li class="nav-item">
                    <div class="search">
                        <form action="{{ route('user.view_cursos') }}" method="get" class="d-flex form-search">
                            <input type="search" name="search" id="search" class="form-control"
                                value="{{ isset($search) ? $search : '' }}">
                            <button type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item nav-item-name">
                        <a href="{{ route('profile.view') }}">{{ Auth::user()->name }}</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="ml-4 btnGeral">Register</a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="{{ route('login') }}" class="btnGeral">Log in</a>
                    </li>
                @endguest
                <li class="nav-item nav-item-offcanvas">
                    @include('components.offcanvas-navbar-user')
                </li>
            </ul>
        @endif
    </div>
</nav>

<script src="/js/navigator/perfil.js"></script>
