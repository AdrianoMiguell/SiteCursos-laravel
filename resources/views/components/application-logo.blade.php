<a href="{{ isset(Auth::user()->id) ? route('dashboard') : '\\' }}" class="nav-brand">
    <img src="{{asset('storage/permanent/logo_curso.png')}}" alt="logo do site cursos play" class="brand" width="75px">
    <span>Cursos Play</span>
</a>