@extends('layouts.app')

@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>
    <section class="bg-warning bg-opacity-25 container">
        <h1> Todos os conteudos do curso estão aqui</h1>
        <style>
            form {
                display: grid;
                gap: .25rem;
                padding: 1rem;
            }
        </style>
        <section class="bg-warning bg-opacity-25 container my-3 p-5 rounded">
            <h1>Criar modulos</h1>
            <h4>Nome do Curso: {{ $curso[0]->name }}</h4>
                @foreach ($conteudos as $key => $cs)
                <form action="{{ route('edit.conteudo', ['id' => $cs->id]) }}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="my-4 grid gap-3">
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
                        <input type="submit" class="btn btn-primary my-2 mx-auto" value="Editar">
                    </div>
                </form>
                @endforeach
        </section>
    </section>
    </body>

    </html>
@endsection()
