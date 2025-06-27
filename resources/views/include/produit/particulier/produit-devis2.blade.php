<!-- Create New Category Modal -->
  <div class="modal fade" id="devisProduitQtyUpdate{{ $particulierdevisprod->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la quantité du produit <span class="text-warning">{{ $particulierdevisprod->produit->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('commercial.produit.devis.particulier.qty.update', $particulierdevisprod) }}" enctype="multipart/form-data">
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
                <input type="number" name="quantite" value="{{ $particulierdevisprod->quantite }}" min="1" max="{{ $particulierdevisprod->produit->qtyStock }}" id="nom" class="form-control" required>
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>

            <h5 class="modal-title mb-3">Remise si neccessaire @if($particulierdevisprod->particulierremise == null) (facultatif) @endif</h5>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Remise (en %)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Remise en % (facultatif)</label>
                @if($particulierdevisprod->particulierremise)
                  <input type="number" name="remise" value="{{ $particulierdevisprod->particulierremise->remise }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit" required>
                @else
                  <input type="number" name="remise" value="{{ old('remise') }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit">
                @endif
                @error('remise') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Motif</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="motif" class="visually-hidden form-label">Motif</label>
                <textarea name="motif" id="motif" class="form-control" @if($particulierdevisprod->particulierremise == null) placeholder="Motif de la remise" @endif> @if($particulierdevisprod->particulierremise != null) {{ $particulierdevisprod->particulierremise->motif }} @endif</textarea>
                @error('motif') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
              <!-- <div class="col-sm mb-2 mb-sm-0">
                <p class="modal-footer-text">What is an API? <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="API stands for application programming interface. It can be helpful to think of the API as a way for different apps to talk to one another."></i></p>
              </div> -->
              <!-- End Col -->

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
