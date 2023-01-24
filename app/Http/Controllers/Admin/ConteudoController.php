<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function view(Request $request)
    {
        $id = $request->id;
        $curso = Curso::where('id', $id)->get();
        if (!isset($id) || empty($id)) {
            return redirect()->route('view-create-curso')
                ->with('status', 'Curso não encontrado');
        } else {
            return view('admin.create-conteudo', compact('curso'));
        }
    }

    public function create(Request $request)
    {
        $id = $request->curso_id;
        $curso = Curso::where('id', $id)->get();
        $qtd = $curso[0]->modulos;
        $dbConteudos = Conteudo::where('cursos_id', $id)->get();

        if (empty($dbConteudos[0]->id)) {
            $request->validate([
                'name.*' => 'required',
                'text.*' => 'required',
                'file_link.*' => 'required',
            ]);

            $conteudos = $request->except('_token');

            for ($i = 0; $i < $qtd; $i++) {
                $conteudo['name'] = $conteudos['name'][$i];
                $conteudo['text'] = $conteudos['text'][$i];
                $conteudo['file_link'] = $conteudos['file_link'][$i];
                $conteudo['cursos_id'] = $id;

                Conteudo::create($conteudo);
            }
        }

        return redirect()->route('dashboard', ['id' => $id])
            ->with('status', 'Conteudos do curso criados com sucesso!');
    }

    public function update(Request $request){
        $id = $request->curso_id;
        $curso = Curso::where('id', $id)->get();
        $qtd = $curso[0]->modulos;
        $dbConteudos = Conteudo::where('cursos_id', $id)->get();

        if (empty($dbConteudos[0]->id)) {
            $request->validate([
                'name.*' => 'required',
                'text.*' => 'required',
                'file_link.*' => 'required',
            ]);

            $conteudos = $request->except('_token');

            for ($i = 0; $i < $qtd; $i++) {
                $conteudo['name'] = $conteudos['name'][$i];
                $conteudo['text'] = $conteudos['text'][$i];
                $conteudo['file_link'] = $conteudos['file_link'][$i];
                $conteudo['cursos_id'] = $id;

                Conteudo::find($conteudo);
            }
        }

        return redirect()->route('dashboard', ['id' => $id])
            ->with('status', 'Conteudos do curso criados com sucesso!');
    }
}
