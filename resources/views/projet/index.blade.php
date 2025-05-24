@extends('layouts.nav')

@section('title', 'Liste des projets')

@section('content')
<div class="main-content">
  <div class="form-container">
    
    @role('gestionnaire')
      <div class="form-header">
          <div class="form-actions">
            <a href="{{ route('projet.create') }}" class="btn-return">Ajouter un projet</a>
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
          <h1>Projets</h1>

          <form action="{{ route('projet.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
              <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
              <button type="submit" class="btn-action btn-edit" title="Rechercher">
                  <i class="fas fa-search"></i>
              </button>
          </form>

    </div>

    <div class="form-content">
      <table class="styled-table">
        <thead>
          <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Province</th>
            <th>Commune</th>
            <th>Année Début</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projets as $projet)
            <tr>
              <td>{{ $projet->code_du_projet }}</td>
              <td>{{ $projet->nom_du_projet }}</td>
              <td>{{ $projet->province->description_province_fr ?? ''}}</td>
              <td>{{ $projet->commune->nom_fr ?? ''}}</td>
              <td>{{ $projet->annee_debut }}</td>
              <td>
                <a href="{{ route('projet.show', $projet->id_projet) }}" class="btn-action btn-view" title="Voir">
                    <i class="fas fa-eye"></i>
                </a>
                @role('gestionnaire')
                  <a href="{{ route('projet.edit', $projet->id_projet) }}" class="btn-action btn-edit" title="Modifier">
                      <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('projet.destroy', $projet->id_projet) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer ce projet ?')" title="Supprimer">
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
</div>
@endsection
