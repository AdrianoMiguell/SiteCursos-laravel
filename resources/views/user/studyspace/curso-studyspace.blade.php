@extends('layouts.app')

@section('content')
    <section class="section-curso-studyspace">

        <div class="section-conteudo">
            @if (isset($conteudo->video_id))
                @include('user.studyspace.curso-studyspace-video')
            @elseif(isset($conteudo->apostila_id))
                @include('user.studyspace.curso-studyspace-apostila')
            @elseif(isset($conteudo->slide_id))
                @include('user.studyspace.curso-studyspace-slide')
            @elseif(isset($conteudo->desafio_id))
                @include('user.studyspace.curso-studyspace-desafio')
            @else
                <span class="alert alert-danger my-5">Houve um problema no carregamnto do conteúdo. Reporte esse problema e
                    aguarde solucionarmos ele.</span>
            @endif
        </div>

        <style>
            .section-curso-studyspace .div-conteudos .conteudo-lock * {
                color: rgba(var(--main-c), .75);
            }

            .section-curso-studyspace .div-conteudos .conteudo-unlock * {
                color: rgb(var(--main-c));
            }

            .section-curso-studyspace .div-conteudos .conteudo-atual * {
                color: rgba(var(--sec-c), 1) !important;
                text-shadow: 0 0 1px rgba(var(--main-c), .75) inset;
            }

            .section-curso-studyspace .div-conteudos .conteudo-link {
                text-decoration: none;
            }

            .section-curso-studyspace .div-conteudos .conteudo-atual:hover {
                background-color: rgba(var(--sec-c), .15) !important;
            }

            .section-curso-studyspace .div-conteudos .conteudo-link:hover {
                background-color: rgba(var(--main-c), .05);
            }
        </style>

        <div class="div-conteudos container my-5">

            <h2 class="my-2"> Conteúdos </h2>

            <div class="accordion" id="accordionModulos">
                @foreach ($curso->modulos as $key_modulo => $moduloItem)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseModulo{{ $key_modulo }}" aria-expanded="false"
                                aria-controls="collapseModulo{{ $key_modulo }}">
                                <span>
                                    <strong> {{ $key_modulo + 1 }}° Modúlo - </strong>
                                    {{ $moduloItem->title }}
                                </span>
                            </button>
                        </h2>

                        <div id="collapseModulo{{ $key_modulo }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionModulos">
                            <div class="accordion-body">
                                @if (count($moduloItem->conteudos) > 0)
                                    @foreach ($moduloItem->conteudos as $key_conteudo => $conteudoItem)
                                        @if (
                                            $moduloItem->order < $matricula->modulo->order ||
                                                ($moduloItem->order == $matricula->modulo->order && $conteudoItem->order <= $matricula->conteudo->order))
                                            @php
                                                $visible = true;
                                                $conteudoItemClass = 'accordion-conteudo conteudo-unlock d-flex justify-content-between align-items-center gap-1';
                                                $conteudoItemIcon = '<span class="order-2">
                                                    <i class="bi bi-unlock-fill"></i>
                                                </span>';
                                                $conteudoItemLinkHref = route('user.curso.studyspace', ['slug' => $curso->slug, 'modulo' => $moduloItem->id, 'conteudo' => $conteudoItem->id]);
                                            @endphp
                                        @else
                                            @php
                                                $visible = false;

                                                $conteudoItemClass = 'accordion-conteudo conteudo-lock d-flex justify-content-between align-items-center gap-1';
                                                $conteudoItemIcon = '<span class="order-2">
                                                    <i class="bi bi-lock-fill"></i>
                                                </span>';
                                                $conteudoItemLinkHref = '#block';
                                            @endphp
                                        @endif

                                        <div class="{{ $conteudoItemClass }}">
                                            @if (isset($conteudoItem->video_id))
                                                <a href="{{ $conteudoItemLinkHref }}"
                                                    class="conteudo-link p-2 m-1 flex-fill order-1  @if ($conteudoItem->id == $conteudo->id) conteudo-atual @endif">
                                                    {{ $conteudoItem->video->title }} (video) {{ $conteudoItem->order }}
                                                </a>
                                            @elseif(isset($conteudoItem->apostila_id))
                                                <a href="{{ $conteudoItemLinkHref }}"
                                                    class="conteudo-link p-2 m-1 flex-fill order-1"
                                                    @if ($conteudoItem->id == $conteudo->id) style = "color: rgb(var(--tert-c)) !important;" @endif>
                                                    {{ $conteudoItem->apostila->title }} (apostila)
                                                </a>
                                            @elseif(isset($conteudoItem->slide_id))
                                                <a href="#" class="conteudo-link p-2 m-1 flex-fill order-1"
                                                    @if ($conteudoItem->id == $conteudo->id) style = "color: rgb(var(--tert-c)) !important;" @endif>
                                                    {{ $conteudoItem->slide->title }} (slide)
                                                </a>
                                            @elseif(isset($conteudoItem->desafio_id))
                                                <a href="#" class="conteudo-link p-2 m-1 flex-fill order-1"
                                                    @if ($conteudoItem->id == $conteudo->id) style = "color: rgb(var(--tert-c)) !important;" @endif>
                                                    {{ $conteudoItem->desafio->title }} (desafio)
                                                </a>
                                            @endif

                                            @php
                                                echo $conteudoItemIcon;
                                            @endphp
                                        </div>

                                        @if ($key_conteudo == count($moduloItem->conteudos) - 1 && !empty($moduloItem->quizzes))
                                            <div
                                                class="accordion-conteudo  d-flex justify-content-between align-items-center gap-1 {{ $visible ? 'conteudo-unlock' : 'conteudo-lock' }}">

                                                @if ($visible)
                                                    <a href="{{ route('user.curso.studyspace.quiz', ['slug', $curso->slug, 'modulo_id' => $moduloItem->id, 'matricula_id' => $matricula->id]) }}"
                                                        class="conteudo-link p-2 m-1 flex-fill order-1">
                                                        Quiz
                                                    </a>
                                                    <span class="order-2">
                                                        <i class="bi bi-unlock-fill"></i>
                                                    </span>
                                                @else
                                                    <a class="conteudo-link p-2 m-1 flex-fill order-1" href="#">
                                                        Quiz
                                                    </a>
                                                    <span class="order-2">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-center"> Nenhum conteúdo. </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
