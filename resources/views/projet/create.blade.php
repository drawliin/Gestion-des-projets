@extends('layouts.nav')

@section('title', 'Créer un nouveau projet')

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

          <h2>CRÉER UN NOUVEAU</h2>
          <h1>Projet</h1>
      </div>

      <form id="projectForm" method="POST" action="{{ route('projet.store') }}">
        @csrf
        <h3>Détails du Projet</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="code_du_projet">Code Projet <span class="required">*</span></label>
            <input type="text" id="code_du_projet" name="code_du_projet" value="{{old("code_du_projet")}}" required>
          </div>
          <div class="form-group">
            <label for="nom_du_projet">Nom Projet <span class="required">*</span></label>
            <input type="text" id="nom_du_projet" name="nom_du_projet" value="{{old("nom_du_projet")}}" required>
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
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_province">Province<span class="required">*</span></label>
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

          <div class="form-group">
              <label for="id_commune">Commune</label>
              <div class="select-wrapper">
                  <select id="id_commune" name="id_commune[]" multiple>
                  </select>
              </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="annee_debut">Année Début <span class="required">*</span></label>
            <input type="number" min="2015" max="2045" id="annee_debut" name="annee_debut" value="{{old("annee_debut")}}" required>
          </div>

          <div class="form-group">
            <label for="annee_fin_prevue">Année Fin Prévue <span class="required">*</span></label>
            <input type="number" min="2015" max="2045" id="annee_fin_prevue" name="annee_fin_prevue" value="{{old("annee_fin_prevue")}}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="etat_d_avancement_physique">Avancement Physique (%) <span class="required">*</span></label>
            <input type="number" id="etat_d_avancement_physique" name="etat_d_avancement_physique" value="{{old("etat_d_avancement_physique")}}" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires <span class="required">*</span></label>
            <textarea id="commentaires" name="commentaires">{{old("commentaires")}}</textarea>
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

<script>
    function loadCommunes (provinceSelect, communeSelect) {
    const provinceId = provinceSelect.value;
    if (!provinceId) {
      
        communeSelect.disabled = true;
        communeSelect.innerHTML = '';
        return;
    }

    communeSelect.innerHTML = '<option disabled>Chargement...</option>';

    fetch(`/communes/by-province/${provinceId}`)
        .then(response => response.json())
        .then(data => {
            communeSelect.innerHTML = ''; 
            data.forEach(commune => {
                communeSelect.innerHTML += `<option value="${commune.id_commune}">${commune.nom_fr}</option>`;
            });
            communeSelect.disabled = false;
        });
}

    document.addEventListener('DOMContentLoaded', function () {
      const provinceSelect = document.getElementById('id_province');
      const communeSelect = document.getElementById('id_commune');
      communeSelect.innerHTML = '<option value="">Sélectionner</option>';

      provinceSelect.addEventListener('change', function(){
        loadCommunes(provinceSelect, communeSelect)
      });
      
      loadCommunes(provinceSelect, communeSelect)
      
    });
</script>