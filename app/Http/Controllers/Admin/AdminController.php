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

        $cursos = Curso::orderBy('name', 'asc')->get();

        return view('admin.workspace', compact('cursos'));
    }

    public function workspace_curso(Request $request)
    {
        if (!isset($request->curso_id)) {
            return redirect()->route('workspace')->with('errors', 'Curso não encontrado!');
        }

        $curso = Curso::findOrFail($request->curso_id);
        
        return view('admin.workspace-curso', compact('curso'));
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
