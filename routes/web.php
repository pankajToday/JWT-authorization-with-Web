<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});

Route::get('login', function (){ return view('Auth.login'); })->name('login');
Route::post('web-login', [\App\Http\Controllers\AuthController::class,'webLogin']);
Route::get('register', function (){ return view('Auth.register'); })->name('register');
Route::get('forget-password', function (){ return view('Auth.forget-password'); });


Route::get('logout', [\App\Http\Controllers\AuthController::class,'logout']);
Route::get('home', ['middleware' => ['auth:web'], function () {
    return view('home');
}]);

Route::get('home-mobile',  function () {
    return view('home-mobile');
});



