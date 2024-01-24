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
                        <li><a class="dropdown-item"
                                href="{{ route('user.view_cursos', ['category_id' => $category->id]) }}">{{ $category->type }}</a>
                        </li>
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
                                href="{{ route('user.view_cursos', ['category_id' => $category->id]) }}">{{ $category->type }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </header>

    <section class="container section-view-cursos">
        <h1 class="title">
            @if (isset($search) && !empty($search))
                Resultados da Pesquisa: 
                <span class="fw-light fst-italic">{{ $search }}</span>
            @elseif (isset($category_param) && !empty($category_param))
                Cursos disponiveis | Categoria selecionada: 
                <span class="fw-light fst-italic">{{ $category_param->type }}</span>
            @else
                Cursos disponiveis
            @endif
        </h1>
        <div class="div-cursos">
            @if (isset($cursos))
                @forelse ($cursos as $key => $curso)
                    @php
                        $promotion_price = $curso->price_in_cents == 0 ? $curso->price_in_cents : ($curso->price_in_cents / 100) * (1 - $curso->promotion);
                        $promotion_price = number_format($promotion_price, 2, ',', '.');
                    @endphp

                    <a class="text-decoration-none" href="{{ route('user.curso', ['slug' => $curso->slug]) }}">
                        <div class="curso">
                            <div class="img-curso">
                                <img src="{{ asset('storage/' . $curso->img) }}" alt="">
                            </div>
                            <div class="info-curso">
                                <span class="name"> {{ $curso->name }} </span>
                                <span class="desc"> {{ $curso->desc }} </span>
                                <span class="creator"> {{ $curso->user->name }} </span>
                                <div class="d-flex justify-content-between">
                                    <span> Carga Horária : {{ $curso->duration }} horas </span>
                                </div>

                                <div class="d-flex gap-5 align-items-start my-1 mt-2" style="font-size: 13pt;">
                                    @if ($curso->price_in_cents == 0)
                                        <span class="text-price-format price"> Gratuito </span>
                                    @else
                                        @if ($curso->promotion > 0)
                                            <span class="text-price-format price">
                                                R$ {{ $promotion_price }}
                                            </span>
                                            <span class="text-price-format text-decoration-line-through">
                                                R$ {{ number_format($curso->price_in_cents / 100, 2, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-price-format price"> R$
                                                {{ number_format($curso->price_in_cents / 100, 2, ',', '.') }}
                                            </span>
                                        @endif
                                    @endif
                                </div>

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
        <div class="div-pagination d-flex align-items-center justify-content-center gap-2 my-5">
            {{ $cursos->appends(['search' => isset($search) ? $search : ''])->links('pagination.bootstrap-5') }}
        </div>
    </section>
@endsection

@section('scripts')
    <script src="/js/text/format-price.js"></script>
@endsection
