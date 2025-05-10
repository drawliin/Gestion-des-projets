<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        return view('province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('province.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_province' => 'required|string|max:100',
            'description_province_fr' => 'nullable|string',
            'description_province_ar' => 'nullable|string',
        ]);

        Province::create([
            'code_province' => $request->code_province,
            'description_province_fr' => $request->description_province_fr,
            'description_province_ar' => $request->description_province_ar,
        ]);

        return redirect()->route('province.index')->with('success', 'Province ajoutée avec succès.');

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
        $province = Province::findOrFail($id);
        return view('province.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code_province' => 'required|string|max:100',
            'description_province_fr' => 'nullable|string',
            'description_province_ar' => 'nullable|string',
        ]);

        $province = Province::findOrFail($id);
        $province->update([
            'code_province' => $request->code_province,
            'description_province_fr' => $request->description_province_fr,
            'description_province_ar' => $request->description_province_ar,
        ]);

        return redirect()->route('province.index')->with('success', 'Province mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $province = Province::findOrFail($id);
        $province->delete();
        return redirect()->route('province.index')->with('success', 'Province supprimée avec succès.');

        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('province.index')
                    ->with('error', 'Impossible de supprimer la province : elle est liée à un ou plusieurs projets.');
            }

            return redirect()->route('province.index')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
    }
}}
