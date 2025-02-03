<button class="btnGeral btnGeral-light btn-offcanvas" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvas-navbar-user" aria-controls="offcanvas-navbar-user">
    <i class="bi bi-list"></i>
</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="offcanvas-navbar-user" aria-labelledby="offcanvas-navbar-userLabel" style="width: 300px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title d-inline-block text-truncate p-3" id="offcanvas-navbar-userLabel"
            style="max-width: 250px; overflow: hidden;">
            @auth
                <a href="{{ route('profile.view') }}">
                    {{ Auth::user()->name }}
                </a>
            @endauth
            @guest
                Cursos Play
            @endguest
        </h5>
        <button type="button" class="offcanvas-btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        @if (Auth::check() && Auth::user()->type == 1)
            <ul class="p-4 offcanvas-menu">
                <li class="offcanvas-item">
                    <a href="{{ route('workspace') }}">
                        <i class="bi bi-eye-fill"></i>
                        <span>Cursos</span>
                    </a>
                </li>
                <li class="offcanvas-item">
                    <a href="">
                        <i class="bi bi-plus"></i>
                        <span>Curso</span>
                    </a>
                </li>
                <li class="offcanvas-item">
                    <a href="">
                        <i class="bi bi-patch-check"></i>
                        <span>Certificados</span>
                    </a>
                </li>
                <li class="offcanvas-item">
                    <a href="">
                        <i class="bi bi-person-workspace"></i>
                        <span>Matriculas</span>
                    </a>
                </li>
                <li class="offcanvas-item">
                    <a href="">
                        <i class="bi bi-envelope-check-fill"></i>
                        <span>Termos</span>
                    </a>
                </li>
            </ul>
        @else
            <div class="search my-3 p-2">
                <form action="{{ route('user.view_cursos') }}" method="get" class="d-flex form-search">
                    <input type="search" name="search" id="search" class="form-control"
                        value="{{ isset($search) ? $search : '' }}">
                    <button type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <ul class="navbar-nav">
                @if (!isset(Auth::user()->id))
                    <li class="offcanvas-item">
                        <a href="{{ route('register') }}" class="ml-4 btnGeral">Register</a>
                    </li>
                    <li class="offcanvas-item">
                        <a href="{{ route('login') }}" class="btnGeral">Log in</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
</div>
