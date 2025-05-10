@extends('layouts.nav')

@section('title', 'Créer une nouvelle province')

@section('content')
<div class="form-container">

    <div class="form-content">
      <div class="form-title">
        <h2>CRÉER UNE NOUVELLE</h2>
        <h1>Province</h1>
      </div>

      <form method="POST" action="{{route('province.store')}}">
        @csrf
        <h3>Créer une Province</h3>

        <div class="form-row">
          <div class="form-group">
            <label for="code_province">Code Province <span class="required">*</span></label>
            <input type="text" id="code_province" name="code_province" required>
          </div>
        </div>

        <div class="form-row">
            <div class="form-group">
              <label for="description_province_fr">Description (Français)</label>
              <textarea id="description_province_fr" name="description_province_fr" class="styled-textarea"></textarea>
            </div>
            <div class="form-group">
              <label for="description_province_ar">Description (Arabe)</label>
              <textarea id="description_province_ar" name="description_province_ar" class="styled-textarea"></textarea>
            </div>
          </div>


        <div class="form-actions-top">
          <button class="btn-return" type="submit">Enregistrer la province</button>
        </div>
      </form>
    </div>
  </div>
@endsection
