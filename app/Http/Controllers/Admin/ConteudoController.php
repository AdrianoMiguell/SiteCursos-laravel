<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Questionario;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function create(Request $request)
    {
        $id = $request->curso_id;
        $curso = Curso::where('id', $id)->get();
        $qtd = $curso[0]->modulos;
        $dbConteudos = Conteudo::where('curso_id', $id)->get();

        if (empty($dbConteudos[0]->id) || count($dbConteudos) < $qtd) {
            if (count($dbConteudos) < $qtd) {
                $new_qtd = $qtd;
                $qtd = $new_qtd - count($dbConteudos);
            }

            $request->validate([
                'name.*' => 'required|string',
                'text.*' => 'required|string',
                'link.*' => 'nullable|string',
            ]);

            $conteudos = $request->except('_token');
            for ($i = 0; $i < $qtd; $i++) {
                $conteudo['name'] = $conteudos['name'][$i];
                $conteudo['text'] = $conteudos['text'][$i];
                $conteudo['link'] = $conteudos['link'][$i];
                $conteudo['numbering'] = $i;
                $conteudo['curso_id'] = $id;

                Conteudo::create($conteudo);

                $curso = Curso::find($curso[0]->id);
                $curso->ready = "ok";
                $curso->save();
            }


            return redirect()->route('view-create-quest', ['id' => $id])
                ->with('status', 'Conteudos do curso criados com sucesso!');
        }
        return back()
            ->with('status', 'Erro!');
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
        $quests = Questionario::where('curso_id', $curso->id)->get();

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
