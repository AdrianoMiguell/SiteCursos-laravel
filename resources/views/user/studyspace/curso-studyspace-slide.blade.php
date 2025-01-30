@if (isset($conteudo->slide))
{{-- 
Exemplo de link esperado para incorporar o slide. Caso seja diferente, será exibido apenas o link para o usuario acessar.
<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vSRlZdyysE0affFYEv31A8u24GrEEEiFs1fr99_dj2YPjF_NSUo-9IOsPaHecd0rgQEg1AnrYIwbp7c/embed?start=false&loop=false&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
--}}

    @php
        foreach ($curso->modulos as $key => $moduloItem) {
            if ($moduloItem->id == $modulo->id) {
                $linkKeyModulo = $key;
            }
        }
    @endphp

    <style>
        .slide-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border: 1px solid #cab;
        }

        .slide-container iframe {
            position: absolute;
            width: 100% !important;
            height: 100% !important;
            min-width: 560px;
            min-height: 315px;
            top: 0;
            left: 0;
        }

        .slide-container object {
            width: 100% !important;
            height: 100% !important;
            min-width: 360px;
            min-height: 650px;
            border: 5px solid rgba(var(--main-c), .75);
            box-shadow: 0 2px 5px solid rgb(var(--main-c));
        }

        /*
        .slide-container {
            width: 100%;
            height: 750px;
        }

        .slide-container object {
        */
    </style>
    <div class="my-5 container">
        <div class="">
            <span class="d-flex align-items-center gap-2">
                <a href="{{ route('user.curso', ['slug' => $curso->slug]) }}" class="text-decoration-none"
                    style="color: rgb(var(--main-c));">
                    {{ $curso->name }}
                </a>
                <i class="bi bi-caret-right-fill"></i>
                <a href="{{ $linkKeyModulo ? '#collapseModulo' . $linkKeyModulo : '#accordionModulos' }}"
                    class="text-decoration-none" style="color: rgb(var(--main-c));">
                    {{ $modulo->title }}
                </a>
                <i class="bi bi-caret-right-fill"></i>
                <a href="{{ route('user.curso.studyspace', ['slug' => $curso->slug, 'modulo' => $modulo->id, 'conteudo' => $conteudo->id]) }}"
                    class="text-decoration-none" style="color: rgb(var(--main-c));">
                    {{ $conteudo->order }}° Conteúdo - {{ $conteudo->slide->title }}
                </a>
            </span>
            <h1 class="title my-4">
                {{ $conteudo->slide->title }}
            </h1>
            <span class="my-2 mb-4">
                {{ $conteudo->slide->text }}
            </span>
        </div>


        {{$conteudo->slide->link;}}

        <div class="slide-container my-5">

            @if (strpos($moduloItem->link, 'iframe') !== false && 
                strpos($moduloItem->link, 'docs') !== false && 
                strpos($moduloItem->link, 'presentation') !== false)
                @php
                    echo $conteudo->slide->link;
                @endphp
            @elseif(strpos($moduloItem->link, '.pdf') !== false || strpos($moduloItem->link, 'doc') !== false)
                {{-- pode ser um pdf ou .doc --}}
                <object data="{{ $conteudo->slide->link }}" type=""> </object>
            @else
                Acesse em: <a href="{{ $conteudo->slide->link }}" target="_blank">{{ $conteudo->slide->link }}</a>
            @endif
            {{-- <object data="https://my.visme.co/view/g76gq6mw-new-project" type=""> </object> --}}
        </div>

        @include('components.buttons-previous-next')
    </div>
@endif
