@extends('layouts.nav')

@section('title', 'Modifier Coût')

@section('content')
<div class="form-container">
    <div class="form-header">
        <a href="{{ route('couts.index') }}" class="btn-return">← Retour</a>
    </div>

    <div class="form-title">
        <h2>Modification</h2>
        <h1>{{ $sousProjet->nom_du_sous_projet }} ({{ $sousProjet->projet->nom_du_projet }})</h1>
    </div>

    @if ($errors->any())
        <div class="custom-alert error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('couts.update', $sousProjet->code_du_sous_projet) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <label>Estimation initiale (DH)</label>
            <input type="number" name="estimation_initiale" value="{{ old('estimation_initiale', $sousProjet->estimation_initiale) }}" step="0.01" required>
        </div>

        <div class="form-row">
            <label>Avancement financier (%)</label>
            <input type="number" name="avancement_financier" value="{{ old('avancement_financier', $sousProjet->avancement_financier) }}" step="0.01" required>
        </div>

        <div class="form-row">
            <button type="submit" class="btn-action btn-edit">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
