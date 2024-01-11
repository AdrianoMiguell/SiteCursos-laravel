<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Desafio;
use Illuminate\Http\Request;

class DesafioController extends Controller
{
    public function view()
    {
    }
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'text' => 'required|string',
            'link' => 'required|string',
            'modulo_id' => 'required',
            'curso_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link');
        $desafio = $request->except('_token', 'type', 'modulo_id', 'curso_id');

        $desafio = Desafio::create($desafio);

        $conteudo['desafio_id'] = $desafio->id;
        $conteudo['order'] = Conteudo::where('curso_id', $conteudo['curso_id'])->count() + 1;


        $conteudo = Conteudo::create($conteudo);

        return redirect()->route('curso.workspace', ['curso_id' => $conteudo->curso_id])->with('status', 'Conteúdo criado com sucesso!');
    }
    public function edit(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'text' => 'required|string',
            'link' => 'required|string',
            'modulo_id' => 'required',
            'curso_id' => 'required',
            'desafio_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link', 'conteudo_id');
        $desafio = $request->except('_token', 'type', 'modulo_id', 'curso_id', 'desafio_id', 'conteudo_id');

        Desafio::findOrFail($request->desafio_id)->update($desafio);
        Conteudo::findOrFail($request->conteudo_id)->update($conteudo);

        return back()->with('status', 'Conteúdo editado com sucesso!');
    }

    public function delete(Request $request)
    {
        Conteudo::findOrFail($request->conteudo_id)->delete();
        Desafio::findOrFail($request->desafio_id)->delete();

        return back()->with('status', 'Conteúdo deletado com sucesso!');
    }
}
