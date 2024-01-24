<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Quiz;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{

    public function view(Request $request)
    {
        if (!isset($request->curso_id)) {
            return redirect()->route('workspace');
        }

        $cursos = Curso::all();
        $curso = Curso::findOrFail($request->curso_id);
        return view('admin.workspace-conteudo', compact('curso', 'cursos'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min: 1|max: 300',
            'text' => 'required|string|min: 25|max: 2500',
            'type' => 'required|string',
            'modulo_id' => 'required',
            'curso_id' => 'required'
        ]);

        

        $modulo = $request->except('_token');

        Modulo::create($modulo);

        $curso = Curso::findOrFail($modulo['curso_id']);
        return view('admin.workspace-modulo', compact('curso'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'text' => 'required',
            'link' => 'required',
        ]);

        $conteudo = $request->except('_token');
        $id = $conteudo['id'];

        $conteudo = Conteudo::findOrFail($id)->update($conteudo);
        return back()
            ->with('status', 'dados editados com sucesso!');
    }

    public function delete($id)
    {
        $conteudo = Conteudo::findOrFail($id);
        $conteudo->delete();

        return back()->with('status', 'Deletado com sucesso!');
    }

    public function conteudos(Request $request)
    {
        if (!isset($request->id) || empty($request->id)) {
            return redirect()->route('view.cursos');
        }

        $id = $request->id;
        $curso = Curso::findOrFail($id);

        if (!isset($curso->id)) {
            return redirect()->route('view-create-curso')->with('status', 'Curso não existente!');
        }

        $conteudos = Conteudo::where('curso_id', $curso->id)->get();
        $quests = Quiz::where('curso_id', $curso->id)->get();

        $tot_modulos = $curso->modulos;

        if (!isset($conteudos) || empty($conteudos[0]->id)) {
            return redirect()->route('view-create-curso', ['curso_id' => $curso->id])
                ->with('status', 'Conteudos do curso não foram criados!');
            dd($tot_modulos);
        } else if ($tot_modulos != $conteudos->count()) {
            return redirect()->route('view-create-curso', ['curso_id' => $curso->id])
                ->with('status', 'Conteudos do curso não estão concluidos!');
        } else {
            return view('admin.view-conteudo', compact('curso', 'conteudos', 'quests'));
        }
    }
}
