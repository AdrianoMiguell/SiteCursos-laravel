@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-around py-5 p-3">
        <div>
            <form action="{{ route('create.questionario') }}" method="post" class="p-2 px-3 shadow-none text-dark" enctype="multipart/form-data">
                <legend class="textDec"> Criar questionario </legend>
                <p style="text-align: center; font-size: 9pt;">Esse quesitonario servira para testar os conhecimentos do
                    aluno. Se responder certo a 6 questões, poderá receber seu certificado</p>
                @csrf
                @for ($i = 0; $i < 2; $i++)
                    <div class="my-4 grid gap-3">
                        <div>
                            <label for="perg">{{ $i + 1 }}° pergunta </label>
                            <textarea class="form-control" type="text" id="perg" name="perg[]" placeholder="Digite o nome do modulo"
                                maxlength="100" required> </textarea>
                        </div>

                        <div>
                            <label for="img"> Imagem auxiliar <span class="text-danger"> (obs: opcional)</span></label>
                            <input type="file" name="img[]" id="img" class="form-control">
                        </div>

                        <div>
                            <label for="resp1"> Opção 1</label>
                            <input class="form-control" type="text" id="resp1" name="resp1[]" maxlength="2500" required>
                        </div>

                        <div>
                            <label for="resp2"> Opção 2</label>
                            <input class="form-control" type="text" id="resp2" name="resp2[]" maxlength="2500" required>
                        </div>

                        <div>
                            <label for="resp3"> Opção 3</label>
                            <input class="form-control" type="text" id="resp3" name="resp3[]" maxlength="2500" required>
                        </div>
                        <div>
                            <label for="respTrue1"> Qual a resposta correta : </label>
                            <select name="respTrue[]" id="respTrue" class="p-1 px-2 rounded m-2">
                                <option value="1"> 1° </option>
                                <option value="2"> 2° </option>
                                <option value="3"> 3° </option>
                            </select>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endfor
                <input type="number" name="curso_id" value="{{ $curso[0]->id }}" class="d-none">
                <input type="submit" class="btnGeral my-2 mx-auto" value="Enviar">
            </form>
        </div>
    </section>
@endsection
