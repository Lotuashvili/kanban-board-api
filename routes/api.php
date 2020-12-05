<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn() => response('Kanban Board API'));

Route::get('board', BoardController::class)->name('board.index');

Route::apiResources([
    'states' => StatesController::class,
    'users' => UsersController::class,
    'tasks' => TasksController::class,
]);

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::post('reorder/{id}', [TasksController::class, 'reorder'])->name('reorder');
});

Route::prefix('states')->name('states.')->group(function () {
    Route::post('reorder/{id}', [StatesController::class, 'reorder'])->name('reorder');
});
