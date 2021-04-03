<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



Route::get('/test', function () {
    return menu('amity-salas');
});


Route::get('/', function () {
    return view('welcome');
});

// Using PHP callable syntax...

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/backend', 'backend.dashboard');

Route::get('{slug}', [PageController::class, 'index'])->name('page');
