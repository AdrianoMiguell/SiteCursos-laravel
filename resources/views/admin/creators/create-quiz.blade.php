@extends('layouts.app')

@section('content')
    @include('admin.header-options')

    <section class="container workspace-conteudo">

        @include('admin.section-info-curso')

        <h2>
            <i class="bi bi-plus-circle-fill"></i>
            Questão
        </h2>

        <form action="{{ route('quiz.create') }}" method="POST" style="max-width: 75vw;" class="my-4"
            enctype="multipart/form-data">
            @csrf

            {{-- <legend class="mb-3 fs-5" style="color: rgba(var(--main-c), .75)">Divida os Quiz do seu curso em modúlos.
                <br> Lembre-se: dê Titulos e descrições chamátivas aos seus
                módulos.
            </legend> --}}

            <input type="hidden" name="curso_id" value="{{ $curso->id }}">

            <div class="my-5">
                <label for="modulo_id" class="form-label">
                    Selecione o modúlo referente a pergunta:
                </label>

                <select name="modulo_id" id="modulo_id" class="form-control">
                    <option value=""> Nenhum </option>
                    @foreach ($curso->modulos as $key => $modulo)
                        <option value="{{ $modulo->id }}">{{ $modulo->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="div-question">
                <div class="question">
                    <div class="mb-2 question-child">
                        <label for="question1-1" class="form-label"> 1° Pergunta </label>
                        <input type="text" value="lorem y" id="question1-1" name="question[]" class="form-control">
                    </div>
                    <div class="mb-2 question-child d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="img1-1" class="form-label"> imagem </label>
                            <input type="file" name="img1[]" id="img1-1" class="form-control">
                        </div>
                        <div style="flex: 1;">
                            <label for="legend-1" class="form-label"> legenda </label>
                            <input type="text" id="legend-1" name="legend[]" class="form-control">
                        </div>
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt1-1" class="form-label"> 1° Alternativa </label>
                        <input type="text" value="resp 1" name="alt1[]" id="alt1-1" class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt2-1" class="form-label"> 2° Alternativa </label>
                        <input type="text" value="resp 2" name="alt2[]" id="alt2-1" class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt3-1" class="form-label"> 3° Alternativa </label>
                        <input type="text" value="resp 3" name="alt3[]" id="alt3-1" class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt4-1" class="form-label"> 4° Alternativa </label>
                        <input type="text" value="resp 4" name="alt4[]" id="alt4-1" class="form-control">
                    </div>

                    <div class="my-2 question-child d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="alt5-1" class="form-label"> 5° Alternativa <span
                                    style="font-size: 10pt; opacity: .9;">(opcional)</span> </label>
                            <input type="text" value="resp 5" name="alt5[]" id="alt5-1" class="form-control">
                        </div>

                        <div style="flex: 0.4;">
                            <label for="altTrue-1" class="form-label">Alternativa correta </label>
                            <select name="altTrue[]" id="altTrue-1" class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}°</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                </div>

                <div class="my-2 d-flex align-items-center justify-content-center" style="order: 2">
                    <button type="button" class="btnGeral btnGeral-dark btn-question" onclick="newQuestion()">
                        <i class="bi bi-plus"></i>
                        Questão
                    </button>
                </div>
            </div>

            <div class="my-4">
                <input type="submit" class="btnGeral btnGeral-dark">
            </div>

        </form>
    </section>

    <script>
        const div_questions = document.querySelector(".div-question");

        const newQuestion = () => {
            let quant_questions = document.querySelectorAll(".question").length + 1;

            let data = `<div class="question">
                    <div class="mb-2 question-child">
                        <label for="question-${quant_questions}" class="form-label"> ${quant_questions}° Pergunta </label>
                        <input type="text" value="lorem y" id="question-${quant_questions}" name="question[]"
                            class="form-control">
                    </div>
                    <div class="mb-2 question-child d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="img-${quant_questions}" class="form-label"> imagem </label>
                            <input type="file" id="img-${quant_questions}" name="img[]" class="form-control">
                        </div>
                        <div style="flex: 1;">
                            <label for="legend-${quant_questions}" class="form-label"> legenda </label>
                            <input type="text" id="legend-${quant_questions}" name="legend[]"
                                class="form-control">
                        </div>
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt1-${quant_questions}" class="form-label"> 1° Alternativa </label>
                        <input type="text" value="resp 1" id="alt1-${quant_questions}" name="alt1[]" 
                            class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt2-${quant_questions}" class="form-label"> 2° Alternativa </label>
                        <input type="text" value="resp 2" id="alt2-${quant_questions}" name="alt2[]"
                            class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt3-${quant_questions}" class="form-label"> 3° Alternativa </label>
                        <input type="text" value="resp 3" id="alt3-${quant_questions}" name="alt3[]"
                            class="form-control">
                    </div>
                    <div class="mb-1 question-child">
                        <label for="alt4-${quant_questions}" class="form-label"> 4° Alternativa </label>
                        <input type="text" value="resp 4" id="alt4-${quant_questions}" name="alt4[]"
                            class="form-control">
                    </div>

                    <div class="my-2 question-child d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="alt5-${quant_questions}" class="form-label"> 5° Alternativa <span
                                    style="font-size: 10pt; opacity: .9;">(opcional)</span> </label>
                            <input type="text" value="resp 5" id="alt5-${quant_questions}" name="alt5[]" class="form-control">
                        </div>

                        <div style="flex: 0.4;">
                            <label for="altTrue-${quant_questions}" class="form-label">Alternativa correta </label>
                            <select name="altTrue[]" id="altTrue-${quant_questions}" class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}°</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>`;

            div_questions.innerHTML += data;
        }
    </script>
@endsection
