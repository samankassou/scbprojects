@extends('layouts.datatable', ['title' => 'Utilisateurs'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Liste des utilisateurs</h4>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="projects-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nom(s)</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th style="width: 100px">Options</th>
                    </tr>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status ? "Actif" : "Inactif" }}</td>
                            <td>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucun utilisateur enregistré</td>
                        </tr>
                    @endforelse
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection