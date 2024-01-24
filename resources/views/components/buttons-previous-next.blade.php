@php
    foreach ($curso->modulos as $key_mod => $for_modulo) {
        if ($key_mod == count($curso->modulos)) {
            foreach ($for_modulo->conteudos as $key_cont => $for_conteudo) {
                if ($key_cont == count($modulo->conteudos)) {
                    $lastConteudo = $for_conteudo;
                }
            }
        }
    }

    // dd($lastConteudo);

@endphp

<div class="w-100">
    <div class="d-flex justify-content-between align-items-center gap-3">
        <span>
            @if ($conteudo->order != 1 || $modulo->order > 1)
                <form action="{{ route('curso.matricula.previous') }}" method="GET">
                    @csrf

                    <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                    <input type="hidden" name="modulo" value="{{ $modulo->id }}">
                    <input type="hidden" name="conteudo" value="{{ $conteudo->id }}">

                    <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                    <button type="submit" class="btnGeral btnGeral-dark">
                        <i class="bi bi-caret-left-fill"></i>
                        Previous
                    </button>
                </form>
            @endif
        </span>

        <span>
            @if (isset($lastConteudo->id) && $lastConteudo->id == $conteudo->id)
                <form action="{{ route('curso.matricula.conclusion') }}" method="GET">
                    @csrf

                    <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                    <input type="hidden" name="modulo" value="{{ $modulo->id }}">
                    <input type="hidden" name="conteudo" value="{{ $conteudo->id }}">

                    <button type="submit" class="btnGeral btnGeral-dark">
                        Concluir
                        <i class="bi bi-caret-right-fill"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('curso.matricula.next') }}" method="GET">
                    @csrf

                    <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                    <input type="hidden" name="modulo" value="{{ $modulo->id }}">
                    <input type="hidden" name="conteudo" value="{{ $conteudo->id }}">

                    <button type="submit" class="btnGeral btnGeral-dark">
                        Next
                        <i class="bi bi-caret-right-fill"></i>
                    </button>
                </form>
            @endif
        </span>

    </div>

</div>
