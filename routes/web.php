<?php

use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\ConteudoController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware('verified')->name('dashboard');

        Route::get('view-create-curso', function () {
            return view('admin.create-curso');
        })->name('view-create-curso');

        Route::get('view-cursos', [CursoController::class, 'cursos'])->name('view.cursos');
        Route::get('view-conteudos', [CursoController::class, 'conteudos'])->name('view.conteudos');
        Route::post('create-curso', [CursoController::class, 'create'])->name('create.curso');
        Route::post('edit', [CursoController::class, 'edit'])->name('edit.curso');

        Route::get('view-create-conteudo', [ConteudoController::class, 'view'])->name('view-create-conteudo');
        Route::post('create-content', [ConteudoController::class, 'create'])->name('create.conteudo');
    });
});

require __DIR__ . '/auth.php';
