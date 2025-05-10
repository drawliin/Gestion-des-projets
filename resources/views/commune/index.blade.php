@extends('layouts.nav')

@section('title', 'Liste des Communes')

@section('content')
<div class="form-container">
  <div class="form-header">
    <div class="form-actions">
      <a href="{{ route('commune.create') }}" class="btn-return">Ajouter une commune</a>
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
      <h1>Communes</h1>
    </div>
    <div class="form-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Nom (FR)</th>
            <th>Nom (AR)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($communes as $commune)
          <tr>
            <td>{{ $commune->id_commune }}</td>
            <td>{{ $commune->code_commune }}</td>
            <td>{{ $commune->nom_fr }}</td>
            <td>{{ $commune->nom_ar }}</td>
            <td>
                <!-- Lien "Modifier" stylisé avec une icône -->
                <a href="{{ route('commune.edit', $commune->id_commune) }}" class="btn-action btn-edit" title="Modifier">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Formulaire "Supprimer" stylisé avec une icône -->
                <form action="{{ route('commune.destroy', $commune->id_commune) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer cette commune ?')" title="Supprimer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>

        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

