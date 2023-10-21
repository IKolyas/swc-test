<?php

use App\Http\Controllers\Admin\EventsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/events/{event?}', [EventsController::class, 'index'])->name('events.index');
    Route::get('/events/reload/{event?}', [EventsController::class, 'reload'])->name('events.reload');
    Route::get('/events/attach/{event}', [EventsController::class, 'attach'])->name('events.attach');
    Route::get('/events/detach/{event}', [EventsController::class, 'detach'])->name('events.detach');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
