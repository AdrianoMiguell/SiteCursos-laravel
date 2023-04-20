<style>
    #btnPerfil {
        z-index: 3;
    }

    #divPerfil {
        position: absolute;
        width: 9em;
        transform: translate(4px, 1px);
        z-index: 1;
        text-align: center;
    }

    #divPerfil>a {
        text-decoration: none;
        color: #fff;

    }

    #divPerfil>a:hover {
        background-color: rgba(var(--white-cor), .05);
        color: rgb(var(--sec-cor));
    }
</style>

<nav id="navbar">
    <a href="/" id="logo_link">
        <div id="logo_div">
            <img src="https://lh3.googleusercontent.com/Do4YWzwlk61PqRSKr_duNOUn-ivFAE8ErrcdrXCx5_8leA0LkDwz7cjxnlXEIwez-pgP12aJMXqzeEKJzrNZw5vxi9MvM2hlBPpj3aOsqXtdVKDeclE6ybzM2P8HYMkLULS7UrwH_u9t_8hkZzCzXIf6NEHaV2V0zKc_tNDO9FKpd264EtEA9021GcmK3vlJKvmCDlm8sCzaLvFG6JAGBF_WqMjHOVHePy7AByiLfyUZG40lJVwu55gNWqg0gxdzsuvGbUq7a0OnNO11SDIPwy4JqYRlAQLFMAjdxFIIUTB1fLrd_NQUb9uhEKcoUu6vE2ITVYFpD6riiPGjEJWV8v9xubEIUuxJ6h_iNMm8GD0mXJqBzQd76iT5oc6elJSfQ1qlLTWreHcdCghbfuaXD0iS2X3x2lBxYRIXC8DW5mPtupvn-yA2nEyq3MSSMWvdwFko1gLbexfmo-DbNyxr1iYPGHL0Rje5WfkEK28_nB9OqcbQZeKnPt5WVTEzedCZi1yt0urawbLqqh4RHNoeQRoRDkrKu9ZHKuMD0Kb3zMivLHphpRaz_RH6-GghJtEmsmasIariA_-pjEhzlnR-_-Wq9C3-ptKx8caoJTmJwzeokQ5hbrgNtBB5pc2RXmow5dvhnU4v3PdDU2-4ZQKEXf295WLnh36cof_20zbMCcj2HdIJ3yIU1dc2UdECOccNMfJ8xG-tl0TW1gxbD_yy3ENbrcW3mn3XfYIZSWcWojJ155z0GdHzLhj81LoVylElW9gFo_Xqwsbtmz-LYGUge1WNGW8JtSKvBjU4rjOUSBfLoJEoribVi2P1IXpLjImDhbrupe327cRmuEFEVhMAz92FX-BFR5TNVOsuEmZ1yr9u1j1moWG5_e6Vyu7uWwEVvabI0-t1UdfQlnPjAk3XNf3Am4nZKH7RVHJ5E-__jbwxuO9beoTfC3mUygQIR_-ZGmcW4cmE_coHAx3MtNs=w500-h380-s-no?authuser=0"
                alt="logo do site cursos play">
                <span>Cursos Play</span>
        </div>
    </a>

    @if (isset(Auth::user()->id))
        {{-- visão do usuario, criar curso, ver cursos,  --}}
        @if (Route::has('login') && Auth::user()->type == '1')
            <div id="content">
                <a class="btnGeral" href="{{ route('view.cursos') }}">
                    <img src="{{ asset('storage/icons/eye.svg') }}" alt="visualize" class="mx-1" width="18"
                        height="18">
                    Cursos
                </a>
                <a class="btnGeral" href="{{ route('view-create-curso') }}">
                    <img src="{{ asset('storage/icons/plus-circle.svg') }}" alt="visualize" class="mx-1">
                    Curso
                </a>
            </div>
        @else
        @endif
    @else
    @endif

    <div class="divUser">
        @if (Route::has('login') && isset(Auth::user()->id))
            @if (Auth::user()->type == 1)
                <a class="btnGeral d-flex align-items-center gap-2" style="font-size: 10pt;"
                    href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    {{ Auth::user()->name }}
                </a>
            @else
                <button class="btnGeral d-flex align-items-center gap-2" style="font-size: 10pt;" id="btnPerfil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    {{ Auth::user()->name }}
                </button>
                <div id="divPerfil" class="d-grid gap-2 m-0 p-2 section_gradient_dark">
                    <a href="{{ route('profile.edit') }}"> perfil </a>
                    <a href="{{ route('dashboard') }}"> meus cursos </a>
                    <a href="{{ route('profile.edit') }}"> sobre nós </a>
                </div>
            @endif
        @else
            @auth
            @else
                <a href="{{ route('login') }}" class="btnGeral">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 btnGeral">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<script src="/js/navigator/perfil.js"></script>
