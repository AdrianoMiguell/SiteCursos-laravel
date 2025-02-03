<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApostilaController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\ConteudoController;
use App\Http\Controllers\Admin\DesafioController;
use App\Http\Controllers\Admin\ModuloController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\User\MatriculaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/cursos', 'view_cursos')->name('user.view_cursos');
    Route::get('curso/{slug}', 'view_curso')->name('user.curso');
});

Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');
        Route::get('/curso/studyspace/{slug}/', 'curso_studyspace')->name('user.curso.studyspace');
        Route::get('/curso/studyspace/quiz/{slug}', 'curso_studyspace_quiz')->name('user.curso.studyspace.quiz');
        Route::post('pay/{slug}', 'pay_curso')->name('user.curso.pay');
    });

    Route::controller(MatriculaController::class)->group(function () {
        Route::post('/matricula/{slug}', 'create')->name('curso.matricula.create');
        Route::delete('/matricula/{id}', 'delete')->name('curso.matricula.delete');
        Route::get('/matricula-previous', 'previous')->name('curso.matricula.previous');
        Route::get('/matricula-next', 'next')->name('curso.matricula.next');
        Route::post('/matricula-score', 'score')->name('curso.matricula.score');
        Route::post('/matricula/conclusion/{slug}', 'conclusion')->name('matricula.conclusion');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'view')->name('profile.view');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });


    Route::middleware('admin')->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('workspace', 'workspace')->name('workspace');
            Route::get('workspacecurso', 'workspace_curso')->name('curso.workspace');
        });

        Route::controller(CursoController::class)->group(function () {
            Route::get('option_curso', 'view')->name('curso.view');
            Route::post('option_curso', 'create')->name('curso.create');
            Route::put('option_curso', 'edit')->name('curso.edit');
            Route::delete('option_curso', 'delete')->name('curso.delete');
            Route::get('option_curso_test', 'messageActualizationInSoon')->name('curso.insoon');
        });

        Route::controller(ModuloController::class)->group(function () {
            Route::get('option_modulo', 'view')->name('modulo.view');
            Route::post('option_modulo', 'create')->name('modulo.create');
            Route::put('option_modulo', 'edit')->name('modulo.edit');
            Route::delete('option_modulo', 'delete')->name('modulo.delete');
        });

        Route::controller(ConteudoController::class)->group(function () {
            Route::get('option_conteudo', 'view')->name('conteudo.view');
            Route::post('option_conteudo', 'create')->name('conteudo.create');
            Route::put('option_conteudo', 'edit')->name('conteudo.edit');
            Route::delete('option_conteudo', 'delete')->name('conteudo.delete');
        });

        Route::controller(VideoController::class)->group(function () {
            Route::get('option_video', 'view')->name('video.view');
            Route::post('option_video', 'create')->name('video.create');
            Route::put('option_video', 'edit')->name('video.edit');
            Route::delete('option_video', 'delete')->name('video.delete');
        });

        Route::controller(ApostilaController::class)->group(function () {
            Route::get('option_apostila', 'view')->name('apostila.view');
            Route::post('option_apostila', 'create')->name('apostila.create');
            Route::put('option_apostila', 'edit')->name('apostila.edit');
            Route::delete('option_apostila', 'delete')->name('apostila.delete');
        });

        Route::controller(SlideController::class)->group(function () {
            Route::get('option_slide', 'view')->name('slide.view');
            Route::post('option_slide', 'create')->name('slide.create');
            Route::put('option_slide', 'edit')->name('slide.edit');
            Route::delete('option_slide', 'delete')->name('slide.delete');
        });

        Route::controller(DesafioController::class)->group(function () {
            Route::get('option_desafio', 'view')->name('desafio.view');
            Route::post('option_desafio', 'create')->name('desafio.create');
            Route::put('option_desafio', 'edit')->name('desafio.edit');
            Route::delete('option_desafio', 'delete')->name('desafio.delete');
        });

        Route::controller(QuizController::class)->group(function () {
            Route::get('option_quiz', 'view')->name('quiz.view');
            Route::post('option_quiz', 'create')->name('quiz.create');
            Route::put('option_quiz', 'edit')->name('quiz.edit');
            Route::delete('option_quiz', 'delete')->name('quiz.delete');
        });
    });
});

// não posso mandar para o questionário, pois ele está com o metodo post.
Route::fallback(function () {
    return redirect()->route('index');
});


require __DIR__ . '/auth.php';
