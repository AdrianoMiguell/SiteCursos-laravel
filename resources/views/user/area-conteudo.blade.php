@extends('layouts.app')

@section('content')
    <section class="section_conteudo">
        <div>
            <h4 class="text-center"> {{ $conteudo->name }}</h4>
            <iframe width="560" height="315" src="{{ $conteudo->link }}&enablejsapi=1" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen id="video_modulo"></iframe>
        </div>

        <div class="conteudo_text my-3">
            {{ $conteudo->text }}

            <div class="dark_text my-3">
                <h5> Conteudos do curso </h5>
                <ul class="conteudo_link">
                    @foreach ($curso->conteudos as $key => $conteudo)
                        <li>
                            <a class="link dark_text"
                                href="{{ route('user.conteudo', ['curso_id' => $curso->id, 'conteudo_id' => $conteudo->id]) }}">
                                {{ $conteudo->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            {{--
            <div class="next_previous">
                @if ($curso->modulos == 1 || $conteudo->numbering == $curso->modulos)
                    <form action="{{ route('questions.modulo', ['curso_id' => $conteudo->curso_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btnGeral"> Questionario </button>
                    </form>
                @else
                    @if ($curso->modulos > 1 && $conteudo->numbering < $curso->modulos - 1 && $conteudo->numbering != 0)
                        <form
                            action="{{ route('next.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btnGeral next">next</button>
                        </form>
                    @else
                        <a href="{{ route('prev.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                            class="btnGeral previous"> Previous </a>

                        <form
                            action="{{ route('next.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btnGeral next">next</button>
                        </form>

                    @endif
                @endif

            </div> --}}

            <div>
                $curso->modulos -
                {{ $curso->modulos }}
                $conteudo->numbering -
                {{ $conteudo->numbering }}
                $curso->modulos - 1 =
                {{ $curso->modulos - 1 }}
                -
                matricula
                {{ $matricula[0]->modulo_atual }}
            </div>

            <div class="next_previous">

                @if ($curso->modulos > 1 && $conteudo->numbering <= $curso->modulos && $conteudo->numbering != 1)
                    <a href="{{ route('prev.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                        class="btnGeral previous"> Previous </a>
                @else
                    <style>
                        .next_previous {
                            flex-direction: row-reverse;
                        }
                    </style>
                @endif

                @if ($curso->modulos == 1 || $conteudo->numbering ==  $curso->modulos)
                    <form action="{{ route('questions.modulo', ['curso_id' => $conteudo->curso_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btnGeral"> Questionario </button>
                    </form>
                @else
                    @if ($matricula[0]->modulo_atual == $conteudo->numbering - 1)
                        <form
                            action="{{ route('next.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btnGeral next">next</button>
                        </form>
                    @else
                        <form
                            action="{{ route('next.modulo', ['matricula_id' => $matricula[0]->id, 'conteudo_id' => $conteudo->id]) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btnGeral">next</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <script src="/js/controller.js"></script>
    <script src="/js/video.js"></script>
@endsection
