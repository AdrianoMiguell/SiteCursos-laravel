<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Modulo;
use App\Models\Questionario;
use App\Models\Quiz;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatriculaController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|integer',
            'matricula_id' => 'nullable|integer',
        ]);


        $curso = Curso::findOrFail($request->curso_id);
        // dd($request->curso_id);;
        $price = ($curso->price_in_cents / 100) * (1 - $curso->promotion);

        if ($price > 0) {
            return redirect()->route('user.curso.pay', ['id' => $curso->id]);
        }

        if (isset($request->matricula_id)) {
            $matricula = Matricula::findOrFail($request->matricula_id);

            $modulo = Modulo::findOrFail($matricula->modulo_id);
            $conteudo = Conteudo::findOrFail($matricula->conteudo_id);
        } else {
            $matricula = Matricula::where([['user_id', Auth::user()->id], ['curso_id', $curso->id]])->first();

            $modulo = Modulo::where('curso_id', $curso->id)->orderBy('order', 'asc')->first();
            $conteudo = Conteudo::where([['curso_id', $curso->id], ['modulo_id', $modulo->id]])->orderBy('order', 'asc')->first();
        }

        if (!isset($modulo->id) || !isset($conteudo->id)) {
            return back()->withErrors("Estamos com um problema interno neste curso. Ele está indisponivel.");
        }

        if (!isset($matricula->id)) {
            $matricula = Matricula::create([
                'user_id' => Auth::user()->id,
                'curso_id' => $curso->id,
                'modulo_id' => $modulo->id,
                'conteudo_id' => $conteudo->id,
            ]);
        }

        return redirect()->route('user.curso.studyspace', ['slug' => $curso->slug, 'modulo' => $modulo->id, 'conteudo' => $conteudo->id, 'matricula' => $matricula->id]);
    }

    public function delete(Request $request)
    {
    }

    public function previous(Request $request)
    {
        $request->validate([
            'matricula' => 'required|integer',
            'modulo' => 'required|integer',
            'conteudo' => 'required|integer',
        ]);

        $matricula = Matricula::findOrFail($request->matricula);

        $conteudo = Conteudo::findOrFail($request->conteudo);
        $modulo = Modulo::findOrFail($request->modulo);

        if ($modulo->order != 1 && $conteudo->order == 1) {
            $prevModulo = Modulo::where([['curso_id', $matricula->curso_id], ['order', $modulo->order - 1]])->first();

            $prevConteudo = Conteudo::where([['curso_id', $matricula->curso_id], ['modulo_id', $prevModulo->id]])->orderBy('order', 'desc')->first();

            if (isset($prevModulo->quizzes) && count($prevModulo->quizzes) > 0) {
                return redirect()->route('user.curso.studyspace.quiz', ['slug', $matricula->curso->slug, 'modulo_id' => $prevModulo->id, 'matricula_id' => $matricula->id, 'conteudo_id' => $prevConteudo->id]);
            }
        } else if ($modulo->order == 1 && $conteudo->order == 1) {
            return back()->withErrors('Conteúdo anterior invalido!');
        } else {
            $prevModulo = Modulo::findOrFail($modulo->id);

            if (isset($request->quiz) && $request->quiz == true) {
                $prevConteudo = $conteudo;
            } else {
                $prevConteudo = Conteudo::where([['curso_id', $matricula->curso_id], ['modulo_id', $modulo->id], ['order', $conteudo->order - 1]])->first();
            }
        }

        if (!isset($prevConteudo)) {
            return back()->withErrors('Conteúdo invalido!');
        }

        return redirect()->route('user.curso.studyspace', ['matricula' => $matricula->id, 'slug' => $matricula->curso->slug, 'modulo' => $prevModulo->id, 'conteudo' => $prevConteudo->id]);
    }

    public function next(Request $request)
    {
        // dd("next");
        $request->validate([
            'matricula' => 'required|integer',
            'modulo' => 'required|integer',
            'conteudo' => 'required|integer',
        ]);

        $matricula = Matricula::findOrFail($request->matricula);

        $conteudo = Conteudo::findOrFail($request->conteudo);
        $modulo = Modulo::findOrFail($request->modulo);

        $nextConteudo = Conteudo::where([['curso_id', $matricula->curso_id], ['modulo_id', $modulo->id], ['order', $conteudo->order + 1]])->orderBy('order', 'asc')->first();

        if (!isset($nextConteudo)) {
            if (isset($modulo->quizzes[0]->id) && count($modulo->quizzes) > 0 && !isset($request->quiz)) {
                $nextModulo = $modulo;
                $nextConteudo = $conteudo;

                return redirect()->route('user.curso.studyspace.quiz', ['slug', $matricula->curso->slug, 'modulo_id' => $nextModulo->id, 'matricula_id' => $matricula->id, 'conteudo_id' => $nextConteudo->id])->with('Teste concluido com sucesso!');
            }

            $nextModulo = Modulo::where([['curso_id', $matricula->curso_id], ['order', $modulo->order + 1]])->first();

            $nextConteudo = Conteudo::where([['curso_id', $matricula->curso_id], ['modulo_id', $nextModulo->id]])->orderBy('order', 'asc')->first();

            if (!isset($nextConteudo)) {
                if ($matricula->modulo_id == $modulo->id && $matricula->conteudo_id == $conteudo->id) {
                    dd($matricula);
                    return redirect()->route('matricula.conclusion', ['matricula_id', $matricula->id]);
                } else {
                    return back();
                }
            }
        } else {
            $nextModulo = $modulo;
        }

        if (
            $matricula->conteudo_id == $conteudo->id &&
            $matricula->modulo_id == $modulo->id
        ) {
            if (isset($nextModulo)) {
                $matricula->update(['conteudo_id' => $nextConteudo->id, 'modulo_id' => $nextModulo->id]);
            } else {
                $matricula->update(['conteudo_id' => $nextConteudo->id]);
            }
        }

        return redirect()->route('user.curso.studyspace', ['matricula' => $matricula->id, 'slug' => $matricula->curso->slug, 'modulo' => $nextModulo->id, 'conteudo' => $nextConteudo->id]);
    }

    public function score(Request $request)
    {

        $request->validate([
            'modulo_id' => 'required|integer',
            'matricula_id' => 'required|integer',
            'resp-1' => 'required|integer'
        ]);

        $resps = $request->except('_token', 'modulo_id', 'matricula_id');

        $matricula = Matricula::findOrFail($request->matricula_id);
        $modulo = Modulo::findOrFail($request->modulo_id);
        $curso = Curso::findOrFail($matricula->curso_id);

        if (isset($curso->id) && isset($modulo->id) && isset($matricula->id)) {
            $tot = 0;
            $score = 0;

            $questions = Quiz::where('modulo_id', $modulo->id)->orderBy('order', 'asc')->get();

            foreach ($questions as $key => $quest) {
                if (isset($resps['resp-' . $key + 1])) {
                    if ($quest->altTrue == $resps['resp-' . $key + 1]) {
                        $score++;
                    }
                    $tot++;
                }
            }

            $percentage_score = ($score / $tot) * 100;
            // dd($percentage_score);

            $score = Score::where([['matricula_id', $matricula->id], ['modulo_id', $modulo->id]])->first();

            if (!isset($score->id)) {
                if ($tot != count($questions) || $percentage_score < 60) {
                    return back()->withErros('errors', 'Refaça o teste. Você não conseguiu a pontuação adequada!');
                }

                Score::create([
                    'points' => $percentage_score,
                    'matricula_id' => $matricula->id,
                    'modulo_id' => $modulo->id
                ]);
            } else {
                if ($percentage_score > $score->points) {
                    $score->update([
                        'points' => $percentage_score
                    ]);
                }
            }
        } else {
            return redirect()->route('user.view_cursos');
        }


        $conteudo = Conteudo::where([['curso_id', $curso->id], ['modulo_id', $modulo->id]])->select('id', 'order')->orderBy('order', 'desc')->first();

        return redirect()->route('curso.matricula.next', ['matricula' => $matricula->id, 'modulo' => $modulo->id, 'conteudo' => $conteudo->id, 'quiz' => true])->with('status', 'Teste concluido com sucesso!');
    }

    public function conclusion(Request $request)
    {
        dd($request);
    }
}
