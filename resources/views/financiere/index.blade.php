@extends('layouts.nav')

@section('title', 'Suivi des Coûts')

@section('styles')
<style>
/* Form container général */
.form-container {
    max-width: 1000px;
    margin: 20px auto;
    padding: 15px;
    font-family: Arial, sans-serif;
}

/* Form header et actions */
.form-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 10px;
}

.btn-return {
    background-color: #4caf50;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.btn-return:hover {
    background-color: #45a049;
}

/* Alertes succès / erreur */
.custom-alert {
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.custom-alert.success {
    background-color: #d4edda;
    color: #155724;
}

.custom-alert.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Titre */
.form-title h2 {
    margin: 0;
    color: #333;
}

.form-title h1 {
    margin: 5px 0 15px 0;
    color: #222;
}

/* Form filtre */
form[method="GET"] {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
    align-items: center;
}

form select {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.btn-action {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-action:hover {
    background-color: #45a049;
}

/* Table */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.styled-table thead tr {
    background-color: #333;
    color: white;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 10px 12px;
    border: 1px solid #ddd;
}

/* Progress bar simple et propre */
.progress {
    height: 20px;
    background-color: #eee;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
}

.progress-bar {
    background-color: #4d4d4a;
    height: 100%;
    line-height: 20px;
    color: rgb(41, 41, 39);
    text-align: center;
    font-weight: bold;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-flex;
    list-style: none;
    padding-left: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #333;
    text-decoration: none;
}

.pagination li.active span {
    background-color: #4caf50;
    color: white;
    border-color: #4caf50;
}

.pagination li.disabled span {
    color: #999;
    cursor: not-allowed;
}

/* Responsive - table scrollable sur petits écrans */
@media (max-width: 768px) {
    .styled-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}
</style>
@endsection

@section('content')
<div class="form-container">

    <div class="form-header">
        <div class="form-actions">
            <a href=" {{route('couts.create')}}" class="btn-return">Affecter une estimation </a>
        </div>
    </div>

    <div class="form-content">
        <div class="form-title">
            @if (session('success'))
                <div class="custom-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="custom-alert error">
                    {{ session('error') }}
                </div>
            @endif

            <h2>Suivi Financier</h2>
            <h1>Projets et Sous-Projets</h1>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Sous-Projet</th>
                    <th>Estimation</th>
                    <th>% Consommé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sousProjets as $sp)
                    @php
                        $estimation = floatval($sp->estimation_initiale ?? 0);
                        $avancementFinancier = floatval($sp->avancement_financier ?? 0);
                        $coutPaye = $estimation * ($avancementFinancier / 100);
                        $reste = $estimation - $coutPaye;
                    @endphp

                    <tr>
                        <td>{{ $sp->projet->nom_du_projet ?? 'N/A' }}</td>
                        <td>{{ $sp->nom_du_sous_projet }}</td>
                        <td>{{ number_format($estimation, 0, ',', ' ') }} DH</td>
<td>
    <div class="progress" style="width: 150px; height: 20px; background-color: #f3f3ec; border-radius: 10px; overflow: hidden;">
        <div class="progress-bar" role="progressbar" style="width: {{ $avancementFinancier }}%; background-color:  #ebc32e; height: 100%; color: white; text-align: center; font-weight: bold;">
            {{ $avancementFinancier }}%
        </div>
    </div>
</td>

                        <td>

                <a href="{{ route('couts.show', $sp->code_du_sous_projet) }}" class="btn-action btn-view" title="Afficher">
                    <i class="fas fa-eye"></i>
                </a>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex flex-column align-items-start mt-4">
            <div>
                {{ $sousProjets->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
    <div class="form-header">
    <div class="form-actions">
        <a href="#" class="btn-return">📁 Exporter en Excel</a>
    </div>
</div>

</div>
@endsection
