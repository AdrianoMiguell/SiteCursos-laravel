<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apostila;
use App\Models\Conteudo;
use Illuminate\Http\Request;

class ApostilaController extends Controller
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
        $apostila = $request->except('_token', 'type', 'modulo_id', 'curso_id');

        $apostila = Apostila::create($apostila);

        $conteudo['apostila_id'] = $apostila->id;
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
            'apostila_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link', 'conteudo_id');
        $apostila = $request->except('_token', 'type', 'modulo_id', 'curso_id', 'apostila_id', 'conteudo_id');

        Apostila::findOrFail($request->apostila_id)->update($apostila);
        Conteudo::findOrFail($request->conteudo_id)->update($conteudo);

        return back()->with('status', 'Conteúdo editado com sucesso!');
    }

    public function delete(Request $request)
    {
        Conteudo::findOrFail($request->conteudo_id)->delete();
        Apostila::findOrFail($request->apostila_id)->delete();

        return back()->with('status', 'Conteúdo deletado com sucesso!');
    }
}
