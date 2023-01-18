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
    <section class="bg-success container my-5 py-2">
        <h1>Criar modulos</h1>
        <form action="" method="post" class="">
            @csrf
            @for($i = 0; $i < 9; $i++)
            <label for="name-curso">Modulo {{$i}}</label>
            <input class="form-control" type="text" id="name-curso" name="name" placeholder="Ex: Programando em Python">
            @endfor
        </form>
    </section>

</body>
</html>
