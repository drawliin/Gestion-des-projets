@extends('layouts.nav')

@section('title', 'Modifier une province')

@section('content')
<div class="form-container">
    <div class="form-header">
      <div class="form-actions">
        <a href="{{ route('province.index') }}" class="btn-icon" title="Retour à la liste">
            <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>

    <div class="form-content">
      <div class="form-title">
        <h2>MODIFIER</h2>
        <h1>Province</h1>
      </div>

      <form method="POST" action="{{ route('province.update', $province->id_province) }}">
        @csrf
        @method('PUT')
        <h3>Détails de la Province</h3>

        <div class="form-row">
          <div class="form-group">
            <label for="code_province">Code Province <span class="required">*</span></label>
            <input type="text" id="code_province" name="code_province" value="{{ $province->code_province }}" required>
          </div>
        </div>

        <div class="form-row">
            <div class="form-group">
              <label for="description_province_fr">Description (Français)</label>
              <textarea id="description_province_fr" name="description_province_fr" class="styled-textarea">{{ $province->description_province_fr }}</textarea>
            </div>
            <div class="form-group">
              <label for="description_province_ar">Description (Arabe)</label>
              <textarea id="description_province_ar" name="description_province_ar" class="styled-textarea">{{ $province->description_province_ar }}</textarea>
            </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Mettre à jour la province</button>
        </div>
      </form>
    </div>
</div>
@endsection
