@extends('layouts.app', ['title' => 'Détails d\'une procédure'])
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Détails de la procédure "{{ $process->last_version->name }}"</h4>
        </div>
        <div class="card-body">
            <p><strong>Domaine: </strong>{{ $process->method->macroprocess->domain->name }}</p>
            <p><strong>Macroprocessus: </strong>{{ $process->method->macroprocess->name }}</p>
            <p><strong>Processus: </strong>{{ $process->method->name }}</p>
            <p><strong>Type: </strong>{{ $process->last_version->type }}</p>
            <p><strong>Reférence: </strong>{{ $process->reference }}</p>
            <p><strong>No. version: </strong>{{ $process->last_version->version }}</p>
            <p><strong>Intitulé: </strong>{{ $process->last_version->name }}</p>
            <p><strong>Statut: </strong>{{ $process->last_version->status }}</p>
            <p><strong>Date de création: </strong>{{ $process->last_version->creation_date->format('d/m/Y') }},
                <strong>par:
                </strong>{{ $process->last_version->created_by }}</p>
            @if ($process->last_version->writing_date)
            <p><strong>Date de rédaction: </strong>{{ $process->last_version->writing_date->format('d/m/Y') }},
                <strong>par:
                </strong>{{ $process->last_version->written_by }}</p>
            @endif
            @if ($process->last_version->verification_date)
            <p><strong>Date de validation: </strong>{{ $process->last_version->verification_date->format('d/m/Y') }},
                <strong>par:
                </strong>{{ $process->last_version->verified_by }}</p>
            @endif
            @if ($process->last_version->date_of_approval)
            <p><strong>Date d'approbation: </strong>{{ $process->last_version->date_of_approval->format('d/m/Y') }},
                <strong>par:
                </strong>{{ $process->last_version->approved_by }}</p>
            @endif
            <p><strong>Pôle(s): </strong>{{ implode(', ', $poles->pluck('name')->toArray()) }}</p>
            <p><strong>Entité(s) impactée(s):
                </strong>{{ implode(', ', $process->last_version->entities->pluck('name')->toArray()) }}
            </p>
            <p><strong>Etat: </strong>{{ $process->last_version->state }}</p>
            @if ($process->last_version->reasons_for_creation)
            <p><strong>Motif de la création: </strong>{{ $process->last_version->reasons_for_creation }}</p>
            @endif
            @if ($process->last_version->reasons_for_modification)
            <p><strong>Motif de la modification: </strong>{{ $process->last_version->reasons_for_modification }}</p>
            @endif
            @if ($process->last_version->modifications)
            <p><strong>Modification(s) apportée(s): </strong>{{ $process->last_version->modifications }}</p>
            @endif
            <p><strong>Annexes: </strong>{{ $process->last_version->appendices }}</p>
        </div>
    </div>
</section>
@endsection