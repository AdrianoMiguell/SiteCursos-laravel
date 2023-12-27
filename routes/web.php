<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\ConteudoController;
use App\Http\Controllers\Admin\QuestionarioController;
use App\Http\Controllers\User\MatriculaController;
use App\Http\Controllers\User\payController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('curso', 'view_curso')->name('view.curso');
    Route::get('/dashboard', 'dashboard')->middleware('verified', 'auth')->name('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'view')->name('profile.view');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(MatriculaController::class)->group(function () {
        Route::post('matricula', 'matricula')->name('matricula.curso');
        Route::get('conteudo', 'user_conteudo')->name('user.conteudo');
        Route::post('next_modulo', 'next_modulo')->name('next.modulo');
        Route::get('prev_modulo', 'prev_modulo')->name('prev.modulo');
        Route::post('questions_modulo', 'questions_modulo')->name('questions.modulo');
        Route::post('finished_modulo', 'finished_modulo')->name('finished.modulo');
        Route::get('view_certificados', 'view_certificados')->name('view.certifs');
        Route::get('certificado', 'certificado')->name('certificado');
    });

    Route::middleware('admin')->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('workspace', 'workspace')->name('workspace');
            Route::get('curso-workspace', 'cursoworkspace')->name('curso.workspace');
        });

        // Route::get('view-create-curso', function () {
        //     return view('admin.create-curso');
        // })->name('view-create-curso');

        Route::controller(CursoController::class)->group(function () {
            Route::get('view-cursos', 'cursos')->name('view.cursos');
            Route::post('create-curso', 'create')->name('create.curso');
            Route::post('edit-curso', 'edit')->name('edit.curso');
            Route::delete('delete_curso/{id}', 'delete')->name('delete.curso');
        });

        Route::controller(ConteudoController::class)->group(function () {
            Route::get('view-conteudos', 'conteudos')->name('view.conteudos');
            Route::post('create-content', 'create')->name('create.conteudo');
            Route::post('edit', 'edit')->name('edit.conteudo');
            Route::delete('delete_conteudo/{id}', 'delete')->name('delete.conteudo');
        });

        Route::controller(QuestionarioController::class)->group(function () {
            Route::get('view-create-quest', 'view')->name('view-create-quest');
            Route::post('create-questionario', 'create')->name('create.questionario');
            Route::post('edit-questionario', 'edit')->name('edit.questionario');
        });

        Route::get('pay', [payController::class, 'pay'])->name('pay.curso');
    });
});

// não posso mandar para o questionário, pois ele está com o metodo post.
Route::fallback(function () {
    return redirect()->route('index');
});


require __DIR__ . '/auth.php';
