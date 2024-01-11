<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function view()
    {
    }
    public function create(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'text' => 'required|string',
            'link' => 'required|string',
            'modulo_id' => 'required',
            'curso_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link');
        $slide = $request->except('_token', 'type', 'modulo_id', 'curso_id');

        $slide = Slide::create($slide);

        $conteudo['slide_id'] = $slide->id;
        $conteudo['order'] = Conteudo::where('curso_id', $conteudo['curso_id'])->count() + 1;


        $conteudo = Conteudo::create($conteudo);

        return redirect()->route('curso.workspace', ['curso_id' => $conteudo->curso_id])->with('status', 'Conteúdo criado com sucesso!');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'text' => 'required|string',
            'link' => 'required|string',
            'modulo_id' => 'required',
            'curso_id' => 'required',
            'slide_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link', 'conteudo_id');
        $slide = $request->except('_token', 'type', 'modulo_id', 'curso_id', 'slide_id', 'conteudo_id');

        Slide::findOrFail($request->slide_id)->update($slide);
        Conteudo::findOrFail($request->conteudo_id)->update($conteudo);

        return back()->with('status', 'Conteúdo editado com sucesso!');
    }

    public function delete(Request $request)
    {
        Conteudo::findOrFail($request->conteudo_id)->delete();
        Slide::findOrFail($request->slide_id)->delete();

        // return redirect()->route('curso.workspace', ['curso_id' => $request->curso_id])->with('status', 'Conteúdo deletado com sucesso!');

        return back()->with('status', 'Conteúdo deletado com sucesso!');
    }
}
