@extends('layouts.app')

@section('content')
    @include('admin.header-options')

    <section class="container workspace-quiz">

        <h1 class="my-5">
            <i class="bi bi-plus-circle-fill"></i>
            Questão
        </h1>

        @include('admin.section-info-curso')

        <form action="{{ route('quiz.create') }}" method="POST" class="my-2" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="curso_id" value="{{ $curso->id }}">

            <div class="sec-modulo-reference my-5 gap-1">
                <label for="modulo_id" class="form-label fs-5">
                    Selecione o modúlo referente a pergunta:
                </label>
                <div class="div-modulo-reference">
                    @foreach ($curso->modulos as $key => $modulo_ref)
                        <div class="modulo-reference">
                            <a href="{{ route('quiz.view', ['curso_id' => $curso->id, 'modulo_id' => $modulo_ref->id]) }}"
                                class="modulo-link">
                                <i class="bi bi-plus"></i> <span>{{ $modulo_ref->title }}</span></a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-2 question-child">
                <label for="question1-1" class="form-label"> Pergunta </label>
                <input type="text" value="lorem y" id="question1-1" name="question" class="form-control">
            </div>
            <div class="mb-2 question-child d-flex align-items-center justify-content-between gap-1">
                <div style="flex: 1;">
                    <label for="img1-1" class="form-label"> imagem <span class="input-optional">(opcional)</span>
                    </label>
                    <input type="file" name="img" id="img1-1" class="form-control">
                </div>
                <div style="flex: 1;">
                    <label for="legend-1" class="form-label"> legenda <span class="input-optional">(opcional)</span>
                    </label>
                    <input type="text" id="legend-1" name="legend" class="form-control">
                </div>
            </div>
            <div class="mb-1 question-child">
                <label for="alt1-1" class="form-label"> 1° Alternativa </label>
                <input type="text" value="resp 1" name="alt1" id="alt1-1" class="form-control">
            </div>
            <div class="mb-1 question-child">
                <label for="alt2-1" class="form-label"> 2° Alternativa </label>
                <input type="text" value="resp 2" name="alt2" id="alt2-1" class="form-control">
            </div>
            <div class="mb-1 question-child">
                <label for="alt3-1" class="form-label"> 3° Alternativa </label>
                <input type="text" value="resp 3" name="alt3" id="alt3-1" class="form-control">
            </div>
            <div class="mb-1 question-child">
                <label for="alt4-1" class="form-label"> 4° Alternativa </label>
                <input type="text" value="resp 4" name="alt4" id="alt4-1" class="form-control">
            </div>

            <div class="my-2 question-child d-flex align-items-center justify-content-between gap-1">
                <div style="flex: 1;">
                    <label for="alt5-1" class="form-label"> 5° Alternativa <span class="input-optional">(opcional)</span>
                    </label>
                    <input type="text" value="resp 5" name="alt5" id="alt5-1" class="form-control">
                </div>

                <div style="flex: 0.4;">
                    <label for="altTrue-1" class="form-label">Alternativa correta </label>
                    <select name="altTrue" id="altTrue-1" class="form-select">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}°</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="my-4">
                <input type="submit" class="btnGeral btnGeral-dark">
            </div>

        </form>
    </section>
@endsection
