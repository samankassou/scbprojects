@extends('layouts.app', ['title' => 'Création d\'une procédure'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Création d'une procédure</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.processes.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <p><em>Les champs marqués d'un</em> (<span class="text-danger">*</span>) sont obligatoires</p>
                    <div class="col-md-8">
                        <label for="status">Domaine:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="domain" class="form-select @error('domain') is-invalid @enderror" name="domain">
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->id }}" {{ old('domain') == $domain->id ? "selected" : "" }}>{{ $domain->name }}</option>
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
                            <select id="macroprocess" data-selected="{{ old('macroprocess') }}" class="form-select @error('macroprocess') is-invalid @enderror" name="macroprocess">
                                
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
                            <select id="method" data-selected="{{ old('method') }}" class="form-select @error('method') is-invalid @enderror" name="method">
                                
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
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
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

                        <label for="reference">Reférence:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="reference" value="{{ old('reference') }}" class="form-control @error('reference') is-invalid @enderror">
                            @error('reference')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="version">No. de version:<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <input type="text" name="version" value="{{ old('version') }}" class="form-control @error('version') is-invalid @enderror">
                            @error('version')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="entities">Entité(s) impactée(s):<sup class="text-danger">*</sup></label>
                        <div class="form-group">
                            <select id="entities" class="form-select @error('entities') is-invalid @enderror" multiple name="entities[]">
                                @foreach ($entities as $entity)
                                    <option value="{{ $entity->id }}" {{ collect(old('entities'))->contains($entity->id) ? "selected": "" }}>{{ $entity->name }}</option>
                                @endforeach
                            </select>
                            @error('entities')
                                <div class="invalid-feedback d-block">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="creation_date">Créée le:<sup class="text-danger">*</sup></label>
                                <div class="form-group">
                                    <input id="creation_date" type="date" value="{{ old('creation_date') }}" name="creation_date" class="form-control @error('creation_date') is-invalid @enderror">
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
                                    <input id="created_by" type="text" value="{{ old('created_by') }}" name="created_by" class="form-control @error('created_by') is-invalid @enderror">
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
                                    <input id="written_date" type="date" value="{{ old('written_date') }}" name="written_date" class="form-control @error('written_date') is-invalid @enderror">
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
                                    <input id="written_by" type="text" value="{{ old('written_by') }}" name="written_by" class="form-control @error('written_by') is-invalid @enderror">
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
                                    <input id="verification_date" type="date" value="{{ old('verification_date') }}" name="verification_date" class="form-control @error('verification_date') is-invalid @enderror">
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
                                    <input id="verified_by" type="text" name="verified_by" value="{{ old('verified_by') }}" class="form-control @error('verified_by') is-invalid @enderror">
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
                                    <input id="date_of_approval" type="date" value="{{ old('date_of_approval') }}" name="date_of_approval" class="form-control @error('date_of_approval') is-invalid @enderror">
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
                                    <input id="approved_by" type="text" value="{{ old('approved_by') }}" name="approved_by" class="form-control @error('approved_by') is-invalid @enderror">
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
                            <input id="broadcasting_date" type="date" value="{{ old('broadcasting_date') }}" name="broadcasting_date" class="form-control @error('broadcasting_date') is-invalid @enderror">
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
                                <option value="Créé" {{ old('state') == "Créé" ? "selected" : "" }}>Créé</option>
                                <option value="Revu" {{ old('state') == "Revu" ? "selected" : "" }}>Revu</option>
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
                                <option value="En cours de rédaction" {{ old('status') == "En cours de rédaction" ? "selected" : "" }}>En cours de rédaction</option>
                                <option value="En cours de vérification" {{ old('status') == "En cours de vérification" ? "selected" : "" }}>En cours de vérification</option>
                                <option value="En cours d'approbation" {{ old('status') == "En cours d'approbation" ? "selected" : "" }}>En cours d'approbation</option>
                                <option value="Existant" {{ old('status') == "Existant" ? "selected" : "" }}>Existant</option>
                                <option value="A Créer" {{ old('status') == "A Créer" ? "selected" : "" }}>A Créer</option>
                                <option value="Terminé" {{ old('status') == "Terminé" ? "selected" : "" }}>Terminé</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="reasons created">
                            <label for="reasons_for_creation">Raison(s) de la création:<sup class="text-danger">*</sup></label>
                            <div class="form-group">
                                <textarea id="reasons_for_creation" name="reasons_for_creation" class="form-control @error('reasons_for_creation') is-invalid @enderror" rows="3"></textarea>
                                @error('reasons_for_creation')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="reasons reviewed">
                            <label for="reasons_for_modification">Raison(s) de la modification:<sup class="text-danger">*</sup></label>
                            <div class="form-group">
                                <textarea id="reasons_for_modification" name="reasons_for_modification" class="form-control @error('reasons_for_modification') is-invalid @enderror" rows="3"></textarea>
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
                            <textarea id="appendices" name="appendices" class="form-control @error('appendices') is-invalid @enderror" rows="3"></textarea>
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
    const entitiesChoices = new Choices(document.getElementById('entities'), {
        removeItemButton: true
    });
    $(function(){
        let domain = $('#domain').val();
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
        $('.reviewed').hide();
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
            $('.reviewed').show();
        }else{
            $('.created').show();
        }
    }
</script>
@endsection