<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\NotificationController;

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

Auth::routes(['verify' => true]);

// Protected Routes
Route::group(['middleware' => ['auth', 'verified']], function() {

    // Vacancies Routes
    Route::get('/vacancies', [App\Http\Controllers\VacantController::class, 'index'])->name('vacancies.index');
    Route::get('/vacancies/create', [App\Http\Controllers\VacantController::class, 'create'])->name('vacancies.create');
    Route::post('/vacancies', [App\Http\Controllers\VacantController::class, 'store'])->name('vacancies.store');
    Route::delete('/vacancies/{vacant}', [App\Http\Controllers\VacantController::class, 'destroy'])->name('vacancies.destroy');
    Route::get('/vacancies/{vacant}/edit', [App\Http\Controllers\VacantController::class, 'edit'])->name('vacancies.edit');
    Route::put('/vacancies/{vacant}/update', [App\Http\Controllers\VacantController::class, 'update'])->name('vacancies.update');

    // Upload Images
    Route::post('/vacancies/image', [App\Http\Controllers\VacantController::class, 'image'])->name('vacancies.image');
    Route::post('/vacancies/imageDelete', [App\Http\Controllers\VacantController::class, 'imageDelete'])->name('vacancies.delete');

    // Change status of the vacant
    Route::post('/vacancies/{vacant}', [App\Http\Controllers\VacantController::class, 'status'])->name('vacancies.status');

    // Notifications
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, '__invoke'])->name('notifications');
});

// Home page
Route::get('/', [App\Http\Controllers\HomeController::class, '__invoke'])->name('home');

// Categories
Route::get('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

// Send data for a vacant
Route::get('/candidates/{id}', [App\Http\Controllers\CandidateController::class, 'index'])->name('candidates.index');
Route::post('/candidates/store', [App\Http\Controllers\CandidateController::class, 'store'])->name('candidates.store');

// Search Vacant
Route::post('/quest/search', [App\Http\Controllers\VacantController::class, 'search'])->name('vacancies.search');
Route::get('/quest/search', [App\Http\Controllers\VacantController::class, 'results'])->name('vacancies.results');

// Vacancies Routes no authentication
Route::get('/vacancies/{vacant}', [App\Http\Controllers\VacantController::class, 'show'])->name('vacancies.show');

