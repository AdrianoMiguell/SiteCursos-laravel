<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{

    public function view(Request $request)
    {
        if (!isset($request->curso_id)) {
            return redirect()->route('workspace');
        }

        $curso = Curso::findOrFail($request->curso_id);

        if (!isset($request->modulo_id)) {
            return redirect()->route('curso.workspace', ['curso_id' => $request->curso_id])->with('status', 'Quiz criado com sucesso!');
        }

        $modulo = Modulo::findOrFail($request->modulo_id);
        return view('admin.workspace-quiz', compact('curso', 'modulo'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'img' => 'nullable',
            'legend' => 'nullable|string',
            'question' => 'required|string',
            'alt1' => 'required|string',
            'alt2' => 'required|string',
            'alt3' => 'required|string',
            'alt4' => 'required|string',
            'alt5' => 'nullable|string',
            'altTrue' => 'required|string',
            'curso_id' => 'required',
            'modulo_id' => 'required'
        ]);

        $question = $request->except('_token');

        $countQuiz = Quiz::where(['curso_id' => $request->curso_id], ['modulo_id' => $request->modulo_id])->count();

        // dd($question['img']);
        if (isset($question['img']) && !empty($question['img'])) {
            $question['img'] = $request->img->store('images/uploads/questions');
        }

        $question['order'] = $countQuiz + 1;

        Quiz::create($question);

        return redirect()->route('curso.workspace', ['curso_id' => $request->curso_id])->with('status', 'Quiz criado com sucesso!');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'img' => 'nullable|string',
            'legend' => 'nullable|string',
            'question' => 'required|string',
            'alt1' => 'required|string',
            'alt2' => 'required|string',
            'alt3' => 'required|string',
            'alt4' => 'required|string',
            'alt5' => 'nullable|string',
            'altTrue' => 'required|string',
            'order' => 'required|string',
            'curso_id' => 'required|string',
            'modulo_id' => 'required|string'
        ]);

        $quest = $request->except('_token');
        $quest_old = Quiz::findOrFail($quest['id']);

        if ($quest_old->order != $quest['order']) {
            $quest_order_changed = Quiz::where([['curso_id', $quest['curso_id']], ['modulo_id', $quest['modulo_id']], ['order', $quest['order']]])->get();
            $quest_order_changed[0]->update(['order' => $quest_old->order]);
        }

        if (!empty($quest['file_img'])) {
            if (!empty($quest['img']) && Storage::exists($quest['img'])) {
                Storage::delete($quest['img']);
            }

            $quest['img'] = $request->file_img->store('images/uploads/questions');
        }

        Quiz::findOrFail($request->id)->update($quest);
        return redirect()->route('curso.workspace', ['curso_id' => $request->curso_id])->with('status', 'Quiz criado com sucesso!');
    }

    public function delete(Request $request)
    {
    }
}
