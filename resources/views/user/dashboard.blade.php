{{-- @dd($cursos_recomendados) --}}

@extends('layouts.app')

@section('content')

    <style>
        .div-user-info {
            display: flex;
            justify-content: space-between;
            gap: 2.5rem;
        }

        .div-user-info .user-info-records {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
        }

        .div-user-info .user-info-records .record {
            margin: 1rem;
            padding: 15px 25px;
            display: grid;
            gap: .5rem;
            min-height: 85px;
            min-width: 200px;
            color: rgb(var(--light-c));
            background: linear-gradient(to bottom, rgb(var(--main-c)) 5%, rgb(var(--tert-c)) 200%);
        }

        .div-user-info .user-info-records .record .data {
            font-size: 30pt;
        }

        .div-cursos-scrollbar {
            justify-content: start !important;
            flex-wrap: nowrap !important;
            flex-direction: row !important;
            gap: 2rem;
            padding: 1.5rem .25rem;
            width: 100% !important;
            overflow: hidden;
            overflow-x: visible;
        }

        .div-cursos-scrollbar::-webkit-scrollbar {
            height: 10px;
            background-color: rgba(var(--main-c), .25);
            border-radius: 10px;
        }

        .div-cursos-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(var(--main-c), .75);
            border-radius: 10px;
        }
    </style>

    <section class="container section-view-dashboard py-5">

        <div class="div-user-info d-flex flex-wrap gap-3 align-items-start mt-5">
            <div class="user-info d-flex gap-3 align-items-center">
                <i class="bi bi-person-circle" style="font-size: 90pt;"></i>
                <div>
                    <span class="d-block m-1 fs-3">{{ Auth::user()->name }}</span>
                    <span class="d-block m-1 fs-5">{{ Auth::user()->email }}</span>
                </div>
            </div>
            <div class="user-info-records">
                <div class="d-flex gap-3">
                    <div class="record">
                        <span class="d-flex gap-3 justify-content-between align-items-start">
                            <span>Total</span>
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="data">{{ $amount_cursos }}</span>
                    </div>
                    <div class="record">
                        <span class="d-flex gap-3 justify-content-between align-items-start">
                            <span>Em andamento</span>
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="data">{{ $amount_cursos }}</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="record">
                        <span class="d-flex gap-3 justify-content-between align-items-start">
                            <span>Concluidos</span>
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="data">{{ $amount_cursos }}</span>
                    </div>
                    <div class="record">
                        <span class="d-flex gap-3 justify-content-between align-items-start">
                            <span>Carga horária</span>
                            <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="data">{{ $amount_cursos }} h </span>
                    </div>
                </div>
            </div>

        </div>


        @if (isset($cursos))
            <h2 class="title mt-5 mb-2"> Cursos em andamento </h2>
            <div class="div-cursos div-cursos-scrollbar">
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
                                <span class="creator d-flex align-items-center gap-2">
                                    <div>
                                        <i class="bi bi-person-circle"></i>
                                        <span>{{ $curso->user->name }}</span>
                                    </div>
                                    <div>
                                        <i class="bi bi-tag-fill"></i>
                                        <span>{{ $curso->category->type }}</span>
                                    </div>
                                </span>
                                <span class="desc my-2"> {{ $curso->desc }} </span>
                                <div class="d-flex justify-content-between">
                                    <span> Carga Horária : {{ number_format($curso->duration, 0, ',', '.') }} horas
                                    </span>
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
                    <span class="alert alert-primary">
                        Nenhum curso iniciado até o momento.
                    </span>
                @endforelse
            </div>
        @endif

        @if (isset($cursos_recomendados))
            <h2 class="title mt-5 mb-2">Cursos recomendados</h2>
            <div class="div-cursos  div-cursos-scrollbar">
                @forelse ($cursos_recomendados as $key => $cursoRecom)
                    @php
                        $promotion_price = $cursoRecom->price_in_cents == 0 ? $cursoRecom->price_in_cents : ($cursoRecom->price_in_cents / 100) * (1 - $cursoRecom->promotion);
                        $promotion_price = number_format($promotion_price, 2, ',', '.');
                    @endphp

                    <a class="text-decoration-none" href="{{ route('user.curso', ['slug' => $cursoRecom->slug]) }}">
                        <div class="curso">
                            <div class="img-curso">
                                <img src="{{ asset('storage/' . $cursoRecom->img) }}" alt="">
                            </div>
                            <div class="info-curso">
                                <span class="name"> {{ $cursoRecom->name }} </span>
                                <span class="creator d-flex align-items-center gap-2">
                                    <div>
                                        <i class="bi bi-person-circle"></i>
                                        <span>{{ $cursoRecom->user->name }}</span>
                                    </div>
                                    <div>
                                        <i class="bi bi-tag-fill"></i>
                                        <span>{{ $cursoRecom->category->type }}</span>
                                    </div>
                                </span>
                                <div class="d-flex justify-content-between">
                                    <span> Carga Horária : {{ number_format($cursoRecom->duration, 0, ',', '.') }} horas
                                    </span>
                                </div>

                                <div class="d-flex gap-5 align-items-start my-1 mt-2" style="font-size: 13pt;">
                                    @if ($cursoRecom->price_in_cents == 0)
                                        <span class="text-price-format price"> Gratuito </span>
                                    @else
                                        @if ($cursoRecom->promotion > 0)
                                            <span class="text-price-format price">
                                                R$ {{ $promotion_price }}
                                            </span>
                                            <span class="text-price-format text-decoration-line-through">
                                                R$ {{ number_format($cursoRecom->price_in_cents / 100, 2, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-price-format price"> R$
                                                {{ number_format($cursoRecom->price_in_cents / 100, 2, ',', '.') }}
                                            </span>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    </a>
                @empty
                    <span class="alert alert-primary">
                        Não foram encontrados cursos para serem recomendados de acordo com o seu perfil.
                    </span>
                @endforelse
            </div>
        @endif

        <div class="div-pagination d-flex align-items-center justify-content-center gap-2 my-5">
            {{ $cursos->appends(['search' => isset($search) ? $search : ''])->links('pagination.bootstrap-5') }}
        </div>
    </section>

@endsection

{{-- @section('scripts')
@endsection --}}
