<!-- Button trigger modal -->
<button type="button" class="btnGeral btnGeral-dark" data-bs-toggle="modal"
    data-bs-target="#modalDesafio{{ $key_conteudo }}">
    <i class="bi bi-pencil-fill"></i>
</button>

<!-- Modal -->
<div class="modal fade modal-conteudo" id="modalDesafio{{ $key_conteudo }}" tabindex="-1"
    aria-labelledby="modalDesafio{{ $key_conteudo }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('desafio.edit') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h1 class="modal-title mt-3 mb-4" id="modalDesafio{{ $key_conteudo }}Label">Editar Desafio</h1>

                    <div class="mb-4">
                        <label for="modulo_id" class="form-label">
                            Mudar modúlo referente a este conteúdo:
                        </label>
                        <select name="modulo_id" id="modulo_id" class="form-control">
                            @foreach ($curso->modulos as $key => $m)
                                <option value="{{ $m->id }}"
                                    @if ($m->id == $modulo->id) @selected(true) @endif>
                                    {{ $m->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="type" value="{{$conteudo->type}}">
                    <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                    <input type="hidden" name="desafio_id" value="{{ $conteudo->desafio->id }}">
                    <input type="hidden" name="conteudo_id" value="{{ $conteudo->id }}">

                    <div class="my-3">
                        <label for="conteudo_title" class="form-label d-flex align-items-center gap-2">
                            <i class="bi bi-pencil-fill"></i>
                            <span> Titulo </span>
                        </label>
                        <input type="text" name="title" value="{{ $conteudo->desafio->title }}" id="conteudo_title"
                            class="form-control">
                    </div>

                    <div class="my-3">
                        <label for="conteudo_text" class="form-label d-flex align-items-center gap-2">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Texto inicial</span>
                        </label>
                        <textarea type="text" name="text" id="conteudo_text" class="form-control">{{ $conteudo->desafio->text }}</textarea>
                    </div>

                    <div class="my-3">
                        <label for="conteudo_link" class="form-label d-flex align-items-center gap-2">
                            <i class="bi bi-link-45deg"></i>
                            <span>Link </span>
                        </label>
                        <textarea type="text" name="link" id="conteudo_link" class="form-control">{{ $conteudo->desafio->link }}</textarea>
                    </div>
                    
                    <div class="my-3">
                        <label for="conteudo_order" class="form-label d-flex align-items-center gap-2">
                            <i class="bi bi-link-45deg"></i>
                            <span> Ordem </span>
                        </label>
                        <input type="number" class="form-control" name="order" id="conteudo_order" value="{{ $conteudo->order }}">
                    </div>

                    <div class="my-3 mt-4 d-flex justify-content-end">
                        <input type="submit" value="Editar" class="btnGeral btnGeral-dark">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
