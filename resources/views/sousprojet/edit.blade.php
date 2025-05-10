@extends('layouts.nav')
@section('title', 'Modifier un sous-projet')
@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-content">
      <div class="form-title">
        <h2>MODIFIER</h2>
        <h1>Sous-Projet</h1>
      </div>
      <form method="POST" action="{{ route('sousprojet.update', $sousProjet->code_du_sous_projet) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
          <div class="form-group">
            <label for="id_projet">Projet parent <span class="required">*</span></label>
            <select id="id_projet" name="id_projet" required>
              <option value="">Sélectionner</option>
              @foreach($projets as $projet)
                <option value="{{ $projet->id_projet }}" {{ $projet->id_projet == $sousProjet->id_projet ? 'selected' : '' }}>
                  {{ $projet->nom_du_projet }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="code_du_sous_projet">Code <span class="required">*</span></label>
            <input type="text" id="code_du_sous_projet" name="code_du_sous_projet" value="{{ old('code_du_sous_projet', $sousProjet->code_du_sous_projet) }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="nom_du_sous_projet">Nom du sous-projet <span class="required">*</span></label>
            <input type="text" id="nom_du_sous_projet" name="nom_du_sous_projet" value="{{ old('nom_du_sous_projet', $sousProjet->nom_du_sous_projet) }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_province">Province <span class="required">*</span></label>
            <select id="id_province" name="id_province" required>
              <option value="">Sélectionner</option>
              @foreach($provinces as $province)
                <option value="{{ $province->id_province }}" {{ $province->id_province == $sousProjet->id_province ? 'selected' : '' }}>
                  {{ $province->description_province_fr }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="id_commune">Commune <span class="required">*</span></label>
            <select id="id_commune" name="id_commune" required>
              <option value="">Sélectionner</option>
              @foreach($communes as $commune)
                <option value="{{ $commune->id_commune }}" {{ $commune->id_commune == $sousProjet->id_commune ? 'selected' : '' }}>
                  {{ $commune->nom_fr }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="secteur_concerne">Secteur concerné</label>
            <input type="text" id="secteur_concerne" name="secteur_concerne" value="{{ old('secteur_concerne', $sousProjet->secteur_concerne) }}">
          </div>
          <div class="form-group">
            <label for="site">Site</label>
            <input type="text" id="site" name="site" value="{{ old('site', $sousProjet->site) }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="statut">Statut</label>
            <input type="text" id="statut" name="statut" value="{{ old('statut', $sousProjet->statut) }}">
          </div>
          <div class="form-group">
            <label for="source_de_financement">Source de financement</label>
            <input type="text" id="source_de_financement" name="source_de_financement" value="{{ old('source_de_financement', $sousProjet->source_de_financement) }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="surface">Surface</label>
            <input type="text" id="surface" name="surface" value="{{ old('surface', $sousProjet->surface) }}">
          </div>
          <div class="form-group">
            <label for="lineaire">Linéaire</label>
            <input type="text" id="lineaire" name="lineaire" value="{{ old('lineaire', $sousProjet->lineaire) }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="beneficiaire">Bénéficiaire</label>
            <input type="text" id="beneficiaire" name="beneficiaire" value="{{ old('beneficiaire', $sousProjet->beneficiaire) }}">
          </div>
          <div class="form-group">
            <label for="estimation_initiale">Estimation initiale (MAD)</label>
            <input type="number" step="0.01" id="estimation_initiale" name="estimation_initiale" value="{{ old('estimation_initiale', $sousProjet->estimation_initiale) }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="avancement_physique">Avancement physique (%)</label>
            <input type="number" id="avancement_physique" name="avancement_physique" min="0" max="100" value="{{ old('avancement_physique', $sousProjet->avancement_physique) }}">
          </div>
          <div class="form-group">
            <label for="avancement_financier">Avancement financier (%)</label>
            <input type="number" id="avancement_financier" name="avancement_financier" min="0" max="100" value="{{ old('avancement_financier', $sousProjet->avancement_financier) }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires</label>
            <textarea id="commentaires" name="commentaires" rows="2">{{ old('commentaires', $sousProjet->commentaires) }}</textarea>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Mettre à jour le sous-projet</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
