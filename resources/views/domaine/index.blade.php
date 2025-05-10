@extends('layouts.nav')

@section('title', 'Liste des domaines')

@section('content')

<div class="form-container">
    <div class="form-header">
        <div></div>
        <div class="form-actions">
          <a href="{{ route('domaine.create') }}" class="btn-return">Ajouter un domaine</a>
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
   <div>
   </div>
      <h2>LISTE DES</h2>
      <h1>Domaines</h1>
    </div>
    <div class="styled-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Code Domaine</th>
            <th>Description (FR)</th>
            <th>Description (AR)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($domaines as $domaine)
          <tr>
            <td>{{ $domaine->id_domaine }}</td>
            <td>{{ $domaine->code_du_domaine }}</td>
            <td>{{ $domaine->description_fr }}</td>
            <td>{{ $domaine->description_ar }}</td>
            <td>
                <!-- Lien "Modifier" stylisé avec une icône -->
                <a href="{{ route('domaine.edit', $domaine->id_domaine) }}" class="btn-action btn-edit" title="Modifier">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('domaine.destroy', $domaine->id_domaine) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer ce domaine ?')" title="Supprimer">
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
