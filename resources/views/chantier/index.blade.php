@extends('layouts.nav')

@section('title', 'Liste des Chantiers')

@section('content')
<div class="form-container">
    <div class="form-header">

        <div class="form-actions">
          <a href="{{ route('chantier.create') }}" class="btn-return">Ajouter un chantier</a>
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
      <h1>Chantiers</h1>
    </div>
    <div class="styled-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Domaine</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($chantiers as $chantier)
          <tr>
            <td>{{ $chantier->id_chantier }}</td>
            <td>{{ $chantier->code_du_chantier }}</td>
            <td>{{ $chantier->description_du_chantier }}</td>
            <td>{{ $chantier->domaine->description_fr ?? 'N/A' }}</td>
            <td>
                <!-- Lien "Modifier" stylisé avec une icône -->
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
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
