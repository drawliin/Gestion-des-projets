<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController; // Ajoute ce use en haut si pas encore fait

Route::get('/projets',function(){
    return view('welcome');
});
Route::get('/sous-projets',function(){
    return view('sousprojet');
});

