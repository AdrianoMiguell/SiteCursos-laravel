<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
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
        $video = $request->except('_token', 'type', 'modulo_id', 'curso_id');

        $video = Video::create($video);
        $conteudo['video_id'] = $video->id;
        $conteudo['order'] = Conteudo::where('curso_id', $conteudo['curso_id'])->count() + 1;
        // dd($conteudo);
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
            'video_id' => 'required',
        ]);

        $conteudo = $request->except('_token', 'title', 'text', 'link', 'conteudo_id');
        $video = $request->except('_token', 'type', 'modulo_id', 'curso_id', 'video_id', 'conteudo_id');

        Video::findOrFail($request->video_id)->update($video);
        Conteudo::findOrFail($request->conteudo_id)->update($conteudo);

        return back()->with('status', 'Conteúdo editado com sucesso!');
    }

    public function delete(Request $request)
    {
        Conteudo::findOrFail($request->conteudo_id)->delete();
        Video::findOrFail($request->video_id)->delete();

        // return redirect()->route('curso.workspace', ['curso_id' => $request->curso_id])->with('status', 'Conteúdo deletado com sucesso!');

        return back()->with('status', 'Conteúdo deletado com sucesso!');
    }
}
