<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Commune;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\SousProjetLocalise;
use Illuminate\Database\QueryException;

class SousprojetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");

        if($search){
            $sousProjets = SousProjetLocalise::with(['projet', 'commune.province'])->where(function ($query) use ($search) {
                $query->where("code_du_sous_projet", "like", "%{$search}%")
                    ->orWhere("nom_du_sous_projet", "like", "%{$search}%")
                    ->orWhere("estimation_initiale", "like", "%{$search}%")
                    ->orWhereHas('projet', function ($q) use ($search) {
                        $q->where("nom_du_projet", "like", "%{$search}%");
                    })
                    ->orWhereHas('commune', function ($q) use ($search) {
                        $q->where("nom_fr", "like", "%{$search}%")
                        ->orWhereHas('province', function ($q2) use ($search) {
                            $q2->where("description_province_fr", "like", "%{$search}%");
                        });
                    });
            })
            ->get();

        }else{
            $sousProjets = SousProjetLocalise::with(['projet', 'commune.province'])->get();
            
        }
        return view('sousprojet.index', compact('sousProjets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return abort(403);
        }
        $projets = Projet::all();
        $provinces = Province::all();
        $communes = Commune::all();

        return view('sousprojet.create', compact('projets', 'communes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_province' => 'required|exists:provinces,id_province',
            'id_commune' => 'required|exists:communes,id_commune',
            'id_projet' => 'required|exists:projets,id_projet',
            'nom_du_sous_projet' => 'required|string|max:100',
            'secteur_concerne' => 'required|string|max:100',
            'site' => 'required|string|max:100',
            'source_de_financement' => 'required|string',
            'beneficiaire' => 'required|string',
            'estimation_initiale' => 'nullable|numeric',
            'avancement_physique' => 'required|string|max:50',
            'avancement_financier' => 'nullable|string|max:50',
            'code_du_sous_projet' => 'required|unique:sous_projets_localises,code_du_sous_projet',
            // champs optionnels
            'centre' => 'nullable|string|max:100',
            'surface' => 'nullable|string|max:50',
            'statut' => 'nullable|string|max:50',
            'lineaire' => 'nullable|string|max:100',
            'douars_desservis' => 'nullable|string',
            'nature_de_l_intervention' => 'nullable|string',
            'commentaires' => 'nullable|string',
            'localite' => 'nullable|string',
        ]);

        SousProjetLocalise::create($validated);

        return redirect()->route('sousprojet.index')->with('success', 'Sous-projet ajouté avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sousProjet = SousProjetLocalise::with(['projet', 'commune'])->findOrFail($id);
        return view('sousprojet.details', compact('sousProjet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return abort(403);
        }
        $sousProjet = SousProjetLocalise::findOrFail($id);
        $projets = Projet::all();
        $provinces = Province::all();
        $communes = Commune::all();

        return view('sousprojet.edit', compact('sousProjet', 'projets', 'communes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sousProjet = SousProjetLocalise::findOrFail($id);

        $validated = $request->validate([
            'id_province' => 'required|exists:provinces,id_province',
            'id_commune' => 'required|exists:communes,id_commune',
            'id_projet' => 'required|exists:projets,id_projet',
            'nom_du_sous_projet' => 'required|string|max:100',
            'secteur_concerne' => 'required|string|max:100',
            'site' => 'required|string|max:100',
            'source_de_financement' => 'required|string',
            'beneficiaire' => 'required|string',
            'estimation_initiale' => 'required|numeric',
            'avancement_physique' => 'required|string|max:50',
            'avancement_financier' => 'required|string|max:50',
            // champs optionnels
            'centre' => 'nullable|string|max:100',
            'surface' => 'nullable|string|max:50',
            'statut' => 'nullable|string|max:50',
            'lineaire' => 'nullable|string|max:100',
            'douars_desservis' => 'nullable|string',
            'nature_de_l_intervention' => 'nullable|string',
            'commentaires' => 'nullable|string',
            'localite' => 'nullable|string',
        ]);

        $sousProjet->update($validated);

        return redirect()->route('sousprojet.index')->with('success', 'Sous-projet mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return abort(403);
        }
        try{
        $sousProjet = SousProjetLocalise::findOrFail($id);
        $sousProjet->delete();

        return redirect()->route('sousprojet.index')->with('success', 'Sous-projet supprimé.');
    } catch (QueryException $e) {
        if ($e->getCode() == '23000') {
            // Contrainte d'intégrité : clé étrangère
            return redirect()->route('sousprojet.index')
                ->with('error', 'Impossible de supprimer ce sous-projet : il est lié à un ou plusieurs enregistrements.');
        }

        return redirect()->route('sousprojet.index')
            ->with('error', 'Une erreur est survenue lors de la suppression du sous-projet.');
    }
    }
}
