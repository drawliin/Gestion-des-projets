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
            "nom" => "required|string|max:255",
            "prenom" => "required|string|max:255",
            "current_password" => "nullable|required_with:new_password|string",
            "new_password" => "nullable|string|min:8|confirmed"
        ],[
            "new_password.min" => "Le mot de passe doit contenir au moins 8 caractères",
            "new_password.confirmed" => "Les mots de passe ne correspondent pas"
        ]);

        $user = auth()->user();
        $toUpdate = $request->only(["nom", "prenom"]);

        if($request->filled("new_password")){
            if(!Hash::check($validated['current_password'], $user->password)){
                return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect']);
            }
            $toUpdate['password'] = Hash::make($validated['new_password']); 
        }
        
        $user->update($toUpdate);

        return redirect()->route("profile.index")->with('success', 'Données mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
