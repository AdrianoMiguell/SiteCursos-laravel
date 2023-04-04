@extends('layouts.app')

@section('content')

    <section class="session_geral">
        <section class="area-cursos dark_text">
            <h4 class="text-center"> Curso </h4>
            <div style="width: auto;">
                @if (isset($curso))
                    <div class="curso section_gradient_dark text-light">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="" class="img-curso">
                        <span class="nome-curso"> {{ $curso->name }} </span>
                        <span class="descricao-curso"> {{ $curso->desc }} </span>
                        <div class="informacoes">
                            <span class="duracao-curso"> Duração : {{ $curso->duration }} </span>
                            <span class="modulos-curso"> Modulos : {{ $curso->modulos }} </span>
                        </div>
                        @if ($curso->promotion != 0)
                            <span class="preco" style="text-decoration: line-through;"> Preço: R$ {{ $curso->real_price }}
                            </span>
                            <div class="desconto">
                                <span class="promocao"> Desconto de {{ $curso->promotion }}% </span>
                                <span class="valorAtual"> Novo preço: R$ {{ $curso->promotion_price }} </span>
                            </div>
                        @elseif ($curso->real_price == 0)
                            <span class="preco"> Gratuito </span>
                        @else
                            <span class="preco"> Preço: R$ {{ $curso->real_price }} </span>
                        @endif
                        <div class="div-btn">
                            @if (isset($matricula) && $matricula[0]->curso_id == $curso->id)
                                <a class="btnGeral"
                                    href="{{ route('user.conteudo', ['curso_id' => $curso->id, 'conteudo_id' => $matricula[0]->conteudo_atual]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                    visualizar</a>
                            @else
                                <form action="{{ route('matricula.curso', ['curso_id' => $curso->id]) }}" method="POST"
                                    class="block_style">
                                    @csrf
                                    <button class="btnGeral" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                        </svg>
                                        matricular-se</button>
                                </form>
                            @endif

                        </div>
                    </div>
                @else
                    <div> Erro, retorne mais tarde! </div>
                @endif

            </div>
        </section>

        <div class="div_modulos">
            <h3> Modulos do curso </h3>
            <ul class="ulContent">
                @foreach ($curso->conteudos as $key => $conteudos)
                    <li class="liContent section_gradient_dark text-light" onclick="appear({{ $key }})">
                        <span>{{ $conteudos->name }}</span>
                        <svg style="margin-left: 8em;" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                        </svg>
                    </li>
                    <div class="textContent mb-4" style="position: absolute;">
                        {{ $conteudos->text }}
                    </div>
                @endforeach
            </ul>
        </div>
    </section>

    <script>
        const liContent = document.querySelectorAll('.liContent');
        const textContent = document.querySelectorAll('.textContent');
        var cont = [];

        function appear(e) {
            if (cont[e] == false) {
                console.log(e);
                textContent[e].style.position = 'relative';
                textContent[e].style.opacity = '1';
                cont[e] = true
            } else {
                disappear(e);
            }
        }

        function disappear(d) {
            console.log(d);
            cont[d] = false
            textContent[d].style.position = 'absolute';
            textContent[d].style.opacity = '0';
        }

        for (let i = 0; i < liContent.length; i++) {
            cont[i] = false
            textContent[i].style.opacity = '0';
        }
    </script>
    <script src="/js/controller.js"></script>
@endsection
