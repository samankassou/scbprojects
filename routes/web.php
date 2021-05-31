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
Route::get('/projects/show/{reference}', [ProjectController::class, 'showByRef'])->name('projects.show');
Route::get('/projects/search/{reference}', [ProjectController::class, 'search'])->name('projects.search');

Route::group([
    'middleware' => 'guest'
], function(){
    Route::get('/login', fn()=>view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group([
    'middleware' => 'auth'
], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin',
    ], function(){

        Route::resource('/projects', ProjectController::class);
        
        Route::get('/processes/poles/{id}/entities', [ProcessController::class, 'getEntities'])->name('processes.poles.entities');
        Route::get('/processes/macroprocesses/{id}/methods', [ProcessController::class, 'getMethods'])->name('processes.macroprocesses.methods');
        Route::get('/processes/domains/{id}/macroprocesses', [ProcessController::class, 'getMacroprocesses'])->name('processes.domains.macroprocesses');
        Route::resource('/processes', ProcessController::class);
        
        Route::resource('/users', UserController::class);
    });
});
