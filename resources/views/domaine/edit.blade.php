@extends('layouts.nav')

@section('title', 'Modifier le domaine')

@section('content')

<div class="form-container">

  <div class="form-content">
    <div class="form-title">
        <div class="form-header">
        </div>
      <h2>MODIFIER</h2>
      <h1>Domaine</h1>
    </div>

    <form method="POST" action="{{ route('domaine.update', $domaine->id_domaine) }}">
      @csrf
      @method('PUT')
      <div class="form-row">
        <div class="form-group">
          <label for="code_du_domaine">Code Domaine <span class="required">*</span></label>
          <input type="number" id="code_du_domaine" name="code_du_domaine" value="{{ $domaine->code_du_domaine }}" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="description_fr">Description (Français)</label>
          <textarea id="description_fr" name="description_fr" class="styled-textarea">{{ $domaine->description_fr }}</textarea>
        </div>
        <div class="form-group">
          <label for="description_ar">Description (Arabe)</label>
          <textarea id="description_ar" name="description_ar" class="styled-textarea">{{ $domaine->description_ar }}</textarea>
        </div>
      </div>

      <div class="form-actions-top">
        <button class="btn-return" type="submit">Mettre à jour le domaine</button>
      </div>
    </form>
  </div>
</div>

@endsection
