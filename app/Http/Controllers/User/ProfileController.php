<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        // dd($request);
        if(isset($request->search)) {
            $request->validate([
                'search' => 'nullable|string|size:30'
            ], [
                'search.size' => "Muitas palavras, reduza a pesquisa;"
            ]);
            $cursos = Curso::where([['name', 'LIKE', '%".$request->search."%'],['ready', 'ok']])->orderBy('name', 'asc')->paginate(2);
        }
        else{
            $cursos = Curso::where('ready', 'ok')->orderBy('name', 'asc')->paginate(2);
        }

        if (isset(Auth::user()->id)) {
            $matricula = Matricula::where('user_id', Auth::user()->id)->get();
            return view('index', compact('cursos', 'matricula'));
        } else if (isset($cursos)) {
            return view('index', compact('cursos'));
        } else {
            return view('index');
        }
    }

    /**
     * Display the user's profile form.
     */
    public function dashboard()
    {
        if (Auth::user()->type == '1') {
            return redirect()->route('view.cursos');
        }

        $matricula = Matricula::where('user_id', Auth::user()->id)->get();

        $cursos = Curso::orderBy('name', 'asc')->paginate(8);

        if (!isset($matricula[0]->id)) {
            return view('user.dashboard', compact('cursos'));
        }

        return view('user.dashboard', compact('matricula', 'cursos'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
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

    public function search(Request $request)
    {
        $search = $request->search;
        $cursos = Curso::where('name', 'LIKE', '%' . $search . '%')->paginate(2);
        $matricula = Matricula::where('user_id', Auth::user()->id)->get();
        if (isset($matricula)) {
            return view('index', compact('cursos', 'matricula'));
        } else {
            return view('index', compact('cursos'));
        }
    }
}
