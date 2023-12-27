<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function workspace()
    {
        if (Auth::user()->type != '1') {
            return redirect()->route('dashboard');
        }

        $cursos = Curso::orderBy('name', 'asc')->paginate(15);

        return view('admin.workspace', compact('cursos'));
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
