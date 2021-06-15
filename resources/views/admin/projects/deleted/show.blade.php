@extends('layouts.app', ['title' => 'Détails d\'un projet'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/toastify/toastify.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Détails du projet "{{ $project->name }}"</h4>
            <div>
                <button class="btn btn-sm btn-info" onclick="restoreProject({{ $project->id }})" title="Restaurer"><i class="bi bi-cloud-upload"></i></button>
                <button class="btn btn-sm btn-danger" onclick="showDeleteProjectModal({{ $project->id }})" title="Supprimer"><i class="bi bi-trash"></i></button>
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
{{-- Delete project modal --}}
<div class="modal-danger me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="delete-project-modal" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="delete-project-form" class="modal-content">
                <div class="modal-header bg-danger">
                    <input type="hidden" id="projectId">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Supprimer un projet
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer?</p>
                    <p><em>Ce projet va être supprimé définitivement!</em></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Annuler</span>
                    </button>
                    <button id="delete-project-btn" type="button" class="btn btn-danger ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">supprimer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--! Delete project modal --}}
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('mazer/assets/vendors/toastify/toastify.js') }}"></script>
    <script>
    $(function(){
        token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $('#delete-project-btn').on('click', deleteProject);
    });
    function showDeleteProjectModal(id)
    {
        $('#projectId').val(id);
        $('#delete-project-modal').modal('show');
    }

    function deleteProject()
    {
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Suppression...')
        .attr('disabled', true);
        let id = $('#projectId').val();
        $.ajax({
            url: "/admin/projects/delete/"+id,
            method: "POST",
            success: (response)=>{                
                Toastify({
                    text: "Projet supprimée avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                
            },
            error: (response)=>{
                console.log(response);
            },
            complete: ()=>{
                $('#delete-project-btn').removeClass('disabled').text('Supprimer').attr('disabled', false);
                $('#delete-project-modal').modal('hide');
                window.location = "/admin/projecsts/deleted";
            }
        });
        return false;
    }

    function restoreProject(id)
    {
        $.ajax({
            url: "/admin/projects/restore/"+id,
            method: "POST",
            success: (response)=>{                
                Toastify({
                    text: "Projet restauré avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                
            },
            error: (response)=>{
                console.log(response);
            },
            complete: function(){
                window.location = "/admin/projects/deleted"
            }
        });
        return false;
    }
    </script>
@endsection