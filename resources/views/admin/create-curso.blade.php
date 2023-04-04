@extends('layouts.app')

@section('content')
    <style>
        form {
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }
    </style>

    <section class="container section_gradient_dark rounded text-light">
        <form action="{{ route('create.curso') }}" method="post" class="m-5" enctype="multipart/form-data">
            <legend class="textDec fs-2">Criar curso</legend>

            @csrf
            <label for="name-curso">Nome do curso</label>
            <input class="form-control" type="text" id="name-curso" name="name" maxlength="100" placeholder="Ex: Programando em Python">

            <label for="img-curso">Imagem do curso</label>
            <input class="form-control" type="file" id="img-curso" name="img">

            <label for="desc-curso">Descrição</label>
            <textarea class="form-control" name="desc" type="text" id="desc-curso" maxlength="500" rows="3"></textarea>

            <label for="duration-curso">Duração</label>
            <input class="form-control" type="number" min="1" max="3600" id="duration-curso" name="duration" placeholder="Ex: 40 (horas)">

            <label for="qtd-modulos">Quantidade de modulos</label>
            <input class="form-control" type="number" id="qtd-modulos" name="modulos" min="0" max="40" placeholder="Ex: 20 modulos">

            <label for="real_price">Preço</label>
            <input class="form-control" type="number" id="real_price" name="real_price" min="0" placeholder="Ex: 20 modulos">

            <label for="promotion">Promoção (%)</label>
            <input class="form-control" type="number" id="promotion" name="promotion" min="0" max="100"
                placeholder="Digite apenas o número, sem simbolo de porcentagem">

            <input type="submit" value="Enviar" class="btnGeral m-auto my-2">
        </form>
    </section>
    </body>

    </html>
@endsection
