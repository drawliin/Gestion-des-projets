@extends('layouts.nav')

@section('title', 'Liste des Chantiers')

@section('content')
<div class="form-container">

  @role('gestionnaire')
    <div class="form-header">
        <div class="form-actions">
          <a href="{{ route('chantier.create') }}" class="btn-return">Ajouter un chantier</a>
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
      <h1>Chantiers</h1>

      <form action="{{ route('chantier.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
          <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
          <button type="submit" class="btn-action btn-edit" title="Rechercher">
              <i class="fas fa-search"></i>
          </button>
      </form>

    </div>
    <div class="styled-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Domaine</th>
            @role('gestionnaire')
              <th>Actions</th>
            @endrole
          </tr>
        </thead>
        <tbody>
        @foreach($chantiers as $chantier)
          <tr>
            <td>{{ $chantier->id_chantier }}</td>
            <td>{{ $chantier->code_du_chantier }}</td>
            <td>{{ $chantier->description_du_chantier }}</td>
            <td>{{ $chantier->domaine->description_fr ?? 'N/A' }}</td>
            @role('gestionnaire')
              <td>
                  <a href="{{ route('chantier.edit', $chantier->id_chantier) }}" class="btn-action btn-edit" title="Modifier">
                      <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('chantier.destroy', $chantier->id_chantier) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer ce chantier ?')" title="Supprimer">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </form>
              </td>
            @endrole
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
