

  <div class="modal fade" id="editfournisseurfacturecomptable{{ $fournisseurfacturecomptable->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la facture <span class="text-danger">{{ $fournisseurfacturecomptable->numero_facture }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.fournisseurfacturecomptable.update', $fournisseurfacturecomptable) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
                <input type="text" name="designation" value="{{ $fournisseurfacturecomptable->designation }}" class="form-control" id="designation" placeholder="Entrer une désignation" aria-label="Entrer une désignation" required>
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
                <input type="date" name="delai_reglement" required value="{{ $fournisseurfacturecomptable->delai_reglement }}" class="form-control" id="contact" placeholder="Entrer un delai reglement" aria-label="Entrer un delai reglement">
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
                <input type="text" name="echeance" required value="{{ $fournisseurfacturecomptable->echeance }}" class="form-control" id="echeance" placeholder="Entrer une echeance" aria-label="Entrer une echeance">
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
                <input type="number" min="1" name="total_payer" value="{{ $fournisseurfacturecomptable->total_payer }}" class="form-control" required id="total_payer" placeholder="Entrer le montant de la facture" aria-label="Entrer le montant de la facture">
                @error('total_payer') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Associer une facture (fichier) (facultative)</div>
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
                  <div class="flex-grow-1">Associer un bon (fichier) (facultative)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="bon" class="visually-hidden form-label">Associer une bon (fichier) (facultative)</label>
                <input type="file" name="bon" value="{{ old('bon') }}" class="form-control" id="bon" placeholder="choisir un un">
                @error('bon') <span class="text-danger">{{ $message }}</span> @enderror
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

  <div class="modal fade" id="deletefournisseurfacturecomptable{{ $fournisseurfacturecomptable->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer la facture <span class="text-warning">{{ $fournisseurfacturecomptable->numero_facture }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('commun.fournisseurfacturecomptable.destroy', $fournisseurfacturecomptable) }}" method="POST">
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