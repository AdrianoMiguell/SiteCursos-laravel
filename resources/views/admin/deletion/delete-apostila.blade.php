<form
    action="{{ route('apostila.delete', ['curso_id' => $conteudo->curso_id, 'apostila_id' => $conteudo->apostila->id, 'conteudo_id' => $conteudo->id]) }}"
    method="POST" class="m-0 p-0">
    @csrf
    @method('DELETE')

    <button class="btnGeral btnGeral-dark" type="submit"
        onclick="return confirm('Tem certeza que deseja deletar esse curso?')">
        <i class="bi bi-trash-fill"></i>
    </button>
</form>
