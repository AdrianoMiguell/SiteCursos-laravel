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
        form{
            display: grid;
            gap: .25rem;
            padding: 1rem;
        }

    </style>
    <section class="bg-warning container">
        <h1>Criar curso</h1>
        <form action="{{route('create.curso')}}" method="post" class="mx-5">
            @csrf
            <label for="name-curso">Nome do curso</label>
            <input class="form-control" type="text" id="name-curso" name="name" placeholder="Ex: Programando em Python">

            <label for="description-curso">Descrição</label>
            <textarea class="form-control" name="description" id="description-curso" cols="25" rows="10"></textarea>

            <label for="duration-curso">Duração</label>
            <input class="form-control" type="text" id="duration-curso" name="duration" placeholder="Ex: 40 horas">

            <label for="qtd-modulos">Quantidade de modulos</label>
            <input class="form-control" type="int" id="qtd-modulos" name="modulos" placeholder="Ex: 20 modulos">

            <label for="price">Preço</label>
            <input class="form-control" type="int" id="price" name="price" placeholder="Ex: 20 modulos">

            <label for="promotion">Promoção</label>
            <input class="form-control" type="int" id="promotion" name="promotion" placeholder="Digite apenas o número, sem simbolo de porcentagem">

            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </section>
</body>
</html>
