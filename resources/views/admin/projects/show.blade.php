@extends('layouts.app', ['title' => 'Détails d\'un projet'])
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Détails du projet "{{ $project->name }}"</h4>
            <div>
                <a href="{{ route('projects.pdf', $project->reference) }}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-printer"></i>
                    <span>Imprimer</span>
                </a>
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-pencil"></i>
                    <span>Editer</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="w-50">
                <h5>Progression: </h5><br>
                <div class="progress progress-primary  mb-4">
                    <div class="progress-bar progress-bar-striped progress-label" role="progressbar" style="width: {{ $project->progress }}%"
                        aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <p><strong>Crée le</strong>: {{ $project->created_at->format('d/m/Y à H:i:s') }}</p>
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
            @if ($project->steps->count())
            <div>
                <h4>Etape(s) Réalisée(s)</h4>
                @foreach ($project->steps as $step)
                <ul>
                    <li>{{ $step->name }}</li>
                </ul>
                @endforeach
            </div>
            @endif
            @if ($project->modifications->count())
            <div>
                <h4>Historique des modifications</h4>
                @foreach ($project->modifications as $modification)
                <p>
                    le {{ $modification->created_at->format('d/m/Y') }} à  {{ $modification->created_at->format('H:i:s') }}
                    par <strong>{{ $modification->author->name }}</strong>
                </p>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endsection