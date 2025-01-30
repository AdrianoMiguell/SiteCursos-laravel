<form action="{{ route('slide.create') }}" method="POST" class="my-4">
    @csrf

    <legend> Slide </legend>

    <div class="my-5">
        <label for="modulo_id" class="form-label">
            <h2>Selecione o modúlo referente ao conteúdo:</h2>
        </label>
        <select name="modulo_id" id="modulo_id" class="form-control">
            <option value=""> --- selecione --- </option>
            @foreach ($curso->modulos as $key => $modulo)
                <option value="{{ $modulo->id }}">{{ $modulo->title }}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="type" value="3">
    <input type="hidden" name="curso_id" value="{{ $curso->id }}">

    <div class="my-3">
        <div class="">
            <label for="" class="form-label d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                <span> Titulo </span>
            </label>
        </div>
        <input type="text" name="title" id="" class="form-control">
    </div>

    <div class="my-3">
        <label class="form-label d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Texto inicial</span>
        </label>
        <textarea type="text" name="text" id="" class="form-control"></textarea>
    </div>

    <div class="my-3">
        <label for="" class="form-label d-flex align-items-center gap-2">
            <i class="bi bi-link-45deg"></i>
            <span>Link</span>
        </label>
        <input type="text" name="link" id="" class="form-control">
    </div>

    <div class="my-3">
        <input type="submit" value="Enviar" class="btnGeral btnGeral-dark">
    </div>

</form>
