<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- style --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

<style>
        #area-cursos{
            background-color: rgb(45, 71, 68);
            border-radius: 5px;
        }

        #area-cursos>div{
            border-radius: 5px;
            /* display: flex;
            flex-direction: row;
            justify-content: space-around;
            flex-wrap: wrap; */
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 10px;
            /* grid: repeat(2, 60px) */
            /* grid-auto-columns: repeat(2, 25vh); */
        }

        .curso {
            height: 22rem;
            margin: 10px;
            text-align: center;
            display: inline-grid;
            background-color: rgb(246, 232, 255);
            word-wrap: break-word;
            border-radius: 5px;
        }

        @media screen and (max-width: 900px){
            #area-cursos{
                margin: auto 0;
                /* font-size: 9pt; */
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            <section class="container m-auto text-center">
                <h1>Bem vindo!</h1>
                <section id="area-cursos" class="my-3">
                    <h2>Cursos</h2>
                    <div class="">
                        <div class="curso">
                            <img src="hhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAbnGp1vx6fGJ6mWZfoBoJNGfKgGy7rrZsd_i_7JjNhilXD3tHu7GKS4o4G_feRE4GcVo&usqp=CAU" alt="" class="img-curso">
                            <div class="nome-curso">tal</div>
                            <div class="preco-atual">50</div>
                            <div class="preco-promocional">
                                <span class="qtd-promocao">100% de desconto</span>
                                <span class="preco"> R$ 0,00 </span>
                                <span class="cartoes-parcela"></span>
                            </div>
                            <a href="" class="matricula"> Matriculi-se </a>
                        </div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicin</div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>

                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>

                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>
                        <div class="curso">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus laudantium beatae ratione at. Reiciendis ducimus obcaecati odit. Dicta accusantium provident et, error earum maxime eius natus explicabo. Ducimus, obcaecati nesciunt.</div>
                    </div>
                </section>

                <section id="relatos">

                </section>
            </section>

            <footer>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate ducimus eius voluptatem architecto perspiciatis magnam suscipit officiis quasi, harum odit iusto? Sequi dolorum esse labore tenetur? Iste excepturi eligendi ducimus?
            </footer>
        </main>
    </div>
</body>

</html>
