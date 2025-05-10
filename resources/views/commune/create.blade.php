@extends('layouts.nav')

@section('title', 'Créer une nouvelle commune')

@section('content')
<div class="form-container">
    <div class="form-header">
    <div class="form-content">
        <div class="form-header">
        </div>
      <div class="form-title">
        <h2>CRÉER UNE NOUVELLE</h2>
        <h1>Commune</h1>
      </div>

      <form method="POST" action="{{route('commune.store')}}">
        @csrf
        <h3>Détails de la Commune</h3>

        <div class="form-row">
          <div class="form-group">
            <label for="code_commune">Code Commune <span class="required">*</span></label>
            <input type="text" id="code_commune" name="code_commune" required>
          </div>

          <div class="form-group">
            <label for="nom_fr">Nom (Français) <span class="required">*</span></label>
            <input type="text" id="nom_fr" name="nom_fr" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="nom_ar">Nom (Arabe) <span class="required">*</span></label>
            <input type="text" id="nom_ar" name="nom_ar" required>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Enregistrer la commune</button>
        </div>
      </form>
    </div>
  </div>
@endsection
