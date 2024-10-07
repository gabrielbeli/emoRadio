<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BandaController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FavoritoController;
use App\Http\Middleware\AdminMiddleware;

// Registrar o middleware admin
Route::aliasMiddleware('admin', AdminMiddleware::class);

// Rota principal
Route::get('/', function () {
    return view('home');
});

//Rota para envio de varias na home pro meu modal se portar bem kkk :/
Route::get('/', [HomeController::class, 'index']);

// Rotas para autenticação
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas para usuários
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/delete/{id}', [UserController::class, 'deleteUserId'])->name('users.delete');
});
Route::post('/users/create', [UserController::class, 'create'])->name('users.create');

// Rotas para bandas
Route::get('/bands', [BandaController::class, 'index'])->name('bandas.index');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/bands/create', [BandaController::class, 'create'])->name('bandas.create');
    Route::delete('/bands/{id}', [BandaController::class, 'delete'])->name('bandas.delete');
});

// Rotas para álbuns
Route::get('/albuns', [AlbumController::class, 'index'])->name('albuns.index');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/albuns/create', [AlbumController::class, 'create'])->name('albuns.create');
    Route::delete('/albuns/delete/{id}', [AlbumController::class, 'delete'])->name('albuns.delete');
});

// Rotas para favoritos
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favorites/add/{albumId}', [FavoritoController::class, 'add'])->name('favoritos.add');
    Route::delete('/favorites/remove/{albumId}', [FavoritoController::class, 'remove'])->name('favoritos.remove');
});

// Rota de fallback
Route::fallback(function () {
    return view('notFound');
});
