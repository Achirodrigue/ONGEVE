

  <div class="modal fade" id="addfournisseurfacture" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une nouvelle facture</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('magasinier.fournisseur.facture.store') }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nombre de produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="produit" class="visually-hidden form-label">Nombre de produit</label>
                <input type="number" min="1" name="produit" value="{{ old('produit') }}" class="form-control" id="produit" placeholder="Indiquer le nombre de produit pour cette facture" required>
                @error('produit') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Fournisseur</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="fournisseur" required class="js-select form-select w-100" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }' required>
                    @foreach(fournisseurs() as $fournisseur)
                      <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                    @endforeach
                  </select>
                </div>
                @error('fournisseur') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Valider</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>