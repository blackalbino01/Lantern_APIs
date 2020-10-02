<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserMediaController;
use App\Http\Controllers\BookStoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// All User media related api route
/*
    you can view all endpoints using the <php artisan route:list> artisan command
*/

Route::apiResource('media', UserMediaController::class);
// ->middleware('auth:api');
Route::apiResource('books', BookStoreController::class);

// Route::get('user_media', [UserMediaController::class, 'index']);
