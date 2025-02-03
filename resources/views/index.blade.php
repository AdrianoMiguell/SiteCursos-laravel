{{-- @dd($cursos[0]->user->name) --}}

@extends('layouts.guest')

@section('links')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('welcome')
    <section class="header-welcome m-0 p-5">
        <div class="div-welcome m-5 d-grid">
            <h2 class="text_light_gradient"> Mergulhe em
                Tecnologia </h2>
            <p> Você vai estudar, praticar e discutir e se aprofundar com o apoio de nossos cursos. </p>
        </div>
        <div class="div-welcome d-flex justify-content-evenly gap-5 m-5">
            <div class="d-flex flex-wrap justify-content-center gap-5 px-5">
                @foreach ($categories as $key => $category)
                    @if ($key <= 10)
                        <a class="tags text-decoration-none" href="{{ route('user.view_cursos', ['category_id' => $category->id]) }}">
                            <span> {{ $category->type }} </span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="background-video-message">
        <video autoplay muted="muted" loop class="video">
            <source media="(max-width: 640px)" src="/videos/notebook-livros-garoto-640px.mp4" type="video/mp4">
            <source media="(min-width: 640px)" src="/videos/notebook-livros-garoto-1280px.mp4" type="video/mp4">
        </video>

        <div class="section-message">
            <div class="div-message">
                <span class="fw-bold fs-1"> Os melhores cursos estão aqui! </span>
                <div class="message-cards">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-star"></i>
                                <span> Cursos Top Stars </span>
                            </h5>
                            <p class="card-text">Nossos cursos são referência no mercado e possuem boas avaliações de
                                profissionais.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-cloud-upload"></i>
                                <span> Opções de Upload </span>
                            </h5>
                            <p class="card-text">Você pode baixar os conteúdos e estudar offline.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-lightbulb"></i>
                                <span> Criatividade é o nosso alvo </span>
                            </h5>
                            <p class="card-text"> Vemos na criatividade e inovação as principais caracteristicas de um bom
                                profissional. </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-lightning"></i>
                                <span> Aprendizado ágil </span>
                            </h5>
                            <p class="card-text"> Te entregamos um conteúdo completo, objetivo e ágil. Nossos cursos se
                                concentram nos conteúdos essenciais para o seu sucesso e desenvolvimento. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="allCursos" class="container section-cursos">

        <h4 class="text-center fw-bolder fs-2">Cursos disponiveis</h4>

        {{-- O Search vai estar numa página separada, onde o usuario vai poder pesquisar e encontrar todos os cursos  --}}
        {{-- <div class="search_div">
            <form action="{{ route('index') }}" method="get" class="search_form">
                <legend> Pesquise e encontre o que você procura </legend>
                <div>
                    <input type="search" name="search" id="search_input" maxlength="25" size="30">
                    <button type="submit" class="search_btn btnGeral">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        Pesquisar
                    </button>
                </div>
            </form>
        </div> --}}

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
                        <span class="text-center">Nenhum curso cadastrado ainda. <br> Fique ligado pois em breve os
                            cursos
                            serão abertos!</span>
                    </div>
                @endforelse
            @endif
        </div>
        <div class="my-5">
            <a href="{{ route('user.view_cursos') }}" class="btnGeral btnGeral-dark py-3 px-5">
                Ver mais
            </a>
        </div>
    </section>

@endsection


@section('scripts')
@endsection
