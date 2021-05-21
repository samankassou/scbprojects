@extends('layouts.datatable', ['title' => 'Projets'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Filtrer par:</h5>
            <select name="" id="" class="form-select w-25">
                <option value=""></option>
                <option value="">Reférence</option>
                <option value="">AMOA</option>
                <option value="">Sponsor/MOA</option>
                <option value="">Statut</option>
                <option value="">Nature</option>
                <option value="">Année début</option>
            </select>
            <div class="d-none flex-wrap">
                <div class="p-2">
                    <label for="reference">Reférence:</label> <input class="form-control" id="reference" type="text" placeholder="Entrez une reférence...">
                </div>
                <div class="p-2">
                    <label for="amoa">AMOA:</label> <input class="form-control" id="amoa" type="text" placeholder="Rechercher...">
                </div>
                <div class="p-2">
                    <label for="sponsor">Sponsor/MOA:</label> <input class="form-control" id="sponsor" type="text" placeholder="Rechercher...">
                </div>
                <div class="p-2">
                    <label for="year">Année début:</label> 
                    <select id="year" class="form-select">
                        <option value="">Toutes</option>
                        <option value="1">2019</option>
                        <option value="2">2020</option>
                    </select>
                </div>
                <div class="p-2">
                    <label for="status">Statut:</label> 
                    <select id="status" class="form-select">
                        <option value="">Tous</option>
                        <option value="1">En cours</option>
                        <option value="2">En stand-by</option>
                        <option value="3">inachevé</option>
                        <option value="4">Terminé</option>
                    </select>
                </div>
                <div class="px-4 py-2">
                    <label>Nature:</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="" id="">
                        <label class="form-check-label" for="">Reglémentaire</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="" id="">
                        <label class="form-check-label" for="">Business</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="" id="">
                        <label class="form-check-label" for="">Gain de productivité</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="" id="">
                        <label class="form-check-label" for="">Optimisation d'un process</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="" id="">
                        <label class="form-check-label" for="">Réduction d'un risque</label>
                    </div>
                </div>
            </div>
            <div class="card-header d-flex justify-content-between">
                <h2>Liste des projets({{ count($projects) }})</h2>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <button class="btn btn-success m-2">Imprimer</button>
                    <button class="btn btn-success m-2">Exporter(Excel)</button>
                </div>
                <div>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-success"><i class="bi bi-plus"></i> Créer</a>
                </div>
            </div>
            <table class="table table-striped" id="projects-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Nom</th>
                        <th>AMOA</th>
                        <th>Sponsor/MOA</th>
                        <th>Statut</th>
                        <th>Année</th>
                        <th>Nature</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td></td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->amoa }}</td>
                            <td>{{ $project->sponsor }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->start_date->year }}</td>
                            <td>
                                @foreach ($project->natures as $nature)
                                    @if (!$loop->last)
                                    {{ $nature->name }},
                                    @else
                                    {{ $nature->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class='btn btn-sm btn-primary'><i class='bi bi-eye'></i></a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                                <button data-bs-toggle='modal' data-bs-target='#delete-project-modal' onclick="showDeleteProjectModal({{ $project->id }})" class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Aucun projet enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</section>
{{-- Delete project modal --}}
<div class="modal-danger me-1 mb-1 d-inline-block">
    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="delete-project-modal" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="delete-project-form" class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Supprimer un projet
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Annuler</span>
                    </button>
                    <button id="delete-project-btn" type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
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
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection