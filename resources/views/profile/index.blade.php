@extends('layouts.nav')

@section('title', 'Profile')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-wrapper">
    <div class="profile-header">
        <h2>Votre espace personnel</h2>
    </div>

    <div class="profile-card">
        <section class="info-section">
            @if(session('success'))
                <div class="custom-alert success">
                {{ session('success') }}
                </div>
            @endif
        
            @if($errors->any())
                @foreach($errors->all() as $err)
                    <div class="custom-alert error">
                    {{ $err }}
                    </div>
                @endforeach
            @endif

            <h2>Informations Personnelles</h2>
            <ul>
                <li><strong>Nom:</strong> {{ $user->nom }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                @if($user->telephone)
                    <li><strong>Téléphone:</strong> {{ $user->telephone }}</li>
                @endif
                <li><strong>Rôle:</strong> {{ $user->roles->first()->name }}</li>
                <li><strong>Créé le:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</li>
            </ul>
        </section>

        <section class="password-section">
            <h2>🔒 Changer le mot de passe</h2>
            <form action="{{route('profile.update')}}" method="POST">
                @csrf
                @method('PUT')

                <label for="current_password">Mot de passe actuel</label>
                <input type="password" id="current_password" name="current_password" required>

                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" id="new_password" name="new_password" required>

                <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>

                <button type="submit">Mettre à jour</button>
            </form>
        </section>
    </div>
</div>
@endsection
