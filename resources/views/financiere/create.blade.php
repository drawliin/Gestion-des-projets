@extends('layouts.nav')

@section('title', 'Affecter une estimation')

@section('content')

<!-- Main Content -->
<div class="main-content">
  <div class="form-container">
    <div class="form-content">
      <div class="form-title">
        @if ($errors->any())
          <div class="alert-error">
            <ul>
              @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <h2>AFFECTER UNE</h2>
        <h1>Estimation Financière</h1>
      </div>

      <form method="POST" action="{{ route('couts.store') }}">
        @csrf
        <h3>Détails de l’Estimation</h3>

        <div class="form-row">
          <div class="form-group">
            <label for="projet_id">Projet <span class="required">*</span></label>
            <div class="select-wrapper">
              <select name="projet_id" id="projet_id" required>
                <option value="">Sélectionner</option>
                @foreach($projets as $projet)
                  <option value="{{ $projet->id }}">{{ $projet->nom_du_projet }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
  <label for="sous_projet_id">Sous-projet <span class="required">*</span></label>
  <div class="select-wrapper">
    <select name="sous_projet_id" id="sous_projet_id" required>
      <option value="">Sélectionner</option>
      @foreach($sous_projets as $sousProjet)
        <option value="{{ $sousProjet->code_du_sous_projet }}">
          {{ $sousProjet->nom_du_sous_projet }}
        </option>
      @endforeach
    </select>
  </div>
</div>

        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="estimation_initiale">Estimation Initiale (MAD) <span class="required">*</span></label>
            <input type="number" name="estimation_initiale" id="estimation_initiale" step="0.01" required>
          </div>

          <div class="form-group">
            <label for="cout_reel">Coût Réel (MAD)</label>
            <input type="number" name="cout_reel" id="cout_reel" step="0.01">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="avancement_financier">Avancement Financier (%) <span class="required">*</span></label>
            <input type="number" name="avancement_financier" id="avancement_financier" step="0.01" required>
          </div>

          <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire" rows="4"></textarea>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Affecter l’Estimation</button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
