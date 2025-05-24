@extends('layouts.nav')

@section('title', 'Créer un nouveau utilisateur')

@section('content')
<div class="form-container">

    <div class="form-content">
        <div class="form-title">
            <h2>CRÉER UN NOUVEAU</h2>
            <h1>Utilisateur</h1>
        </div>

        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <h3>Créer un utilisateur</h3>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="custom-alert error">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            @endif
        
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" value="{{old('email')}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" name="password" required/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="role">Role <span class="required">*</span></label>
                    <select name="role">
                        <option value="">Sélectionner un role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions-top">
                <button type="submit" class="btn-return">Ajouter</button>
            </div>
        </form>
    </div>
  </div>
@endsection
