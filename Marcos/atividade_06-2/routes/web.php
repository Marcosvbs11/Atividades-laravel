<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;

// Rota para registrar um empréstimo
Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');

// Rota para listar o histórico de empréstimos de um usuário
Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');

// Rota para registrar a devolução
Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');


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
