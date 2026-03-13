<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\RelatorioController;

// Rota raiz → splash / login
Route::get('/', fn() => \Illuminate\Support\Facades\Auth::check() ? redirect()->route('home') : view('splash'));

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastro']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');

    // Livros
    Route::get('/estoque', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/novo', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{livro}', [LivroController::class, 'show'])->name('livros.show');
    Route::get('/livros/{livro}/editar', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livros/{livro}', [LivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{livro}', [LivroController::class, 'destroy'])->name('livros.destroy');

    // Movimentações de estoque
    Route::post('/livros/{livro}/entrada', [LivroController::class, 'entrada'])->name('livros.entrada');
    Route::post('/livros/{livro}/saida', [LivroController::class, 'saida'])->name('livros.saida');

    // Relatório
    Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio');

    // Perfil
    Route::get('/perfil', fn() => view('perfil'))->name('perfil');
});
