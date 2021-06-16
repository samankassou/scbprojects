@extends('layouts.app', ['title' => 'Détails d\'une procédure'])
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Détails de la procédure "{{ $process->name }}"</h4>
        </div>
        <div class="card-body">
            <p><strong>Domaine: </strong>{{ $process->method->macroprocess->domain->name }}</p>
            <p><strong>Macroprocessus: </strong>{{ $process->method->macroprocess->name }}</p>
            <p><strong>Processus: </strong>{{ $process->method->name }}</p>
            <p><strong>Type: </strong>{{ $process->type }}</p>
            <p><strong>Reférence: </strong>{{ $process->reference }}</p>
            <p><strong>No. version: </strong>{{ $process->version }}</p>
            <p><strong>Intitulé: </strong>{{ $process->name }}</p>
            <p><strong>Statut: </strong>{{ $process->status }}</p>
            <p><strong>Date de création: </strong>{{ $process->creation_date->format('d/m/Y') }}, <strong>par:
                </strong>{{ $process->created_by }}</p>
            @if ($process->writing_date)
            <p><strong>Date de rédaction: </strong>{{ $process->writing_date->format('d/m/Y') }}, <strong>par:
                </strong>{{ $process->written_by }}</p>
            @endif
            @if ($process->verification_date)
            <p><strong>Date de validation: </strong>{{ $process->verification_date->format('d/m/Y') }}, <strong>par:
                </strong>{{ $process->verified_by }}</p>
            @endif
            @if ($process->date_of_approval)
            <p><strong>Date d'approbation: </strong>{{ $process->date_of_approval->format('d/m/Y') }}, <strong>par:
                </strong>{{ $process->approved_by }}</p>
            @endif
            <p><strong>Pôle(s): </strong>{{ implode(', ', $poles->pluck('name')->toArray()) }}</p>
            <p><strong>Entité(s) impactée(s): </strong>{{ implode(', ', $process->entities->pluck('name')->toArray()) }}
            </p>
            <p><strong>Etat: </strong>{{ $process->state }}</p>
            @if ($process->reasons_for_creation)
            <p><strong>Motif de la création: </strong>{{ $process->reasons_for_creation }}</p>
            @endif
            @if ($process->reasons_for_modification)
            <p><strong>Motif de la modification: </strong>{{ $process->reasons_for_modification }}</p>
            @endif
            @if ($process->modifications)
            <p><strong>Modification(s) apportée(s): </strong>{{ $process->modifications }}</p>
            @endif
            <p><strong>Annexes: </strong>{{ $process->appendices }}</p>
        </div>
    </div>
</section>
@endsection