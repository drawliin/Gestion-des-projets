<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\SousProjetLocalise;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoutsExport;

class CoutProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SousProjetLocalise::with('projet');

        if ($request->filled('id_projet')) {
            $query->where('id_projet', $request->id_projet);
        }

        $sousProjets = $query->paginate(5); // 10 items par page

        $projets = Projet::all();

        return view('financiere.index', compact('sousProjets', 'projets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projets = Projet::all();
        $sous_projets = SousProjetLocalise::all();

        return view('financiere.create', compact('projets', 'sous_projets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'sous_projet_id' => 'required|exists:sous_projets_localises,code_du_sous_projet',
            'estimation_initiale' => 'required|numeric|min:0',
            'avancement_financier' => 'required|numeric|min:0|max:100',
    ]);

    // Récupérer le sous projet par son code
    $sousProjet = SousProjetLocalise::where('code_du_sous_projet', $request->sous_projet_id)->first();

    // Affecter les valeurs
    $sousProjet->estimation_initiale = $request->estimation_initiale;
    $sousProjet->avancement_financier = $request->avancement_financier;
    $sousProjet->save();

    return redirect()->route('couts.index')->with('success', 'Estimation affectée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sousProjet = SousProjetLocalise::with('projet')->findOrFail($id);
    return view('financiere.show', compact('sousProjet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sousProjet = SousProjetLocalise::with('projet')->findOrFail($id);
    return view('financiere.edit', compact('sousProjet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'estimation_initiale' => 'required|numeric|min:0',
        'avancement_financier' => 'required|numeric|min:0|max:100',
    ]);

    $sousProjet = SousProjetLocalise::findOrFail($id);
    $sousProjet->update($validated);

    return redirect()->route('couts.index')->with('success', 'Les coûts ont été mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

public function export()
{
    // return Excel::download(new CoutsExport, 'suivi_couts.xlsx');
}

}
