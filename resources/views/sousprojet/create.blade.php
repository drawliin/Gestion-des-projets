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

      @if ($errors->any())
        <div class="alert-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      
      <form method="POST" action="{{ route('sousprojet.store') }}">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label for="id_projet">Projet parent <span class="required">*</span></label>
            <select id="id_projet" name="id_projet" required>
              <option value="">Sélectionner</option>
              @foreach($projets as $projet)
                @if($projet->commune->isEmpty())
                  <option value="{{ $projet->id_projet }}">{{ $projet->nom_du_projet }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="code_du_sous_projet">Code <span class="required">*</span></label>
            <input type="text" id="code_du_sous_projet" name="code_du_sous_projet" value='{{old("code_du_sous_projet")}}' required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="nom_du_sous_projet">Nom du sous-projet <span class="required">*</span></label>
            <input type="text" id="nom_du_sous_projet" name="nom_du_sous_projet" value='{{old("nom_du_sous_projet")}}' required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_province">Province <span class="required">*</span></label>
            <select id="id_province" name="id_province" disabled required>
              <option value="">Sélectionner</option>
              @foreach($provinces as $province)
                <option value="{{ $province->id_province }}">{{ $province->description_province_fr }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="id_commune">Commune <span class="required">*</span></label>
            <select id="id_commune" name="id_commune" disabled  required>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="secteur_concerne">Secteur concerné<span class="required">*</span></label>
            <input type="text" id="secteur_concerne" name="secteur_concerne" value='{{old("secteur_concerne")}}'>
          </div>
          <div class="form-group">
            <label for="site">Site<span class="required">*</span></label>
            <input type="text" id="site" name="site" value='{{old("site")}}'>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="statut">Statut</label>
            <input type="text" id="statut" name="statut" value='{{old("statut")}}'>
          </div>
          <div class="form-group">
            <label for="source_de_financement">Source de financement<span class="required">*</span></label>
            <input type="text" id="source_de_financement" name="source_de_financement" value='{{old("source_de_financement")}}'>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="surface">Surface</label>
            <input type="text" id="surface" name="surface" value='{{old("surface")}}'>
          </div>
          <div class="form-group">
            <label for="lineaire">Linéaire</label>
            <input type="text" id="lineaire" name="lineaire" value='{{old("lineaire")}}'>
          </div>
        </div>

        <div class="form-row">

          <div class="form-group">
            <label for="beneficiaire">Bénéficiaire<span class="required">*</span></label>
            <input type="text" id="beneficiaire" name="beneficiaire" value='{{old("beneficiaire")}}'>
          </div>

          <div class="form-group">
            <label for="avancement_physique">Avancement physique (%)</label>
            <input type="number" id="avancement_physique" name="avancement_physique" min="0" max="100" value='{{old("avancement_physique")}}'>
          </div>
         
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="commentaires">Commentaires</label>
            <textarea id="commentaires" name="commentaires" rows="2">{{old("commentaires")}}</textarea>
          </div>
        </div>

        <div class="form-actions-top">
            <button class="btn-return" type="submit">Créer le sous-projet</button>
          </div>
        </div>
  </div>
</form>
@endsection

<script>
function loadCommunesByProvince(provinceId, communeSelect) {
    if (!provinceId) {
        communeSelect.disabled = true;
        return;
    }

    communeSelect.innerHTML = '<option disabled>Chargement communes...</option>';
    
    fetch(`/communes/by-province/${provinceId}`)
        .then(response => response.json())
        .then(data => {
            communeSelect.innerHTML = '<option value="">Sélectionner une commune</option>';
            data.forEach(commune => {
                communeSelect.innerHTML += `<option value="${commune.id_commune}">${commune.nom_fr}</option>`;
            });
            communeSelect.disabled = false;
        })
        .catch(error => console.error('Erreur chargement communes:', error));
}

function loadProvinceAndCommunesByProjet(projetId, provinceSelect, communeSelect) {
    if (!projetId) {
        provinceSelect.disabled = true;
        provinceSelect.innerHTML = '';
        communeSelect.disabled = true;
        communeSelect.innerHTML = '';
        return;
    }

    provinceSelect.disabled = true;
    communeSelect.disabled = true;
    communeSelect.innerHTML = '<option disabled>Chargement communes...</option>';

    fetch(`/sous-projets/by-projet/${projetId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.id_province) {
                throw new Error('Province non trouvée');
            }

            provinceSelect.innerHTML = `<option value="${data.id_province}">${data.description_province_fr}</option>`;
            provinceSelect.disabled = false;


            loadCommunesByProvince(data.id_province, communeSelect);
        })
        .catch(error => {
            console.error('Erreur chargement projet/province:', error);
            communeSelect.innerHTML = '<option value="">Erreur chargement</option>';
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const projetSelect = document.getElementById('id_projet');
    const provinceSelect = document.getElementById('id_province');
    const communeSelect = document.getElementById('id_commune');

    projetSelect.addEventListener('change', function () {
        loadProvinceAndCommunesByProjet(projetSelect.value, provinceSelect, communeSelect);
    });

    provinceSelect.addEventListener('change', function () {
        loadCommunesByProvince(provinceSelect.value, communeSelect);
    });
});
</script>
