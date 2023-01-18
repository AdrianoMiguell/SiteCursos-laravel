<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'duration'=>'required',
            'modulos'=>'required',
            'price'=>'required',
            'promotion'=>'required',
        ]);

        $curso = $request->except('_token');
        $curso = Curso::create($curso);
        $id = $curso['id'];

        return redirect()->route('view-create-conteudo', ['id' => $id])
            ->with('status', 'dados criados com sucesso!');
    }
}
