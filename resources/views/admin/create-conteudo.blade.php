@extends('layouts.app')
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="bg-warning bg-opacity-25 my-3 p-5 d-flex justify-content-around">
        <div>
            <form method="post" action="{{ route('edit.curso', ['id' => $curso[0]->id]) }}"
                class="bg-warning mx-2 rounded my-2 d-grid gap-2 p-2" enctype="multipart/form-data">
                @csrf
                <h1>Editar curso</h1>
                <label for="name-curso">Nome do curso</label>
                <input class="form-control" type="text" id="name-curso" value="{{ $curso[0]->name }}" name="name">
                <div class="d-flex justify-content-around">
                    <img src="{{ asset('storage/' . $curso[0]->image) }}" alt="" class="img-curso">
                    <div>
                        <label for="image-curso">Imagem do curso</label>
                        <input class="form-control" type="file" id="image-curso" name="image">
                    </div>
                </div>
                <label for="description-curso">Descrição</label>
                <textarea class="form-control" name="description" id="description-curso" rows="3"> {{ $curso[0]->description }} </textarea>
                <label for="duration-curso">Duração</label>
                <input class="form-control" type="text" id="duration-curso" value="{{ $curso[0]->duration }}"
                    name="duration">
                <label for="qtd-modulos">Quantidade de modulos</label>
                <input class="form-control" type="int" id="qtd-modulos" value="{{ $curso[0]->modulos }}" name="modulos">
                <label for="price">Preço</label>
                <input class="form-control" type="int" id="price" value="{{ $curso[0]->price }}" name="price">
                <label for="promotion">Promoção</label>
                <input class="form-control" type="int" id="promotion" value="{{ $curso[0]->promotion }}"
                    name="promotion">
                <input type="submit" value="Enviar" class="btn btn-primary m-auto my-2">
            </form>
        </div>

        <div>
            <h1>Criar modulos</h1>
            <h4>Nome do Curso: {{ $curso[0]->name }}</h4>
            @if (isset($conteudos) && $conteudos != null)
                @foreach ($conteudos as $key => $cs)
                    <form action="{{ route('edit.conteudo', ['id' => $cs->id]) }}" method="post" class=""
                        enctype="multipart/form-data">
                        @csrf
                        <div class="my-4 grid gap-3">
                            <label for="name">Nome do {{ $key + 1 }}</label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Digite o nome do modulo" value="{{ $cs->name ?? '' }}" required>
                            <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                            <textarea class="form-control" type="text" id="text" name="text"
                                placeholder="Um texto como conteúdo ou apenas com informações iniciais para o caso do conteúdo ser dado em um arquivo pdf."
                                minlength="50" maxlength="10000" required> {{ $cs->text }} </textarea>
                            <label for="link">Link do material <span class="text-danger">(obs: Se o conteúdo for o
                                    próprio
                                    texto,
                                    deixe este campo vazio)</span></label>
                            <input class="form-control" type="text" id="link" name="link"
                                placeholder="Digite o nome do modulo" value="{{ $cs->link }}">
                            <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">

                            <div class="div-btn">
                                <button class="btn-curso" type="submit"> <img
                                        src="{{ asset('storage/icons/pencil-edit.svg') }}" alt=""> </button>
                    </form>

                    <form action="{{ route('delete.conteudo', ['id' => $cs->id]) }}" method="POST" class="m-0 p-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn-curso" type="submit"> <img src="{{ asset('storage/icons/trash.svg') }}"
                                alt=""> </button>
                    </form>
        </div>
        </div>
        @endforeach
        @endif

        <form action="{{ route('create.conteudo') }}" method="post" class="">
            @csrf
            @for ($i = 0; $i < $curso[0]->modulos; $i++)
                @if (isset($conteudos) && $conteudos != null && $i + 1 > $conteudos->count())
                    {{-- @if (isset($conteudos) && $conteudos != null && $i + 1 <= $conteudos->count()) --}}

                    <div class="my-4 grid gap-3">
                        <label for="name">Nome do {{ $i + 1 }}° modulo</label>
                        <input class="form-control" type="text" id="name" name="name[]"
                            placeholder="Digite o nome do modulo" maxlength="100" required>

                        <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                        <textarea class="form-control" type="text" id="text" name="text[]"
                            placeholder="Um texto como conteúdo ou apenas com informações iniciais para o caso do conteúdo ser dado em um arquivo pdf."
                            maxlength="2500" rows="5" required> </textarea>

                        <label for="link">Link do material <span class="text-danger">(obs: Se o conteúdo for o
                                próprio
                                texto,
                                deixe este campo vazio)</span></label>
                        <input class="form-control" type="text" id="link" name="link[]"
                            placeholder="Digite o nome do modulo">
                        {{-- <input class="form-control" type="file" id="file-link" name="file-link[]"
                            placeholder="Digite o nome do modulo"> --}}
                    </div>
                @endif
            @endfor
            <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">
            <input type="submit" class="btn btn-primary my-2 mx-auto" value="Enviar">
        </form>
        </div>
    </section>
@endsection
