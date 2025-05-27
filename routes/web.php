<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SousprojetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoutProjetController;

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

Route::middleware(['role:directeur'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [ProjetController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
    Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
    Route::get('/sous-projets', [SousProjetController::class, 'index'])->name('sous-projets.index');
    Route::get('/sous-projets/{sousProjet}', [SousProjetController::class, 'show'])->name('sous-projets.show');
});

Route::middleware(['auth'])->group(function (){
    Route::get("profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("profile", [ProfileController::class, "update"])->name("profile.update");
});

Route::middleware(['role:financier'])->group(function(){
    Route::resource("couts", CoutProjetController::class);
    Route::get('/financiere/couts/export', [CoutProjetController::class, 'export'])->name('financiere.couts.export');
});
