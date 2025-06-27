<div class="modal fade" id="rejetCommandeClient{{ $clientdevis->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="createAKIKeyModalLabel">Motif du rejet de la commande de <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <form method="post" action="{{ route('comptable.rejet.commande.client.store', $clientdevis) }}" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
            <textarea name="motif_rejet" id="" class="form-control" required placeholder="entrer le motif du rejet"></textarea>
            @error('motif_rejet') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
          <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
            <div class="col-sm-auto">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Sortir</button>
                <button type="submit" class="btn btn-primary">Appliquer</button>
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

<div class="modal fade" id="motifRejetCommandeClient{{ $clientdevis->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="createAKIKeyModalLabel">Motif du rejet de la commande de <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <!-- <form method="post" action="{{ route('comptable.rejet.commande.client.store', $clientdevis) }}" enctype="multipart/form-data">
      @csrf -->
        <div class="modal-body">
            <textarea name="motif_rejet" readonly class="form-control" required placeholder="{{ $clientdevis->clientdevisinfo->motif_rejet }}"></textarea>
            <!-- @error('motif_rejet') <span class="text-danger">{{ $message }}</span> @enderror -->
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
          <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
            <div class="col-sm-auto">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Sortir</button>
                <!-- <button type="submit" class="btn btn-primary">Appliquer</button> -->
              </div>
            </div>
          </div>
        </div>
      <!-- </form> -->

    </div>
  </div>
</div>

<div class="modal fade" id="confirmeCommandeClient{{ $clientdevis->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">Confirmation livraison</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <div class="modal-body">
          <p class="fw-bold mb-0">
            Voulez-vous vraiment confirmer que la livraison de 
            <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span> 
            a bien été effectué ??
          </p>
      </div>
      <!-- End Body -->

      <!-- Footer -->
      <form action="{{ route('magasinier.confirme.livraison.commande.client', $clientdevis) }}" method="POST">
      @csrf
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

<div class="modal fade" id="validerClientDevis{{ $clientdevis->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter les infos du devis de <span class="text-warning">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- End Header -->

      <form method="post" action="{{ route('comptable.valider.commande.client.store', $clientdevis) }}" enctype="multipart/form-data">
      @csrf
        <!-- Body -->
        <div class="modal-body">
          
          <div class="row mb-4">
            <div class="col-sm-3 mb-2 mb-sm-0">
              <div class="d-flex align-items-center mt-2">
                <i class="bi-people nav-icon"></i>
                <div class="flex-grow-1">Frais de livraison</div>
              </div>
            </div>
            <div class="col-sm">
              <label for="frais" class="visually-hidden form-label">Frais de livraison</label>
              <input type="text" name="frais" value="{{ $clientdevis->frais }}" class="form-control" id="nom" aria-label="Entrer un nom" required>
              @error('frais') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-sm-3 mb-2 mb-sm-0">
              <div class="d-flex align-items-center mt-2">
                <i class="bi-people nav-icon"></i>
                <div class="flex-grow-1">Délai de livraison</div>
              </div>
            </div>
            <div class="col-sm">
              <label for="delai_livraison" class="visually-hidden form-label">Délai de livraison</label>
              <input type="text" name="delai_livraison" value="{{ $clientdevis->delai_livraison }}" class="form-control" id="delai_livraison" aria-label="Entrer un prenom" required>
              @error('delai_livraison') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer gap-3">
          <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          <button type="submit" id="processEvent" class="btn btn-primary">Appliquer</button>
        </div>
        <!-- End Footer -->
        </form>
    </div>
  </div>
</div>