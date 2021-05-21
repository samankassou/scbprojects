<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', fn()=>view('welcome'));
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin'
], function(){
    Route::resource('/projects', ProjectController::class);
    Route::resource('/users', UserController::class);
});