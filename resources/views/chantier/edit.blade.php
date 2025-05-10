@extends('layouts.nav')

@section('title', 'Modifier un Chantier')

@section('content')
<div class="form-container">

  <div class="form-content">
    <div class="form-title">
        <div class="form-header">
        </div>
      <h2>MODIFIER</h2>
      <h1>Chantier</h1>
    </div>

    <form method="POST" action="{{ route('chantier.update', $chantier->id_chantier) }}">
      @csrf
      @method('PUT')

      <div class="form-row">
        <div class="form-group">
          <label for="code_du_chantier">Code Chantier <span class="required">*</span></label>
          <input type="number" id="code_du_chantier" name="code_du_chantier" value="{{ $chantier->code_du_chantier }}" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="description_du_chantier">Description du Chantier</label>
          <textarea id="description_du_chantier" name="description_du_chantier" class="styled-textarea">{{ $chantier->description_du_chantier }}</textarea>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="id_domaine">Domaine associé <span class="required">*</span></label>
          <div class="select-wrapper">
            <select id="id_domaine" name="id_domaine" required>
              <option value="">Sélectionner</option>
              @foreach ($domaines as $domaine)
                <option value="{{ $domaine->id_domaine }}" {{ $chantier->id_domaine == $domaine->id_domaine ? 'selected' : '' }}>
                  {{ $domaine->description_fr ?? 'Domaine ' . $domaine->code_du_domaine }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-actions-top">
        <button class="btn-return" type="submit">Mettre à jour le chantier</button>
      </div>
    </form>
  </div>
</div>
@endsection
