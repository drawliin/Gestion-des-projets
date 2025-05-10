@extends('layouts.nav')

@section('title', 'Modifier le programme')

@section('content')
<div class="form-container">
  <div class="form-content">
    <div class="form-header">
    </div>
    <div class="form-title">
      <h2>MODIFIER</h2>
      <h1>Programme</h1>
    </div>

    <form method="POST" action="{{ route('programme.update', $programme->id_programme) }}">
      @csrf
      @method('PUT')

      <h3>Détails du Programme</h3>

      <div class="form-row">
        <div class="form-group">
          <label for="code_du_programme">Code Programme <span class="required">*</span></label>
          <input type="number" id="code_du_programme" name="code_du_programme" value="{{ $programme->code_du_programme }}" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="description_du_programme">Description du Programme</label>
          <textarea id="description_du_programme" name="description_du_programme" class="styled-textarea">{{ $programme->description_du_programme }}</textarea>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label for="id_chantier">Chantier associé <span class="required">*</span></label>
          <div class="select-wrapper">
            <select id="id_chantier" name="id_chantier" required>
              <option value="">Sélectionner</option>
              @foreach ($chantiers as $chantier)
                <option value="{{ $chantier->id_chantier }}" {{ $programme->id_chantier == $chantier->id_chantier ? 'selected' : '' }}>
                  {{ $chantier->description_du_chantier ?? 'Chantier ' . $chantier->code_du_chantier }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="form-actions-top">
        <button class="btn-return" type="submit">Mettre à jour le programme</button>
      </div>
    </form>
  </div>
</div>
@endsection
