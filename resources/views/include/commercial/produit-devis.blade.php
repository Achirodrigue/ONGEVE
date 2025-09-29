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
        <form method="post" action="{{ route('commercial.facture.client.store.deux', ['clientdevis'=>$clientdevis, 'produit'=>$produit]) }}" enctype="multipart/form-data">
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
            
            @if($produit->TP)
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <div class="flex-grow-1">Nombre de jours</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="nbre_jour" class="visually-hidden form-label">Quantité</label>
                  <input type="number" name="nbre_jour" value="{{ old('nbre_jour') }}" id="nbre_jour" min="1" class="form-control" placeholder="nombre de jours de location" required>
                  @error('nbre_jour') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
            @endif

            <hr>

            <h5 class="modal-title mb-3">Remise si neccessaire (facultatif)</h5>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Remise (en %)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Remise en % (facultatif)</label>
                <input type="number" step="0.01" name="remise" value="{{ old('remise') }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit">
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

  <div class="modal fade" id="editProdPrix{{ $produit->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier le prix de <span class="text-warning">{{ $produit->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header">
          <h5>Prix actuel : <span class="text-success">{{ getpricefr($produit->prix) }}</span></h5>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('commun.produit.prix.update', $produit) }}" enctype="multipart/form-data">
        @csrf
        <!-- @method('PATCH') -->
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Prix (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix" class="visually-hidden form-label">Prix (facultatif)</label>
                <input type="number" name="prix" value="{{ $produit->prix }}" id="prix" class="form-control" placeholder="entrer un prix">
                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Quantité en stock (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="qtyStock" class="visually-hidden form-label">Quantité en stock (facultatif)</label>
                <input type="number" name="qtyStock" value="{{ $produit->qtyStock }}" id="qtyStock" class="form-control" placeholder="entrer quantité en stock">
                @error('qtyStock') <span class="text-danger">{{ $message }}</span> @enderror
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