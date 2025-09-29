  <div class="modal fade" id="devisPrestationUpdate{{ $clientdevisprestation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header --> 
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
             Modifier la prestation de service <span class="text-danger">{{ $clientdevisprestation->designation }}</span>
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('commun.clientdevis.prestation.update', $clientdevisprestation) }}" enctype="multipart/form-data">
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
                <label for="designation" class="visually-hidden form-label">Désignation</label>
                <textarea name="designation" id="designation" class="form-control" placeholder="Entrer une designation" required>{{ $clientdevisprestation->designation }}</textarea>
                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
        
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Nombre de passage</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nbre_passage" class="visually-hidden form-label">Nombre de passage</label>
                <input type="number" min="1" name="nbre_passage" required value="{{ $clientdevisprestation->nbre_passage }}" class="form-control" id="nbre_passage" placeholder="Entrer le nombre de passage">
                @error('nbre_passage') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Prix unitaire</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prix_unitaire" class="visually-hidden form-label">Prix unitaire</label>
                <input type="number" min="1" name="prix_unitaire" required value="{{ $clientdevisprestation->prix_unitaire }}" class="form-control" id="prix_unitaire" placeholder="Entrer le prix unitaire">
                @error('prix_unitaire') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4 d-none">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Quantité</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="quantite" class="visually-hidden form-label">Quantité</label>
                <input type="number" min="1" name="quantite" value="{{ $clientdevisprestation->quantite }}" class="form-control" id="quantite" placeholder="Entrer la quantité">
                @error('quantite') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Unité de prestation</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="unite" class="visually-hidden form-label">Unité de vente ou de prestation</label>
                <select name="unite" class="form-control" autocomplete="off" id="unite" data-hs-tom-select-options='{
                          "searchInDropdown": false,
                          "hideSearch": true,
                          "placeholder": "Select category"
                        }'>
                  <option value="{{ $clientdevisprestation->unite }}">@if($clientdevisprestation->unite) {{ $clientdevisprestation->unite }} @else Aucune @endif</option>
                  <option value="L">L</option>
                  <option value="KG">KG</option>
                  <option value="">Aucune</option>
                  <option value="Pièce">Pièce</option>
                  <option value="Carton">Carton</option>
                  <option value="Boîte">Boîte</option>
                  <option value="Sac">Sac</option>
                  <option value="Paquet">Paquet</option>
                </select>
                @error('unite') <span class="text-danger">{{ $message }}</span> @enderror
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

  <div class="modal fade" id="devisPrestationDelete{{ $clientdevisprestation->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">Voulez-vous vraiment supprimer la prestation de service <span class="text-danger">{{ $clientdevisprestation->designation }}</span> ??</p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('commun.clientdevis.prestation.destroy', $clientdevisprestation) }}" method="POST">
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