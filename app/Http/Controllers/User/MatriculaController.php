<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Conteudo;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Questionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Mpdf\Mpdf;
// use MpdfException;

// use PDFBarcode;

class MatriculaController extends Controller
{

    public function index()
    {
        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
        } else {
            $matricula = null;
        }

        $curso = Curso::all();
        for ($i = 0; $i < count($curso); $i++) {
            $conteudo = Conteudo::where('curso_id', $curso[$i]->id)->get();
            $quest = Questionario::where('curso_id', $curso[$i]->id)->get();
            if (isset($conteudo[0]->id) && isset($quest[0]->id)) {
                $num[] = $curso[$i]->id;
            }
        }

        if (isset($num) && !empty($num) && count($num) == count($curso)) {
            $cursos = Curso::orderBy('name', 'asc')->paginate(8);
        } else if (!empty($num) && count($num) < count($curso)) {
            for ($i = 0; $i < count($num); $i++) {
                $cursos = Conteudo::where('id', $num[$i])->paginate(8);
            }
        } else {
            return view('index');
        }

        return view('index', compact('cursos', 'matricula'));
    }

    public function matricula(Request $request)
    {
        if (!isset($request->curso_id)) {
            return back()->with('errors', 'Informações invalidas ou você não está matriculado!');
        }

        $curso = Curso::where('id', $request->curso_id)->get();
        $matricExist = Matricula::where([['curso_id', $request->curso_id], ['user_id', Auth::user()->id]])->get();

        if (isset($matricExist[0]->id)) {
            $conteudo = Conteudo::where([
                ['curso_id', $curso[0]->id],
                ['numbering', $matricExist[0]->modulo_atual],
            ])->get();

            // dd($curso);
            return redirect()->route('user.conteudo', ['matricula_id' => $matricExist[0]->id, 'curso_id' => $curso[0]->id, 'conteudo_id' => $conteudo[0]->id])
                ->with('status', 'Bem vindo de volta ao curso!');
        }


        if ($curso[0]->promotion_price != 0) {
            return view('user.pagamento');
        }

        $matricula = $request->except('_token');
        $matricula['user_id'] = Auth::user()->id;
        $matricula['price'] = $curso[0]->promotion_price;
        $matricula['status'] = 'em andamento';
        $matricula['modulo_atual'] = 0;
        $matricula = Matricula::create($matricula);

        return redirect()->route('user.conteudo', ['curso_id' => $curso[0]->id, 'conteudo_id' => $matricula->modulo_atual])
            ->with('status', 'Matricula realizada com sucesso!');
    }

    public function next_modulo(Request $request)
    {

        // Requisições : $matricula_id; $conteudo_id;
        if (!isset($request->matricula_id) && !isset($request->conteudo_id)) {
            return back()->with('status', 'Informações invalidas ou você não está matriculado!');
        }

        $matricula = Matricula::findOrFail($request->matricula_id);
        $conteudo = Conteudo::findOrFail($request->conteudo_id);

        if ($matricula->modulo_atual == $conteudo->numbering) {
            $matricula->modulo_atual =   $matricula->modulo_atual + 1;
            $conteudo = Conteudo::where([
                ['curso_id', $matricula->curso_id],
                ['numbering', $matricula->modulo_atual],
            ])->get();

            $matricula->save();

            return redirect()->route('user.conteudo', ['curso_id' => $matricula->curso_id, 'conteudo_id' => $conteudo[0]->id])->with('status', 'Proximo modulo desbloquado! 🎉');
        } else {
            $next_cont = Conteudo::where([['numbering', ($conteudo->numbering + 1)], ['curso_id', $matricula->curso_id]])->get();

            return redirect()->route('user.conteudo', ['curso_id' => $matricula->curso_id, 'conteudo_id' => $next_cont[0]->id]);
        }
    }

    public function prev_modulo(Request $request)
    {
        if (isset($request->matricula_id) && isset($request->conteudo_id)) {
            $cont_atual = Conteudo::findOrFail($request->conteudo_id);
            $mat_atual = Matricula::findOrFail($request->matricula_id);
            $conteudo = Conteudo::where([['numbering', ($cont_atual->numbering - 1)], ['curso_id', $mat_atual->curso_id]])->get();

            return redirect()->route('user.conteudo', ['curso_id' => $mat_atual->curso_id, 'conteudo_id' => $conteudo[0]->id])->with('status', 'Video anterior');
        } else {
            return back()->with('errors', 'Informações invalidas ou você não está matriculado!');
        }
    }

    public function pagamento()
    {
        return view('user.pagamento');
    }

    public function view_curso(Request $request)
    {
        // Requisições : curso_id; conteudo_id;
        if (!isset($request->curso_id)) {
            return redirect()->route('/')->with('errors', 'Curso não encontrado!');
        }

        $curso = Curso::find($request->curso_id);

        if (empty(Auth::user()->id)) {
            return view('user.area-curso', compact('curso'));
        } else {
            $matricula = Matricula::where([['curso_id', $request->curso_id], ['user_id', Auth::user()->id]])->get();
        }

        if (!empty($matricula[0]->id)) {
            if (!isset($request->conteudo_id)) {
                $conteudo_id = $curso->conteudos[$matricula[0]->modulo_atual]->id;
            } else {
                $conteudo_id = $request->conteudo_id;
            }

            return redirect()->route('user.conteudo', ['curso_id' => $curso->id, 'conteudo_id' => $conteudo_id])
                ->with('status', 'Bom estudo!');
        } else {
            return view('user.area-curso', compact('curso'));
        }
    }

    public function user_conteudo(Request $request)
    {
        // Requisições : curso_id; conteudo_id;
        if (!isset($request->curso_id)) {
            return redirect()->route('/')->with('errors', 'Informações invalidas ou você não está matriculado!');
        }

        $curso = Curso::find($request->curso_id);
        $matricula = Matricula::where([['curso_id', $request->curso_id], ['user_id', Auth::user()->id]])->get();

        if (!isset($matricula[0]->id) || !isset($curso->id)) {
            return redirect()->route('index')->with('status', 'Informações invalidas ou você não está matriculado!');
        }

        if (isset($request->conteudo_id)) {
            $conteudo = Conteudo::find($request->conteudo_id);
        } else {
            $conteudo = Conteudo::find($curso->conteudos[$matricula[0]->modulo_atual]->id);
        }

        if (empty($conteudo->id) || $conteudo->curso_id != $curso->id) {
            return back()->with('status', 'Conteudo não encontrado!');
        } else if ($conteudo->numbering <= $matricula[0]->modulo_atual) {
            return view('user.area-conteudo', compact('matricula', 'curso', 'conteudo'));
        } else {
            return back()->with('status', 'Complete a atividade atual!');
        }
    }

    public function questions_modulo(Request $request)
    {
        $questions = Questionario::where('curso_id', $request->curso_id)->get();

        if (empty($questions[0]->id)) {
            // concluido sem prova
            return redirect()->route('dashboard');
        } else {
            // vai para a prova
            return view('user.questionario', compact('questions'));
        }
    }

    public function finished_modulo(Request $request)
    {
        if (!isset($request->resp[0])) {
            return back()->with('status', 'Error!');
        }

        $questions = Questionario::where('curso_id', $request->curso_id)->get();
        $matricula = Matricula::where([['user_id', Auth::user()->id], ['curso_id', $request->curso_id]])->get();
        $matricula = Matricula::findOrFail($matricula[0]->id);

        $pontuacao = 0;
        $pontos = (10 / count($questions));


        if (count($questions) == 1) {
            if ($questions[0]->respTrue == $request->resp[0]) {
                $pontuacao = 10;

                if ($matricula->status != 'concluido') {
                    $matricula->status = 'concluido';
                    $matricula->save();

                    return redirect()->route('dashboard')->with('status', 'Parabéns! Você concluiu o curso!');
                } else {
                    return redirect()->route('dashboard')->with('status', 'Parabéns! Sua nota foi de ' . $pontuacao . ' pontos!');
                }
            } else {
                return back()->with('status', 'Quase lá, tente novamente');
            }
        }


        foreach ($questions as $key => $q) {
            if ($q->respTrue == $request->resp[$key]) {
                $pontuacao += $pontos;
            }
        }

        $pontuacao = (int) $pontuacao;

        if ($pontuacao >= 6) {
            if ($matricula->status != 'concluido') {
                $matricula->status = 'concluido';
                $matricula->save();
            } else {
                return redirect()->route('dashboard')->with('status', 'Parabéns! Sua nota foi de ' . $pontuacao . ' pontos!');
            }
        } else {
            return redirect()->route('dashboard')->with('status', 'Quase lá, tente novamente!');
        }

        return redirect()->route('dashboard')->with('status', 'Parabéns! Você concluiu o curso!');
    }

    public function view_certificados(Request $request)
    {
        $cursos = Curso::all();
        $concluidos = Matricula::where([['status', "concluido"], ['user_id', Auth::user()->id]])->get();

        return view('documents.view_certificados', compact('concluidos', 'cursos'));
    }

    // public function certificado(Request $request)
    // {
    //     $pdf = new MpdfException();


    //     // $pdf = ::loadView('pdf.document');

    //     // return $pdf->stream('document.pdf');
    // }
}
