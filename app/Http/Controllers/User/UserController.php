<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (isset($request->search)) {
            $request->validate([
                'search' => 'nullable|string|size:30'
            ], [
                'search.size' => "Muitas palavras, reduza a pesquisa;"
            ]);
            $cursos = Curso::where([['name', 'LIKE', '%".$request->search."%'], ['visible', true]])->orderBy('name', 'asc')->limit(10)->get();
        } else {
            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where('visible', true)->orderBy('categories.amount', 'asc')->orderBy('cursos.name', 'asc')->limit(10)->get();
        }

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('index', compact('cursos', 'matricula'));
        }

        return view('index', compact('cursos'));
    }

    public function view_cursos(Request $request)
    {
        $search = '';

        if (isset($request->search) && !isset($request->category_id)) {
            $request->validate([
                'search' => 'nullable|string|max:50'
            ], [
                'search.max' => "Muitas palavras, reduza a pesquisa;"
            ]);

            $search = $request->search;

            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where(function ($query) use ($search) {
                $query->where('cursos.name', 'like', '%' . $search . '%')
                    ->orWhere('categories.name', 'like', '%' . $search . '%')
                    ->orWhere('cursos.desc', 'like', '%' . $search . '%');
            })
                ->where('cursos.visible', true)->orderBy('categories.amount', 'desc')->orderBy('cursos.name', 'asc')->paginate(20);

            // dd($cursos);
            // $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where('cursos.name', 'like', '%' . $search . '%')->orWhere('categories.name', 'like', '%' . $search . '%')->orWhere('cursos.desc', 'like', '%' . $search . '%')->where('cursos.visible', true)->orderBy('categories.amount', 'desc')->orderBy('cursos.name', 'asc')->paginate(20);

        } else if (isset($request->category_id)) {
            $cursos = Curso::where('category_id', $request->category_id)->orderBy('name', 'asc')->paginate(20);
        } else {
            $cursos = Curso::join('categories', 'category_id', '=', 'categories.id')->where('visible', true)->orderBy('categories.amount', 'asc')->orderBy('cursos.name', 'asc')->paginate(20);
        }

        $populares_categories = Category::orderBy('amount', 'desc')->orderBy('name', 'asc')->limit(5)->get();
        $categories = Category::orderBy('name', 'asc')->limit(10)->get();

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('user.cursos', compact('cursos', 'populares_categories', 'categories', 'matricula', 'search'));
        }

        return view('user.cursos', compact('cursos', 'populares_categories', 'categories', 'search'));
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

        $cursos = Curso::where('visible', true)->orderBy('name', 'asc')->paginate(15);

        if (!isset($matricula[0]->id)) {
            return view('user.dashboard', compact('cursos'));
        }

        return view('user.dashboard', compact('matricula', 'cursos'));
    }

    public function view_curso(Request $request)
    {
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

    // public function search(Request $request)
    // {
    //     $search = $request->search;
    //     $cursos = Curso::where('name', 'LIKE', '%' . $search . '%')->paginate(2);
    //     $matricula = Matricula::where('user_id', Auth::user()->id)->get();
    //     if (isset($matricula)) {
    //         return view('index', compact('cursos', 'matricula'));
    //     } else {
    //         return view('index', compact('cursos'));
    //     }
    // }

}
