<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Commune;
use App\Models\Province;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\SousProjetLocalise;
use Illuminate\Database\QueryException;

class ProjetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");

        if($search){
            $projets = Projet::with(['programme', 'province', 'commune'])->where("code_du_projet", "like", "%{$search}%")
                ->orWhere("nom_du_projet", "like", "%{$search}%")
                ->orWhere("annee_debut", "like", "%{$search}%")
                ->orWhereHas('province', function ($query) use ($search) {
                    $query->where("description_province_fr", "like", "%{$search}%");
                })
                ->orWhereHas('commune', function ($query) use ($search) {
                    $query->where("nom_fr", "like", "%{$search}%");
                })
                ->get();
        }else{
            $projets = Projet::with(['programme', 'province', 'commune'])->get();
        }

        return view('projet.index', compact('projets'));
    }

    public function create()
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('programme.index');
        }

        $programmes = Programme::all();
        $provinces = Province::all();
        $communes = Commune::all();

        return view('projet.create', compact('programmes', 'provinces', 'communes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_du_projet' => 'required|unique:projets,code_du_projet',
            'nom_du_projet' => 'required|string',
            'annee_debut' => 'required|integer|min:2015|max:2045',
            'annee_fin_prevue' => 'required|integer|after_or_equal:annee_debut|min:2015|max:2045',
            'etat_d_avancement_physique' => 'required|numeric|min:0|max:100',
            'commentaires' => 'nullable|string',
            'id_province' => 'required|exists:provinces,id_province',
            'id_commune' => 'required|exists:communes,id_commune',
            'id_programme' => 'required|exists:programmes,id_programme',
        ]);

        Projet::create($request->all());
        return redirect()->route('projet.index')->with('success', 'Projet ajouté avec succès.');
    }

    public function show($id){
        $projet = Projet::with(['programme', 'province', 'commune'])->findOrFail($id);
        return view('projet.details', compact('projet'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('programme.index');
        }

        $projet = Projet::findOrFail($id);
        $programmes = Programme::all();
        $provinces = Province::all();
        $communes = Commune::all();

        return view('projet.edit', compact('projet', 'programmes', 'provinces', 'communes'));
    }

    public function update(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);

        $request->validate([
            'code_du_projet' => 'required|unique:projets,code_du_projet,' . $id . ',id_projet',
            'nom_du_projet' => 'required|string',
            'cout_cro' => 'required|numeric',
            'cout_total_du_projet' => 'required|numeric',
            'annee_debut' => 'required|date',
            'annee_fin_prevue' => 'required|date|after_or_equal:annee_debut',
            'etat_d_avancement_physique' => 'required|numeric|min:0|max:100',
            'etat_d_avancement_financier' => 'required|numeric|min:0|max:100',
            'commentaires' => 'nullable|string',
            'id_province' => 'required|exists:provinces,id_province',
            'id_commune' => 'required|exists:communes,id_commune',
            'id_programme' => 'required|exists:programmes,id_programme',
        ]);

        $projet->update($request->all());
        return redirect()->route('projet.index')->with('success', 'Projet modifié avec succès.');
    }

    public function destroy($id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('programme.index');
        }

        try{
            $projet = Projet::findOrFail($id);
            $projet->delete();
            return redirect()->route('projet.index')->with('success', 'Projet supprimé avec succès.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('projet.index')
                    ->with('error', 'Impossible de supprimer ce projet : il est lié à un ou plusieurs sous-projets ou d’autres entités.');
            }

            return redirect()->route('projet.index')
            ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
    
    public function dashboard()
    {
        $total = Projet::count();
        $totalSousProjets = SousProjetLocalise::count();

        $avgPhysique = Projet::avg('etat_d_avancement_physique') ?? 0;
        $avgFinancier = Projet::avg('etat_d_avancement_financier') ?? 0;

        $nonCommences = Projet::where('etat_d_avancement_physique', 0)->count();
        $enCours = Projet::where('etat_d_avancement_physique', '>', 0)
                        ->where('etat_d_avancement_physique', '<', 100)
                        ->count();
        $termines = Projet::where('etat_d_avancement_physique', 100)->count();

        $projets = Projet::with(['province', 'commune'])->get();
        $sousProjets = SousProjetLocalise::with(['projet', 'province', 'commune'])->get();

        return view('directeur.dashboard', compact(
            'total', 'totalSousProjets', 'avgPhysique', 'avgFinancier',
            'nonCommences', 'enCours', 'termines', 'projets', 'sousProjets'
        ));
    }


}
