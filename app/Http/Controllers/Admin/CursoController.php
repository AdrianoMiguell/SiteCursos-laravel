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
        $id = $curso['id'];

        $dbConteudos = Conteudo::where('cursos_id', $id)->get();
        if (empty($dbConteudos[0]->id)) {
            return redirect()->route('view-create-conteudo', ['id' => $id])
                ->with('status', 'Erro! Crie primeiramente o conteudo, antes de editá-lo!');
        }

        Storage::delete($request->image);
        $curso['image'] = $request->image->store('images');

        Curso::find($id)->update($curso);

       return redirect()->route('view.conteudos', ['id' => $id])
                ->with('status', 'dados editados com sucesso!');
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
        $conteudos = Conteudo::where('cursos_id', $id)->get();

        if (empty($curso[0]->id)) {
            return redirect()->route('view-create-curso', ['id' => $id])
                ->with('status', 'Curso não definido ou não existente!');
        }
        else if (empty($conteudos[0]->id)) {
            return redirect()->route('view-create-conteudo', ['id' => $id])
                ->with('status', 'Conteudos do curso não estão concluidos!');
        }

        return view('admin.view-conteudo', compact('curso', 'conteudos'));
    }
}
