<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Validation\ValidationException;

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

Route::get('/', fn () => view('home'));
Route::get('/projects/export/{reference}', [ProjectController::class, 'exportPdf'])->name('projects.pdf');
Route::get('/projects/show/{reference}', [ProjectController::class, 'showByRef'])->name('projects.show');
Route::get('/projects/search/{reference}', [ProjectController::class, 'search'])->name('projects.search');

Route::get('/processes/export/{reference}', [ProcessController::class, 'exportPdf'])->name('processes.pdf');
Route::get('/processes/show/{reference}', [ProcessController::class, 'showByRef'])->name('processes.show');
Route::get('/processes/search/{reference}', [ProcessController::class, 'search'])->name('processes.search');


Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['status' => __($status)]);
        } else {
            throw ValidationException::withMessages([
                'email' => __($status)
            ]);
        }
    })->name('password.email');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
});

Route::group([
    'middleware' => 'auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin',
    ], function () {
        Route::group([
            'middleware' => 'permission:manage-account'
        ], function () {
            Route::get('/settings', [UserController::class, 'settings'])->name('settings');
            Route::post('/settings/update', [UserController::class, 'updateInfos'])->name('settings.update');
            Route::post('/settings/updatePassword', [UserController::class, 'updatePassword'])->name('settings.update.password');
        });
        Route::group([
            'middleware' => ['permission:view-project|view-projects']
        ], function () {
            Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');
            Route::post('/projects/list', [ProjectController::class, 'ajaxList']);

            Route::get('/projects/deleted', [ProjectController::class, 'deleted'])->name('projects.deleted.index');
            Route::post('/projects/deleted', [ProjectController::class, 'ajaxDeletedList'])->name('projects.deleted');
            Route::get('/projects/deleted/{id}', [ProjectController::class, 'showDeleted'])->name('projects.deleted.show');
            Route::resource('/projects', ProjectController::class);

            Route::group([
                'middleware' => ['permission:delete-project']
            ], function () {
                Route::post('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.forcedelete');
            });
            Route::group([
                'middleware' => ['permission:restore-project']
            ], function () {
                Route::post('/projects/restore/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
            });
        });

        Route::group([
            'middleware' => ['permission:view-processes|view-process']
        ], function () {
            Route::get('/processes/export', [ProcessController::class, 'export'])->name('processes.export');
            Route::post('/processes/list', [ProcessController::class, 'ajaxList']);

            Route::get('/processes/deleted', [ProcessController::class, 'deleted'])
                ->name('processes.deleted.index')->middleware('permission:viewDeletedProcesses');
            Route::post('/processes/deleted', [ProcessController::class, 'ajaxDeletedList'])->name('processes.deleted');
            Route::get('/processes/deleted/{id}', [ProcessController::class, 'showDeleted'])->name('processes.deleted.show');

            Route::group([
                'middleware' => ['permission:restore-process']
            ], function () {
                Route::post('/processes/restore/{id}', [ProcessController::class, 'restore'])->name('processes.restore');
                Route::post('/processes/delete/{id}', [ProcessController::class, 'delete'])->name('processes.forcedelete');
            });

            Route::get('/processes/macroprocesses/{id}/methods', [ProcessController::class, 'getMethods'])->name('processes.macroprocesses.methods');
            Route::get('/processes/domains/{id}/macroprocesses', [ProcessController::class, 'getMacroprocesses'])->name('processes.domains.macroprocesses');
            Route::resource('/processes', ProcessController::class);
        });

        Route::group([
            'middleware' => ['role:admin']
        ], function () {
            Route::post('/users/{user}/toggleStatus', [UserController::class, 'toggleStatus']);
            Route::resource('/users', UserController::class);
        });
    });
});
