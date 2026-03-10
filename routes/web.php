<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => view('login'));

Route::get('/index', fn() => view('index'));

Route::get('/fazerReserva', fn() => view('fazerReserva'));

Route::resource('quartos', QuartosController::class);