<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="/css/geral.css"> --}}
    <link rel="stylesheet" href="/css/certificado.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Ms+Madi&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Parisienne&display=swap');

        * {
            margin: 0;
            padding: 0;
        }

        .header_certificado {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            column-gap: .5em;
        }

        .sec_certificado {
            margin: 1em auto !important;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vh;
        }

        .content_certificado {
            position: absolute;
            top: 50;
            left: 50;
            width: 500px;
            margin-top: -8em;
            font-family: 'Ms Madi', cursive;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            row-gap: 3em;
        }

        .content .text {
            width: 400px;
            font-size: 13pt;
        }

        #title {
            color: rgb(var(--main-cor));
            font-family: 'Parisienne', cursive;
            font-weight: 200;
            font-size: 40pt;
        }

        .destaque {
            font-weight: 700;
            text-transform: uppercase;
            word-wrap: break-word;
        }


        #logo_div {
            display: flex;
            justify-content: center;
            flex-direction: row;
            align-items: center;
            column-gap: .5em;
        }

        #logo_div img {
            width: 6em;
            height: auto;
        }

        #logo_div>div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            row-gap: -15px;
        }

        #logo_div span {
            font-size: 25pt;
            text-align: center;
        }

        #footer {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transform: translateY(8em);
        }

        #footer>#content_prog {
            display: grid;
            row-gap: .5em;
        }

        #footer #content_prog #caps {
            text-align: justify;
            list-style: none;
        }

        #alert_end {
            transform: translateY(4em);
            text-align: center;
            font-size: 9pt;
        } */
    </style>
</head>

<body>
    <section class="sec_certificado">
        <div class="content_certificado">
            <div id="header_certificado">
                <div id="logo_div">
                    <span id="logotipo">Cursos Play</span>
                </div>
                <div style="text-align: center; font-size: 10pt;"> Plataforma de Curso Online </div>
            </div>
            <div class="content">
                <h1 id="title"> Certificado de Conclusão </h1>
                <p class="text">Certificamos que {{ Auth::user()->name }}, concluiu no dia
                    {{ date_format($matricula->updated_at, 'd/m/Y') }} o curso online: <span
                        class="destaque">{{ $curso->name }}</span> </p>
            </div>

            <div id="footer">
                <ul id="content_prog">
                    <h2 style="font-size: 12pt;"> Conteúdo programático </h2>
                    @foreach ($curso->conteudos as $key => $c)
                        @if ($key < 4)
                            <li id="caps" style="font-size: 10pt;"> Capitulo {{ $key + 1 }}:
                                {{ $c->name }}
                            </li>
                        @endif
                    @endforeach
                </ul>

                <div id="alert_end">
                    Esses certificados não possuem nenhum peso educacional, só servem de ilustração para o site teste
                    "Cursos Play".
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    const logotipo = document.getElementById('logotipo');
    const textLogo = logotipo.textContent;
    if (typeof logotipo != undefined) {
        const text = textLogo.split(" ");
        console.log(text);
    }
</script>

</html>
