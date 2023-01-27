@extends('layouts.app')
@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>
    <section class="container">
        <form action="{{ route('create.curso') }}" method="post" class="m-5" enctype="multipart/form-data">
            <legend class="text-center">Criar curso</legend>

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

            <label for="real_price">Preço</label>
            <input class="form-control" type="int" id="real_price" name="real_price" placeholder="Ex: 20 modulos">

            <label for="promotion">Promoção (%)</label>
            <input class="form-control" type="int" id="promotion" name="promotion"
                placeholder="Digite apenas o número, sem simbolo de porcentagem">

            <input type="submit" value="Enviar" class="btnGeral m-auto my-2">
        </form>
    </section>
    </body>

    </html>
@endsection
