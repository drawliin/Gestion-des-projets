<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if(!auth()->user()->hasRole('gestionnaire') && !auth()->user()->hasRole('admin')){
            return abort(403);
        }
        $search = $request->input('search');

        if ($search) {
            $communes = Commune::where('nom_fr', 'like', "%{$search}%")
                ->orWhere('nom_ar', 'like', "%{$search}%")
                ->orWhere('code_commune', 'like', "%{$search}%")
                ->get();
        } else {
            $communes = Commune::all();
        }
        return view('commune.index', compact('communes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('commune.index');
        }
        return view('commune.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_commune' => 'required|string|max:100',
            'nom_fr' => 'required|string|max:400',
            'nom_ar' => 'required|string|max:400',
        ]);

        Commune::create([
            'code_commune' => $request->code_commune,
            'nom_fr' => $request->nom_fr,
            'nom_ar' => $request->nom_ar,
        ]);

        return redirect()->route('commune.index')->with('success', 'Commune ajoutée avec succès.');
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
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('commune.index');
        }
        $commune = Commune::findOrFail($id);
        return view('commune.edit', compact('commune'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code_commune' => 'required|string|max:100',
            'nom_fr' => 'required|string|max:400',
            'nom_ar' => 'required|string|max:400',
        ]);

        $commune = Commune::findOrFail($id);
        $commune->update($request->all());

        return redirect()->route('commune.index')->with('success', 'Commune mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('commune.index');
        }
        
        try {
            $commune = Commune::findOrFail($id);
            $commune->delete();

            return redirect()->route('commune.index')->with('success', 'Commune supprimée avec succès.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                // Violation de contrainte de clé étrangère
                return redirect()->route('commune.index')
                    ->with('error', 'Impossible de supprimer la commune : elle est liée à un ou plusieurs projets.');
            }

            return redirect()->route('commune.index')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }

}}
