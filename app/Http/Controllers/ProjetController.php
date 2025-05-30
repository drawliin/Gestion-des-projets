<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Commune;
use App\Models\Province;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\SousProjetLocalise;
use App\Models\CommuneProjet;
use Illuminate\Database\QueryException;

class ProjetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");

        $query = Projet::with(['programme', 'province', 'commune', 'sousProjetsCommunes']);

        if ($search) {
            $query->where("code_du_projet", "like", "%{$search}%")
                ->orWhere("nom_du_projet", "like", "%{$search}%")
                ->orWhere("annee_debut", "like", "%{$search}%")
                ->orWhereHas('province', function ($q) use ($search) {
                    $q->where("description_province_fr", "like", "%{$search}%");
                })
                ->orWhereHas('commune', function ($q) use ($search) {
                    $q->where("nom_fr", "like", "%{$search}%");
                })
                ->orWhereHas('sousProjetsCommunes', function ($q) use ($search) {
                    $q->where("nom_fr", "like", "%{$search}%");
                });
        }

        $projets = $query->get();

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
        $validated = $request->validate([
            'code_du_projet' => 'required|unique:projets,code_du_projet',
            'nom_du_projet' => 'required|string',
            'annee_debut' => 'required|integer|min:2015|max:2045',
            'annee_fin_prevue' => 'required|integer|after_or_equal:annee_debut|max:2045',
            'etat_d_avancement_physique' => 'required|numeric|min:0|max:100',
            'commentaires' => 'nullable|string',
            'id_province' => 'required|exists:provinces,id_province',
            'id_programme' => 'required|exists:programmes,id_programme',
            'id_commune' => 'nullable|array',
            'id_commune.*' => 'nullable|exists:communes,id_commune',
        ],
        [
            "code_du_projet.unique" => "Le code du projet a déjà été pris",
            "annee_fin_prevue.after_or_equal" => "Le champ année fin prévue doit être une date postérieure ou égale à année début"
        ]);
        
        $communeId = null;
        if(!empty($validated["id_commune"])){
            $communeId = $validated["id_commune"];
        }

        unset($validated["id_commune"]);

        $newProjet = Projet::create($validated);

        $createdProjet = Projet::with(['sousProjetsCommunes', 'commune'])->find($newProjet->id_projet);

        if($communeId){
            $createdProjet->commune()->sync($communeId);
        }else{
            $createdProjet->commune()->detach(); 
        }

        return redirect()->route('projet.index')->with('success', 'Projet ajouté avec succès.');
    }

    public function show($id){
        $projet = Projet::with(['programme', 'province', 'sousProjetsCommunes', 'commune'])->find($id);
        return view('projet.details', compact('projet'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasAnyRole(['gestionnaire', 'financier'])){
            return redirect()->route('programme.index');
        }

        $projet = Projet::with(['programme', 'province', 'sousProjetsCommunes', 'commune'])->find($id);
        $programmes = Programme::all();
        $provinces = Province::all();
        $communes = Commune::where("id_province", $projet->province?->id_province)->get();

        return view('projet.edit', compact('projet', 'programmes', 'provinces', 'communes'));
    }

    public function update(Request $request, $id)
    {
        $projet = Projet::with(['sousProjetsCommunes', 'commune'])->find($id);

        if(auth()->user()->hasRole("gestionnaire")){
            $validated = $request->validate([
                'code_du_projet' => 'required|unique:projets,code_du_projet,' . $id . ',id_projet',
                'nom_du_projet' => 'required|string',
                'cout_cro' => 'nullable|numeric',
                'cout_total_du_projet' => 'nullable|numeric',
                'annee_debut' => 'required|integer|min:2015|max:2045',
                'annee_fin_prevue' => 'required|integer|after_or_equal:annee_debut|max:2045',
                'etat_d_avancement_physique' => 'nullable|numeric|min:0|max:100',
                'etat_d_avancement_financier' => 'nullable|numeric|min:0|max:100',
                'commentaires' => 'nullable|string',
                'id_province' => 'nullable|exists:provinces,id_province',
                'id_commune' => 'nullable|array',
                'id_commune.*' => 'nullable|exists:communes,id_commune',
                'id_programme' => 'required|exists:programmes,id_programme',
            ]);
        }else if(auth()->user()->hasRole("financier")){
            $validated = $request->validate([
                'cout_cro' => 'required|numeric',
                'cout_total_du_projet' => 'required|numeric',
                'etat_d_avancement_financier' => 'required|numeric|min:0|max:100',
            ]);
        }


        $dataToUpdate = $validated;
        unset($dataToUpdate['id_commune']);
        $projet->update($dataToUpdate);
        
        if (!empty($validated['id_commune'])) {
            $projet->commune()->sync($validated['id_commune']);
        } else if($projet->commune->isNotEmpty()) {
            $projet->commune()->detach();  
        }

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

    public function getProvinceByProject($id){
        $projet = Projet::find($id);
        $province = Province::find($projet->id_province);
        return response()->json($province);
    }


}
