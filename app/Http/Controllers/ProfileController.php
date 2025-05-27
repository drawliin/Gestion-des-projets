<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view("profile.index", compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            "current_password" => "required",
            "new_password" => "required|min:8|confirmed"
        ],[
            "current_password.required" => "Veuillez saisir votre mot de passe actuel",
            "new_password.min" => "Le mot de passe doit contenir au moins 8 caractères",
            "new_password.confirmed" => "Les mots de passe ne correspondent pas"
        ]);

        $user = auth()->user();

        if(!Hash::check($validated['current_password'], $user->password)){
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
