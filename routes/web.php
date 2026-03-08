<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartosController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => view('welcome'));

Route::get('/index', function () {
    return view('index');
});

Route::resource('quartos', QuartosController::class);