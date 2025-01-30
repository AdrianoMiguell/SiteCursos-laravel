<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Conteudo;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Modulo;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where('visible', true)->orderBy('categories.amount', 'asc')->orderBy('cursos.name', 'asc')->limit(10)->get();

        $categories = Category::orderBy('amount', 'desc')->orderBy('type', 'asc')->limit(10)->get();

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('index', compact('cursos', 'matricula', 'categories'));
        }

        return view('index', compact('cursos', 'categories'));
    }

    public function view_cursos(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:50',
            'category_id' => 'nullable|integer'
        ], [
            'search.max' => "Muitas palavras, reduza a pesquisa;"
        ]);

        $search = '';
        $category_param = '';

        if (isset($request->search) && !isset($request->category_id)) {
            $search = $request->search;

            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where(function ($query) use ($search) {
                $query->where('cursos.name', 'like', '%' . $search . '%')
                    ->orWhere('categories.type', 'like', '%' . $search . '%')
                    ->orWhere('cursos.desc', 'like', '%' . $search . '%');
            })
                ->where('cursos.visible', true)->orderBy('categories.amount', 'desc')->orderBy('cursos.name', 'asc')->paginate(20);
        } else if (isset($request->category_id)) {
            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where([['cursos.visible', true], ['categories.id', $request->category_id]])->orderBy('cursos.name', 'asc')->paginate(20);

            $category_param = Category::findOrFail($request->category_id);
        } else {
            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where('visible', true)->orderBy('categories.amount', 'asc')->orderBy('cursos.name', 'asc')->paginate(20);
        }

        // dd($cursos);
        $populares_categories = Category::orderBy('amount', 'desc')->orderBy('type', 'asc')->limit(5)->get();
        $categories = Category::orderBy('type', 'asc')->limit(10)->get();

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('user.cursos', compact('cursos', 'populares_categories', 'categories', 'matricula', 'search', 'category_param'));
        }

        return view('user.cursos', compact('cursos', 'populares_categories', 'categories', 'search', 'category_param'));
    }

    /**
     * Display the user's profile form.
     */
    public function dashboard()
    {
        if (Auth::user()->type == '1') {
            return redirect()->route('workspace');
        }

        $matricula = Matricula::where('user_id', Auth::user()->id)->get();
        $cursos = Curso::join('matriculas', 'curso_id', '=', 'cursos.id')->where('matriculas.user_id', Auth::user()->id)->paginate();

        if (isset($cursos) && count($cursos) == 0) {
            $cursos_recomendados = Curso::join('categories', 'category_id', '=', 'categories.id')->where('visible', true)->orderBy('amount', 'desc')->limit(15)->get();
        } else {
            $maioresAmountCategorias = Category::select('id', 'amount')
                ->orderByDesc('amount')
                ->limit(15)
                ->get();

            $cursos_recomendados = Curso::join('categories', 'cursos.category_id', '=', 'categories.id')
                ->leftJoin('matriculas', function ($join) {
                    $join->on('cursos.id', '=', 'matriculas.curso_id');
                })
                ->where('cursos.visible', true)
                ->whereIn('categories.id', $maioresAmountCategorias->pluck('id')->all())
                ->whereNull('matriculas.curso_id')
                ->orderByRaw('CASE WHEN matriculas.curso_id IS NOT NULL THEN 1 ELSE 0 END, amount DESC')
                ->select('cursos.*')
                ->limit(15)
                ->get();
        }

        $amount_cursos = count($cursos);

        return view('user.dashboard', compact('matricula', 'cursos', 'cursos_recomendados', 'amount_cursos'));
    }

    public function view_curso(Request $request)
    {
        if (!isset($request->slug)) {
            return redirect()->route('user.view_cursos');
        }
        $curso =  Curso::where('slug', '' . $request->slug . '')->firstOrFail();

        if (!isset(Auth::user()->id))
            return view('user.homepage-curso', compact('curso'));

        $matricula = Matricula::where([['user_id', Auth::user()->id], ['curso_id', $curso->id]])->first();

        return view('user.homepage-curso', compact('curso', 'matricula'));
    }

    public function curso_studyspace(Request $request)
    {
        if (!isset(Auth::user()->id) || !isset($request->slug) || !isset($request->modulo) || !isset($request->conteudo)) {
            return redirect()->route('user.view_cursos')->withErrors("Houve um erro na matricula do curso. Desculpe o transtorno.");
        }

        $modulo_id = $request->modulo;
        $conteudo_id = $request->conteudo;

        $curso =  Curso::where('slug', '' . $request->slug . '')->firstOrFail();
        $matricula = Matricula::where([['user_id', Auth::user()->id], ['curso_id', $curso->id]])->firstOrFail();

        $modulo =  Modulo::where([['id', $modulo_id], ['curso_id', $curso->id]])->orderBy('order', 'asc')->firstOrFail();
        $conteudo = Conteudo::where([['id', $conteudo_id], ['curso_id', $curso->id], ['modulo_id', $modulo_id]])->orderBy('order', 'asc')->firstOrFail();

        if (!isset($matricula->id) || !isset($curso->id) || !isset($conteudo->id) || !isset($modulo->id)) {
            return redirect()->route('user.curso', ['slug' => $request->slug])->withErrors('errors', "Houve um erro na matricula do curso. Desculpe o transtorno.");
        }

        if ($modulo->order > $matricula->modulo->order || ($modulo->order == $matricula->modulo->order && $conteudo->order > $matricula->conteudo->order)) {
            dd("Conteudo invalido");
            return back()->withErrors("Complete o conteúdo anterior.");
        }

        // dd($modulo);

        // $quizzes = Quiz::where('modulo_id', $curso->id)->get();

        return view('user.studyspace.curso-studyspace', compact('matricula', 'curso', 'modulo', 'conteudo'));
    }

    public function curso_studyspace_quiz(Request $request)
    {
        $request->validate([
            'matricula_id',
            'slug',
            'modulo_id'
        ]);

        $matricula = Matricula::findOrFail($request->matricula_id);
        $curso = Curso::firstOrFail($request->slug);
        $modulo = Modulo::findOrFail($request->modulo_id);
        $questions = Quiz::where('modulo_id', $modulo->id)->orderBy('order', 'asc')->get();

        if (isset($request->conteudo_id)) {
            $conteudo = Conteudo::where('id', $request->conteudo_id)->orderBy('order', 'desc')->first();

            return view('user.studyspace.curso-studyspace-quiz', compact('matricula', 'curso', 'modulo', 'questions', 'conteudo'))->with('status', 'Resolva as questões antes que o tempo acabe.');
        }

        return view('user.studyspace.curso-studyspace-quiz', compact('matricula', 'curso', 'modulo', 'questions'))->with('status', 'Resolva as questões antes que o tempo acabe.');
    }

    public function pay_curso(Request $request)
    {
        // if (!isset($request->slug)) {
        //     return redirect()->route('user.view_cursos');
        // }
        // $curso =  Curso::where('slug', '' . $request->slug . '')->firstOrFail();
        
        // dd($request);
        
        // return view('user.pay-curso', compact('curso'));

        return back()->withErrors("Método de compra ainda não disponível.");
    }
}
