@if (isset($conteudo->desafio))
    @php
        foreach ($curso->modulos as $key => $moduloItem) {
            if ($moduloItem->id == $modulo->id) {
                $linkKeyModulo = $key;
            }
        }
    @endphp

    <style>
        .desafio-container {
            width: 100%;
            height: 750px;
        }

        /* .desafio-container object { */
        .desafio-container object {
            width: 100% !important;
            height: 100% !important;
            min-width: 360px;
            min-height: 650px;
            border: 5px solid rgba(var(--main-c), .75);
            box-shadow: 0 2px 5px solid rgb(var(--main-c));
        }
    </style>
    <div class="my-5">
        <div class="container">
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
                    {{ $conteudo->order }}° Conteúdo - {{ $conteudo->desafio->title }}
                </a>
            </span>
            <h1 class="title my-4">
                {{ $conteudo->desafio->title }}
            </h1>
            <span class="my-2 mb-4">
                {{ $conteudo->desafio->text }}
            </span>
        </div>
        
        <div class="desafio-container my-5">
            <object data="{{ asset('storage' . $conteudo->desafio->link) }}" type=""> </object>
        </div>

        @include('components.buttons-previous-next')
    </div>
@endif
