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

        @if($errors->any())
          @foreach($errors->all() as $err)
            <div class="custom-alert error">
              {{$err}}
            </div>
          @endforeach
        @endif

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
        </div>

        <div class="form-row">

          @php
            if($projet->commune->isNotEmpty()){
              $disabled = false;
            }else if($projet->sousProjetsCommunes->isNotEmpty()){
              $disabled = true;
            }else{
              $disabled = false;
            }
          @endphp

          <div class="form-group">
            <label for="id_province">Province *</label>
            <select id="id_province" name="id_province" required {{ $disabled ? 'disabled': '' }}>
              <option value="">Sélectionner</option>
              @foreach ($provinces as $province)
                <option value="{{ $province->id_province }}" {{ $projet->id_province == $province->id_province ? 'selected' : '' }}>
                  {{ $province->description_province_fr }}
                </option>
              @endforeach
            </select>
          </div>

          
          <div class="form-group">
            <label for="id_commune">Commune *</label>
            <select id="id_commune" name="id_commune[]" {{ $disabled ? 'disabled': 'multiple' }}>
                @if ($disabled)
                    <option value="">Sélectionner</option>
                @endif

                @foreach($communes as $commune)
                    <option value="{{ $commune->id_commune }}" 
                        @if ($projet->commune->contains('id_commune', $commune->id_commune)) selected @endif
                    >
                        {{ $commune->nom_fr }}
                 </option>
                @endforeach

            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="annee_debut">Année Début *</label>
            <input type="number" id="annee_debut" name="annee_debut" min="2015" max="2045" value="{{ $projet->annee_debut }}" required>
          </div>

          <div class="form-group">
            <label for="annee_fin_prevue">Année Fin Prévue *</label>
            <input type="number" id="annee_fin_prevue" name="annee_fin_prevue" min="2015" max="2045" value="{{ $projet->annee_fin_prevue }}" required>
          </div>
        </div>

        @role("financier")
        <div class="form-row">

          <div class="form-group">
            <label for="etat_d_avancement_physique">Avancement Physique (%)</label>
            <input type="number" id="etat_d_avancement_physique" name="etat_d_avancement_physique" value="{{ $projet->etat_d_avancement_physique }}">
          </div>

          <div class="form-group">
            <label for="etat_d_avancement_financier">Avancement Financier (%)</label>
            <input type="number" id="etat_d_avancement_financier" name="etat_d_avancement_financier" value="{{ $projet->etat_d_avancement_financier }}">
          </div>

        </div>

        <div class="form-row">
          
          <div class="form-group">
            <label for="cout_total_du_projet">Coût Total (MAD)</label>
            <input type="number" step="0.01" id="cout_total_du_projet" name="cout_total_du_projet" value="{{ $projet->cout_total_du_projet }}">
          </div>

          <div class="form-group">
            <label for="cout_cro">Coût CRO (MAD)</label>
            <input type="number" step="0.01" id="cout_cro" name="cout_cro" value="{{ $projet->cout_cro }}">
          </div>

        </div>
        @endrole

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

<script>
    const isDisabled = {{ $disabled ? 'true' : 'false' }};

    function loadCommunes (provinceSelect, communeSelect) {
    const provinceId = provinceSelect.value;
    if (!provinceId) {
        // Disable commune select and reset options
        communeSelect.disabled = true;
        communeSelect.innerHTML = '';
        return;
    }

    communeSelect.innerHTML = '<option disabled>Chargement...</option>';

    fetch(`/communes/by-province/${provinceId}`)
        .then(response => response.json())
        .then(data => {
            communeSelect.innerHTML = ''; // clear previous options
            data.forEach(commune => {
                communeSelect.innerHTML += `<option value="${commune.id_commune}">${commune.nom_fr}</option>`;
            });
            communeSelect.disabled = false;
        });
}

    document.addEventListener('DOMContentLoaded', function () {
      if (isDisabled) return;

      const provinceSelect = document.getElementById('id_province');
      const communeSelect = document.getElementById('id_commune');
      communeSelect.innerHTML = '<option value="">Sélectionner</option>';

      provinceSelect.addEventListener('change', function(){
        loadCommunes(provinceSelect, communeSelect)
      });
      
      loadCommunes(provinceSelect, communeSelect)
      
    });
</script>