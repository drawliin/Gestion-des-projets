@extends('layouts.nav')

@section('title', 'Modifier une commune')

@section('content')
<div class="form-container">
    <div class="form-header">
        
    </div>

    <div class="form-content">
        <div class="form-title">
            <h2>MODIFIER LA</h2>
            <h1>Commune</h1>
        </div>

        <form method="POST" action="{{ route('commune.update', $commune->id_commune) }}">
            @csrf
            @method('PUT')
            <h3>Détails de la Commune</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="code_commune">Code Commune <span class="required">*</span></label>
                    <input type="text" id="code_commune" name="code_commune" value="{{ $commune->code_commune }}" required>
                </div>

                <div class="form-group">
                    <label for="nom_fr">Nom (Français) <span class="required">*</span></label>
                    <input type="text" id="nom_fr" name="nom_fr" value="{{ $commune->nom_fr }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="nom_ar">Nom (Arabe) <span class="required">*</span></label>
                    <input type="text" id="nom_ar" name="nom_ar" value="{{ $commune->nom_ar }}" required>
                </div>
            </div>

            <div class="form-actions-top">
                <button class="btn-return" type="submit">Mettre à jour la commune</button>
            </div>
        </form>
    </div>
</div>
@endsection
