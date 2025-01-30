@extends('layouts.app')

@section('content')

    @include('admin.header-options')

    <style>
        .type-conteudo {
            font-size: 9.5pt;
            color: rgba(var(--main-c), .85)
        }
    </style>

    <section class="container workspace-curso">
        <div class="info-curso mb-3">
            <h2 class="title fs-2 name"> {{ $curso->name }} </h2>
            <span class="desc"> {{ $curso->desc }} </span>
            <div class="div-info">
                <div>
                    <h3 class="title fs-4 my-2"> Informações </h3>
                    <span class="duration">Categoria : {{ $curso->category->name }} </span>
                    <span class="duration">Carga Horária : {{ $curso->duration }} </span>
                    <span class="price_in_cents"> Preço : R$ {{ $curso->price_in_cents }} </span>
                    <span class="promotion"> Promoção Atual: {{ $curso->promotion }}% </span>
                    <span class="promotion_price">Preço Promocional: {{ $curso->promotion_price }}</span>
                    <span class="quant_ready">Taxa de conclusão: 0% </span>
                    <span class="quant-modulos">Quantidade de Modulos: {{ count($curso->modulos) }} </span>
                    {{-- <span class="quant-conteudos"> Quantidade de conteúdos: {{ count($curso->conteudos) }} </span> --}}
                </div>
                <div class="div-img">
                    <img src="{{ asset('storage/' . $curso->img) }}" alt="">
                </div>
            </div>
        </div>

        @if (isset($curso->modulos) && count($curso->modulos) > 0)
            <div class="sec-modulos my-3">
                <h2> Modúlos </h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> id </th>
                            <th scope="col"> Title </th>
                            <th scope="col"> Descrição </th>
                            <th scope="col">
                                Opções
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($curso->modulos as $key => $modulo)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $modulo->title }}</td>
                                <td>{{ $modulo->desc }}</td>
                                <td>
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <a href="{{ route('modulo.view', ['curso_id' => $curso->id, 'modulo_id' => $modulo->id]) }}"
                                            class="btnGeral btnGeral-dark p-1 px-2">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        @include('admin.deletion.delete-modulo')
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif

        <style>
            .accordion-conteudo {
                margin: 5px 0;
                padding: .5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .accordion-conteudo:hover {
                background-color: rgba(var(--main-c), .025);
            }
        </style>

        <div class="sec-conteudos my-3">
            @if (!isset($curso->modulos[0]) || !isset($curso->modulos[0]->conteudos))
                <div class="alert alert-danger">
                    <span> Nenhum Conteúdo Postado </span>
                </div>
            @else
                <div class="div-conteudos">

                    <h2> Conteúdos </h2>

                    <div class="accordion" id="accordionModulos">
                        @foreach ($curso->modulos as $key_modulo => $modulo)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseModulo{{ $key_modulo }}" aria-expanded="false"
                                        aria-controls="collapseModulo{{ $key_modulo }}">
                                        <span>
                                            <strong> {{ $key_modulo + 1 }}° Modúlo - </strong>
                                            {{ $modulo->title }}
                                        </span>
                                    </button>
                                </h2>

                                <div id="collapseModulo{{ $key_modulo }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionModulos">
                                    <div class="accordion-body">
                                        @if (count($modulo->conteudos) > 0)
                                            @foreach ($modulo->conteudos as $key_conteudo => $conteudo)
                                                <div class="accordion-conteudo">
                                                    @if (isset($conteudo->video_id))
                                                        <div>
                                                            <span class="conteudo-title">{{ $conteudo->video->title }}
                                                            </span>
                                                            <span class="mx-1 type-conteudo">(video)</span>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-1">
                                                            @include('admin.edition.edit-video')
                                                            @include('admin.deletion.delete-video')
                                                        </div>
                                                    @elseif(isset($conteudo->apostila_id))
                                                        <div>
                                                            <span
                                                                class="conteudo-title">{{ $conteudo->apostila->title }}</span>
                                                            <span class="mx-1 type-conteudo">(apostila)</span>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-1">
                                                            @include('admin.edition.edit-apostila')

                                                            @include('admin.deletion.delete-apostila')
                                                        </div>
                                                    @elseif(isset($conteudo->slide_id))
                                                        <div>
                                                            <span
                                                                class="conteudo-title">{{ $conteudo->slide->title }}</span>
                                                            <span class="mx-1 type-conteudo">(slide)</span>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-1">
                                                            @include('admin.edition.edit-slide')
                                                            @include('admin.deletion.delete-slide')
                                                        </div>
                                                    @elseif(isset($conteudo->desafio_id))
                                                        <div>
                                                            <span
                                                                class="conteudo-title">{{ $conteudo->desafio->title }}</span>
                                                            <span class="mx-1 type-conteudo">(desafio)</span>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between gap-1">
                                                            @include('admin.edition.edit-desafio')
                                                            @include('admin.deletion.delete-desafio')
                                                        </div>
                                                    @else
                                                        <span class="text-danger">(Conteúdo desconhecido ou com
                                                            problemas)</span>
                                                    @endif
                                                </div>
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
            @endif
        </div>

        <style>
            .sec-quiz {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .div-table-quiz {
                flex: 1;
                max-width: 100%;
                overflow-x: visible;
            }

            .div-table-quiz table {
                max-width: 100%;
            }

            .div-table-quiz .table thead {
                font-weight: 700;
                text-transform: capitalize;
            }

            .div-table-quiz .table th,
            .div-table-quiz .table tbody td:not(.td-question) {
                text-align: center;
            }
        </style>

        <div class="sec-questions">
            <h2 class="mt-5 mb-3"> Questionários </h2>

            @if (isset($curso->quiz) && count($curso->quiz) > 0)
                <div class="sec-quiz">
                    <div class="div-table-quiz">

                        <table class="table">
                            <thead>
                                <tr scope="col">
                                    <th>id</th>
                                    <th>question</th>
                                    <th>alt1</th>
                                    <th>alt2</th>
                                    <th>alt3</th>
                                    <th>alt4</th>
                                    <th>alt5</th>
                                    <th>order</th>
                                    <th>curso_id</th>
                                    <th>modulo_id</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($curso->quiz as $key_quiz => $quiz)
                                    <tr>
                                        <th> {{ $quiz->id }} </th>
                                        <td class="td-question"> {{ $quiz->question }} </td>
                                        <td> {{ $quiz->alt1 }} </td>
                                        <td> {{ $quiz->alt2 }} </td>
                                        <td> {{ $quiz->alt3 }} </td>
                                        <td> {{ $quiz->alt4 }} </td>
                                        <td> {{ $quiz->alt5 }} </td>
                                        <td> {{ $quiz->order }} </td>
                                        <td> {{ $quiz->curso_id }} </td>
                                        <td> {{ !empty($quiz->modulo_id) ? $quiz->modulo_id : 'Nenhum' }} </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <div class="td-quiz-edit">
                                                    @include('admin.edition.edit-quiz')
                                                </div>
                                                <div class="td-quiz-delete">
                                                    @include('admin.deletion.delete-quiz')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    Nenhuma questão criada (As questões ajudarão a analisar o desempenho dos alunos).
                </div>
            @endif
        </div>

    </section>
@endsection
