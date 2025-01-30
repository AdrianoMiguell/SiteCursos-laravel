@if (isset($conteudo->apostila))
    @php
        foreach ($curso->modulos as $key => $moduloItem) {
            if ($moduloItem->id == $modulo->id) {
                $linkKeyModulo = $key;
            }
        }
    @endphp

    <style>
        .apostila-container {
            width: 100%;
            height: 750px;
        }

        /* .apostila-container object { */
        .apostila-container object {
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
                    {{ $conteudo->order }}° Conteúdo - {{ $conteudo->apostila->title }}
                </a>
            </span>
            <h1 class="title my-4">
                {{ $conteudo->apostila->title }}
            </h1>
            <span class="my-2 mb-4">
                {{ $conteudo->apostila->text }}
            </span>
        </div>

        @if (strpos($conteudo->apostila->link, 'iframe') !== false &&
                strpos($conteudo->apostila->link, 'docs') !== false &&
                strpos($conteudo->apostila->link, 'presentation') !== false)
            @php
                echo $conteudo->apostila->link;
            @endphp
        @elseif(strpos($conteudo->apostila->link, '.pdf') !== false || strpos($conteudo->apostila->link, '.doc') !== false)
            {{-- pode ser um pdf ou .doc --}}
            <div class="apostila-container my-5">
                <object data="{{ asset('storage' . $conteudo->apostila->link) }}" type=""> </object>
            </div>
        @else
            <div class="container my-5">
                Acesse em: <a href="{{ $conteudo->apostila->link }}" target="_blank">{{ $conteudo->apostila->link }}</a>
            </div>
        @endif

        @include('components.buttons-previous-next')

    </div>
@endif
