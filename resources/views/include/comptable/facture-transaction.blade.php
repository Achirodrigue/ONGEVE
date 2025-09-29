
  <div class="modal fade" id="editfournisseurfct{{ $fournisseurfct->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la facture <span class="text-danger">{{ $fournisseurfacturecomptable->numero_facture }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('comptable.fournisseur.facture.transaction.update', $fournisseurfacturecomptable) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <!-- Body -->
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Reference de la transaction</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="reference" class="visually-hidden form-label">Reference de la transaction</label>
                <input type="text" minlength="1" name="reference" value="{{ $fournisseurfct->reference }}" class="form-control" id="reference" placeholder="Entrer la reference de la transaction" required>
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Montant de la transaction</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="montant" class="visually-hidden form-label">Montant de la transaction</label>
                <input type="number" min="1" name="montant" value="{{ $fournisseurfct->montant }}" class="form-control" id="montant" placeholder="Entrer le montant de la transaction" required>
                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Décaissement</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="decaissement" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                      <option value="{{ $fournisseurfct->decaissement }}">{{ $fournisseurfct->decaissement }}</option>
                      <option value="Espèce">Espèce</option>
                      <option value="Chèque">Chèque</option>
                      <option value="Virement">Virement</option>
                      <option value="Money">Money</option>
                  </select>
                </div>
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

  <div class="modal fade" id="deletefournisseurfct{{ $fournisseurfct->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer la transaction de <span class="text-warning">{{ $fournisseurfct->montant }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('comptable.fournisseur.facture.transaction.destroy', $fournisseurfct) }}" method="POST">
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