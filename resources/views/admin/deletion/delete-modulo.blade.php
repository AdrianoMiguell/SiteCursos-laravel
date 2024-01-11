<form action="{{ route('modulo.delete') }}" method="post" onsubmit="return confirm('Tem certeza que quer deletar este modúlo?')">
{{-- <form action="/" method="post" > --}}
    @csrf
    @method('DELETE')

    <input type="hidden" name="curso_id" value="{{ $curso->id }}">
    <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">

    <button type="submit" class="btnGeral btnGeral-dark p-2 py-1">
        <i class="bi bi-trash-fill"></i>
    </button>
</form>
