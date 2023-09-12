<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MindMapController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectsPageController;
use App\Http\Controllers\TaskController;
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

Route::get('/', HomepageController::class)->name('homepage');

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('process_login');
    Route::get('/login', [HomepageController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('process_register');
    Route::get('/register', [HomepageController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('projects', ProjectsPageController::class);
    Route::prefix('projects/{project}')->name('project.')->group(function () {
        Route::resource('/mind-map', MindMapController::class)->except('edit','create');
        Route::resource('/materials', MaterialController::class)->except('edit','create');
        Route::resource('/events', EventController::class)->except('edit','create');
        Route::resource('/notes', NoteController::class)->except('edit','create');
        Route::resource('/tasks', TaskController::class)->except('edit','create');
    });
});
