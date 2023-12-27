@extends('layouts.app')

@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>

    <section class="section_gradient_dark text-light my-4 mx-0">
        @if (isset($curso))
            <form action="{{ route('edit.curso') }}" method="post" class="m-5" enctype="multipart/form-data">
                <legend class="textDec fs-2">Editar curso</legend>
            @else
                <form action="{{ route('create.curso') }}" method="post" class="m-5" enctype="multipart/form-data">
                    <legend class="textDec fs-2">Criar curso</legend>
        @endif

        @csrf

        <label for="name-curso">Nome do curso</label>
        <input class="form-control" type="text" id="name-curso" name="name" maxlength="100"
            value="{{ $curso[0]->name ?? '' }}" placeholder="Ex: Programando em Python">

        <label for="img-curso">Imagem do curso</label>
        <div class="d-flex gap-2">
            @if (isset($curso))
                <img src="{{ asset('./storage/', $curso[0]->img) }}" alt="imagem do curso: {{ $curso[0]->name }}">
            @endif
            <input class="form-control" type="file" id="img-curso" name="img">
        </div>

        <label for="desc-curso">Descrição</label>
        <textarea class="form-control" name="desc" type="text" id="desc-curso" maxlength="500" rows="3"> {{ $curso[0]->desc ?? '' }} </textarea>

        <label for="desc-long">Descrição mais detalhada</label>
        <textarea class="form-control" name="desc_more" id="desc-long" rows="3"> {{ $curso[0]->desc_more ?? '' }} </textarea>

        <label for="duration-curso">Duração</label>
        <input class="form-control" type="number" min="1" max="3600" id="duration-curso" name="duration"
            value="{{ $curso[0]->duration ?? '' }}" placeholder="Ex: 40 (horas)">

        <label for="real_price">Preço</label>
        <input class="form-control" type="number" id="real_price" name="real_price" min="0"
            value="{{ $curso[0]->real_price ?? '' }}" placeholder="Ex: 20 modulos">

        <label for="promotion">Promoção (%)</label>
        <input class="form-control" type="number" id="promotion" name="promotion" min="0" max="100"
            value="{{ $curso[0]->promotion ?? '' }}" placeholder="Digite apenas o número, sem simbolo de porcentagem">

        <input type="submit" value=" Enviar " class="btnGeral m-auto my-2">
        </form>
    </section>

    @if (isset($curso) && !isset($conteudos))
        {{-- editar modulos --}}
        <section class="d-flex justify-content-around flex-wrap p-3 pt-5">
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
                                <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span>
                                </label>
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

                                <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span>
                                </label>
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

        {{-- editar modulos --}}
        <section class="d-flex justify-content-around flex-wrap p-3 pt-5">
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
                                <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span>
                                </label>
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

            {{-- criar modulos --}}
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

                                <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span>
                                </label>
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
    @endif
@endsection
