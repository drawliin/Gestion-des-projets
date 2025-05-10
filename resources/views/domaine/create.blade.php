@extends('layouts.nav')

@section('title', 'Créer un nouveau domaine')

@section('content')

<div class="form-container">

  <div class="form-content">
    <div class="form-title">
        <div class="form-header">
        </div>
        <div>
        </div>
      <h2>CRÉER UN NOUVEAU</h2>
      <h1>Domaine</h1>
    </div>

    <form method="POST" action=" {{route('domaine.index')}}">
      @csrf
      <h3>Détails du Domaine</h3>

      <div class="form-row">
        <div class="form-group">
          <label for="code_du_domaine">Code Domaine <span class="required">*</span></label>
          <input type="number" id="code_du_domaine" name="code_du_domaine" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="description_fr">Description (Français)</label>
          <textarea id="description_fr" name="description_fr" class="styled-textarea"></textarea>
        </div>
        <div class="form-group">
          <label for="description_ar">Description (Arabe)</label>
          <textarea id="description_ar" name="description_ar" class="styled-textarea"></textarea>
        </div>
      </div>

      <div class="form-actions-top">
        <button class="btn-return" type="submit">Enregistrer le domaine</button>
      </div>
    </form>
  </div>
</div>
@endsection

