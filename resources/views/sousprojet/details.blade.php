@extends('layouts.nav')

@section('title', 'Détails du sous-projet')

@section('content')
<div class="main-content">
    <div class="form-container">
        <div class="form-header">
            <div class="form-actions">
                <a href="{{ route('sousprojet.index') }}" class="btn-return">← Retour à la liste</a>
            </div>
        </div>
        <div class="form-content">
            <div class="form-title">
                <h2>DÉTAILS DU</h2>
                <h1>Sous-projet</h1>
            </div>

            <div class="form-row">
                <label class="form-label">Code :</label>
                <div class="form-value">{{ $sousProjet->code_du_sous_projet }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Nom :</label>
                <div class="form-value">{{ $sousProjet->nom_du_sous_projet }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Projet associé :</label>
                <div class="form-value">{{ $sousProjet->projet->nom_du_projet ?? '' }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Province :</label>
                <div class="form-value">{{ $sousProjet->province->description_province_fr ?? '' }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Commune :</label>
                <div class="form-value">{{ $sousProjet->commune->nom_fr ?? '' }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Secteur concerné :</label>
                <div class="form-value">{{ $sousProjet->secteur_concerne }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Site :</label>
                <div class="form-value">{{ $sousProjet->site }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Source de financement :</label>
                <div class="form-value">{{ $sousProjet->source_de_financement }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Bénéficiaire :</label>
                <div class="form-value">{{ $sousProjet->beneficiaire }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Estimation initiale :</label>
                <div class="form-value">{{ $sousProjet->estimation_initiale }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Avancement physique :</label>
                <div class="form-value">{{ $sousProjet->avancement_physique }}</div>
            </div>

            <div class="form-row">
                <label class="form-label">Avancement financier :</label>
                <div class="form-value">{{ $sousProjet->avancement_financier }}</div>
            </div>

            {{-- Champs optionnels s'ils existent --}}
            @if ($sousProjet->centre)
            <div class="form-row">
                <label class="form-label">Centre :</label>
                <div class="form-value">{{ $sousProjet->centre }}</div>
            </div>
            @endif

            @if ($sousProjet->surface)
            <div class="form-row">
                <label class="form-label">Surface :</label>
                <div class="form-value">{{ $sousProjet->surface }}</div>
            </div>
            @endif

            @if ($sousProjet->statut)
            <div class="form-row">
                <label class="form-label">Statut :</label>
                <div class="form-value">{{ $sousProjet->statut }}</div>
            </div>
            @endif

            @if ($sousProjet->lineaire)
            <div class="form-row">
                <label class="form-label">Linéaire :</label>
                <div class="form-value">{{ $sousProjet->lineaire }}</div>
            </div>
            @endif

            @if ($sousProjet->douars_desservis)
            <div class="form-row">
                <label class="form-label">Douars desservis :</label>
                <div class="form-value">{{ $sousProjet->douars_desservis }}</div>
            </div>
            @endif

            @if ($sousProjet->nature_de_l_intervention)
            <div class="form-row">
                <label class="form-label">Nature de l'intervention :</label>
                <div class="form-value">{{ $sousProjet->nature_de_l_intervention }}</div>
            </div>
            @endif

            @if ($sousProjet->commentaires)
            <div class="form-row">
                <label class="form-label">Commentaires :</label>
                <div class="form-value">{{ $sousProjet->commentaires }}</div>
            </div>
            @endif

            @if ($sousProjet->localite)
            <div class="form-row">
                <label class="form-label">Localité :</label>
                <div class="form-value">{{ $sousProjet->localite }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
