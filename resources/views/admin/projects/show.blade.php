@extends('layouts.app', ['title' => 'Détails d\'un projet'])
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Détails du projet "{{ $project->name }}"</h4>
        </div>
        <div class="card-body">
            <p><strong>Crée le</strong>: {{ $project->created_at->format('l j F H:i:s') }}</p>
            <p><strong>Reférence</strong>: {{ $project->reference }}</p>
            <p><strong>Nom</strong>: {{ $project->name }}</p>
            <p><strong>Description</strong>: {{ $project->description }}</p>
            <p><strong>Sponsor/MOA</strong>: {{ $project->sponsor }}</p>
            <p><strong>Initiative</strong>: {{ $project->initiative }}</p>
            <p><strong>AMOA</strong>: {{ $project->amoa }}</p>
            <p><strong>Chef de projet</strong>: {{ $project->manager }}</p>
            <p><strong>Statut</strong>: {{ $project->status }}</p>
            <p><strong>Date de début</strong>: {{ $project->start_date->format('d/m/Y') }}</p>
            <p><strong>Date de fin</strong>: {{ $project->end_date->format('d/m/Y') }}</p>
            <p><strong>Documentation du projet</strong>: {{ $project->documentation }}</p>
            <p><strong>Facture</strong>: {{ $project->bills }}</p>
            <p><strong>Gains/Impact</strong>: {{ $project->benefits }}</p>
        </div>
    </div>
</section>
@endsection