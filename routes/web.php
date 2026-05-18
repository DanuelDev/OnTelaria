<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\EstadiasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

// --- ROTAS PÚBLICAS (Visitantes) ---

Route::get('/rodar-migrations-secreto', function () {
    // Força o driver de sessão a virar 'file' na marra antes de dar erro
    Config::set('session.driver', 'file');
    
    try {
        Artisan::call('migrate', ['--force' => true]);
        
        $output = Artisan::output();
        return '<h1>Banco de dados atualizado com sucesso! 🎉</h1><pre>' . $output . '</pre>';
    } catch (\Exception $e) {
        return '<h1>Erro ao rodar as migrations:</h1><br><pre>' . $e->getMessage() . '</pre>';
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
        
        Route::resource('quartos', QuartosController::class);
        Route::resource('estadias', EstadiasController::class);
        Route::patch('estadias/{estadia}/cancelar', [EstadiasController::class, 'cancelar'])->name('estadias.cancelar');
        Route::post('estadias/confirmar/{reserva}', [EstadiasController::class, 'confirmar'])
            ->name('estadias.confirmar');
    });

    // --- ROTAS DE CLIENTES (Acessíveis por ambos) ---
    Route::resource('reservas', ReservasController::class);
    
});