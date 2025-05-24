<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SousprojetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

//'role:gestionnaire'
Route::middleware(['is.AdminOrGestionnaire'])->group(function (){
    Route::resource('province', ProvinceController::class);
    Route::resource('commune', CommuneController::class);
    Route::resource('domaine', DomaineController::class);
    Route::resource('chantier', ChantierController::class);
    Route::resource('programme', ProgrammeController::class);
    Route::resource('projet', ProjetController::class);
    Route::resource('sousprojet', SousprojetController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::resource('users', UserController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


