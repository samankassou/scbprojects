@extends('layouts.app', ['title' => 'Modification d\'une procédure'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Modification de la procédure "{{ $process->name }}"</h4>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{ route('admin.processes.update', $process->id) }}" method="POST" data-process-id="{{ $process->id }}">
                @method('PATCH')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <label for="status">Domaine:</label>
                        <div class="form-group">
                            <select id="domain" class="form-select @error('domain') is-invalid @enderror" name="domain">
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->id }}" @if(old('domain', $process->id) == $domain->id) selected @endif>{{ $domain->name }}</option>
                                @endforeach
                            </select>
                            @error('domain')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="status">Macroprocessus:</label>
                        <div class="form-group">
                            <select id="macroprocess" class="form-select @error('macroprocess') is-invalid @enderror" name="macroprocess">
                                
                            </select>
                            @error('macroprocess')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="method">Processus:</label>
                        <div class="form-group">
                            <select id="method" class="form-select @error('method') is-invalid @enderror" name="method">
                                
                            </select>
                            @error('method')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="name">Intitulé:</label>
                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name', $process->name) }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="type">Type:</label>
                        <div class="form-group">
                            <select id="type" class="form-select @error('type') is-invalid @enderror" name="type">
                                <option value="Note circulaire">Note circulaire</option>
                                <option value="Instruction à durée limitée">Instruction à durée limitée</option>
                                <option value="Note de procédure">Note de procédure</option>
                                <option value="Note de fonctionnement">Note de fonctionnement</option>
                                <option value="Fiche de décision">Fiche de décision</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="reference">Reférence:</label>
                        <div class="form-group">
                            <input type="text" name="reference" value="{{ old('reference', $process->reference) }}" class="form-control @error('reference') is-invalid @enderror">
                            @error('reference')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="version">No. de version:</label>
                        <div class="form-group">
                            <input type="text" name="version" value="{{ old('version', $process->version) }}" class="form-control @error('version') is-invalid @enderror">
                            @error('version')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="pole">Pôle:</label>
                        <div class="form-group">
                            <select id="pole" class="form-select @error('pole') is-invalid @enderror" name="pole">
                                @foreach ($poles as $pole)
                                    <option value="{{ $pole->id }}" @if(old('pole', $process->entity->pole->id) == $pole->id) selected @endif>{{ $pole->name }}</option>
                                @endforeach
                            </select>
                            @error('pole')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="entity">Entité:</label>
                        <div class="form-group">
                            <select id="entity" class="form-select @error('entity') is-invalid @enderror" name="entity">
                                
                            </select>
                            @error('entity')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="creation_date">Créée le:</label>
                                <div class="form-group">
                                    <input id="creation_date" type="date" name="creation_date" value="{{ old('creation_date', $process->creation_date->format('Y-m-d')) }}" class="form-control @error('creation_date') is-invalid @enderror">
                                    @error('creation_date')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="created_by">Par:</label>
                                <div class="form-group">
                                    <input id="created_by" type="text" name="created_by" value="{{ old('created_by', $process->created_by) }}" class="form-control @error('created_by') is-invalid @enderror">
                                    @error('created_by')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="written_date">Redigée le:</label>
                                <div class="form-group">
                                    <input id="written_date" type="date" name="written_date" value="{{ old('written_date', $process->written_date->format('Y-m-d')) }}" class="form-control @error('written_date') is-invalid @enderror">
                                    @error('written_date')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="written_by">Par:</label>
                                <div class="form-group">
                                    <input id="written_by" type="text" name="written_by" value="{{ old('written_by', $process->written_by) }}" class="form-control @error('written_by') is-invalid @enderror">
                                    @error('written_by')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="validation_date">Validée le:</label>
                                <div class="form-group">
                                    <input id="validation_date" type="date" name="validation_date" value="{{ old('validation_date', $process->validation_date->format('Y-m-d')) }}" class="form-control @error('validation_date') is-invalid @enderror">
                                    @error('validation_date')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validated_by">Par:</label>
                                <div class="form-group">
                                    <input id="validated_by" type="text" name="validated_by" value="{{ old('validated_by', $process->validated_by) }}" class="form-control @error('validated_by') is-invalid @enderror">
                                    @error('validated_by')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="approved_date">Approuvée le:</label>
                                <div class="form-group">
                                    <input id="approved_date" type="date" name="approved_date" value="{{ old('approved_date', $process->approved_date->format('Y-m-d')) }}" class="form-control @error('approved_date') is-invalid @enderror">
                                    @error('approved_date')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="approved_by">Par:</label>
                                <div class="form-group">
                                    <input id="approved_by" type="text" name="approved_by" value="{{ old('approved_by', $process->approved_by) }}" class="form-control @error('approved_by') is-invalid @enderror">
                                    @error('approved_by')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <label for="state">Etat:</label>
                        <div class="form-group">
                            <select id="state" class="form-select @error('state') is-invalid @enderror" name="state">
                                <option value="Créé" @if(old('state') == 'Créé') selected @endif>Créé</option>
                                <option value="Revu" @if(old('state') == 'Revu') selected @endif>Revu</option>
                            </select>
                            @error('state')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="reasons created" @if(!$process->reasons_for_creation) style="display: none" @endif>
                            <label for="reasons_for_creation">Raison(s) de la création:</label>
                            <div class="form-group">
                                <textarea id="reasons_for_creation" name="reasons_for_creation" class="form-control @error('reasons_for_creation') is-invalid @enderror" rows="3">{{ old('reasons_for_creation', $process->reasons_for_creation) }}</textarea>
                                @error('reasons_for_creation')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="reasons reviewed" @if(!$process->reasons_for_modification) style="display: none" @endif>
                            <label for="reasons_for_modification">Raison(s) de la modification:</label>
                            <div class="form-group">
                                <textarea id="reasons_for_modification" name="reasons_for_modification" class="form-control @error('reasons_for_modification') is-invalid @enderror" rows="3">{{ old('reasons_for_modification', $process->reasons_for_modification) }}</textarea>
                                @error('reasons_for_modification')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <label for="modifications">Modification(s) apportée(s):</label>
                        <div class="form-group">
                            <textarea id="modifications" name="modifications" class="form-control @error('modifications') is-invalid @enderror" rows="3"></textarea>
                            @error('modifications')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="appendices">Annexes:</label>
                        <div class="form-group">
                            <textarea id="appendices" name="appendices" class="form-control @error('appendices') is-invalid @enderror" rows="3">{{ old('appendices', $process->appendices) }}</textarea>
                            @error('appendices')
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
<script src="{{ asset('vendor/datatables/js/jquery-3.5.1.js') }}"></script>
<script>
    $(function(){
        let domain = $('#domain').val();
        let pole = $('#pole').val();
        fillMacroprocesses(domain);
        fillEntities(pole);
        $('#domain').on('change', function(e){
            fillMacroprocesses($(this).val());
        });
        $('#macroprocess').on('change', function(e){
            fillMethods($(this).val());
        });
        $('#pole').on('change', function(e){
            fillEntities($(this).val());
        });
        $('#state').on('change', switchReasonInput);
    });

    function fillMacroprocesses(domain)
    {
        $.ajax({
            url: "/admin/processes/domains/"+domain+"/macroprocesses",
            success: function(response){
                let macroprocesses = response.macroprocesses;
                let html = '';
                macroprocesses.forEach(macroprocess => {
                    html+= `<option value="${macroprocess.id}">${macroprocess.name}</option>`;
                });

                $('#macroprocess').html(html);
                let macroprocess = $('#macroprocess').val();
                fillMethods(macroprocess);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function fillMethods(macroprocess)
    {
        $.ajax({
            url: "/admin/processes/macroprocesses/"+macroprocess+"/methods",
            success: function(response){
                let methods = response.methods;
                let html = '';
                methods.forEach(method => {
                    html+= `<option value="${method.id}">${method.name}</option>`;
                });

                $('#method').html(html);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function fillEntities(pole)
    {
        $.ajax({
            url: "/admin/processes/poles/"+pole+"/entities",
            success: function(response){
                let entities = response.entities;
                let html = '';
                entities.forEach(entity => {
                    html+= `<option value="${entity.id}">${entity.name}</option>`;
                });

                $('#entity').html(html);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function switchReasonInput(e)
    {
        $('.reasons textarea').val('');
        $('.reasons').hide();
        const id = $('#edit-form').data("process-id");
        
        $.ajax({
            url: "/admin/processes/"+id,
            success: function(response){
                let process = response.process;
                if(e.target.value == "Revu"){
                    $('.reviewed textarea').val(process.reasons_for_modification);
                    $('.reviewed').show();
                }else{
                    $('.created textarea').val(process.reasons_for_creation);
                    $('.created').show();
                }
            }
        });
    }
</script>
@endsection