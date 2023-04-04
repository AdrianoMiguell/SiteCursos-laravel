@extends('layouts.app')

<style>
    body {
        overflow-x: visible;
    }

    .div_mycursos {
        display: flex;
        justify-content: start;
        padding: 0 5em;
    }

    .div_control {
        position: absolute;
        bottom: 0;
    }
</style>

@section('content')
    @if (isset($matricula))
        <div class="view_cursos mt-5">
            <div class="view_cursos_content" onclick="view_curso(0)"> Cursos disponibiizados </div>
            <div class="view_cursos_content" onclick="view_curso(1)"> Meus cursos </div>
            <div class="view_cursos_content" onclick="view_curso(2)"> Meus Certificados </div>
        </div>
    @else
        <div class="view_cursos mt-5">
            <div class="view_cursos_content fs-5"> Cursos disponibiizados </div>
        </div>
    @endif

    <section class="area-cursos mt-5 my-1">
        <div>
            {{-- @if (isset($cursos)) --}}
            @forelse ($cursos as $key => $curso)
                <div class="curso section_gradient_dark light_text">
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
            <div class="my-1">
                {{ $cursos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </section>

    @if (isset($matricula))
        <section class="area-cursos mt-5 my-1">
            @include('user.myCursos')
        </section>


        @foreach ($cursos as $key => $c)
            @foreach ($matricula as $m)
                @if ($m->curso_id == $c->id && $m->status == 'concluido')
                    <style>
                        .img_legend {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 5px;
                        }

                        .img_legend>.legend {
                            font-size: 10pt
                        }
                    </style>

                    <section class="area-cursos mt-5 my-1 gap-5">
                        <div class="img_legend">
                            <img src="https://img.freepik.com/vetores-gratis/ilustracao-de-certificacao-iso-com-pessoas-e-bloco-de-notas_23-2148689291.jpg?w=740&t=st=1680278085~exp=1680278685~hmac=b60e87305dee46a75aa245d3c40c4e0fab4dc8b871701d01e79fd886bd16d439"
                                alt="" width="350px">
                            <div class="legend">
                                Imagem de <a
                                    href="https://br.freepik.com/vetores-gratis/ilustracao-de-certificacao-iso-com-pessoas-e-bloco-de-notas_10329155.htm#query=certifica%C3%A7%C3%A3o&position=13&from_view=search&track=sph"
                                    class="link">Freepik</a>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('view.certifs') }}" class="link fs-4"> Ver meus certificados </a>

                            <img src="{{ asset('storage/certificado/certificado_curso.png') }}" alt="">
                        </div>
                    </section>
                @endif
            @endforeach
        @endforeach
    @endif
@endsection
