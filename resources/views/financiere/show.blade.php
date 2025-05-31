@extends('layouts.nav')

@section('title', 'Détails du suivi financier')

@section('content')
<div class="main-content">
  <div class="form-container">
    <div class="form-content">

      <div class="form-title">
        <h2>DÉTAILS DU</h2>
        <h1>Suivi Financier</h1>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Sous-projet</label>
          <div>{{ $sousProjet->nom_du_sous_projet ?? 'N/A' }}</div>
        </div>
        <div class="form-group">
          <label>Code Sous-projet</label>
          <div>{{ $sousProjet->code_du_sous_projet ?? 'N/A' }}</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Estimation Initiale (MAD)</label>
          <div>{{ number_format($sousProjet->estimation_initiale ?? 0, 2, ',', ' ') }}</div>
        </div>
        <div class="form-group">
          <label>Avancement Financier (%)</label>
          <div>{{ $sousProjet->avancement_financier ?? 0 }}%</div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label>Projet associé</label>
          <div>{{ $sousProjet->projet?->nom_du_projet ?? 'N/A' }}</div>
        </div>
      </div>

      <div class="form-actions-top">
        <a href="{{ route('couts.index') }}" class="btn-return">Retour à la liste</a></div>

        <!-- Bouton d'exportation -->
        <form method="GET" action="#" style="display:inline;">
        <div class="form-header">
     </form>
      </div>

    </div>
  </div>
</div>
@endsection
