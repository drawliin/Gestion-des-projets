@extends('layouts.nav')

@section('title', 'Modifier le projet')

@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-content">
        <div class="form-header">
        </div>
      <div class="form-title">
        <h2>MODIFIER LE</h2>
        <h1>Projet</h1>
      </div>

      <form method="POST" action="{{ route('projet.update', $projet->id_projet) }}">
        @csrf
        @method('PUT')

        <h3>Détails du Projet</h3>

        <div class="form-row">
          <div class="form-group">
            <label for="code_du_projet">Code Projet *</label>
            <input type="text" id="code_du_projet" name="code_du_projet" value="{{ $projet->code_du_projet }}" required>
          </div>
          <div class="form-group">
            <label for="nom_du_projet">Nom Projet *</label>
            <input type="text" id="nom_du_projet" name="nom_du_projet" value="{{ $projet->nom_du_projet }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_programme">Programme *</label>
            <select id="id_programme" name="id_programme" required>
              <option value="">Sélectionner</option>
              @foreach ($programmes as $programme)
                <option value="{{ $programme->id_programme }}" {{ $projet->id_programme == $programme->id_programme ? 'selected' : '' }}>
                  {{ $programme->description_du_programme }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="id_province">Province *</label>
            <select id="id_province" name="id_province" required>
              <option value="">Sélectionner</option>
              @foreach ($provinces as $province)
                <option value="{{ $province->id_province }}" {{ $projet->id_province == $province->id_province ? 'selected' : '' }}>
                  {{ $province->description_province_fr }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_commune">Commune *</label>
            <select id="id_commune" name="id_commune" required>
                <option value="">Sélectionner</option>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id_commune }}" {{ $projet->id_commune == $commune->id_commune ? 'selected' : '' }}>
                        {{ $commune->nom_fr }}
                 </option>
                @endforeach

              </select>
          </div>
          <div class="form-group">
            <label for="date_debut">Date Début *</label>
            <input type="date" id="date_debut" name="date_debut" value="{{ $projet->date_debut }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="date_fin_prevue">Date Fin Prévue *</label>
            <input type="date" id="date_fin_prevue" name="date_fin_prevue" value="{{ $projet->date_fin_prevue }}" required>
          </div>
          <div class="form-group">
            <label for="etat_d_avancement_physique">Avancement Physique (%)</label>
            <input type="number" id="etat_d_avancement_physique" name="etat_d_avancement_physique" value="{{ $projet->etat_d_avancement_physique }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="etat_d_avancement_financier">Avancement Financier (%)</label>
            <input type="number" id="etat_d_avancement_financier" name="etat_d_avancement_financier" value="{{ $projet->etat_d_avancement_financier }}">
          </div>
          <div class="form-group">
            <label for="cout_total_du_projet">Coût Total (MAD)</label>
            <input type="number" step="0.01" id="cout_total_du_projet" name="cout_total_du_projet" value="{{ $projet->cout_total_du_projet }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="cout_cro">Coût CRO (MAD)</label>
            <input type="number" step="0.01" id="cout_cro" name="cout_cro" value="{{ $projet->cout_cro }}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires</label>
            <textarea id="commentaires" name="commentaires">{{ $projet->commentaires }}</textarea>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Mettre à jour le projet</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
