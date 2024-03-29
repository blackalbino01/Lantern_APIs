<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserMediaController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BlogController;




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


Route::post('category/{category}/skill',[SkillController::class,'store']);
Route::post('category/{category}/subject',[SubjectController::class,'store']);
Route::post('category/{category}/interest',[InterestController::class,'store']);


Route::apiResources([
		'categories'=> CategoryController::class,
		'subjects'=>SubjectController::class,
		'skills'=>SkillController::class,
		'interests'=>InterestController::class,
	]);



Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'

],  function($router){
	Route::post('login',[UserController::class,'login']);
	Route::post('register',[UserController::class,'register']);
	Route::post('logout',[UserController::class,'logout']);
    Route::post('refresh',[UserController::class,'refresh']);
    Route::get('me/{id}',[UserController::class,'me']);

	Route::patch('update/{id}',[UserController::class,'update']);
	Route::get('userprofile/{id}',[User_ProfileController::class,'show']);
	Route::post('userprofile',[User_ProfileController::class,'store']);
	Route::patch('userprofile/{id}',[User_ProfileController::class,'update']);
	Route::delete('userprofile/{id}',[User_ProfileController::class,'destroy']);
});

Route::apiResource('media', UserMediaController::class)->middleware('auth:api');
Route::apiResource('blogs', BlogController::class);

Route::apiResource('books', BookStoreController::class);
Route::apiResource('adverts', AdvertisementController::class);

