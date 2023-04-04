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
        <h4 class="text-center">Editar modulos</h4>
        @foreach ($conteudos as $key => $cs)
            <form action="{{ route('edit.conteudo', ['id' => $cs->id]) }}" method="post"
                class="bg-transparent shadow-none m-2" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-3">
                    <label for="name">Nome do {{ $key + 1 }}</label>
                    <input class="form-control" type="text" id="name" name="name"
                        placeholder="Digite o nome do modulo" value="{{ $cs->name ?? '' }}" required>
                    <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                    <textarea class="form-control" type="text" id="text" name="text"
                        placeholder="Um texto como conteúdo ou apenas com informações iniciais para o caso do conteúdo ser dado em um arquivo pdf."
                        minlength="50" maxlength="10000" required> {{ $cs->text }} </textarea>
                    <label for="link">Link do material <span class="text-danger">(obs: Se o conteúdo for o próprio
                            texto,
                            deixe este campo vazio)</span></label>
                    <input class="form-control" type="text" id="link" name="link"
                        placeholder="Digite o nome do modulo" value="{{ $cs->link }}">
                    <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">
                    <input type="submit" class="btnGeral my-2 mx-auto" value="Editar">
                </div>
            </form>
        @endforeach

        <h4 class="text-center">Editar questionário</h4>
        <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
            @foreach ($quests as $key => $qs)
                <form action="{{ route('edit.questionario') }}" method="post" class="p-2 px-3 bg-transparent shadow-none"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="my-4 grid gap-3">
                        <label for="perg">{{ $key + 1 }}° pergunta </label>
                        <textarea class="form-control" type="text" id="perg" name="perg" placeholder="Digite o nome do modulo"
                            maxlength="100" required> {{$qs->perg}} </textarea>

                        <div>
                            <div>
                                <label for="imagem"> Imagem auxiliar <span class="text-danger"> (obs:
                                        opcional)</span></label>
                                <input type="file" name="imagem" id="imagem" class="form-control">
                            </div>
                            {{-- <img src="{{asset('storage/.{{$qs->imagem}}')}}" alt=""> --}}
                        </div>

                        <label for="resp1"> Opção 1</label>
                        <input class="form-control" type="text" id="resp1" name="resp1" maxlength="2500" value="{{$qs->resp1}}" required>

                        <label for="resp2"> Opção 2</label>
                        <input class="form-control" type="text" id="resp2" name="resp2" value="{{$qs->resp2}}" maxlength="2500" required>

                        <label for="resp3"> Opção 3</label>
                        <input class="form-control" type="text" id="resp3" value="{{$qs->resp3}}" name="resp3" maxlength="2500" required>
                        <label for="respTrue1"> Qual a resposta correta : </label>
                        <select name="respTrue" id="respTrue" class="p-1 px-2 rounded m-2">
                            <option value="{{$qs->respTrue}}" selected>{{$qs->respTrue}}°</option>
                            <option value="1"> 1° </option>
                            <option value="2"> 2° </option>
                            <option value="3"> 3° </option>
                        </select>
                    </div>
                    {{-- @endif --}}
                    <input type="number" name="curso_id" value="{{ $qs->curso_id }}" class="d-none">
                    <input type="submit" class="btnGeral my-2 mx-auto" value="Editar">
                </form>
            @endforeach
        </div>
    </section>
    </body>

    </html>
@endsection
