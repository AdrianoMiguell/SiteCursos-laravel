<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Questionario;
use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    public function view(Request $request)
    {
        $id = $request->id;
        $curso = Curso::where('id', $id)->get();
        $questionario = Questionario::where('curso_id', $id)->get();

        if (!isset($id) || empty($id)) {
            return redirect()->route('view-create-curso')
                ->with('status', 'Curso não encontrado');
        } else if (!empty($id) && !empty($questionario[0]->id)) {
            return redirect()->route('view.cursos')
                ->with('status', 'Quesitonarios já criados');
        } else {
            return view('admin.create-questionario', compact('curso'));
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'img.*' => 'nullable',
            'perg.*' => 'required',
            'resp1.*' => 'required',
            'resp2.*' => 'required',
            'resp3.*' => 'required',
            'respTrue.*'  => 'required'
        ]);

        $quests = $request->except('_token');
        $id = $quests['curso_id'];

        for ($i = 0; $i < count($quests['perg']); $i++) {
            $quest['img'] = 'java.png';
            $quest['perg'] = $quests['perg'][$i];
            $quest['resp1'] = $quests['resp1'][$i];
            $quest['resp2'] = $quests['resp2'][$i];
            $quest['resp3'] = $quests['resp3'][$i];
            $quest['respTrue'] = $quests['respTrue'][$i];
            $quest['curso_id'] = $id;

            Questionario::create($quest);
        }

        return redirect()->route('view.cursos')
            ->with('status', 'O curso, seus conteudos e questionario foram criados com sucesso!');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'img' => 'nullable',
            'perg' => 'required',
            'resp1' => 'required',
            'resp2' => 'required',
            'resp3' => 'required',
            'respTrue'  => 'required'
        ]);

        $quest = $request->except('_token');
        $id = $request->id;

        Questionario::findOrFail($id)->update($quest);

        return back()
            ->with('status', 'Os questionarios do curso foram atualizados com sucesso!');
    }
}
