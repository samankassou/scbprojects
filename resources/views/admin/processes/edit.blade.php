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
            <form id="edit-form" data-process="{{ $process }}" data-old-method="{{ old('method') }}"
                data-old-macroprocess="{{ old('macroprocess') }}" data-old-created="{{ old('reasons_for_creation') }}"
                data-old-reviewed="{{ old('reasons_for_modifications') }}"
                action="{{ route('admin.processes.update', $process->id) }}" method="POST"
                data-process-id="{{ $process->id }}">
                @method('PATCH')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <p><em>Les champs marqués d'un</em> (<span class="text-danger">*</span>) sont obligatoires</p>
                        <label for="status">Domaine:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="domain" class="form-select @error('domain') is-invalid @enderror" name="domain">
                                @foreach ($domains as $domain)
                                <option value="{{ $domain->id }}" @if(old('domain', $process->
                                    method->macroprocess->domain->id) == $domain->id) selected
                                    @endif>{{ $domain->name }}</option>
                                @endforeach
                            </select>
                            @error('domain')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="status">Macroprocessus:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="macroprocess" class="form-select @error('macroprocess') is-invalid @enderror"
                                name="macroprocess">

                            </select>
                            @error('macroprocess')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="method">Processus:<sup class="text-danger">*</sup></label>
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

                        <label for="name">Intitulé:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name', $process->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="type">Type:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="type" class="form-select @error('type') is-invalid @enderror" name="type">
                                <option value="Note circulaire"
                                    {{ old('type', $process->type) == "Note circulaire" ? "selected" : "" }}>Note
                                    circulaire</option>
                                <option value="Instruction à durée limitée"
                                    {{ old('type', $process->type) == "Instruction à durée limitée" ? "selected" : "" }}>
                                    Instruction à durée limitée</option>
                                <option value="Note de procédure"
                                    {{ old('type', $process->type) == "Note de procédure" ? "selected" : "" }}>Note de
                                    procédure</option>
                                <option value="Note de fonctionnement"
                                    {{ old('type', $process->type) == "Note de fonctionnement" ? "selected" : "" }}>Note
                                    de fonctionnement</option>
                                <option value="Fiche de décision"
                                    {{ old('type', $process->type) == "Fiche de décision" ? "selected" : "" }}>Fiche de
                                    décision</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="reference">Reférence:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="reference" value="{{ old('reference', $process->reference) }}"
                                class="form-control @error('reference') is-invalid @enderror">
                            @error('reference')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="version">No. de version:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="version" value="{{ old('version', $process->version) }}"
                                class="form-control @error('version') is-invalid @enderror">
                            @error('version')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="entities">Entité(s) impactée(s):<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="entities" class="form-select @error('entities') is-invalid @enderror" multiple
                                name="entities[]">
                                @foreach ($entities as $entity)
                                <option value="{{ $entity->id }}"
                                    {{ collect(old('entities', $process->entities->pluck('id')->toArray()))->contains($entity->id) ? "selected": "" }}>
                                    {{ $entity->name }}</option>
                                @endforeach
                            </select>
                            @error('entities')
                            <div class="invalid-feedback" style="display: block">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="creation_date">Créée le:<sup class="text-danger">*</sup></label>
                                <div class="form-group">
                                    <input id="creation_date" type="date" name="creation_date"
                                        value="{{ old('creation_date', $process->creation_date->format('Y-m-d')) }}"
                                        class="form-control @error('creation_date') is-invalid @enderror">
                                    @error('creation_date')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="created_by">Par:<sup class="text-danger">*</sup></label>
                                <div class="form-group">
                                    <input id="created_by" type="text" name="created_by"
                                        value="{{ old('created_by', $process->created_by) }}"
                                        class="form-control @error('created_by') is-invalid @enderror">
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
                                <label for="writing_date">Redigée le:</label>
                                <div class="form-group">
                                    <input id="writing_date" type="date" name="writing_date"
                                        value="{{ old('writing_date', optional($process->writing_date)->format('Y-m-d')) }}"
                                        class="form-control @error('writing_date') is-invalid @enderror">
                                    @error('writing_date')
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
                                    <input id="written_by" type="text" name="written_by"
                                        value="{{ old('written_by', $process->written_by) }}"
                                        class="form-control @error('written_by') is-invalid @enderror">
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
                                <label for="verification_date">Vérifiée le:</label>
                                <div class="form-group">
                                    <input id="verification_date" type="date" name="verification_date"
                                        value="{{ old('verification_date', optional($process->verification_date)->format('Y-m-d')) }}"
                                        class="form-control @error('verification_date') is-invalid @enderror">
                                    @error('verification_date')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="verified_by">Par:</label>
                                <div class="form-group">
                                    <input id="verified_by" type="text" name="verified_by"
                                        value="{{ old('verified_by', $process->verified_by) }}"
                                        class="form-control @error('verified_by') is-invalid @enderror">
                                    @error('verified_by')
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
                                <label for="date_of_approval">Approuvée le:</label>
                                <div class="form-group">
                                    <input id="date_of_approval" type="date" name="date_of_approval"
                                        value="{{ old('date_of_approval', optional($process->date_of_approval)->format('Y-m-d')) }}"
                                        class="form-control @error('date_of_approval') is-invalid @enderror">
                                    @error('date_of_approval')
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
                                    <input id="approved_by" type="text" name="approved_by"
                                        value="{{ old('approved_by', $process->approved_by) }}"
                                        class="form-control @error('approved_by') is-invalid @enderror">
                                    @error('approved_by')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <label for="broadcasting_date">Date de diffusion:</label>
                        <div class="form-group">
                            <input id="broadcasting_date" type="date"
                                value="{{ old('broadcasting_date', optional($process->broadcasting_date)->format('Y-m-d')) }}"
                                name="broadcasting_date"
                                class="form-control @error('broadcasting_date') is-invalid @enderror">
                            @error('broadcasting_date')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="state">Etat:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="state" class="form-select @error('state') is-invalid @enderror" name="state">
                                <option value="Créé" @if(old('state', $process->state) == 'Créé') selected @endif>Créé
                                </option>
                                <option value="Revu" @if(old('state', $process->state) == 'Revu') selected @endif>Revu
                                </option>
                            </select>
                            @error('state')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="status">Statut:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="En cours de rédaction"
                                    {{ old('status', $process->status) == "En cours de rédaction" ? "selected" : "" }}>
                                    En cours de rédaction</option>
                                <option value="En cours de vérification"
                                    {{ old('status', $process->status) == "En cours de vérification" ? "selected" : "" }}>
                                    En cours de vérification</option>
                                <option value="En cours d'approbation"
                                    {{ old('status', $process->status) == "En cours d'approbation" ? "selected" : "" }}>
                                    En cours d'approbation</option>
                                <option value="Existant"
                                    {{ old('status', $process->status) == "Existant" ? "selected" : "" }}>Existant
                                </option>
                                <option value="A Créer"
                                    {{ old('status', $process->status) == "A Créer" ? "selected" : "" }}>A Créer
                                </option>
                                <option value="Terminé"
                                    {{ old('status', $process->status) == "Terminé" ? "selected" : "" }}>Terminé
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="reasons created" @if(!$process->reasons_for_creation) style="display: none" @endif>
                            <label for="reasons_for_creation">Raison(s) de la création:<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group">
                                <textarea id="reasons_for_creation" name="reasons_for_creation"
                                    class="form-control @error('reasons_for_creation') is-invalid @enderror"
                                    rows="3">{{ old('reasons_for_creation', $process->reasons_for_creation) }}</textarea>
                                @error('reasons_for_creation')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="reasons reviewed" @if(!$process->reasons_for_modification) style="display: none"
                            @endif>
                            <label for="reasons_for_modification">Raison(s) de la modification:<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group">
                                <textarea id="reasons_for_modification" name="reasons_for_modification"
                                    class="form-control @error('reasons_for_modification') is-invalid @enderror"
                                    rows="3">{{ old('reasons_for_modification', $process->reasons_for_modification) }}</textarea>
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
                            <textarea id="modifications" name="modifications"
                                class="form-control @error('modifications') is-invalid @enderror"
                                rows="3">{{ old('modifications', $process->modifications) }}</textarea>
                            @error('modifications')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <label for="appendices">Annexes:</label>
                        <div class="form-group">
                            <textarea id="appendices" name="appendices"
                                class="form-control @error('appendices') is-invalid @enderror"
                                rows="3">{{ old('appendices', $process->appendices) }}</textarea>
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
        entitiesChoices = new Choices(document.getElementById('entities'), {
            removeItemButton: true
        });
        let domain = $('#domain').val();
        oldReasonsOfModification = $('#edit-form').data('old-reviewed');
        oldReasonsOfCreation = $('#edit-form').data('old-created');
        process = $('#edit-form').data('process');
        let oldMethod = $('#edit-form').data('old-method');
        let oldMacroprocess = $('#edit-form').data('old-macroprocess');
        let selectedMethod = oldMethod ? oldMethod : process.method_id;
        let selectedMacroprocess = oldMacroprocess ? oldMacroprocess : process.method.macroprocess_id;
        $('#macroprocess').data('selected', selectedMacroprocess);
        $('#method').data('selected', selectedMethod);
        fillMacroprocesses(domain);
        $('#domain').on('change', function(e){
            $('#macroprocess').data('selected', null);
            $('#method').data('selected', null);
            fillMacroprocesses($(this).val());
        });
        $('#macroprocess').on('change', function(e){
            $('#method').data('selected', null);
            fillMethods($(this).val());
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
                let selected = $('#macroprocess').data('selected');
                if(selected){
                    $('#macroprocess').val(selected);
                }
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
                let selected = $('#method').data('selected');
                if(selected){
                    $('#method').val(selected);
                }
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
        if(e.target.value == "Revu"){
            let content = oldReasonsOfModification ? oldReasonsOfModification : process.reasons_for_modification;
            $('#reasons_for_modification').val(content);
            $('.reviewed').show();
        }else{
            let content = oldReasonsOfCreation ? oldReasonsOfCreation : process.reasons_for_creation;
            $('#reasons_for_creation').val(content);
            $('.created').show();
        }
        
    }
</script>
@endsection