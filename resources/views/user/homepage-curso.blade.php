{{-- @dd($curso) --}}
@extends('layouts.guest')

@section('content')
    @php
        $price = number_format($curso->price_in_cents == 0 ? $curso->price_in_cents : ($curso->price_in_cents / 100) * (1 - $curso->promotion), 2, ',', '.');
    @endphp

    <style>
        .section-view-curso {
            margin-bottom: 2.5em;
        }

        .section-view-curso .view-curso {
            display: flex;
            align-items: flex-start;
            justify-content: space-evenly;
            flex-wrap: wrap;
            gap: 2rem 1rem;
            margin: 3.5em 0;
        }

        .section-view-curso .view-curso .div-img {
            min-width: 400px;
            width: 40vw;
            max-width: 600px;
        }

        .section-view-curso .view-curso .div-info {
            min-width: 300px;
        }

        .section-view-curso .view-curso .div-img img {
            width: 100%;
            height: auto;
        }

        .section-view-curso .view-curso .div-info {
            flex: 1;
            padding: 1rem;
            padding-top: 0;
            height: 100%;
            min-height: 300px
        }

        .section-view-curso .view-curso .div-info .desc {
            display: block;
            color: rgb(var(--main-c));
            margin: 1rem 0;
        }

        .section-view-curso .view-curso .div-info .duration-type-date {
            color: rgba(var(--main-c), .85);
            font-size: 10.5pt;
        }
    </style>

    <section class="container section-view-curso">



        <div class="view-curso">

            <div class="div-img">
                <img src="{{ asset('storage/' . $curso->img) }}" alt="">
            </div>

            <div class="div-info d-flex flex-column justify-content-between gap-5">
                <div>
                    <h1 class="title"> {{ $curso->name }} </h1>
                    <span class="desc"> {{ $curso->desc }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia
                        dolore laudantium ipsum voluptatibus perferendis laboriosam harum et reprehenderit nam repudiandae!
                        Praesentium tempora rem cum, nisi quasi expedita eveniet aspernatur! Officia. Lorem ipsum, dolor sit
                        amet consectetur adipisicing elit. Aut similique, dolor debitis obcaecati neque iure dolorem
                        perferendis voluptates quaerat ullam sapiente ad quae repellendus quam laborum illo officiis
                        laboriosam esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ad inventore aliquid
                        incidunt, nihil voluptate placeat, quo libero ut corporis voluptatem nam unde nemo eius quod beatae,
                        quam animi. Quaerat. </span>
                    <div class="duration-type-date">
                        <span class="duration"> {{ $curso->duration }} horas </span>
                        &bull;
                        <span class="category"> Categoria: {{ $curso->category->type }} </span>
                        &bull;
                        <span class="release_date"> Data de criação: {{ date('d/m/Y', strtotime($curso->release_date)) }}
                        </span>
                    </div>
                </div>
                <form
                    action="{{ $curso->price_in_cents == 0 || $curso->promotion == 1 ? route('curso.matricula.create', ['slug' => $curso->slug]) : route('user.curso.pay', ['slug' => $curso->slug]) }}"
                    method="post" class="d-flex justify-content-end">

                    @csrf

                    <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                    <input type="hidden" name="matricula_id" value="{{ isset($matricula->id) ? $matricula->id : '' }}">

                    <button type="submit" class="btnGeral btnGeral-dark py-3 px-5">
                        @if (isset($matricula->id))
                            <span class="d-flex justify-content-center align-items-center gap-2">
                                <i class="bi bi-eye-fill"></i>
                                <span>Curso</span>
                            </span>
                        @else
                            @if ($curso->price_in_cents == 0 || $curso->promotion == 1)
                                <span>Matricular-se</span>
                            @else
                                Comprar por R$ {{ $price }}
                            @endif
                        @endif
                    </button>
                </form>
            </div>

        </div>



    </section>
@endsection
