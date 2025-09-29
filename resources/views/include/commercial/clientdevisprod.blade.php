<!-- Create New Category Modal -->
  <div class="modal fade" id="devisProduitQtyUpdate{{ $clientdevisprod->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Modifier la quantité du produit <span class="text-warning">{{ $clientdevisprod->produit->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('commercial.produit.facture.qty.update', $clientdevisprod) }}" enctype="multipart/form-data">
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
                <input type="number" name="quantite" value="{{ $clientdevisprod->quantite }}" min="1" max="{{ $clientdevisprod->produit->qtyStock }}" id="nom" class="form-control" required>
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            @if($clientdevisprod->produit->TP)
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <div class="flex-grow-1">Nombre de jours</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="nbre_jour" class="visually-hidden form-label">Quantité</label>
                  <input type="number" name="nbre_jour" value="{{ $clientdevisprod->nbre_jour }}" id="nbre_jour" min="1" class="form-control" placeholder="nombre de jours de location" required>
                  @error('nbre_jour') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
            @endif

            <hr>

            <h5 class="modal-title mb-3">Remise si neccessaire @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR) (facultatif) @endif</h5>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Remise (en %)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Remise en % (facultatif)</label>
                @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR)
                  <input type="number" name="remise" step="0.01" value="{{ $clientdevisprod->clientdevisremise->remise }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit" required>
                @else
                  <input type="number" name="remise" step="0.01" value="{{ old('remise') }}" id="nom" min="1" max="99" class="form-control" placeholder="Remise sur le produit">
                @endif
                @error('remise') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            <!-- <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <div class="flex-grow-1">Motif</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="motif" class="visually-hidden form-label">Motif</label>
                <textarea name="motif" id="motif" class="form-control" @if($clientdevisprod->clientdevisremise && !$clientdevisprod->clientdevisremise->TR) placeholder="Motif de la remise" @endif> @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR) {{ $clientdevisprod->clientdevisremise->motif }} @endif</textarea>
                @error('motif') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div> -->
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

  @if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR) 
    <div class="modal fade" id="devisProduitRemise{{ $clientdevisprod->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <!-- Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="createAKIKeyModalLabel">Infos de la remise sur <span class="text-warning">{{ $clientdevisprod->produit->nom }}</span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- End Header -->

          <form method="post" action="#" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
            <!-- Body -->
            <div class="modal-body">
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Date</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="nom" class="visually-hidden form-label">Date</label>
                  <input type="text" value="{{ $clientdevisprod->clientdevisremise->date }}" class="form-control" readonly>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Remise en %</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Remise en %</label>
                  <input type="text" value="{{ $clientdevisprod->clientdevisremise->remise }}" class="form-control" readonly>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Prix remise</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Prix remise</label>
                  <input type="text" value="{{ getprice($clientdevisprod->clientdevisremise->prix_remise) }} F" class="form-control" readonly>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Motif</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">Motif</label>
                  <textarea class="form-control" readonly>{{ $clientdevisprod->clientdevisremise->motif }}</textarea>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-list-ul nav-icon"></i>
                    <div class="flex-grow-1">Commercial</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="prenom" class="visually-hidden form-label">commercial</label>
                  <input type="text" value="@if($clientdevisprod->clientdevisremise->commercial_id) {{ $clientdevisprod->clientdevisremise->commercial->nom }} {{ $clientdevisprod->clientdevisremise->commercial->prenom }} @else Service comptable @endif" class="form-control" readonly>
                </div>
              </div>
            </div>
            <!-- End Body -->

            <!-- Footer -->
            <div class="modal-footer gap-3">
              <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            </div>
            <!-- End Footer -->
            </form>
        </div>
      </div>
    </div>
  @endif

<!-- End Create New API Key Modal -->