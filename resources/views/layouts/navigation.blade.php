<nav class="navbar">
    <a href="{{ isset(Auth::user()->id) ? route('dashboard') : '\\'  }}" class="nav-brand">
        <img src="https://lh3.googleusercontent.com/Do4YWzwlk61PqRSKr_duNOUn-ivFAE8ErrcdrXCx5_8leA0LkDwz7cjxnlXEIwez-pgP12aJMXqzeEKJzrNZw5vxi9MvM2hlBPpj3aOsqXtdVKDeclE6ybzM2P8HYMkLULS7UrwH_u9t_8hkZzCzXIf6NEHaV2V0zKc_tNDO9FKpd264EtEA9021GcmK3vlJKvmCDlm8sCzaLvFG6JAGBF_WqMjHOVHePy7AByiLfyUZG40lJVwu55gNWqg0gxdzsuvGbUq7a0OnNO11SDIPwy4JqYRlAQLFMAjdxFIIUTB1fLrd_NQUb9uhEKcoUu6vE2ITVYFpD6riiPGjEJWV8v9xubEIUuxJ6h_iNMm8GD0mXJqBzQd76iT5oc6elJSfQ1qlLTWreHcdCghbfuaXD0iS2X3x2lBxYRIXC8DW5mPtupvn-yA2nEyq3MSSMWvdwFko1gLbexfmo-DbNyxr1iYPGHL0Rje5WfkEK28_nB9OqcbQZeKnPt5WVTEzedCZi1yt0urawbLqqh4RHNoeQRoRDkrKu9ZHKuMD0Kb3zMivLHphpRaz_RH6-GghJtEmsmasIariA_-pjEhzlnR-_-Wq9C3-ptKx8caoJTmJwzeokQ5hbrgNtBB5pc2RXmow5dvhnU4v3PdDU2-4ZQKEXf295WLnh36cof_20zbMCcj2HdIJ3yIU1dc2UdECOccNMfJ8xG-tl0TW1gxbD_yy3ENbrcW3mn3XfYIZSWcWojJ155z0GdHzLhj81LoVylElW9gFo_Xqwsbtmz-LYGUge1WNGW8JtSKvBjU4rjOUSBfLoJEoribVi2P1IXpLjImDhbrupe327cRmuEFEVhMAz92FX-BFR5TNVOsuEmZ1yr9u1j1moWG5_e6Vyu7uWwEVvabI0-t1UdfQlnPjAk3XNf3Am4nZKH7RVHJ5E-__jbwxuO9beoTfC3mUygQIR_-ZGmcW4cmE_coHAx3MtNs=w500-h380-s-no?authuser=0"
            alt="logo do site cursos play" class="brand">
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
                        <a href="">
                            <i class="bi bi-plus"></i>
                            <span>Curso</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="">
                            <i class="bi bi-patch-check"></i>
                            <span>Certificados</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="">
                            <i class="bi bi-person-workspace"></i>
                            <span>Matriculas</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-control">
                        <a href="">
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
                        @include('admin.components.offcanvas-navbar-admin')
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
                    <li class="nav-item nav-item-control">
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
