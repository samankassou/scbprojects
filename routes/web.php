<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Arr;

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
Route::get('/projects/export/{reference}', [ProjectController::class, 'exportPdf'])->name('projects.pdf');
Route::get('/projects/show/{reference}', [ProjectController::class, 'showByRef'])->name('projects.show');
Route::get('/projects/search/{reference}', [ProjectController::class, 'search'])->name('projects.search');

Route::get('/processes/export/{reference}', [ProcessController::class, 'exportPdf'])->name('processes.pdf');
Route::get('/processes/show/{reference}', [ProcessController::class, 'showByRef'])->name('processes.show');
Route::get('/processes/search/{reference}', [ProcessController::class, 'search'])->name('processes.search');


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
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
        Route::post('/settings/update', [UserController::class, 'updateInfos'])->name('settings.update');
        Route::post('/settings/updatePassword', [UserController::class, 'updatePassword'])->name('settings.update.password');
        Route::group([
            'middleware' => ['permission:view-project|view-projects']
        ], function(){
            Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');
            Route::post('/projects/list', [ProjectController::class, 'ajaxList']);
            
            Route::get('/projects/deleted', [ProjectController::class, 'deleted'])->name('projects.deleted.index');
            Route::post('/projects/deleted', [ProjectController::class, 'ajaxDeletedList'])->name('projects.deleted');
            Route::get('/projects/deleted/{id}', [ProjectController::class, 'showDeleted'])->name('projects.deleted.show');
            Route::resource('/projects', ProjectController::class);

            Route::group([
                'middleware' => ['permission:delete-project']
            ], function(){
                Route::post('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.forcedelete');
            });
            Route::group([
                'middleware' => ['permission:restore-project']
            ], function(){
                Route::post('/projects/restore/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
            });
        });
        
        Route::group([
            'middleware' => ['permission:view-processes|view-process']
        ], function(){
            Route::post('/processes/list', [ProcessController::class, 'ajaxList']);

            Route::get('/processes/deleted', [ProcessController::class, 'deleted'])->name('processes.deleted.index');
            Route::post('/processes/deleted', [ProcessController::class, 'ajaxDeletedList'])->name('processes.deleted');
            Route::get('/processes/deleted/{id}', [ProcessController::class, 'showDeleted'])->name('processes.deleted.show');

            Route::post('/processes/delete/{id}', [ProcessController::class, 'delete'])->name('processes.forcedelete');

            Route::get('/processes/macroprocesses/{id}/methods', [ProcessController::class, 'getMethods'])->name('processes.macroprocesses.methods');
            Route::get('/processes/domains/{id}/macroprocesses', [ProcessController::class, 'getMacroprocesses'])->name('processes.domains.macroprocesses');
            Route::resource('/processes', ProcessController::class);
        });
        
        Route::group([
            'middleware' => ['role:admin']
        ],function(){
            Route::post('/users/{user}/toggleStatus', [UserController::class, 'toggleStatus']);
            Route::resource('/users', UserController::class);
        });
    });
});
