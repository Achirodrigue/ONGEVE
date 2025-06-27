 @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.documents.store', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="document_name">Nom du document :</label>
                <input type="text" id="document_name" name="document_name" value="{{ old('document_name') }}" required>
            </div>

            <div class="form-group">
                <label for="document_type">Type de document :</label>
                <select id="document_type" name="document_type" required>
                    <option value="">Sélectionner un type</option>
                    <option value="CNI" {{ old('document_type') == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                    <option value="PASSPORT" {{ old('document_type') == 'PASSPORT' ? 'selected' : '' }}>Passeport</option>
                    <option value="DIPLOMA" {{ old('document_type') == 'DIPLOMA' ? 'selected' : '' }}>Diplôme</option>
                    <option value="CV" {{ old('document_type') == 'CV' ? 'selected' : '' }}>Curriculum Vitae</option>
                    <option value="CONTRACT" {{ old('document_type') == 'CONTRACT' ? 'selected' : '' }}>Contrat de Travail</option>
                    <option value="ATTESTATION" {{ old('document_type') == 'ATTESTATION' ? 'selected' : '' }}>Attestation (Médicale, Résidence, etc.)</option>
                    <option value="WORK_PERMIT" {{ old('document_type') == 'WORK_PERMIT' ? 'selected' : '' }}>Permis de Travail</option>
                    <option value="OTHER" {{ old('document_type') == 'OTHER' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">Fichier du document :</label>
                <input type="file" id="file" name="file" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
            </div>

            <div class="form-group">
                <label for="expiration_date">Date d'expiration (optionnel) :</label>
                <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}">
            </div>

            <div class="form-group">
                <label for="description">Description (optionnel) :</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-actions">
                <div class="back-button">
                    <a href="{{ route('employees.show', $employee->id) }}">Annuler et Retour</a>
                </div>
                <button type="submit" class="btn-submit">Ajouter le document</button>
            </div>
        </form>
 
 
 
 
 
 
 
 @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.documents.update', [$employee->id, $document->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="document_name">Nom du document :</label>
                <input type="text" id="document_name" name="document_name" value="{{ old('document_name', $document->document_name) }}" required>
            </div>

            <div class="form-group">
                <label for="document_type">Type de document :</label>
                <select id="document_type" name="document_type" required>
                    <option value="">Sélectionner un type</option>
                    <option value="CNI" {{ old('document_type', $document->document_type) == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                    <option value="PASSPORT" {{ old('document_type', $document->document_type) == 'PASSPORT' ? 'selected' : '' }}>Passeport</option>
                    <option value="DIPLOMA" {{ old('document_type', $document->document_type) == 'DIPLOMA' ? 'selected' : '' }}>Diplôme</option>
                    <option value="CV" {{ old('document_type', $document->document_type) == 'CV' ? 'selected' : '' }}>Curriculum Vitae</option>
                    <option value="CONTRACT" {{ old('document_type', $document->document_type) == 'CONTRACT' ? 'selected' : '' }}>Contrat de Travail</option>
                    <option value="ATTESTATION" {{ old('document_type', $document->document_type) == 'ATTESTATION' ? 'selected' : '' }}>Attestation (Médicale, Résidence, etc.)</option>
                    <option value="WORK_PERMIT" {{ old('document_type', $document->document_type) == 'WORK_PERMIT' ? 'selected' : '' }}>Permis de Travail</option>
                    <option value="OTHER" {{ old('document_type', $document->document_type) == 'OTHER' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">Fichier du document :</label>
                @if ($document->file_path)
                    <p>Fichier actuel : <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">{{ $document->original_file_name }}</a></p>
                    <input type="checkbox" id="clear_file" name="clear_file" value="1">
                    <label for="clear_file" style="display:inline;">Supprimer le fichier actuel</label>
                    <br>
                @endif
                <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <small>Laisser vide pour conserver le fichier actuel, ou choisissez un nouveau fichier.</small>
            </div>

            <div class="form-group">
                <label for="expiration_date">Date d'expiration (optionnel) :</label>
                <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $document->expiration_date ? $document->expiration_date->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label for="description">Description (optionnel) :</label>
                <textarea id="description" name="description">{{ old('description', $document->description) }}</textarea>
            </div>

            <div class="form-actions">
                <div class="back-button">
                    <a href="{{ route('employees.show', $employee->id) }}">Annuler et Retour</a>
                </div>
                <button type="submit" class="btn-submit">Mettre à jour le document</button>
            </div>
        </form>