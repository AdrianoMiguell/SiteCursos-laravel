<?php

use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\ConteudoController;
use App\Http\Controllers\Admin\QuestionarioController;
use App\Http\Controllers\User\MatriculaController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(MatriculaController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('curso', 'view_curso')->name('view.curso');
});

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::get('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');
        Route::get('search', 'search')->name('search');
    });

    Route::controller(MatriculaController::class)->group(function () {
        Route::post('matricula', 'matricula')->name('matricula.curso');
        Route::get('pagamento', 'pagamento')->name('pagamento.curso');
        Route::get('conteudo', 'user_conteudo')->name('user.conteudo');
        Route::get('prev_modulo', 'prev_modulo')->name('prev.modulo');
        Route::post('next_modulo', 'next_modulo')->name('next.modulo');
        Route::post('questions_modulo', 'questions_modulo')->name('questions.modulo');
        Route::post('finished_modulo', 'finished_modulo')->name('finished.modulo');
        Route::get('view_certificados', 'view_certificados')->name('view.certifs');
        Route::get('certificado', 'certificado')->name('certificado');
    });

    Route::middleware('admin')->group(function () {
        Route::get('view-create-curso', function () {
            return view('admin.create-curso');
        })->name('view-create-curso');

        Route::controller(CursoController::class)->group(function () {
            Route::get('view-cursos', 'cursos')->name('view.cursos');
            Route::get('view-conteudos', 'conteudos')->name('view.conteudos');
            Route::post('create-curso', 'create')->name('create.curso');
            Route::post('view-create-curso', 'view')->name('view-create-curso');
            Route::post('edit-curso', 'edit')->name('edit.curso');
            Route::delete('delete_curso/{id}', 'delete')->name('delete.curso');
        });

        Route::controller(ConteudoController::class)->group(function () {
            Route::post('edit', 'edit')->name('edit.conteudo');
            Route::post('create-content', 'create')->name('create.conteudo');
            Route::delete('delete_conteudo/{id}', 'delete')->name('delete.conteudo');
        });

        Route::controller(QuestionarioController::class)->group(function () {
            Route::get('view-create-quest', 'view')->name('view-create-quest');
            Route::post('create-questionario', 'create')->name('create.questionario');
            Route::post('edit-questionario', 'edit')->name('edit.questionario');
        });
    });
});

Route::fallback(function () {
    return redirect()->route('index');
});


require __DIR__ . '/auth.php';
