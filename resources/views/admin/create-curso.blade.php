@extends('layouts.app')
@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>
    <section class="bg-warning container">
        <h1>Criar curso</h1>
        <form action="{{ route('create.curso') }}" method="post" class="mx-5" enctype="multipart/form-data">
            @csrf
            <label for="name-curso">Nome do curso</label>
            <input class="form-control" type="text" id="name-curso" name="name" maxlength="100" placeholder="Ex: Programando em Python">

            <label for="image-curso">Imagem do curso</label>
            <input class="form-control" type="file" id="image-curso" name="image">
{{-- http://127.0.0.1:8000/view-create-conteudo?id=2 --}}
            <label for="description-curso">Descrição</label>
            <textarea class="form-control" name="description" id="description-curso" maxlength="500" rows="3"></textarea>

            <label for="duration-curso">Duração</label>
            <input class="form-control" type="text" id="duration-curso" name="duration" placeholder="Ex: 40 horas">

            <label for="qtd-modulos">Quantidade de modulos</label>
            <input class="form-control" type="int" id="qtd-modulos" name="modulos" placeholder="Ex: 20 modulos">

            <label for="price">Preço</label>
            <input class="form-control" type="int" id="price" name="price" placeholder="Ex: 20 modulos">

            <label for="promotion">Promoção</label>
            <input class="form-control" type="int" id="promotion" name="promotion"
                placeholder="Digite apenas o número, sem simbolo de porcentagem">

            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </section>
    </body>

    </html>
@endsection
