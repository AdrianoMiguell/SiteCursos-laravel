<form action="{{ route('slide.delete', ['curso_id' => $quiz->curso_id, 'modulo_id' => $quiz->modulo_id]) }}"
    method="POST" class="m-0 p-0">
    @csrf
    @method('DELETE')

    <button class="btnGeral btnGeral-dark" type="submit"
        onclick="return confirm('Tem certeza que deseja deletar esta pergunta?')">
        <i class="bi bi-trash-fill"></i>
    </button>
</form>
