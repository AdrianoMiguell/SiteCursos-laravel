<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="bg-warning bg-opacity-25 container my-3 p-5 rounded">
        <form action="{{ route('edit.curso', ['id' => $curso[0]->id]) }}" method="post"
            class="w-50 bg-warning mx-auto rounded my-2">
            @csrf
            <h1>Editar curso</h1>
            <label for="name-curso">Nome do curso</label>
            <input class="form-control" type="text" id="name-curso" value="{{ $curso[0]->name }}" name="name">

            <label for="description-curso">Descrição</label>
            <textarea class="form-control" name="description" id="description-curso" cols="25" rows="10"> {{ $curso[0]->description }} </textarea>

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

            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>

        <h1>Criar modulos</h1>
        <h4>Nome do Curso: {{ $curso[0]->name }}</h4>
        <form action="{{ route('create.conteudo') }}" method="post" class="" enctype="multipart/form-data">
            @csrf
            @for ($i = 0; $i < $curso[0]->modulos; $i++)
                <div class="my-4 grid gap-3">
                    <label for="name">Nome do {{ $i + 1 }}° modulo</label>
                    <input class="form-control" type="text" id="name" name="name[]"
                        placeholder="Digite o nome do modulo" required>
                    <label for="text">Texto <span class="text-danger">(informação ou conteúdo)</span> </label>
                    <textarea class="form-control" type="text" id="text" name="text[]"
                        placeholder="Um texto como conteúdo ou apenas com informações iniciais para o caso do conteúdo ser dado em um arquivo pdf."
                        minlength="50" maxlength="10000" required> </textarea>
                    <label for="file_link">Link do material <span class="text-danger">(obs: Se o conteúdo for o próprio
                            texto,
                            deixe este campo vazio)</span></label>
                    <input class="form-control" type="text" id="file_link" name="file_link[]"
                        placeholder="Digite o nome do modulo">
                    {{-- <input class="form-control" type="file" id="file-link" name="file-link[]"
                        placeholder="Digite o nome do modulo"> --}}
                </div>
            @endfor
            <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">
            <input type="submit" class="btn btn-primary my-2 mx-auto" value="Enviar">
        </form>
    </section>

</body>

</html>
