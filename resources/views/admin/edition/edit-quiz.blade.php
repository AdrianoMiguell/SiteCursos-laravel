<!-- Button trigger modal -->
<button type="button" class="btnGeral btnGeral-dark" data-bs-toggle="modal" data-bs-target="#modalQuiz{{ $key_quiz }}">
    <i class="bi bi-pencil-fill"></i>
</button>

<!-- Modal -->
<div class="modal fade modal-conteudo" id="modalQuiz{{ $key_quiz }}" tabindex="-1"
    aria-labelledby="modalQuiz{{ $key_quiz }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('quiz.edit') }}" method="POST" enctype="multipart/form-data" class="text-start">
                    @csrf
                    @method('PUT')

                    <h1 class="modal-title mt-3 mb-4" id="modalQuiz{{ $key_quiz }}Label">Editar Quiz</h1>

                    <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                    <input type="hidden" name="id" value="{{ $quiz->id }}">

                    <div class="my-4 d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="modulo_id-{{ $key_quiz }}" class="form-label">Mudar o modulo referente:
                            </label>
                            <select name="modulo_id" id="modulo_id-{{ $key_quiz }}" class="form-control">
                                @foreach ($curso->modulos as $modulo)
                                    <option value="{{ $modulo->id }}"
                                        @if ($modulo->id == $quiz->modulo_id) @selected(true) @endif>
                                        {{ $modulo->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="flex: 0.4;">
                            <label for="order-{{ $key_quiz }}" class="form-label">Ordem</label>
                            <select name="order" id="order-{{ $key_quiz }}" class="form-control">
                                @for ($i = 1; $i <= count($curso->quiz); $i++)
                                    <option value="{{ $i }}"
                                        @if ($quiz->order == $i) @selected(true) @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="question{{ $key_quiz }}" class="form-label"> 1° Pergunta </label>
                        <input type="text" value="lorem y" id="question{{ $key_quiz }}" name="question"
                            class="form-control">
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-between gap-2">
                        @if (isset($quiz->img) && !empty($quiz->img))
                            <div style="flex: 1;" class="image">
                                <img src="{{ asset('storage/' . $quiz->img) }}"
                                    alt="Questão número: {{ $quiz->order }}" style="max-width: 200px;">
                            </div>
                        @endif
                        <div style="flex: 1;"
                            class="mb-2 d-flex align-items-start justify-content-between flex-column gap-1">
                            <div>
                                <label for="img-{{ $key_quiz }}" class="form-label"> imagem </label>
                                <input type="file" name="file_img" id="img-{{ $key_quiz }}"
                                    class="form-control">
                                <input type="hidden" name="img" value="{{ $quiz->img }}">
                            </div>
                            <div>
                                <label for="legend-{{ $key_quiz }}" class="form-label"> legenda </label>
                                <input type="text" id="legend-{{ $key_quiz }}" name="legend"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alt1-{{ $key_quiz }}" class="form-label"> 1° Alternativa </label>
                        <input type="text" value="resp 1" name="alt1" id="alt1-{{ $key_quiz }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="alt2-{{ $key_quiz }}" class="form-label"> 2° Alternativa </label>
                        <input type="text" value="{{ $quiz->alt2 }}" name="alt2" id="alt2-{{ $key_quiz }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="alt3-{{ $key_quiz }}" class="form-label"> 3° Alternativa </label>
                        <input type="text" value="resp 3" name="alt3" id="alt3-{{ $key_quiz }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="alt4-1" class="form-label"> 4° Alternativa </label>
                        <input type="text" value="resp 4" name="alt4" value="{{ $quiz->alt4 }}"
                            id="alt4-{{ $key_quiz }}" class="form-control">
                    </div>
                    <div class="my-2 d-flex align-items-center justify-content-between gap-1">
                        <div style="flex: 1;">
                            <label for="alt5-{{ $key_quiz }}" class="form-label"> 5° Alternativa <span
                                    style="font-size: 10pt; opacity: .9;">(opcional)</span> </label>
                            <input type="text" value="{{ $quiz->alt5 }}" name="alt5"
                                id="alt5-{{ $key_quiz }}" class="form-control">
                        </div>
                        <div style="flex: 0.4;">
                            <label for="altTrue-{{ $key_quiz }}" class="form-label">Alternativa
                                correta
                            </label>
                            <select name="altTrue" id="altTrue-{{ $key_quiz }}" class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}°</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-end">
                        <input type="submit" class="btnGeral btnGeral-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
