<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
    */

    public function index(Request $request){
        if(!auth()->user()->hasRole('gestionnaire') && !auth()->user()->hasRole('admin')){
            return abort(403);
        }
        $search = $request->input("search");

        if($search){
            $domaines = Domaine::where("code_du_domaine", "like", "%{$search}%")
                ->orWhere("description_fr", "like", "%{$search}%")
                ->orWhere("description_ar", "like", "%{$search}%")
                ->get();
        }else{
            $domaines = Domaine::all();        
        }

        return view('domaine.index', compact('domaines'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('domaine.index');
        }
        return view('domaine.create');
    }

    
    public function store(Request $request)
    {
         $request->validate([
            'code_du_domaine' => 'required|integer|unique:domaines,code_du_domaine',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ]);

        Domaine::create($request->all());

        return redirect()->route('domaine.index')->with('success', 'Domaine créé avec succès.');

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
            return redirect()->route('domaine.index');
        }
        $domaine = Domaine::findOrFail($id);
        return view('domaine.edit', compact('domaine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $domaine = Domaine::findOrFail($id);

        $request->validate([
            'code_du_domaine' => 'required|integer|unique:domaines,code_du_domaine,' . $domaine->id_domaine . ',id_domaine',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ]);

        $domaine->update($request->all());

        return redirect()->route('domaine.index')->with('success', 'Domaine mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->hasRole('gestionnaire')){
            return redirect()->route('domaine.index');
        }
        
        try{
            $domaine = Domaine::findOrFail($id);
            $domaine->delete();

            return redirect()->route('domaine.index')->with('success', 'Domaine supprimé avec succès.');
        
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('domaine.index')
                    ->with('error', 'Impossible de supprimer le domaine : il est lié à un ou plusieurs chantiers ou projets.');
        }

        return redirect()->route('domaine.index')
            ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
