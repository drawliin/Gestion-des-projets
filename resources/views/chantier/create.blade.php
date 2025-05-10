@extends('layouts.nav')

@section('title', 'Créer un Chantier')

@section('content')
<div class="form-container">

  <div class="form-content">
    <div class="form-title">
      <h2>CRÉER UN NOUVEAU</h2>
      <h1>Chantier</h1>
    </div>

    <form method="POST" action="{{route('chantier.store')}}">
      @csrf
      <h3>Détails du Chantier</h3>

      <div class="form-row">
        <div class="form-group">
          <label for="code_du_chantier">Code Chantier <span class="required">*</span></label>
          <input type="number" id="code_du_chantier" name="code_du_chantier" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="description_du_chantier">Description du Chantier</label>
          <textarea id="description_du_chantier" name="description_du_chantier" class="styled-textarea"></textarea>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="id_domaine">Domaine associé <span class="required">*</span></label>
          <div class="select-wrapper">
            <select id="id_domaine" name="id_domaine" required>
              <option value="">Sélectionner</option>
              @foreach ($domaines as $domaine)
                <option value="{{ $domaine->id_domaine }}">{{ $domaine->description_fr ?? 'Domaine ' . $domaine->code_du_domaine }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-actions-top">
        <button class="btn-return" type="submit">Enregistrer le chantier</button>
      </div>
    </form>
  </div>
</div>
@endsection
