<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max: 10000',
            'description' => 'required',
            'duration' => 'required',
            'modulos' => 'required',
            'price' => 'required',
            'promotion' => 'required',
        ]);

        $curso = $request->except('_token');
        $curso['image'] = $request->image->store('images');
        $curso = Curso::create($curso);
        $id = $curso['id'];

        return redirect()->route('view-create-conteudo', ['id' => $id])
            ->with('status', 'dados criados com sucesso!');
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max: 10000',
            'description' => 'required',
            'duration' => 'required',
            'modulos' => 'required',
            'price' => 'required',
            'promotion' => 'required',
        ]);

        if (!empty($request->image)) {
            Storage::delete($request->image);
            $curso['image'] = $request->image->store('images');
            $curso = $request->except('_token');
        } else {
            $curso = $request->except('_token', 'image');
        }

        $ago_curso = Curso::findOrFail($id);

        if ($request->modulos < $ago_curso->modulos) {
            $conteudos = Conteudo::where('curso_id', $id)->get();
            if ($conteudos->count() > $request->modulos) {
                return back()
                    ->with('status', 'Você não pode mudar o número de modulos para um número menor. Exclua os conteúdos manualmente!');
            }
        }

        Curso::findOrFail($id)->update($curso);

        return back()
            ->with('status', 'Dados editados com sucesso!');
    }

    public function delete($id)
    {
        $curso = Curso::findOrFail($id);
        $conteudos = Conteudo::where('curso_id', $id)->get();

        for ($i = 0; $i < $conteudos->count(); $i++) {
            $conteudos[$i]->delete();
        }

        $curso->delete();

        return back()->with('status', 'Deletado com sucesso!');
    }

    public function cursos()
    {
        $cursos = Curso::all();
        if (empty($cursos[0]->id)) {
            return redirect()->route('view-create-curso');
        }
        $admin = true;
        return view('admin.view-cursos', compact('cursos', 'admin'));
    }

    public function conteudos(Request $request)
    {
        if (!isset($request->id) || empty($request->id)) {
            return redirect()->route('view.cursos');
        }

        $id = $request->id;

        $curso = Curso::where('id', $id)->get();
        $conteudos = Conteudo::where('curso_id', $id)->get();
        $tot_modulos = $curso[0]->modulos;

        if (empty($curso[0]->id)) {
            return redirect()->route('view-create-curso', ['id' => $id])
                ->with('status', 'Curso não definido ou não existente!');
        } else if (empty($conteudos[0]->id)) {
            return redirect()->route('view-create-conteudo', ['id' => $id])
                ->with('status', 'Conteudos do curso não estão concluidos!');
        } else if ($tot_modulos != $conteudos->count()) {
            return redirect()->route('view-create-conteudo', ['id' => $id])
                ->with('status', 'Conteudos do curso não estão concluidos!');
        }

        return view('admin.view-conteudo', compact('curso', 'conteudos'));
    }
}
