<?php

declare(strict_types=1);

use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
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

Route::domain('get.' . config('app.domain'))
    ->group(function (): void {
        Route::get('/{presetOrWidth?}/{height?}', [QuoteController::class, 'get'])->name('createPicture');
    })
;

Route::get('/', [HomeController::class, 'show'])->name('index');
Route::get('/aide', [HelpController::class, 'show'])->name('help');
