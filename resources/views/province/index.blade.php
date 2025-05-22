@extends('layouts.nav')

@section('title', 'Liste des Provinces')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-actions">
          <a href="{{ route('province.create') }}" class="btn-return">Ajouter province</a>
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
            <h1>Provinces</h1>

            <form action="{{ route('province.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
                <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                <button type="submit" class="btn-action btn-edit" title="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
            </form>

        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description (FR)</th>
                    <th>Description (AR)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provinces as $province)
                <tr>
                    <td>{{ $province->id_province }}</td>
                    <td>{{ $province->code_province }}</td>
                    <td>{{ $province->description_province_fr }}</td>
                    <td>{{ $province->description_province_ar }}</td>
                    <td>
                        <!-- Lien "Modifier" stylisé avec une icône -->
                        <a href="{{ route('province.edit', $province->id_province) }}" class="btn-action btn-edit" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('province.destroy', $province->id_province) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer cette province ?')" title="Supprimer">
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