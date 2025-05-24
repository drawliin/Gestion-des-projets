@extends('layouts.nav')

@section('title', 'Liste des Communes')

@section('content')
<div class="form-container">
  
  @role('gestionnaire')
    <div class="form-header">
      <div class="form-actions">
        <a href="{{ route('commune.create') }}" class="btn-return">Ajouter une commune</a>
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
      <h1>Communes</h1>

      <form action="{{ route('commune.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
        <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
        <button type="submit" class="btn-action btn-edit" title="Rechercher">
            <i class="fas fa-search"></i>
        </button>
      </form>

    </div>
    <div class="form-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Nom (FR)</th>
            <th>Nom (AR)</th>
            @role('gestionnaire')
              <th>Actions</th>
            @endrole
          </tr>
        </thead>
        <tbody>
        @foreach($communes as $commune)
          <tr>
            <td>{{ $commune->id_commune }}</td>
            <td>{{ $commune->code_commune }}</td>
            <td>{{ $commune->nom_fr }}</td>
            <td>{{ $commune->nom_ar }}</td>
            @role('gestionnaire')
              <td>
                  <a href="{{ route('commune.edit', $commune->id_commune) }}" class="btn-action btn-edit" title="Modifier">
                      <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('commune.destroy', $commune->id_commune) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer cette commune ?')" title="Supprimer">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </form>
              </td>
            @endrole

        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

