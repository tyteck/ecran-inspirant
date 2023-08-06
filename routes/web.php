<?php

declare(strict_types=1);

use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::domain('www.' . config('app.domain'))
    ->group(function (): void {
        Route::get('/', function () {
            return view('welcome');
        })->name('index');
    })
;

Route::domain('get.' . config('app.domain'))
    ->group(function (): void {
        Route::get('/', [QuoteController::class, 'get'])->name('get');
    })
;
