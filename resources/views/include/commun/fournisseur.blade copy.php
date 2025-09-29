  <div class="modal fade" id="addfournisseur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau fournisseur</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.fournisseur.store') }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom complet</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Contact</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="contact" class="visually-hidden form-label">Contact</label>
                <input type="number" name="contact" required minlength="8" value="{{ old('contact') }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact">
                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Email</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="email" class="visually-hidden form-label">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">NCC (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="NCC" class="visually-hidden form-label">NCC (facultatif)</label>
                <input type="text" name="NCC" value="{{ old('NCC') }}" class="form-control" id="NCC" placeholder="Entrer un NCC" aria-label="Entrer un NCC">
                @error('NCC') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Adresse postale complète</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="adresse_postale" class="visually-hidden form-label">Adresse postale complète</label>
                <input type="text" name="adresse_postale" value="{{ old('adresse_postale') }}" class="form-control" required id="adresse_postale" placeholder="Entrer une adresse postale complète" aria-label="Entrer une adresse postale complète">
                @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Domaine d'activité</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="domaine" class="visually-hidden form-label">Domaine d'activité</label>
                <input type="text" name="domaine" value="{{ old('domaine') }}" class="form-control" id="domaine" placeholder="Entrer le domaine d'activité" required>
                @error('domaine') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Siège social</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="domaine" class="visually-hidden form-label">Siège social</label>
                <input type="text" name="siege_social" value="{{ old('siege_social') }}" class="form-control" id="siege_social" placeholder="Entrer le siege social" required>
                @error('siege_social') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addFournisseurFactureComptable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une nouvelle facture fournisseur</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('comptable.fournisseurfacturecomptable.store') }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Désignation</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="designation" class="visually-hidden form-label">Désignation *</label>
                <input type="text" name="designation" value="{{ old('designation') }}" class="form-control" id="designation" placeholder="Entrer une désignation" aria-label="Entrer une désignation" required>
                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Delai de reglement *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_reglement" class="visually-hidden form-label">Delai de reglement</label>
                <input type="date" name="delai_reglement" required value="{{ old('delai_reglement') }}" class="form-control" id="contact" placeholder="Entrer un delai reglement" aria-label="Entrer un delai reglement">
                @error('delai_reglement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Echeance *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="echeance" class="visually-hidden form-label">Echeance *</label>
                <input type="text" name="echeance" required value="{{ old('echeance') }}" class="form-control" id="echeance" placeholder="Entrer une echeance" aria-label="Entrer une echeance">
                @error('echeance') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Montant de la facture *</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="total_payer" class="visually-hidden form-label">Montant de la facture *</label>
                <input type="number" min="1" name="total_payer" value="{{ old('total_payer') }}" class="form-control" required id="total_payer" placeholder="Entrer le montant de la facture" aria-label="Entrer le montant de la facture">
                @error('total_payer') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4" style="display: none;">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Avance du paiement (facultative)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="versement" class="visually-hidden form-label">Avance du paiement (facultative)</label>
                <input type="number" min="1" name="versement" value="{{ old('versement') }}" class="form-control" id="versement" placeholder="Entrer une avance">
                @error('versement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Associer une facture (fichier facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="facture" class="visually-hidden form-label">Associer une facture (fichier) (facultative)</label>
                <input type="file" name="facture" value="{{ old('facture') }}" class="form-control" id="facture" placeholder="Entrer un fichier">
                @error('facture') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Associer un bon (fichier facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="bon" class="visually-hidden form-label">Associer une bon (fichier) (facultative)</label>
                <input type="file" name="bon" value="{{ old('bon') }}" class="form-control" id="bon" placeholder="choisir un un">
                @error('bon') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Fournisseur *</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="fournisseur_id" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }' required>
                    @foreach(fournisseurs() as $fournisseur)
                      <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }} : {{ $fournisseur->contact }}</option>
                    @endforeach
                  </select>
                </div>
                @error('fournisseur') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>