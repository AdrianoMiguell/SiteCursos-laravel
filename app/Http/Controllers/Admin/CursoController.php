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
    public function cursos()
    {
        $cursos = Curso::all();
        if (empty($cursos[0]->id) && Auth::user()->type == 1) {
            return redirect()->route('view-create-curso');
        }

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('admin.workspace', compact('cursos', 'matricula'));
        } else {
            return view('admin.workspace', compact('cursos'));
        }
    }

    public function view_create(Request $request)
    {
        if (!isset($request->curso_id)) {
            return view('admin.create-curso')
                ->with('status', 'Crie um curso');
        }
        $curso = Curso::find($request->curso_id);

        if (!isset($curso) || empty($curso)) {
            return view('admin.create-curso')
                ->with('status', 'Crie um curso');
        }

        $conts = Conteudo::where('curso_id', $curso->id)->get();

        if (isset($conts) && !empty($conts)) {
            return view('admin.create-curso', compact('curso', 'conteudos'));
        } else {
            return view('admin.create-curso', compact('curso'));
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'img' => 'required|image|max: 10000',
            'desc' => 'required|string',
            'desc_more' => 'nullable|string',
            'duration' => 'required|integer',
            'real_price' => 'required',
        ], [
            'img.max' => 'A imagem é muito grande!',
        ]);

        $curso = $request->except('token');
        
        $curso['img'] = $request->img->store('images');

        if(empty($curso['desc_more'])) {
            $curso['desc_more'] = $curso['desc'];
        }
        $curso['promotion'] = 0;
        $curso['promotion'] = 0;
        $curso['promotion_price'] = $curso['real_price'];
        // $curso['promotion_price'] = ($curso['real_price']) - ($curso['real_price'] * $curso['promotion']) / 100;
        $curso['modulos'] = 0;
        $curso['ready'] = "no";
        
        $curso = Curso::create($curso);

        return redirect()->route('view.create.curso', compact('curso'))
            ->with('status', 'Curso criado com sucesso!');
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'img' => 'nullable|image|max: 10000',
            'desc' => 'required',
            'desc_more' => 'required',
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

        if ($request->modulos != $ago_curso->modulos) {
            $conteudos = Conteudo::where('curso_id', $id)->get();
            if ($conteudos->count() > $request->modulos) {
                return back()
                    ->with('status', 'Você não pode mudar o número de modulos para um número menor. Exclua os conteúdos manualmente!');
            } else{
                $curso['ready'] = "no";
            }
        }

        if ($request->promotion != $ago_curso->promotion || $request->real_price != $ago_curso->real_price) {
            if ($request->promotion != 0) {
                $curso['promotion_price'] = ($request->real_price) - ($request->real_price * $request->promotion) / 100;
            } else {
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
}
