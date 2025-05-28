@extends('layouts.nav')

@section('title', 'Détails du projet')

@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-content">
        <div class="form-header">
        </div>
      <div class="form-title">
        <h2>DÉTAILS DU</h2>
        <h1>Projet</h1>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Code Projet</label>
          <div>{{ $projet->code_du_projet }}</div>
        </div>
        <div class="form-group">
          <label>Nom Projet</label>
          <div>{{ $projet->nom_du_projet }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Programme</label>
          <div>{{ $projet->programme?->description_du_programme }}</div>
        </div>
        <div class="form-group">
          <label>Province</label>
          <div>{{ $projet->province?->description_province_fr }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Commune</label>
            <div>
              <ul>
                @if ($projet->commune->isNotEmpty())
                  @foreach ($projet->commune as $commune)
                      <li>{{ $commune->nom_fr }}</li>
                  @endforeach
                @elseif ($projet->sousProjetsCommunes->isNotEmpty())
                  @foreach ($projet->sousProjetsCommunes as $commune)
                      <li>{{ $commune->nom_fr }}</li>
                  @endforeach
                @else
                  {{"Aucune commune"}}
                @endif
                <ul>
            </div>
          
          
        </div>
        <div class="form-group">
          <label>Année Début</label>
          <div>{{ $projet->annee_debut }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Date Fin Prévue</label>
          <div>{{ $projet->annee_fin_prevue }}</div>
        </div>
        <div class="form-group">
          <label>Avancement Physique (%)</label>
          <div>{{ $projet->etat_d_avancement_physique }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Avancement Financier (%)</label>
          <div>{{ $projet->etat_d_avancement_financier }}</div>
        </div>
        <div class="form-group">
          <label>Coût Total (MAD)</label>
          <div>{{ $projet->cout_total_du_projet }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label>Coût CRO (MAD)</label>
          <div>{{ $projet->cout_cro }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label>Commentaires</label>
          <div>{{ $projet->commentaires }}</div>
        </div>
      </div>

      <div class="form-actions-top">
        <a href="{{ route('projet.index') }}" class="btn-return">Retour à la liste</a>
      </div>
    </div>
  </div>
</div>
@endsection
