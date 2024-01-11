<div class="header-options">
    <ul class="header-list">

        <li class="header-item">
            <a href="{{ isset($curso) ? route('curso.workspace', ['curso_id' => $curso->id]) : route('curso.view') }}">
                <i class="bi bi-eye-fill"></i> <span>Curso</span>
            </a>
        </li>

        <li class="header-item">
            <a href="{{ isset($curso) ? route('curso.view', ['curso_id' => $curso->id]) : route('curso.view') }}">
                <i class="bi bi-pencil-fill"></i> <span>Editar</span>
            </a>
        </li>

        <li class="header-item">
            <a href=""><i class="bi bi-trash-fill"></i> <span>Deletar</span></a>
        </li>

        <li class="header-item"> <a href="{{ route('modulo.view', ['curso_id' => $curso->id]) }}"><i
                    class="bi bi-plus"></i>
                <span>Módulo</span> </a> </li>

        <li class="header-item">
            <a href="{{ route('conteudo.view', ['curso_id' => $curso->id]) }}"><i class="bi bi-plus"></i>
                <span>Conteúdo</span> </a>
        </li>

        <li class="header-item"> <a
                href="{{ route('quiz.view', ['curso_id' => $curso->id, 'modulo_id' => !empty($curso->modulos[0]->id) ? $curso->modulos[0]->id : '' ]) }}"><i
                    class="bi bi-plus"></i> <span>Questionário</span></a> </li>

        <li class="header-item"> <a href=""><i class="bi bi-patch-check"></i> <span>Certificação</span></a> </li>
    </ul>
</div>
