@extends('layouts.app')



{{-- 

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

@section('content')
    <form action="{{ route('search') }}" method="POST" class="search_form p-5 m-0 mb-3 d-block text-center"
        style="background-color: rgba(var(--main-cor), .98);">
        <legend class="text-light"> Pesquisa </legend>
        <input type="search" name="search" id="search_input" maxlength="25" size="30">
        <button type="submit" class="search_btn btnGeral">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
    </form>

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

    <section class="section-cursos mt-5 my-1">
        <div class="div-cursos">
            @forelse ($cursos as $key => $curso)
                <div class="curso">
                    <div class="img-curso">
                        <img src="{{ asset('storage/' . $curso->img) }}" alt="">
                    </div>
                    <div class="info-curso">
                        <span class="name"> {{ $curso->name }} </span>
                        <span class="desc"> {{ $curso->desc }} </span>
                        <div class="d-flex justify-content-between">
                            <span> Duração : {{ $curso->duration }} </span>
                            <span> Modulos : {{ $curso->modulos }} </span>
                        </div>
                        <div class="info-price">
                            @if ($curso->promotion_price == 0)
                                <span class="price"> Gratuito </span>
                            @else
                                <span class="price"> Preço: R$ {{ $curso->promotion_price }} </span>
                            @endif
                            <a class="btnGeral" href="{{ route('view.curso', ['curso_id' => $curso->id]) }}">
                                <i class="bi bi-eye-fill"></i>
                                visualizar</a>
                        </div>
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
        </div>
    </section>

    @if (isset($matricula))
        <section class="area_cursos mt-5 my-1">
            @include('user.myCursos')
        </section>


        @foreach ($cursos as $key => $c)
            @foreach ($matricula as $m)
                @if ($m->curso_id == $c->id && $m->status == 'concluido')
                    <section class="area_cursos mt-5 my-1 gap-5">
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

@endsection --}}
