<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apostila;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Desafio;
use App\Models\Modulo;
use App\Models\Slide;
use App\Models\Video;
use Illuminate\Http\Request;

class ModuloController extends Controller
{

    public function view(Request $request)
    {
        if (!isset($request->curso_id)) {
            return redirect()->route('workspace');
        }

        $curso = Curso::findOrFail($request->curso_id);

        if (!isset($request->modulo_id)) {
            return view('admin.workspace-modulo', compact('curso'));
        }

        $modulo = Modulo::findOrFail($request->modulo_id);
        return view('admin.workspace-modulo', compact('curso', 'modulo'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min: 1|max: 150',
            'desc' => 'nullable|string|min: 25|max: 1500',
            'curso_id' => 'required'
        ]);

        $modulo = $request->except('_token');

        Modulo::create($modulo);

        return redirect()->route('curso.workspace', ['curso_id' => $modulo['curso_id']])->with('status', 'Modulo criado com sucesso!');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min: 1|max: 150',
            'desc' => 'nullable|string|min: 25|max: 1500',
            'curso_id' => 'required'
        ]);

        $modulo = $request->except('_token', 'modulo_id');

        Modulo::findOrFail($request->modulo_id)->update($modulo);

        return redirect()->back()->with('status', 'Módulo Atualizado com sucesso.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'modulo_id' => 'required'
        ]);

        $conteudos = Conteudo::where([['modulo_id', $request->modulo_id], ['curso_id', $request->curso_id]])->get();

        if (count($conteudos) > 0) {
            foreach ($conteudos as $key => $c) {
                Conteudo::findOrFail($c->id)->delete();

                if (isset($c->apostila_id)) {
                    Apostila::findOrFail($c->apostila->id)->delete();
                } else if (isset($c->desafio_id)) {
                    Desafio::findOrFail($c->desafio->id)->delete();
                } else if (isset($c->slide_id)) {
                    Slide::findOrFail($c->slide->id)->delete();
                } else if (isset($c->video_id)) {
                    Video::findOrFail($c->video->id)->delete();
                }
            }
        }

        Modulo::findOrFail($request->modulo_id)->delete();

        return redirect()->back()->with('status', 'Módulo Atualizado com sucesso.');
    }
}
