<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Modulo;
use App\Models\Questionario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class CursoController extends Controller
{

    public function view(Request $request)
    {
        $categories = Category::all();

        if (!isset($request->curso_id)) {
            return view('admin.creators.create-edit-curso', compact('categories'));
        }

        $curso = Curso::find($request->curso_id);

        return view('admin.creators.create-edit-curso', compact('curso', 'categories'));
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'img' => 'required|image|max: 10000',
                'desc' => 'required|string',
                'duration' => 'required|integer',
                'price_in_cents' => 'required|integer'
            ],
            [
                'name' => 'O Nome do curso não foi informado.',
                'img' => ['max' => 'A imagem é muito grande!', 'required' => 'A imagem é obrigatória.'],

            ]
        );

        $curso = $request->except('_token');
        // dd($curso);
        $curso['img'] = $request->img->store('images/uploads/cursos');

        $curso['visible'] = false;
        $curso['release_date'] = Carbon::now();
        $curso['user_id'] = Auth::user()->id;

        $category_id = Category::where('name', $curso['category_name'])->get();

        if (!isset($category_id[0]->id) || empty($category_id[0]->id)) {
            $category_created = Category::create([
                'name' => $curso['category_name'],
                'amount' => 1
            ]);

            $curso['category_id'] = $category_created->id;
        } else {
            $curso['category_id'] = $category_id[0]->id;

            $category_id[0]->update(['amount' => ($category_id[0]->amount + 1)]);
        }

        $curso = Curso::create($curso);

        Modulo::create([
            'title' => "Introdução",
            'desc' => "",
            'order' => 0,
            'curso_id' => $curso->id
        ]);

        return redirect()->route('curso.workspace', ['curso_id' => $curso->id])
            ->with('status', 'Curso criado com sucesso!');
    }

    public function edit(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'img' => 'nullable|image|max: 10000',
            'desc' => 'required|string',
            'duration' => 'required|integer|max: 6000',
            'price_in_cents' => 'required|integer',
            'promotion' => 'required|integer|max: 100',
            'visible' => 'nullable'
        ]);


        if (!empty($request->img)) {
            $curso = $request->except('_token');

            if (Storage::exists($request->img_old)) {
                Storage::delete($request->img_old);
            }
            $curso['img'] = $request->img->store('images/uploads/cursos');
        } else {
            $curso = $request->except('_token', 'img');
        }

        

        $curso_edit = Curso::findOrFail($request->id);
        $category_old = Category::findOrFail($curso_edit->category->id);
        $curso['promotion'] = $curso['promotion'] / 100;

        $curso['visible'] = isset($curso['visible']) && $curso['visible'] == 'on' ? true : false;

        
        if($curso['category_type'] != null) {
            $category_id = Category::where('type', $curso['category_type'])->get();
        } else {
            return back()->withErrors('errors', 'Categoria não encontrada ');
        }

        if (!isset($category_id[0]->id) || empty($category_id[0]->id)) {
            $category_created = Category::create([
                'type' => $curso['category_type'],
                'amount' => 1
            ]);

            $curso['category_id'] = $category_created->id;
        } else {
            $total_courses_using_category = Curso::where('category_id', $curso_edit->category_id)->count();
            $curso['category_id'] = $category_id[0]->id;

            if ($curso['category_id'] != $curso_edit->category_id) {
                $category_id[0]->update(['amount' => ($category_id[0]->amount + 1)]);
            }
        }

        $curso_edit->update($curso);

        if (isset($total_courses_using_category) && $total_courses_using_category == 0) {
            dd("deletando o category");
            Category::findOrFail($category_old->id)->delete();
        }

        return back()
            ->with('status', 'Dados editados com sucesso!');
    }

    public function delete(Request $request)
    {

        $id = $request->id;
        $curso = Curso::findOrFail($id);
        $conteudos = Conteudo::where('curso_id', $id)->get();

        if (count($conteudos) > 0) {
            for ($i = 0; $i < $conteudos->count(); $i++) {
                $conteudos[$i]->delete();
            }
        }

        if (!empty($curso->img)) {
            Storage::delete($curso->img);
        }

        $curso->delete();
        return back()->with('status', 'Deletado com sucesso!');
    }

    public function messageActualizationInSoon() {
        return back()->withErrors("Atualização em breve!");
    }
}
