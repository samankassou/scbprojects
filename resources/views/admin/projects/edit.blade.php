@extends('layouts.app', [
'title' => 'Modification d\'un projet',
'description' => "Formulaire d'édition d'un projet"
])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Modification du projet "{{ $project->name }}"</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row justify-content-center">

                    <div class="col-md-8">
                        <p><em>Les champs marqués d'un</em> (<span class="text-danger">*</span>) sont obligatoires</p>
                        <label for="name">Nom:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name', $project->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="description">Description:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <textarea id="description" name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date">Date début:<sup class="text-danger">*</sup></label>
                                <div class="form-group">
                                    <input id="start_date" type="date" name="start_date"
                                        value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}"
                                        class="form-control @error('start_date') is-invalid @enderror">
                                    @error('start_date')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date">Date fin:</label>
                                <div class="form-group">
                                    <input id="end_date" type="date" name="end_date"
                                        value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}"
                                        class="form-control @error('end_date') is-invalid @enderror">
                                    @error('end_date')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <label for="sponsor">Sponsor/MOA:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input id="sponsor" type="text" name="sponsor"
                                value="{{ old('sponsor', $project->sponsor) }}"
                                class="form-control @error('sponsor') is-invalid @enderror">
                            @error('sponsor')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="natures">Nature(s):<sup class="text-danger">*</sup> </label>
                        <fieldset class="form-group">
                            <select id="natures"
                                class="form-select choices multiple-remove @error('natures') is-invalid @enderror"
                                multiple name="natures[]">
                                @foreach ($natures as $nature)
                                <option value="{{ $nature->id }}"
                                    {{ collect(old('natures', $project->natures->pluck('id')->toArray()))->contains($nature->id) ? "selected": "" }}>
                                    {{ $nature->name }}</option>
                                @endforeach
                            </select>
                            @error('natures')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </fieldset>

                        <label for="steps">Etape(s) réalisée(s): </label>
                        <div class="form-group">
                            <select id="steps"
                                class="form-select choices multiple-remove @error('steps') is-invalid @enderror"
                                multiple name="steps[]">
                                @foreach ($steps as $step)
                                <option value="{{ $step->id }}"
                                    {{ collect(old('steps', $project->steps->pluck('id')->toArray()))->contains($step->id) ? "selected": "" }}>
                                    {{ $step->name }}</option>
                                @endforeach
                            </select>
                            @error('steps')
                            <div class="invalid-feedback" style="display: block">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="initiative">Initiative:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="initiative" class="form-select @error('initiative') is-invalid @enderror"
                                name="initiative">
                                <option value="local" @if(old('initiative', $project->initiative) == "local") selected
                                    @endif>local
                                </option>
                                <option value="groupe" @if(old('initiative', $project->initiative) == "groupe") selected
                                    @endif>groupe
                                </option>
                            </select>
                            @error('initiative')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="amoa">AMOA:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input id="amoa" type="text" name="amoa" value="{{ old('amoa', $project->name) }}"
                                class="form-control @error('amoa') is-invalid @enderror">
                            @error('amoa')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="progress">Progression(%):<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input id="progress" type="number" name="progress"
                                value="{{ old('progress', $project->progress) }}"
                                class="form-control @error('progress') is-invalid @enderror">
                            @error('progress')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="moe">MOE:</label>
                        <div class="form-group">
                            <input id="moe" type="text" name="moe" value="{{ old('moe', $project->moe) }}"
                                class="form-control @error('moe') is-invalid @enderror">
                            @error('moe')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="manager">Chef de projet:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input id="manager" type="text" name="manager"
                                value="{{ old('manager', $project->manager) }}"
                                class="form-control @error('manager') is-invalid @enderror">
                            @error('manager')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="cost">Coût du projet:</label>
                        <div class="form-group">
                            <input id="cost" type="number" name="cost" value="{{ old('cost', $project->cost) }}"
                                class="form-control @error('manager') is-invalid @enderror">
                            @error('cost')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="status">Statut du projet:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="en cours" @if($project->status == "en cours") selected @endif>en cours
                                </option>
                                <option value="inachevé" @if($project->status == "inachevé") selected @endif>inachevé
                                </option>
                                <option value="en stand-by" @if($project->status == "en stand-by") selected @endif>en
                                    stand-by</option>
                                <option value="terminé" @if($project->status == "terminé") selected @endif>terminé
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="benefits">Gains/Impact:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <textarea id="benefits" name="benefits"
                                class="form-control @error('benefits') is-invalid @enderror"
                                rows="3">{{ old('benefits', $project->benefits) }}</textarea>
                            @error('benefits')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="documentation">Documentation du projet:</label>
                        <div class="form-group">
                            <textarea id="documentation" name="documentation"
                                class="form-control @error('documentation') is-invalid @enderror"
                                rows="3">{{ old('documentation', $project->documentation) }}</textarea>
                            @error('documentation')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="bills">Factures:</label>
                        <div class="form-group">
                            <textarea id="bills" name="bills" class="form-control @error('bills') is-invalid @enderror"
                                rows="3">{{ old('bills', $project->bills) }}</textarea>
                            @error('bills')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <button type="reset" class="btn btn-danger">Annuler</button>
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