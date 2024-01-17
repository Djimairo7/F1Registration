<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/discover', [App\Http\Controllers\DiscoverController::class, 'index'])->name('discover');
Route::get('/race/{raceName}', 'App\Http\Controllers\RaceController@show')->name('race.show');
Route::post('/race/{raceName}/submit', 'App\Http\Controllers\RaceController@submitScore')->name('race.submit');
//route om profile.create.blade to connecten aan een web eindpunt met een authetificatie zodat je alleen een profiel kan maken als je ingelogt bent.
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'create'])->name('profile.create')
    ->middleware('auth');
Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store')
    ->middleware('auth');

Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')
    ->middleware('auth');
