<?php

use App\Http\Controllers\Admin\ProcessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/', fn()=>view('home'));
Route::get('/login', fn()=>view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin'
], function(){
    Route::resource('/projects', ProjectController::class);
    Route::resource('/processes', ProcessController::class);
    Route::resource('/users', UserController::class);
});