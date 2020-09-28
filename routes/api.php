<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\InterestController;


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
Route::apiResources([
		'categories'=> CategoryController::class,
		'subjects'=>SubjectController::class,
		'skills'=>SkillController::class,
		'interests'=>InterestController::class,
	]);
Route::post('addsubject',[SubjectController::class,'store']);
Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'

],  function($router){
	Route::post('login',[UserController::class,'login']);
	Route::post('register',[UserController::class,'register']);
	Route::post('logout',[UserController::class,'logout']);
	Route::post('refresh',[UserController::class,'refresh']);
	Route::get('userprofile/{id}',[User_ProfileController::class,'show']);
	Route::post('userprofile',[User_ProfileController::class,'store']);
	Route::put('userprofile/{id}',[User_ProfileController::class,'update']);
	Route::delete('userprofile/{id}',[User_ProfileController::class,'destroy']);
});