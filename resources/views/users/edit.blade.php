@extends('layouts.nav')

@section('title', 'Modifier un utilisateur')

@section('content')
<div class="form-container">
    <div class="form-header">
      <div class="form-actions">
        <a href="{{ route('users.index') }}" class="btn-icon" title="Retour à la liste">
            <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>

    <div class="form-content">
        <div class="form-title">
            <h2>MODIFIER</h2>
            <h1>Utilisateur</h1>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="custom-alert error">
                    <p>{{ $error }}</p>
                </div>
            @endforeach
        @endif


        <form method="POST" action="{{ route('users.update', $user->id_utilisateur) }}">
            @csrf
            @method('PUT')
            <h3>Détails de l'utilisateur</h3>

            <div class="form-row">
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email..." value="{{$user->email}}"/>
                </div>

                <div class="form-group">
                <label for="role">Role</label>
                <select name="role">
                    @foreach($roles as $role)
                        <option 
                            value="{{$role->name}}" 
                            
                            {{$user->roles->first()?->name == $role->name ? 'selected' : ''}}
                        >
                            {{$role->name}}
                        </option>
                    @endforeach
                </select>
                
                </div>
            </div>

            <div class="form-actions-top">
            <button type="submit" class="btn-return">Mettre à jour la province</button>
            </div>
        </form>
    </div>
</div>
@endsection