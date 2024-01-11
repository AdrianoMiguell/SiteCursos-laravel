@extends('layouts.guest')

@section('links')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('content')

    <header class="mt-0 mb-5 user-header-options">
        <div class="options-items">
            <div class="dropdown more-categories">
                <a class="btn-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i>
                    <span class="mx-1"> Filter </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#"> Mais Populares </a>
                        <a class="dropdown-item" href="#"> Mais Recentes </a>
                        {{-- <a class="dropdown-item" href="#"> Mais Relevantes </a> --}}
                    </li>
                </ul>
            </div>
            <div class="dropdown more-categories">
                <a class="btn-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sort-alpha-up"></i>
                    <span class="mx-1"> {{ isset($order) ? $order->title : 'Ordenar Por' }} </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#"> Mais Populares </a>
                        <a class="dropdown-item" href="#"> Mais Recentes </a>
                        {{-- <a class="dropdown-item" href="#"> Mais Relevantes </a> --}}
                    </li>
                </ul>
            </div>
            <div class="dropdown more-categories">
                <a class="btn-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-tags-fill"></i>
                    <span class="mx-1">Categorias</span>
                </a>
                <ul class="dropdown-menu">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="dropdown more-pops">
                <a class="btn-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-star-fill"></i>
                    <span class="mx-1">Mais Populares</span>
                </a>
                <ul class="dropdown-menu">
                    @foreach ($populares_categories as $category)
                        <li><a class="dropdown-item"
                                href="{{ route('user.view_cursos', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </header>

    <section class="container section-view-cursos p-5">
        <h1> Cursos </h1>
        <div class="div-cursos">
            @if (isset($cursos))
                @forelse ($cursos as $key => $curso)
                    <a class="text-decoration-none" href="{{ route('view.curso', ['curso_id' => $curso->id]) }}">
                        <div class="curso">
                            <div class="img-curso">
                                <img src="{{ asset('storage/' . $curso->img) }}" alt="">
                            </div>
                            <div class="info-curso">
                                <span class="name"> {{ $curso->name }} </span>
                                <span class="creator"> {{ $curso->user->name }} </span>
                                <div class="d-flex justify-content-between">
                                    <span> Duração : {{ $curso->duration }} </span>
                                </div>
                                @if ($curso->promotion_price == 0)
                                    <span class="price"> Gratuito </span>
                                @else
                                    <span class="price"> Preço: R$ {{ $curso->promotion_price }} </span>
                                @endif

                            </div>
                        </div>
                    </a>
                @empty
                    <div class="message">
                        <span class="text-center">Nenhum curso cadastrado ainda. <br> Fique ligado pois em breve os cursos
                            serão abertos!</span>
                    </div>
                @endforelse
            @endif
        </div>
        <div class="div-pagination d-flex align-items-center justify-content-center gap-2">
            {{ $cursos->appends(['search' => isset($search) ? $search : ''])->links('pagination.bootstrap-5') }}
        </div>
    </section>
@endsection
