<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::post('refresh', [AuthController::class,'refresh'])->middleware('auth:api');;
Route::post('logout', [AuthController::class,'logout'])->middleware('auth:api');;

Route::post('profile',[ AuthController::class,'profile' ])->middleware('auth:api');;
Route::post('fetch-posts',[ PostController::class,'fetchPosts' ])->middleware('auth:api');
Route::post('fetch-post',[ PostController::class,'fetchPost' ])->middleware('auth:api');
Route::post('delete-post',[ PostController::class,'deletePost' ])->middleware('auth:api');

