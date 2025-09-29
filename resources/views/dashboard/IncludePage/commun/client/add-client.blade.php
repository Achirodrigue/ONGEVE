<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
        <label for="nom" class="form-label">Nom complet du client</label>
        <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="nom" placeholder="Entrer un nom" required>
        @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4">
        <label for="contact" class="form-label">Contact du client</label>
        <input type="number" minlength="8" maxlength="10" class="form-control" name="contact" value="{{ old('contact') }}" id="contact" placeholder="Entrer un contact" required>
        @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4">
        <label for="email" class="form-label">Email du client</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Entrer un email">
        @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="mb-4">
        <label for="reference" class="form-label">Référence du client</label>
        <input type="text" class="form-control" name="reference" value="{{ old('reference') }}" id="reference" placeholder="Entrer une reference">
        @error('reference') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div> -->
    <div class="col-md-6">
        <div class="mb-4">
            <label for="NCC" class="form-label">NCC (facultatif)</label>
            <input type="text" class="form-control" name="NCC" value="{{ old('NCC') }}" id="NCC" placeholder="Entrer un NCC">
            @error('NCC') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4">
            <label for="Pachat" class="form-label">Plafond d'achat (facultatif)</label>
            <input type="number" min="1" minlength="1" class="form-control" name="Pachat" value="{{ old('Pachat') }}" id="Pachat" placeholder="Entrer un plafond d'achat">
            @error('Pachat') <span class="text-danger"> {{ $message }} </span> @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-4">
            <label for="adresse_postale" class="form-label">Adresse postale complète</label>
            <input type="text" name="adresse_postale" value="{{ old('adresse_postale') }}" class="form-control" id="adresse_postale" placeholder="Entrer une adresse postale complète">
            @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <div class="mb-4">
            <label for="TC" class="form-label">Type de client</label>
            <div class="tom-select-custom">
                <select id="typeCli" onchange="typeClient()" name="TC" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                        "searchInDropdown": false,
                        "hideSearch": true,
                        "placeholder": "Select category"
                        }' required>
                    <option value="0">Entreprise</option>
                    <option value="1">Particulier</option>
                </select>
            </div>
        </div>
    </div>
    
    <div id="typeEntreprise" style="display: block;">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <label for="interlocuteur" class="form-label">Interlocuteur</label>
                    <input type="text" name="interlocuteur" value="{{ old('interlocuteur') }}" class="form-control" id="interlocuteur" placeholder="Entrer le nom complet d'un interlocuteur">
                    @error('interlocuteur') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="forme_juridique" class="form-label">Forme juridique</label>
                    <input type="text" name="forme_juridique" value="{{ old('forme_juridique') }}" class="form-control" id="forme_juridique" placeholder="Entrer une Forme juridique">
                    @error('forme_juridique') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="numero_identifie" class="form-label">Numéro d'identification</label>
                    <input type="text" name="numero_identifie" value="{{ old('numero_identifie') }}" class="form-control" id="numero_identifie" placeholder="Entrer un Numéro d'identification">
                    @error('numero_identifie') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="domaine" class="form-label">Secteur d'activité</label>
                    <input type="text" name="domaine" value="{{ old('domaine') }}" class="form-control" id="domaine" placeholder="Entrer un Secteur d'activité">
                    @error('domaine') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="siege_social" class="form-label">Siège social</label>
                    <input type="text" name="siege_social" value="{{ old('siege_social') }}" class="form-control" id="siege_social" placeholder="Entrer un Siège social">
                    @error('siege_social') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <div id="typeParticulier" style="display: none;">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="genre" class="form-label">Genre</label>
                    <select name="genre" class="js-select form-select">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                    @error('genre') <span class="text-danger"> {{ $message }} </span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="naissance" class="form-label">Date de naissance</label>
                    <input type="date" name="naissance" id="naissance" value="{{ old('naissance') }}" class="flatpickr-custom form-control" placeholder="Entrer une date de naissance">
                    @error('naissance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>