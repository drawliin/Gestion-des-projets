@extends('layouts.nav')

@section('title', 'Liste des Sous-Projets')

@section('content')
<div class="form-container">

    @role('gestionnaire')
        <div class="form-header">
            <div class="form-actions">
                <a href="{{ route('sousprojet.create') }}" class="btn-return">Ajouter Sous-Projet</a>
            </div>
        </div>
    @endrole

    <div class="form-content">
        <div class="form-title">
            @if (session('success'))
                    <div class="custom-alert success">
                    {{ session('success') }}
                    </div>
            @endif

            @if (session('error'))
                <div class="custom-alert error">
                {{ session('error') }}
                </div>
            @endif
            <h2>LISTE DES</h2>
            <h1>Sous-Projets</h1>

            <form action="{{ route('sousprojet.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
                <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                <button type="submit" class="btn-action btn-edit" title="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
            </form>

        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Projet</th>
                    <th>Commune</th>
                    <th>Province</th>
                    <th>Estimation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sousProjets as $sousprojet)
                <tr>
                    <td>{{ $sousprojet->code_du_sous_projet }}</td>
                    <td>{{ $sousprojet->nom_du_sous_projet }}</td>
                    <td>{{ $sousprojet->projet->nom_du_projet ?? '' }}</td>
                    <td>{{ $sousprojet->commune->nom_fr ?? '' }}</td>
                    <td>{{$sousprojet->commune->province->description_province_fr}}</td>
                    <td>{{ $sousprojet->estimation_initiale }} DH</td>
                    <td>
                        <a href="{{ route('sousprojet.show', $sousprojet->code_du_sous_projet) }}" class="btn-action btn-view" title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </a>
                        @role('gestionnaire')
                            <a href="{{ route('sousprojet.edit', $sousprojet->code_du_sous_projet) }}" class="btn-action btn-edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sousprojet.destroy', $sousprojet->code_du_sous_projet) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Supprimer ce sous-projet ?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endrole
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
