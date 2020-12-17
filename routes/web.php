<?php

use App\Http\Controllers\EmploymentHistoryController;
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

    Route::name('employment-history.')
        ->group(function () {
            Route::post('/', [EmploymentHistoryController::class, 'store'])
                ->name('store');
        });
});
