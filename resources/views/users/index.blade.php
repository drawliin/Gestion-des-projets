@extends('layouts.nav')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="form-container">

    <div class="form-header">
        <div class="form-actions">
            <a href="{{ route('users.create') }}" class="btn-return">Ajouter Utilisateurs</a>
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
            <h1>Utilisateurs</h1>

            <form action="{{ route('users.index') }}" method="GET" style="display: flex; align-items: center;    gap: 8px; margin-top: 10px;">
                <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                <button type="submit" class="btn-action btn-edit" title="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->first()?->name }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id_utilisateur) }}" class="btn-action btn-edit" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id_utilisateur) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Supprimer ce utilisateur ?')">
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

<style>
    .styled-table th,
    .styled-table td {
        color: #000 !important;
    }
</style>
@endsection
