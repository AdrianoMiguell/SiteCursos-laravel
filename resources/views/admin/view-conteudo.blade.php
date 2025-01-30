{{-- @dd($quests) --}}
@extends('layouts.app')

@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>
    <section class="background container my-5">
        {{-- <h1> Todos os conteudos do curso estão aqui</h1> --}}
        <style>
            form {
                display: grid;
                gap: .25rem;
                padding: 1rem;
            }
        </style>

        <div class="view_cursos mt-5 dark_text">
            <div class="view_cursos_content fs-4" onclick="view_curso(0)"> modulos </div>
            <div class="view_cursos_content fs-4" onclick="view_curso(1)"> questionário </div>
        </div>

        <div class="area-cursos">
            @foreach ($conteudos as $key => $cs)
                <form action="{{ route('edit.conteudo', ['id' => $cs->id]) }}" method="post"
                    class="p-3 d-grid gap-2 rounded-1 section_gradient_light my-4" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Nome do {{ $key + 1 }}</label>
                    <input class="form-control" type="text" id="name" name="name"
                        placeholder="Digite o nome do modulo" value="{{ $cs->name ?? '' }}" required>
                    <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                    <textarea class="form-control" type="text" id="text" name="text"
                        placeholder="Um texto como conteúdo ou apenas com informações iniciais para o caso do conteúdo ser dado em um arquivo pdf."
                        minlength="50" maxlength="2500" required rows="5"> {{ $cs->text }} </textarea>
                    <label for="link">Link do material <span class="text-danger">(obs: Se o conteúdo for o próprio
                            texto,
                            deixe este campo vazio)</span></label>
                    <input class="form-control" type="text" id="link" name="link"
                        placeholder="Digite o nome do modulo" value="{{ $cs->link }}">
                    <input type="number" name="curso_id" value="{{ $curso->id }}" class="d-none">
                    <input type="submit" class="btnGeral my-2 mx-auto" value="Editar">
                </form>
            @endforeach
        </div>

        <div class="area-cursos">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                @foreach ($quests as $key => $qs)
                    <form action="{{ route('edit.questionario') }}" method="post"
                        class="p-3 d-grid gap-2 rounded-1 section_gradient_light my-4" enctype="multipart/form-data">
                        @csrf
                        <label for="perg">{{ $key + 1 }}° pergunta </label>
                        <textarea class="form-control" type="text" id="perg" name="perg" placeholder="Digite o nome do modulo"
                            maxlength="100" required> {{ $qs->perg }} </textarea>
                        <div>
                            <div>
                                <label for="imagem"> Imagem auxiliar <span class="text-danger"> (obs:
                                        opcional)</span></label>
                                <input type="file" name="imagem" id="imagem" class="form-control">
                            </div>
                            {{-- <img src="{{asset('storage/.{{$qs->imagem}}')}}" alt=""> --}}
                        </div>
                        <label for="resp1"> Opção 1</label>
                        <input class="form-control" type="text" id="resp1" name="resp1" maxlength="2500"
                            value="{{ $qs->resp1 }}" required>
                        <label for="resp2"> Opção 2</label>
                        <input class="form-control" type="text" id="resp2" name="resp2"
                            value="{{ $qs->resp2 }}" maxlength="2500" required>
                        <label for="resp3"> Opção 3</label>
                        <input class="form-control" type="text" id="resp3" value="{{ $qs->resp3 }}"
                            name="resp3" maxlength="2500" required>
                        <div>
                            <label for="respTrue1"> Qual a resposta correta : </label>
                            <select name="respTrue" id="respTrue" class="p-1 px-2 rounded m-2">
                                @for ($i = 1; $i <= 3; $i++)
                                    @if ($i == $qs->respTrue)
                                        <option value="{{ $qs->respTrue }}" selected>{{ $qs->respTrue }}°</option>
                                    @else
                                        <option value="{{ $i }}"> {{ $i }}° </option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        {{-- @endif --}}
                        <input type="number" name="curso_id" value="{{ $qs->curso_id }}" class="d-none">
                        <input type="submit" class="btnGeral my-2 mx-auto" value="Editar">
                    </form>
                @endforeach
            </div>
        </div>

    </section>
    </body>

    </html>
@endsection
