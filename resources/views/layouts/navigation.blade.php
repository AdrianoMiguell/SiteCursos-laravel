<nav id="navbar">
    <div id="logo">LOGO</div>
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
            <a href="{{ url('/dashboard') }}" class="btnGeral">
                <img src="{{ asset('storage/icons/eye.svg') }}" alt="visualize" class="mx-1" width="18"
                height="18">
                Usuário
            </a>
        </div>
    @else
    @endif
    <div class="divUser">
        @if (Route::has('login'))
            @auth
                <a href="{{ route('profile.edit') }}" class="btnGeral"> {{ Auth::user()->name }} </a>
            @else
                <a href="{{ route('login') }}" class="btnGeral">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 btnGeral">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>
