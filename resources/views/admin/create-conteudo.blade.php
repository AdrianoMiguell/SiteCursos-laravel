@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-around flex-wrap p-3 pt-5">
        <div class="section_gradient_dark text-light p-3 rounded">
            <form method="post" action="{{ route('edit.curso', ['id' => $curso[0]->id]) }}" class="d-grid gap-2 p-2 px-5"
                enctype="multipart/form-data">
                @csrf
                <legend class="textDec">Editar curso</legend>
                <label for="name-curso">Nome do curso</label>
                <input class="form-control" type="text" id="name-curso" value="{{ $curso[0]->name }}" name="name">
                <div class="d-grid gap-1">
                    <label for="img-curso">Imagem do curso</label>
                    <img src="{{ asset('storage/' . $curso[0]->img) }}" alt="" class="img-curso">
                    <div>
                        <label for="img-curso">Nova imagem</label>
                        <input class="form-control" type="file" id="img-curso" name="img">
                    </div>
                </div>
                <label for="description-curso">Descrição</label>
                <textarea class="form-control" name="description" id="description-curso" rows="3"> {{ $curso[0]->description }} </textarea>
                <label for="duration-curso">Duração</label>
                <input class="form-control" type="text" id="duration-curso" value="{{ $curso[0]->duration }}"
                    name="duration">
                <label for="qtd-modulos">Quantidade de modulos</label>
                <input class="form-control" type="int" id="qtd-modulos" value="{{ $curso[0]->modulos }}" name="modulos">
                <label for="real_price">Preço</label>
                <input class="form-control" type="int" id="real_price" value="{{ $curso[0]->real_price }}"
                    name="real_price">
                <label for="promotion">Promoção</label>
                <input class="form-control" type="int" id="promotion" value="{{ $curso[0]->promotion }}"
                    name="promotion">
                <input type="submit" value="Enviar" class="btnGeral m-auto my-2">
            </form>
        </div>

        @if (isset($conteudos) && $conteudos->count() != null)
            <div>
                <h4 class="textDec text-dark"> Editar modulos</h4>
                @foreach ($conteudos as $key => $cs)
                    <form action="{{ route('edit.conteudo', ['id' => $cs->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="my-4 grid gap-3">
                            <label for="name">Nome do {{ $key + 1 }}</label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Digite o nome do modulo" value="{{ $cs->name ?? '' }}" required>
                            <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                            <textarea class="form-control" type="text" id="text" name="text" maxlength="2500" required> {{ $cs->text }} </textarea>
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
                @endforeach
            </div>
        @endif

        @if (isset($conteudos) && $curso[0]->modulos > $conteudos->count())
            <div>
                <form action="{{ route('create.conteudo') }}" method="post">
                    <legend class="textDec text-dark"> Criar novos modulos </legend>
                    @csrf
                    @for ($i = 0; $i < $curso[0]->modulos - $conteudos->count(); $i++)
                        <div class="my-4 grid gap-3">
                            <label for="name">Nome do {{ $i + 1 }}° novo modulo</label>
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
                        </div>
                    @endfor
                    <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">
                    <input type="submit" class="btnGeral my-2 mx-auto" value="Enviar">
                </form>
            </div>
        @endif
    </section>
@endsection
