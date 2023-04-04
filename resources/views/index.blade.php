@extends('layouts.app')

@section('content')
    <div id="initial_area" class="section_gradient_dark">
        <div>
            <h2 style="font-weight: 800; font-size: 32pt;"> Mergulhe em Tecnologia </h2>
            <p> Você vai estudar, praticar e discutir e se aprofundar com o apoio de nossos cursos. </p>
        </div>
        <div class="d-flex justify-content-evenly gap-5">
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


    </div>

    <div class="search_div">
        <div class="search_img">
            <img class="img-curso"
                src="https://img.freepik.com/vetores-gratis/ilustracao-do-conceito-de-cerebro-de-curiosidade_114360-11037.jpg?w=740&t=st=1680082052~exp=1680082652~hmac=9b9faa6873395a0c748784a865d1efc252786238185aa60d053231a9ecefdfa3"
                alt="">
            <div><a href="https://br.freepik.com/vetores-gratis/ilustracao-do-conceito-de-cerebro-de-curiosidade_30576698.htm#query=brain&position=49&from_view=search&track=sph"
                    style="text-decoration: none;">Imagem de storyset</a> no Freepik</div>
        </div>
        <form action="" method="post" class="search_form">
            <input type="search" name="" id="" class="search_input" maxlength="25" size="30">
            <button type="submit" class="search_btn btnGeral">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </form>
    </div>

    <section class="area-cursos section_gradient_dark text-light my-5">
        <h4 class="text-center">Cursos disponiveis</h4>
        <div>
            @if (isset($cursos))
                @forelse ($cursos as $key => $curso)
                    <div class="curso section_gradient_light">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img-curso">
                        <span class="nome-curso"> {{ $curso->name }} </span>
                        <span class="descricao-curso"> {{ $curso->desc }} </span>
                        <div class="informacoes">
                            <span class="duracao-curso"> Duração : {{ $curso->duration }} </span>
                            <span class="modulos-curso"> Modulos : {{ $curso->modulos }} </span>
                        </div>
                        @if ($curso->promotion == 0)
                            <span class="preco"> Preço: R$ {{ $curso->promotion_price }} </span>
                        @elseif($curso->promotion_price == 0)
                            <span class="preco"> Gratuito </span>
                        @else
                            <span class="preco" style="text-decoration: line-through;"> Preço: R$ {{ $curso->real_price }}
                            </span>
                            <div class="desconto">
                                <span class="promocao"> Desconto de {{ $curso->promotion }}% </span>
                                <span class="valorAtual"> Novo preço: R$ {{ $curso->promotion_price }} </span>
                            </div>
                        @endif
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
                <div class="my-5">
                    {{ $cursos->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>

    <div id="for_user main_limit">
        <h2 class="text-center">
            Venha experimentar os melhores cursos sobre programação, design e vários outros temas!
        </h2>
    </div>

    <section class="initial_info main_limit">
        <blockquote>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione quo a delectus facere! Sunt distinctio
            asperiores
            quaerat odio corporis, necessitatibus nam laudantium, odit nobis, consequuntur architecto mollitia. Suscipit,
            commodi quasi?
        </blockquote>
        <div class="d-flex justify-content-around">
            <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore, distinctio. Voluptatibus quae
                voluptatum,
                pariatur error dolores recusandae possimus debitis modi nostrum est illo nam explicabo maxime fugit,
                voluptate
                dignissimos ipsum?</div>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, suscipit hic ad nesciunt, ipsam provident
                laudantium modi repudiandae ut architecto perspiciatis assumenda minima tempore eius autem quisquam
                exercitationem quas accusamus.</div>
        </div>
        <div class="d-flex justify-content-around">
            <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore, distinctio. Voluptatibus quae
                voluptatum,
                pariatur error dolores recusandae possimus debitis modi nostrum est illo nam explicabo maxime fugit,
                voluptate
                dignissimos ipsum?</div>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, suscipit hic ad nesciunt, ipsam provident
                laudantium modi repudiandae ut architecto perspiciatis assumenda minima tempore eius autem quisquam
                exercitationem quas accusamus.</div>
        </div>
    </section>


    <section id="area-coments" class="my-3 main_limit" style="flex-wrap: wrap;">
        <h4>Reflexão</h4>

        @if (isset($coments))
        @else
            <blockquote>
                Se a educação sozinha não muda a sociedade, sem ela a sociedade tão pouco muda! <br> <strong>Paulo
                    Freire</strong>
            </blockquote>
        @endif
    </section>
@endsection
