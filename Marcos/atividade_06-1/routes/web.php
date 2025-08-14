<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);

// Rota da página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação (login, register, etc.)
Auth::routes();

// Rota para a dashboard/home do usuário autenticado
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});
