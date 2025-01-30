{{-- @dd($questions) --}}

@extends('layouts.app')

@section('content')
    <section class="container py-5">

        <h1 class="title my-4"> Quiz - {{ $modulo->title }} </h1>

        <form action="{{ route('curso.matricula.score') }}" method="post">
            @csrf
            <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">
            <input type="hidden" name="matricula_id" value="{{ $matricula->id }}">

            @forelse ($questions as $key => $quest)
                <div class="my-5">
                    <legend class="title"> {{ $key + 1 }}°) {{ $quest->question }} </legend>

                    <div class="d-flex align-items-center justify-content-start flex-wrap"
                        style="column-gap: 1rem; row-gap: .25rem;">
                        <div>
                            <input required type="radio" name="resp-{{ $key + 1 }}" value="1"
                                id="quest-1-{{ $key }}">
                            <label for="quest-1-{{ $key }}">{{ $quest->alt1 }}</label>
                        </div>
                        <div>
                            <input required type="radio" name="resp-{{ $key + 1 }}" value="2"
                                id="quest-2-{{ $key }}">
                            <label for="quest-2-{{ $key }}">{{ $quest->alt2 }}</label>
                        </div>
                        <div>
                            <input required type="radio" name="resp-{{ $key + 1 }}" value="3"
                                id="quest-3-{{ $key }}">
                            <label for="quest-3-{{ $key }}">{{ $quest->alt3 }}</label>
                        </div>
                        <div>
                            <input required type="radio" name="resp-{{ $key + 1 }}" value="4"
                                id="quest-4-{{ $key }}">
                            <label for="quest-4-{{ $key }}">{{ $quest->alt4 }}</label>
                        </div>

                    </div>

                </div>

            @empty
                <span class="alert alert-danger">
                    Perdoe-nos pelo transtorno, mas não temos nenhuma pergunta de conhecimento para este modulo no momento.
                </span>
            @endforelse

            @if (count($questions) > 0)
                <div class="d-flex justify-content-end my-3">
                    <input type="submit" value="Enviar" class="btnGeral btnGeral-dark p-2 px-4">
                </div>
            @endif

        </form>

        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <span>
                    @if ($conteudo->order != 1 || $modulo->order > 1)
                        <form action="{{ route('curso.matricula.previous') }}" method="GET">
                            @csrf

                            <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                            <input type="hidden" name="modulo" value="{{ $modulo->id }}">
                            <input type="hidden" name="conteudo" value="{{ $conteudo->id }}">
                            <input type="hidden" name="quiz"
                                value="{{ isset($modulo->quizzes[0]->id) ? true : false }}">

                            <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                            <button type="submit" class="btnGeral btnGeral-dark">
                                <i class="bi bi-caret-left-fill"></i>
                                Previous
                            </button>
                        </form>
                    @endif
                </span>
            </div>
        </div>

    </section>
@endsection
