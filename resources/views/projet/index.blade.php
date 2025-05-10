@extends('layouts.nav')

@section('title', 'Liste des projets')

@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-header">
        <div class="form-actions">
          <a href="{{ route('projet.create') }}" class="btn-return">Ajouter un projet</a>
        </div>
      </div>
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
    </div>

    <div class="form-content">
      <table class="styled-table">
        <thead>
          <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Province</th>
            <th>Commune</th>
            <th>Date Début</th>
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
              <td>{{ $projet->date_debut }}</td>
              <td>
                <!-- Lien "Voir" stylisé avec une icône -->
                <a href="{{ route('projet.show', $projet->id_projet) }}" class="btn-action btn-view" title="Voir">
                    <i class="fas fa-eye"></i>
                </a>
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
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
