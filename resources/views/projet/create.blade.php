@extends('layouts.nav')

@section('title', 'Créer un nouveau projet')

@section('content')

<!-- Main Content -->
<div class="main-content">
  <div class="form-container">
    <div class="form-header">
    </div>
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

        <h2>CRÉER UN NOUVEAU</h2>
        <h1>Projet</h1>
      </div>
      <form id="projectForm" method="POST" action="{{ route('projet.store') }}">
        @csrf
        <h3>Détails du Projet</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="code_du_projet">Code Projet <span class="required">*</span></label>
            <input type="text" id="code_du_projet" name="code_du_projet" required>
          </div>
          <div class="form-group">
            <label for="nom_du_projet">Nom Projet <span class="required">*</span></label>
            <input type="text" id="nom_du_projet" name="nom_du_projet" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_programme">Programme <span class="required">*</span></label>
            <div class="select-wrapper">
              <select id="id_programme" name="id_programme" required>
                <option value="">Sélectionner</option>
                @foreach ($programmes as $programme)
                  <option value="{{ $programme->id_programme }}">{{ $programme->description_du_programme }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="id_province">Province <span class="required">*</span></label>
            <div class="select-wrapper">
              <select id="id_province" name="id_province" required>
                <option value="">Sélectionner</option>
                @foreach($provinces as $province)
                  <option value="{{ $province->id_province }}">
                    {{ $province->description_province_fr }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="id_commune">Commune <span class="required">*</span></label>
                <div class="select-wrapper">
                    <select id="id_commune" name="id_commune" required>
                        <option value="">Sélectionner</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune->id_commune }}"> {{ $commune->nom_fr }}
                         </option>
                        @endforeach

                      </select>
                </div>
              </div>
          <div class="form-group">
            <label for="date_debut">Date Début <span class="required">*</span></label>
            <input type="date" id="date_debut" name="date_debut" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="date_fin_prevue">Date Fin Prévue <span class="required">*</span></label>
            <input type="date" id="date_fin_prevue" name="date_fin_prevue" required>
          </div>
          <div class="form-group">
            <label for="etat_d_avancement_physique">Avancement Physique (%) <span class="required">*</span></label>
            <input type="number" id="etat_d_avancement_physique" name="etat_d_avancement_physique" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="etat_d_avancement_financier">Avancement Financier (%) <span class="required">*</span></label>
            <input type="number" id="etat_d_avancement_financier" name="etat_d_avancement_financier" required>
          </div>
          <div class="form-group">
            <label for="cout_total_du_projet">Coût Total (MAD) <span class="required">*</span></label>
            <input type="number" id="cout_total_du_projet" name="cout_total_du_projet" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="cout_cro">Coût CRO (MAD) <span class="required">*</span></label>
            <input type="number" id="cout_cro" name="cout_cro" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires <span class="required">*</span></label>
            <textarea id="commentaires" name="commentaires" required></textarea>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Créer le projet</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
