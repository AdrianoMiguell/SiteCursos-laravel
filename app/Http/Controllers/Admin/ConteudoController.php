<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{
    public function view(Request $request) {
        $id = $request->id;
        if(!isset($id) || empty($id)){
            return redirect()->route('create-curso');
        }
        else{
            return view('admin.create-conteudo', compact('id'));
        }
    }
}

