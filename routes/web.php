<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;
use App\Http\Controllers\ReservasController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => view('login'));

Route::get('/index', fn() => view('index'));

// Route::get('/fazerReserva', fn() => view('fazerReserva'));

Route::resource('quartos', QuartosController::class);

Route::resource('reservas', ReservasController::class);