<!-- Create New Category Modal -->
  <div class="modal fade" id="FFProduitQtyUpdate{{ $fournisseurfactureprod->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la quantité du produit <span class="text-warning">{{ $fournisseurfactureprod->produit->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('geststock.fournisseur.facture.edit.produit', $fournisseurfactureprod) }}" enctype="multipart/form-data">
        @csrf
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Quantité</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Quantité</label>
                <input type="number" name="quantite" value="{{ $fournisseurfactureprod->quantite }}" min="1" id="nom" class="form-control" required>
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Montant du produit</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="montant" class="visually-hidden form-label">Montant du produit</label>
                <input type="number" name="montant" value="{{ $fournisseurfactureprod->prix_unitaire }}" id="montant" min="1" class="form-control" required>
                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
              <div class="col-sm-auto">
                <div class="d-flex gap-3">
                  <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Sortir</button>
                  <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- End Footer -->
        </form>

      </div>
    </div>
  </div>

<!-- End Create New API Key Modal -->