<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Commune;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\SousProjetLocalise;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
//

}
public function dashboard()
    {
        $projets = Projet::with(['province', 'commune'])->paginate(5, ['*'], 'projets');
    $sousProjets = SousProjetLocalise::with(['province', 'commune', 'projet'])->paginate(5, ['*'], 'sous_projets');
         // Données des projets
    $totalProjets = Projet::count();
    $totalSousProjets = SousProjetLocalise::count();
    $avgPhysique = SousProjetLocalise::avg('avancement_physique') ?? 0;
    $avgFinancier = SousProjetLocalise::avg('avancement_financier') ?? 0;

    // Groupement par année de début
    $projetsParAnnee = DB::table('projets')
        ->select(DB::raw('YEAR(annee_debut) as annee'), DB::raw('count(*) as total'))
        ->groupBy('annee')
        ->orderBy('annee')
        ->get();

    // Groupement par province
    $projetsParProvince = DB::table('projets')
        ->join('provinces', 'projets.id_province', '=', 'provinces.id_province')
        ->select('provinces.description_province_fr as province', DB::raw('count(*) as total'))
        ->groupBy('province')
        ->get();

    // Labels pour un chart (exemple noms projets récents)
    $labels = $projets->pluck('nom_du_projet')->toArray();
    $data = $sousProjets->pluck('avancement_physique')->toArray();

    return view('directeur.dashboard', compact(
        'projets', 'sousProjets',
        'totalProjets', 'totalSousProjets',
        'avgPhysique', 'avgFinancier',
        'projetsParAnnee', 'projetsParProvince',
        'labels','data'
    ));
    }
    public function avancementSousProjets()
{
    $sousProjets = SousProjetLocalise::orderBy('created_at', 'desc')
        ->take(5)
        ->get(['commune', 'avancement_physique']);

    $labels = $sousProjets->pluck('commune')->toArray();
    $data = $sousProjets->pluck('avancement_physique')->toArray();

    return view('directeur.dashboard', compact('labels', 'data'));
}






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projets = Projet::all();
    $provinces = Province::all();
    $communes = Commune::all();

    // Données pour les graphiques
    $labels = $projets->pluck('nom_du_projet');
    $avancementPhysique = $projets->pluck('etat_d_avancement_physique');
    $avancementFinancier = $projets->pluck('etat_d_avancement_financier');

    return view('sousprojet.create', compact(
        'projets', 'provinces', 'communes',
        'labels', 'avancementPhysique', 'avancementFinancier'
    ));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
