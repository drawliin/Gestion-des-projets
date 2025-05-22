@extends('layouts.nav')

@section('title', 'Liste des Programmes')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-actions">
          <a href="{{ route('programme.create') }}" class="btn-return">Ajouter un programme</a>
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
      <h1>Programmes</h1>

      <form action="{{ route('programme.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
          <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
          <button type="submit" class="btn-action btn-edit" title="Rechercher">
              <i class="fas fa-search"></i>
          </button>
      </form>

    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="styled-table">
      <thead>
        <tr>
          <th>Code</th>
          <th>Description</th>
          <th>Chantier</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($programmes as $programme)
          <tr>
            <td>{{ $programme->code_du_programme }}</td>
            <td>{{ $programme->description_du_programme }}</td>
            <td>{{ $programme->chantier->description_du_chantier ?? 'Chantier ' . $programme->chantier->code_du_chantier }}</td>
            <td>
                <!-- Lien "Modifier" stylisé avec une icône -->
                <a href="{{ route('programme.edit', $programme->id_programme) }}" class="btn-action btn-edit" title="Modifier">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('programme.destroy', $programme->id_programme) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer ce programme ?')" title="Supprimer">
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
@endsection
