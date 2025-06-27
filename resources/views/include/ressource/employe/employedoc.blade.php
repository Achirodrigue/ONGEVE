  <!-- delete New Category Modal -->
  <div class="modal fade" id="deleteemployedoc{{ $employedoc->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">Confirmation suppression</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer ce document <span class="text-warning">{{ $employedoc->nom_document }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('ressource.employedoc.destroy', $employedoc) }}" method="POST">
        @csrf
        @method('DELETE')
            <div class="modal-footer">
                <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
                    <div class="col-sm-auto">
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Non</button>
                            <button type="submit" class="btn btn-primary">Oui</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Create New API Key Modal -->

  <div class="modal fade" id="editemployedoc{{ $employedoc->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le document <span class="text-danger">{{ $employedoc->nom_document }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('ressource.employedoc.update', $employedoc) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom du document</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom du document</label>
                <input type="text" name="nom_document" value="{{ old('nom_document', $employedoc->nom_document) }}" class="form-control" id="nom_document">
                @error('nom_document') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Type de document</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="type_document" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                    <option value="CNI" {{ old('type_document', $employedoc->type_document) == 'CNI' ? 'selected' : '' }}>Carte Nationale d'Identité</option>
                    <option value="PASSPORT" {{ old('type_document', $employedoc->type_document) == 'PASSPORT' ? 'selected' : '' }}>Passeport</option>
                    <option value="DIPLOME" {{ old('type_document', $employedoc->type_document) == 'DIPLOME' ? 'selected' : '' }}>Diplôme</option>
                    <option value="CV" {{ old('type_document', $employedoc->type_document) == 'CV' ? 'selected' : '' }}>Curriculum Vitae</option>
                    <option value="CONTRAT" {{ old('type_document', $employedoc->type_document) == 'CONTRAT' ? 'selected' : '' }}>Contrat de Travail</option>
                    <option value="ATTESTATION" {{ old('type_document', $employedoc->type_document) == 'ATTESTATION' ? 'selected' : '' }}>Attestation (Médicale, Résidence, etc.)</option>
                    <option value="PERMIS DE TRAVAIL" {{ old('type_document', $employedoc->type_document) == 'PERMIS DE TRAVAIL' ? 'selected' : '' }}>Permis de Travail</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Fichier du document (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="fichier" class="visually-hidden form-label">Fichier du document (facultatif)</label>
                <input type="file" name="fichier" class="form-control" id="fichier">
                @error('fichier') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Date d'expiration (optionnel)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="date_expiration" class="visually-hidden form-label">Date d'expiration (optionnel)</label>
                <input type="date" name="date_expiration" value="{{ old('date_expiration', $employedoc->date_expiration ? $document->date_expiration->format('d-m-Y') : '') }}" class="form-control" id="date_expiration">
                @error('date_expiration') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Description (optionnel)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="description" class="visually-hidden form-label">Description (optionnel)</label>
                <textarea id="description" class="form-control" name="description">{{ old('description', $employedoc->description) }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Modifier</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>