<?php

use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/curriculum', function() {
        return inertia('Curriculum');
    })->name('curriculum');

    Route::name('profile.')
        ->prefix('profile')
        ->group(function () {
            Route::put('/{profile}', [ProfileController::class, 'update'])
                ->name('update');
        });

    Route::name('link.')
        ->prefix('link')
        ->group(function () {
            Route::post('/', [LinkController::class, 'store'])
                ->name('store');
            Route::put('/{link}', [LinkController::class, 'update'])
                ->name('update');
            Route::delete('/{link}', [LinkController::class, 'destroy'])
                ->name('destroy');
        });

    Route::name('skill.')
        ->prefix('skill')
        ->group(function () {
            Route::post('/', [SkillController::class, 'store'])
                ->name('store');
            Route::put('/{skill}', [SkillController::class, 'update'])
                ->name('update');
            Route::delete('/{skill}', [SkillController::class, 'destroy'])
                ->name('destroy');
        });

    Route::name('employment-history.')
        ->prefix('employment-history')
        ->group(function () {
            Route::post('/', [EmploymentHistoryController::class, 'store'])
                ->name('store');
            Route::put('/{employmentHistory}', [EmploymentHistoryController::class, 'update'])
                ->name('update');
            Route::delete('/{employmentHistory}', [EmploymentHistoryController::class, 'destroy'])
                ->name('destroy');
        });
});
