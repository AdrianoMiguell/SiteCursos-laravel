@extends('layouts.app')

@section('content')
    @include('admin.header-options')

    <section class="container workspace-conteudo">

        <h1 class="mb-5"> Novo conteúdo </h1>

        <div class="sec-curso-reference">
            <h2> Cursos cadastrados: </h2>
            <div class="div-curso-reference">
                @foreach ($cursos as $key => $c)
                    <div class="curso-reference">
                        <a href="{{ route('conteudo.view', ['curso_id' => $c->id]) }}" class="curso-link">
                            {{ $c->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        @include('admin.section-info-curso')

        @if (isset($curso) && isset($curso->modulos) && count($curso->modulos) > 0)
            <div class="choose-type">

                <h2> Escolha o tipo de conteúdo: </h2>

                <div class="d-flex justify-content-between align-items-center p-0 my-5"
                    style="background-color: rgb(var(--main-c));">
                    <div class="type-conteudo">
                        <input type="radio" name="type" class="input-type" id="type-1" value="1"
                            onclick="changeTypeContent(1)" checked>
                        <label class="label-type" for="type-1">
                            Apostila
                        </label>
                    </div>
                    <div class="type-conteudo">
                        <input type="radio" name="type" class="input-type" id="type-2" value="2"
                            onclick="changeTypeContent(2)">
                        <label class="label-type" for="type-2">
                            Desafio
                        </label>
                    </div>
                    <div class="type-conteudo">
                        <input type="radio" name="type" class="input-type" id="type-3" value="3"
                            onclick="changeTypeContent(3)">
                        <label class="label-type" for="type-3">
                            Slide
                        </label>
                    </div>
                    <div class="type-conteudo">
                        <input type="radio" name="type" class="input-type" id="type-4" value="4"
                            onclick="changeTypeContent(4)">
                        <label class="label-type" for="type-4">
                            Video
                        </label>
                    </div>
                </div>

                <div class="d-grid gap-4">
                    <div class="div-type-conteudo" id="div-type-conteudo-1">
                        @include('admin.creators.create-conteudo-apostila')
                    </div>
                    <div class="div-type-conteudo" id="div-type-conteudo-2">
                        @include('admin.creators.create-conteudo-desafio')
                    </div>
                    <div class="div-type-conteudo" id="div-type-conteudo-3">
                        @include('admin.creators.create-conteudo-slide')
                    </div>
                    <div class="div-type-conteudo" id="div-type-conteudo-4">
                        @include('admin.creators.create-conteudo-video')
                    </div>
                </div>
            </div>

            <script>
                const changeTypeContent = (id) => {
                    let allElems = document.querySelectorAll('.div-type-conteudo');
                    let elName = document.getElementById(`div-type-conteudo-${id}`);

                    allElems.forEach(el => {
                        el.style.display = "none";
                    });

                    elName.style.display = "flex";
                }
            </script>
        @else
            <span class="alert alert-danger">
                Nenhum modulo criado. Crie um modúlo antes de criar os conteúdos do seu curso.
            </span>
        @endif

    </section>
@endsection
