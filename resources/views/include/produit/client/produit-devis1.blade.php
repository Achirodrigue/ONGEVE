  <div class="modal fade" id="addProdDevis{{ $produit->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajout de <span class="text-warning">{{ $produit->nom }}</span> à <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('commercial.devis.client.store.deux', ['clientdevis'=>$clientdevis, 'produit'=>$produit]) }}" enctype="multipart/form-data">
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
                <input type="number" name="quantite" value="{{ old('quantite') }}" id="nom" min="1" max="{{ $produit->qtyStock }}" class="form-control" placeholder="quantité du produit à ajouter" required>
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>

            <h5 class="modal-title mb-3">Remise si neccessaire (facultatif)</h5>
            @if(!auth()->user()->role)<h6 class="modal-title mb-3">Plafond remise : {{ auth()->user()->premise }}</h6>@endif
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Remise (en %)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Remise en % (facultatif)</label>
                <input type="number" name="remise" value="{{ old('remise') }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit">
                @error('remise') <span class="text-danger">{{ $message }}</span> @enderror
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
                  <button type="submit" class="btn btn-primary">Ajouter</button>
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
