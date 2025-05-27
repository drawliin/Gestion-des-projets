<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!auth()->user()->hasRole('gestionnaire') && !auth()->user()->hasRole('admin')){
            return abort(403);
        }
        
        $search = $request->input("search");

        if($search){
            $programmes = Programme::with('chantier')->where("code_du_programme", "like", "%{$search}%")
                ->orWhere("description_du_programme", "like", "%{$search}%")
                 ->orWhereHas('chantier', function ($query) use ($search) {
                    $query->where("description_du_chantier", "like", "%{$search}%");
                })
                ->get();
        }else{
            $programmes = Programme::with('chantier')->get();
        }
        
        return view('programme.index', compact('programmes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('programme.index');
        }
        $chantiers = Chantier::all();
        return view('programme.create', compact('chantiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_du_programme' => 'required|integer',
            'description_du_programme' => 'nullable|string',
            'id_chantier' => 'required|exists:chantiers,id_chantier',
        ]);

        Programme::create($request->all());

        return redirect()->route('programme.index')->with('success', 'Programme créé avec succès.');
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
            return redirect()->route('programme.index');
        }
        $programme = Programme::findOrFail($id);
        $chantiers = Chantier::all();
        return view('programme.edit', compact('programme', 'chantiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code_du_programme' => 'required|integer',
            'description_du_programme' => 'nullable|string',
            'id_chantier' => 'required|exists:chantiers,id_chantier',
        ]);

        $programme = Programme::findOrFail($id);
        $programme->update($request->all());

        return redirect()->route('programme.index')->with('success', 'Programme mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('programme.index');
        }
        
        $programme = Programme::findOrFail($id);
        $programme->delete();

        return redirect()->route('programme.index')->with('success', 'Programme supprimé avec succès.');

    }
}
