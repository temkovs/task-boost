<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProjectsPageController;
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

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('projects', ProjectsPageController::class);
    Route::prefix('projects/{project}')->name('project.')->group(function () {
        Route::get('/home', [ProjectsPageController::class, 'showHome'])->name('home');
        Route::get('/mind-map', [ProjectsPageController::class, 'showMindMap'])->name('mind_map');
        Route::post('/mind-map/store', [ProjectsPageController::class, 'storeMindMap'])->name('mind_map.store');
        Route::get('/events', [ProjectsPageController::class, 'showEvents'])->name('events');
        Route::get('/tasks', [ProjectsPageController::class, 'showTasks'])->name('tasks');
        Route::get('/notes', [ProjectsPageController::class, 'showNotes'])->name('notes');
        Route::get('/materials', [ProjectsPageController::class, 'showMaterials'])->name('materials');
    });
});
