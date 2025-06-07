<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArtistController;

Route::get('/', [LoginController::class, 'get_homepage']);

Route::get('register', [LoginController::class, 'register_form']);
Route::post('register', [LoginController::class, 'do_register']);
Route::get('login', [LoginController::class, 'login_form']);
Route::post('login', [LoginController::class, 'do_login']);

Route::get('api/getownedticketdetails/{ricevuta}', [ApiController::class, 'getOwnedTicketDetails']);
Route::get('api/getownedtickets', [ApiController::class, 'getOwnedTickets']);

Route::get('profile', [LoginController::class, 'get_profile']);

Route::get('search', [LoginController::class, 'get_search']);

Route::get('artist/{id}', [ArtistController::class, 'get_artistpage']);
Route::get('buy/{id}', [ArtistController::class, 'get_buypage']);
Route::post('buy/{id}', [ArtistController::class, 'post_buypage']);

Route::get('logout', function () {
    session()->flush();
    return redirect('/');
});