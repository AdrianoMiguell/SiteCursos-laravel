<form action="{{ route('curso.delete', ['id' => $curso->id]) }}" method="POST" class="m-0 p-0">
    @csrf
    @method('DELETE')
    <button class="btnGeral btnGeral-dark" type="submit" onclick="return confirm('Tem cerrteza que deseja deletar esse curso?')">
        <i class="bi bi-trash-fill"></i>
    </button>
</form>
