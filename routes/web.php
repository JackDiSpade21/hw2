<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Test;

Route::get('/', function () {
    return view('homepage');
});

Route::get('register', [LoginController::class, 'register_form']);
Route::post('register', [LoginController::class, 'do_register']);
Route::get('login', [LoginController::class, 'login_form']);
Route::post('login', [LoginController::class, 'do_login']);

Route::get('logout', function () {
    session()->flush();
    return redirect('/');
});


// Route::get('/test/{id}', function ($id) {
//     return 'Test ID: ' . $id;
// });

// Route::get('/test2', [Test::class, 'test']);