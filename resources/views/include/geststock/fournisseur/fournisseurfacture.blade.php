
  <div class="modal fade" id="editFF{{ $fournisseurfacture->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">
            Modifier la facture <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span> 
            du fournisseur <span class="text-danger">{{ $fournisseurfacture->fournisseur->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('geststock.fournisseurfacture.update', $fournisseurfacture) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
                <input type="number" name="frais" value="{{ $fournisseurfacture->frais }}" class="form-control" id="nom" aria-label="">
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
                <input type="text" name="delai_livraison" value="{{ $fournisseurfacture->delai_livraison }}" class="form-control" id="delai_livraison" aria-label="Entrer un prenom">
                @error('delai_livraison') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>

            <!-- @if(auth()->user()->role) -->
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">AIRSI (en %)</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="airsi" class="visually-hidden form-label">AIRSI</label>
                  <input type="number" min="1" max="100" name="airsi" value="{{ $fournisseurfacture->airsi }}" class="form-control" id="airsi" placeholder="Entrer l'AIRSI">
                  @error('airsi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>            
              <div class="row mb-4">
                <div class="col-sm-3 mb-2 mb-sm-0">
                  <div class="d-flex align-items-center mt-2">
                    <i class="bi-people nav-icon"></i>
                    <div class="flex-grow-1">Montant de Timbre</div>
                  </div>
                </div>
                <div class="col-sm">
                  <label for="timbre_montant" class="visually-hidden form-label">Timbre</label>
                  <input type="number" name="timbre_montant" value="{{ $fournisseurfacture->timbre_montant }}" class="form-control" id="timbre_montant" placeholder="Entrer le montant de la timbre">
                  @error('timbre_montant') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
              </div>
            <!-- @endif -->
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <input type="text" name="timbre_montant" value="{{ $fournisseurfacture->delai_paiement }}" class="form-control" id="delai_paiement" placeholder="Entrer le delai de paiement">
                @error('delai_paiement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <hr>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nouveau bon de commande (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="bon" class="visually-hidden form-label">Nouveau bon de commande (facultatif)</label>
                <input type="file" name="bon" class="form-control" id="bon">
                @error('bon') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nouvelle facture (facultatif)</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="facture" class="visually-hidden form-label">Nouvelle facture (facultatif)</label>
                <input type="file" name="facture" class="form-control" id="facture">
                @error('facture') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

          </div>

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

  <div class="modal fade" id="infoFF{{ $fournisseurfacture->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Infos sur <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span> du fournisseur <span class="text-danger">{{ $fournisseurfacture->fournisseur->nom }}</span></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

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
                <input type="text" name="frais" value="{{ getpricefr($fournisseurfacture->frais) }}" class="form-control" id="frais" readonly>
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
                <input type="text" name="delai_livraison" value="{{ $fournisseurfacture->delai_livraison }}" class="form-control" id="delai_livraison" readonly>
                @error('delai_livraison') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">AIRSI</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="airsi" class="visually-hidden form-label">AIRSI</label>
                <input type="text" name="airsi" value="@if($fournisseurfacture->airsi) {{ $fournisseurfacture->airsi }}% @endif" class="form-control" id="airsi" readonly>
                @error('airsi') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">AIRSI Montant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="airsi_montant" class="visually-hidden form-label">AIRSI</label>
                <input type="text" name="airsi_montant" value="{{ getpricefr($fournisseurfacture->airsi_montant) }}" class="form-control" id="airsi" readonly>
                @error('airsi_montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Timbre Montant</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="timbre_montant" class="visually-hidden form-label">Timbre</label>
                <input type="text" name="timbre_montant" value="{{ getpricefr($fournisseurfacture->timbre_montant) }}" class="form-control" id="timbre_montant" readonly>
                @error('timbre_montant') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Délai de paiement</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <input type="text" name="delai_paiement" value="{{ $fournisseurfacture->delai_paiement }}" class="form-control" id="delai_paiement" readonly>
                @error('delai_paiement') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Créateur de la facture</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="delai_paiement" class="visually-hidden form-label">Délai de paiement</label>
                <input type="text" name="commercial" value="@if($fournisseurfacture->rgeststock_id) {{ $fournisseurfacture->rgeststock->nom }} {{ $fournisseurfacture->rgeststock->prenom }} @else Comptabilité @endif" class="form-control" id="commercial" readonly>
                @error('commercial') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
          </div>
          <!-- End Footer -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteFF{{ $fournisseurfacture->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
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
            <p class="fw-bold mb-0">
              Voulez-vous vraiment supprimer la facture 
              <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span> 
              du fournisseur <span class="text-danger">{{ $fournisseurfacture->fournisseur->nom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <form action="{{ route('geststock.fournisseurfacture.destroy', $fournisseurfacture) }}" method="POST">
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

  <div class="modal fade" id="confirmeConformiteFF{{ $fournisseurfacture->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">Confirmation validation</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <p class="fw-bold mb-0">
                Voulez-vous vraiment @if($fournisseurfacture->isvalide) annuler la confirmation de @else Confirmer @endif
                la conformité de la facture <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span> 
                du fournisseur <span class="text-danger">{{ $fournisseurfacture->fournisseur->nom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
                <div class="col-sm-auto">
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Non</button>
                        <a href="{{ route('geststock.fournisseur.facture.confirme.conformite', $fournisseurfacture) }}" class="btn btn-primary">Oui</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmeReceptionFF{{ $fournisseurfacture->id }}" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger" id="createAKIKeyModalLabel">Confirmation validation</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="modal-body">
            <p class="fw-bold mb-0">
                Voulez-vous vraiment @if($fournisseurfacture->livraison) annuler la confirmation de @else confirmer @endif
                la reception de la facture <span class="text-danger">{{ $fournisseurfacture->numero_facture }}</span> 
                du fournisseur <span class="text-danger">{{ $fournisseurfacture->fournisseur->nom }}</span> ??
            </p>
        </div>
        <!-- End Body -->

        <!-- Footer -->
        <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
                <div class="col-sm-auto">
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Non</button>
                        <a href="{{ route('geststock.fournisseur.facture.confirme.reception', $fournisseurfacture) }}" class="btn btn-primary">Oui</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>