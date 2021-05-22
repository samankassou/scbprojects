@extends('layouts.app', ['title' => 'Création d\'un projet'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Création d'un projet</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">

                    <div class="col-md-8">
                        <label for="name">Nom:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label for="name">Description:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Date début:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Date fin:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <label for="name">Sponsor/MOA:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>Nature(s): </label>
                        <fieldset class="form-group">
                            <select class="form-select choices multiple-remove" multiple name="nature[]">
                                @foreach ($natures as $nature)
                                    <option value="{{ $nature->id }}">{{ $nature->name }}</option>
                                @endforeach
                            </select>
                        </fieldset>

                        <label>Initiative:</label>
                        <div class="form-group">
                            <select class="form-select" name="initiative">
                                <option value="local">local</option>
                                <option value="groupe">groupe</option>
                            </select>
                        </div>

                        <label>AMOA:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>MOE:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>Chef de projet:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>Statut du projet:</label>
                        <div class="form-group">
                            <select class="form-select" name="status">
                                <option value="en cours">en cours</option>
                                <option value="inachevé">inachevé</option>
                                <option value="en stand-by">en stand-by</option>
                                <option value="terminé">terminé</option>
                            </select>
                        </div>

                        <label>Gains/Impact:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>Documentation du projet:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>

                        <label>Factures:</label>
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection