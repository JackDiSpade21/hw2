<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/gethomecards', [ApiController::class, 'getHomeCards']);
Route::get('/checkmail/{mail}', [ApiController::class, 'checkMail']);
Route::get('/getartistdetails/{id}', [ApiController::class, 'getArtista']);
Route::get('/geteventdetails/{id}', [ApiController::class, 'getEventiByArtista']);
Route::get('/getqrcode/{codice}', [ApiController::class, 'getQrCode']);
Route::get('/getspotifydetail/{id}', [ApiController::class, 'getSpotifyTracks']);
Route::get('/searchresults/{query}', [ApiController::class, 'searchResults']);