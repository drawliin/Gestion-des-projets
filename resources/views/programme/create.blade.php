@extends('layouts.nav')

@section('title', 'Créer un nouveau projet')

@section('content')
<div class="form-container">
    <div class="form-content">
        <div class="form-header">
        </div>
      <div class="form-title">
        <h2>CRÉER UN NOUVEAU</h2>
        <h1>Programme</h1>
      </div>
      <form method="POST" action=" {{route('programme.store')}}">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label for="code_du_programme">Code Programme <span class="required">*</span></label>
            <input type="number" id="code_du_programme" name="code_du_programme" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="description_du_programme">Description du Programme</label>
            <textarea id="description_du_programme" name="description_du_programme" class="styled-textarea"></textarea>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group full-width">
            <label for="id_chantier">Chantier associé <span class="required">*</span></label>
            <div class="select-wrapper">
                <select id="id_chantier" name="id_chantier" required>
                    <option value="">Sélectionner</option>
                    @foreach ($chantiers as $chantier)
                        <option value="{{ $chantier->id_chantier }}">
                            {{ $chantier->description_du_chantier ?? 'Chantier ' . $chantier->code_du_chantier }}
                        </option>
                    @endforeach
                </select>
            </div>
          </div>
        </div>

        <div class="form-actions-top">
          <button class="btn-return" type="submit">Enregistrer le programme</button>
        </div>
      </form>
    </div>
  </div>
  @endsection
