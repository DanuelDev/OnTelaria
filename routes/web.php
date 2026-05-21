<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\EstadiasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

// --- ROTAS PÚBLICAS (Visitantes) ---

Route::get('/rodar-migrations-secreto', function () {
    Config::set('session.driver', 'file');
    try {
        Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        return '<h1>OnTelaria configurado com absoluto sucesso na nuvem! 🚀</h1>';
    } catch (\Exception $e) {
        return '<h1>Erro:</h1><pre>' . $e->getMessage() . '</pre>';
    }
});
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// --- ROTAS PROTEGIDAS (Precisa estar logado) ---
Route::middleware('auth')->group(function () {

    // Dashboard (funcionário e cliente)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rota comum para todos (Clientes e Funcionários)
    Route::get('/index', fn() => view('index'))->name('index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- ROTAS EXCLUSIVAS DE FUNCIONÁRIOS ---
    Route::middleware('can:acesso-funcionario')->group(function () {
        
        Route::resource('clientes', ClientesController::class);
        Route::resource('quartos', QuartosController::class);
        Route::resource('estadias', EstadiasController::class);
        Route::patch('estadias/{estadia}/cancelar', [EstadiasController::class, 'cancelar'])->name('estadias.cancelar');
        Route::post('estadias/confirmar/{reserva}', [EstadiasController::class, 'confirmar'])
            ->name('estadias.confirmar');
    });

    // --- ROTAS DE CLIENTES (Acessíveis por ambos) ---
    Route::resource('reservas', ReservasController::class);
    
});