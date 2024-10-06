<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

// ----------------------- public page route section ----------------------- //
Route::get('/', [PublicPageController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::prefix('admin-panel/dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index']);

        Route::resource('tasks', TaskController::class);
        Route::resource('to-dos', ToDoController::class);

        Route::get('mark-as-completed/{task}', [TaskController::class, 'mark_as_completed']);
        Route::get('tasks-all-delete', [TaskController::class, 'all_delete']);
    });
});

require __DIR__.'/auth.php';
