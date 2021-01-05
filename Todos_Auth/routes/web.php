<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/register', [RegisterController::class, 'register']);


Route::resource('todos', TodoController::class);
Route::patch('todos/status/{todo}', [TodoController::class, 'updateStatus']);

Route::resource('contacts', ContactController::class);

Route::get('/me', function () {
    return Auth::user();
})->middleware('auth');

Route::post('/mail', function (Request $request) {

    Auth::user()->update($request->validate([
        'email' => 'required|email'
    ]));
})->middleware('auth');

Route::get('/{path}', function () {
    if (Auth::check()) {
        return view('app');
    } else {
        return view('interface');
    }
})->where('path', '.*');