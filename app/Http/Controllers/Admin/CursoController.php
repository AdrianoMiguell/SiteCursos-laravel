<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Questionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'img' => 'required|image|max: 10000',
            'desc' => 'required|string',
            'duration' => 'required|integer',
            'modulos' => 'required|integer',
            'real_price' => 'required',
            'promotion' => 'required|integer',
        ],[
            'img.max' => 'A imagem é muito grande!',
            'real_price.decimal' => 'O número não é um decimal!',
        ]);

        $curso = $request->except('_token');
        $curso['img'] = $request->img->store('images');
        $curso['promotion_price'] = ($curso['real_price']) - ($curso['real_price'] * $curso['promotion']) / 100;

        $curso = Curso::create($curso);

        return redirect()->route('view-create-conteudo', ['curso_id' => $curso['id']])
            ->with('status', 'Dados criados com sucesso!');
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image|max: 10000',
            'desc' => 'required',
            'duration' => 'required',
            'modulos' => 'required',
            'real_price' => 'required',
            'promotion' => 'required',
        ]);

        if (!empty($request->img)) {
            Storage::delete($request->img);
            $curso['img'] = $request->img->store('images');
            $curso = $request->except('_token');
        } else {
            $curso = $request->except('_token', 'img');
        }

        $ago_curso = Curso::findOrFail($id);

        if ($request->modulos < $ago_curso->modulos) {
            $conteudos = Conteudo::where('curso_id', $id)->get();
            if ($conteudos->count() > $request->modulos) {
                return back()
                    ->with('status', 'Você não pode mudar o número de modulos para um número menor. Exclua os conteúdos manualmente!');
            }
        }
        if ($request->promotion != $ago_curso->promotion || $request->real_price != $ago_curso->real_price) {
            if ($request->promotion != 0) {
                $curso['promotion_price'] = ($request->real_price) - ($request->real_price * $request->promotion) / 100;
            }
            else{
                $curso['promotion_price'] = $request->real_price;
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

        Storage::delete($curso->img);
        $curso->delete();

        return back()->with('status', 'Deletado com sucesso!');
    }

    public function cursos()
    {
        $cursos = Curso::all();
        if (empty($cursos[0]->id) && Auth::user()->type == 1) {
            return redirect()->route('view-create-curso');
        }

        if(isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('admin.view-cursos', compact('cursos', 'matricula'));
        }
        else{
        return view('admin.view-cursos', compact('cursos'));
        }
    }

    public function conteudos(Request $request)
    {
        if (!isset($request->id) || empty($request->id)) {
            return redirect()->route('view.cursos');
        }

        $id = $request->id;

        $curso = Curso::where('id', $id)->get();
        $conteudos = Conteudo::where('curso_id', $id)->get();
        $quests= Questionario::where('curso_id', $id)->get();

        if(!isset($quests[0]->id)){
            return redirect()->route('view-create-quest', ['id' => $id]);
        }
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

        return view('admin.view-conteudo', compact('curso', 'conteudos', 'quests'));
    }
}
