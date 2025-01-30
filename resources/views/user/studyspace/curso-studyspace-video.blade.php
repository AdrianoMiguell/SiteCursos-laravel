@if (isset($conteudo->video_id))
    @php
        foreach ($curso->modulos as $key => $moduloItem) {
            if ($moduloItem->id == $modulo->id) {
                $linkKeyModulo = $key;
            }
        }
    @endphp

    <style>
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border: 1px solid #cab;
        }

        .video-container iframe {
            position: absolute;
            width: 100% !important;
            height: 100% !important;
            min-width: 560px;
            min-height: 315px;
            top: 0;
            left: 0;
        }
    </style>
    <div class="my-5 container">
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
                {{ $conteudo->order }}° Conteúdo - {{ $conteudo->video->title }}
            </a>
        </span>
        <h1 class="title my-4">
            {{ $conteudo->video->title }}
        </h1>

        <span class="my-2 mb-4">
            {{ $conteudo->video->text }}
        </span>

        @if (strpos($conteudo->video->link, 'iframe') !== false &&
                strpos($conteudo->video->link, 'youtube') !== false &&
                strpos($conteudo->video->link, 'src') !== false)
            <div class="video-container mt-3 mb-5">
                @php
                    echo $conteudo->video->link;
                @endphp
            </div>
        @else
            <div class="container my-5">
                Acesse em: <a href="{{ $conteudo->video->link }}"
                    target="_blank">{{ $conteudo->video->link }}</a>
            </div>
        @endif

        @include('components.buttons-previous-next')

    </div>
@endif
