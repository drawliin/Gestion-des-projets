<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Chantier;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ChantierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chantiers = Chantier::with('domaine')->get();
        return view('chantier.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domaines = Domaine::all();
        return view('chantier.create', compact('domaines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_du_chantier' => 'required|integer|unique:chantiers,code_du_chantier',
            'description_du_chantier' => 'nullable|string',
            'id_domaine' => 'required|exists:domaines,id_domaine',
        ]);

        Chantier::create([
            'code_du_chantier' => $request->code_du_chantier,
            'description_du_chantier' => $request->description_du_chantier,
            'id_domaine' => $request->id_domaine,
        ]);

        return redirect()->route('chantier.index')->with('success', 'Chantier ajouté avec succès.');
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
        $chantier = Chantier::findOrFail($id);
        $domaines = Domaine::all();
        return view('chantier.edit', compact('chantier', 'domaines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chantier = Chantier::findOrFail($id);

        $request->validate([
            'code_du_chantier' => 'required|integer|unique:chantiers,code_du_chantier,' . $chantier->id_chantier . ',id_chantier',
            'description_du_chantier' => 'nullable|string',
            'id_domaine' => 'required|exists:domaines,id_domaine',
        ]);

        $chantier->update([
            'code_du_chantier' => $request->code_du_chantier,
            'description_du_chantier' => $request->description_du_chantier,
            'id_domaine' => $request->id_domaine,
        ]);

        return redirect()->route('chantier.index')->with('success', 'Chantier mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $chantier = Chantier::findOrFail($id);
        $chantier->delete();

        return redirect()->route('chantier.index')->with('success', 'Chantier supprimé avec succès.');
    } catch (QueryException $e) {
        if ($e->getCode() == '23000') {
            return redirect()->route('chantier.index')
                ->with('error', 'Impossible de supprimer le chantier : il est lié à un ou plusieurs sous-projets ou autres entités.');
        }

        return redirect()->route('chantier.index')
            ->with('error', 'Une erreur est survenue lors de la suppression.');
    }
    }
}
