<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Questionario;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function view(Request $request)
    {
        $id = $request->curso_id;
        $curso = Curso::where('id', $id)->get();
        $conteudos = Conteudo::where('curso_id', $id)->get();

        if (!isset($id)) {
            return redirect()->route('view-create-curso')
                ->with('status', 'Curso não encontrado');
        } else if (!empty($id) && !empty($conteudos)) {
            return view('admin.create-conteudo', compact('curso', 'conteudos'));
        } else {
            return view('admin.create-conteudo', compact('curso'));
        }
    }

    public function create(Request $request)
    {
        $id = $request->curso_id;
        $curso = Curso::where('id', $id)->get();
        $qtd = $curso[0]->modulos;
        $dbConteudos = Conteudo::where('curso_id', $id)->get();

        if (empty($dbConteudos[0]->id) || count($dbConteudos) < $qtd) {
            if(count($dbConteudos) < $qtd) {
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
}
