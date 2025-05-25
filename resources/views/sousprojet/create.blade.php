@extends('layouts.nav')
@section('title', 'Créer un sous-projet')
@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-content">
      <div class="form-title">
        <h2>CRÉER UN NOUVEAU</h2>
        <h1>Sous-Projet</h1>
      </div>
      
      <form method="POST" action="{{ route('sousprojet.store') }}">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label for="id_projet">Projet parent <span class="required">*</span></label>
            <select id="id_projet" name="id_projet" required>
              <option value="">Sélectionner</option>
              @foreach($projets as $projet)
                <option value="{{ $projet->id_projet }}">{{ $projet->nom_du_projet }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="code_du_sous_projet">Code <span class="required">*</span></label>
            <input type="text" id="code_du_sous_projet" name="code_du_sous_projet" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="nom_du_sous_projet">Nom du sous-projet <span class="required">*</span></label>
            <input type="text" id="nom_du_sous_projet" name="nom_du_sous_projet" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_province">Province <span class="required">*</span></label>
            <select id="id_province" name="id_province" required>
              <option value="">Sélectionner</option>
              @foreach($provinces as $province)
                <option value="{{ $province->id_province }}">{{ $province->description_province_fr }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="id_commune">Commune <span class="required">*</span></label>
            <select id="id_commune" name="id_commune" required>
              <option value="">Sélectionner</option>
              @foreach($communes as $commune)
                <option value="{{ $commune->id_commune }}">{{ $commune->nom_fr }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="secteur_concerne">Secteur concerné</label>
            <input type="text" id="secteur_concerne" name="secteur_concerne">
          </div>
          <div class="form-group">
            <label for="site">Site</label>
            <input type="text" id="site" name="site">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="statut">Statut</label>
            <input type="text" id="statut" name="statut">
          </div>
          <div class="form-group">
            <label for="source_de_financement">Source de financement</label>
            <input type="text" id="source_de_financement" name="source_de_financement">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="surface">Surface</label>
            <input type="text" id="surface" name="surface">
          </div>
          <div class="form-group">
            <label for="lineaire">Linéaire</label>
            <input type="text" id="lineaire" name="lineaire">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="beneficiaire">Bénéficiaire</label>
            <input type="text" id="beneficiaire" name="beneficiaire">
          </div>
          <div class="form-group">
            <label for="estimation_initiale">Estimation initiale (MAD)</label>
            <input type="number" step="0.01" id="estimation_initiale" name="estimation_initiale">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="avancement_physique">Avancement physique (%)</label>
            <input type="number" id="avancement_physique" name="avancement_physique" min="0" max="100">
          </div>
          <div class="form-group">
            <label for="avancement_financier">Avancement financier (%)</label>
            <input type="number" id="avancement_financier" name="avancement_financier" min="0" max="100">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires</label>
            <textarea id="commentaires" name="commentaires" rows="2"></textarea>
          </div>
        </div>

        <div class="form-actions-top">
            <button class="btn-return" type="submit">Créer le sous-projet</button>
          </div>
        </div>
  </div>
</form>
@endsection
