@extends('layouts.app')

@section('content')
    <section class="m-0 mb-5 p-5 section_gradient_dark text_light">
        <div class="m-5">
            <h2 class="text_light_gradient" style="font-weight: 800; font-size: 32pt; margin-bottom: 1em;"> Mergulhe em
                Tecnologia </h2>
            <p> Você vai estudar, praticar e discutir e se aprofundar com o apoio de nossos cursos. </p>
        </div>
        <div class="d-flex justify-content-evenly gap-5 m-5">
            <div class="tags">
                <span class="text-primary text-center"> Front-end </span>
            </div>
            <div class="tags">
                <span class="text-danger"> Back-end </span>
            </div>
            <div class="tags">
                <span class="text-warning"> Programação </span>
            </div>
        </div>

        <div class="mt-5 my-3 simpleGradient area_coments rounded-4"
            style="flex-wrap: wrap; box-shadow: 0 0 1px 2px rgb(var(--quint-cor)), 0 0 2px 4px rgb(var(--sec-cor)); backdrop-filter: opacity(.5);">
            @if (isset($coments))
            @else
                <blockquote>
                    Se a educação sozinha não muda a sociedade, sem ela a sociedade tão pouco muda! <br> <strong>Paulo
                        Freire</strong>
                </blockquote>
            @endif
        </div>
    </section>

    <section class="mt-2 mb-5 py-5 d-grid gap-5">

        <div id="for_user main_limit mt-5 mb-2 py-2 mx-5">
            <h2 class="mx-5 px-5 text-center textRealist">
                Venha experimentar os melhores cursos sobre programação, design e vários outros temas!
            </h2>
        </div>

        <div class="d-flex justify-content-evenly text-dark flex-wrap align-items-center mt-1 mb-5">
            <img src="https://img.freepik.com/vetores-gratis/estudante-de-menino-sentado-na-pilha-de-livros-com-ilustracao-de-icone-plana-de-laptop_1284-64037.jpg?w=740&t=st=1681406162~exp=1681406762~hmac=27f27703d42194dd8909eb51256f25dea689d74dfeeec1d4860443926ace3423"
                alt="" class="imgP">
            <blockquote class="text_dark p-2 rounded-1" style="width: 30em;">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quo a delectus facere! Sunt distinctio
                asperiores
                quaerat odio corporis, necessitatibus nam laudantium, odit nobis, consequuntur architecto mollitia.
                Suscipit,
                commodi quasi?
            </blockquote>
        </div>

        <div class="d-flex justify-content-evenly text-dark flex-wrap align-items-center my-5">
            <blockquote class="text_dark p-2 rounded-1" style="width: 30em;">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quo a delectus facere! Sunt distinctio
                asperiores
                quaerat odio corporis, necessitatibus nam laudantium, odit nobis, consequuntur architecto mollitia.
                Suscipit,
                commodi quasi?
            </blockquote>
            <img src="https://img.freepik.com/vetores-gratis/estudante-de-menino-sentado-na-pilha-de-livros-com-ilustracao-de-icone-plana-de-laptop_1284-64037.jpg?w=740&t=st=1681406162~exp=1681406762~hmac=27f27703d42194dd8909eb51256f25dea689d74dfeeec1d4860443926ace3423"
                alt="" class="imgP">
        </div>
    </section>

    <div class="my-3 simpleGradient area_coments" style="flex-wrap: wrap;">
        @if (isset($coments))
        @else
            <blockquote>
                Se a educação sozinha não muda a sociedade, sem ela a sociedade tão pouco muda! <br> <strong>Paulo
                    Freire</strong>
            </blockquote>
        @endif
    </div>

    <div class="search_div">
        <div class="search_img">
            <img class="img_curso"
                src="https://img.freepik.com/vetores-gratis/ilustracao-do-conceito-de-cerebro-de-curiosidade_114360-11037.jpg?w=740&t=st=1680082052~exp=1680082652~hmac=9b9faa6873395a0c748784a865d1efc252786238185aa60d053231a9ecefdfa3"
                alt="">
            <div><a href="https://br.freepik.com/vetores-gratis/ilustracao-do-conceito-de-cerebro-de-curiosidade_30576698.htm#query=brain&position=49&from_view=search&track=sph"
                    style="text-decoration: none;">Imagem de storyset</a> no Freepik</div>
        </div>
        <form action="{{ route('index') }}" method="get" class="search_form">
            <input type="search" name="search" id="search_input" maxlength="25" size="30">
            <button type="submit" class="search_btn btnGeral">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </form>
    </div>

    <section id="allCursos" class="area_cursos section_gradient_dark light_text my-5">
        <h4 class="text-center fw-bolder fs-2 my-5">Cursos disponiveis</h4>
        <div>
            @if (isset($cursos))
                @forelse ($cursos as $key => $curso)
                    <div class="curso section_gradient_light dark_text">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img_curso">
                        <span class="nome_curso"> {{ $curso->name }} </span>
                        <span class="desc_curso"> {{ $curso->desc }} </span>
                        <span> Duração : {{ $curso->duration }} </span>
                        <span> Modulos : {{ $curso->modulos }} </span>
                        <div class="fw-bold">
                            @if ($curso->promotion_price == 0)
                                <span> Gratuito </span>
                            @else
                                <span> Preço: R$ {{ $curso->promotion_price }} </span>
                            @endif
                        </div>
                        <div class="div-btn">
                            <a class="btnGeral" href="{{ route('view.curso', ['curso_id' => $curso->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                visualizar</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alery-primary">
                        <h1>Nenhum curso cadastrado</h1>
                    </div>
                @endforelse
                <div>
                    {{ $cursos->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>

    <div class="my-3 mb-5 simpleGradient area_coments" style="flex-wrap: wrap;">
        <blockquote>
            Se a educação sozinha não muda a sociedade, sem ela a sociedade tão pouco muda! <br> <strong>Paulo
                Freire</strong>
        </blockquote>
    </div>

@endsection
